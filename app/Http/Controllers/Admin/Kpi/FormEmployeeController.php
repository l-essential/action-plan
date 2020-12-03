<?php

namespace App\Http\Controllers\Admin\Kpi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hris\MS_Department;
use App\Models\Hris\MS_Jabatan;
use App\Models\Hris\MS_Karyawan;
use App\Models\Hris\TR_AbsenTidakMasuk;
use App\Models\Kpi\KpiDepartment;
use App\Models\Kpi\KpiTrxDepartment;
use App\Models\Kpi\KpiTrxDepartmentDetail;
use App\Models\Kpi\KpiTrxPersonal;
use App\Models\Kpi\KpiTrxPersonalJobdesk;
use App\Models\Kpi\KpiPersonalJobdesk;
use App\User;
use ModelInit;
use Auth;
use DB;

class FormEmployeeController extends Controller
{
    
    public function index()
    {
        # param 
        $data = [];

        $objTrx = new KpiTrxPersonal();
        $query = $objTrx->orderBy(\DB::raw("CONCAT(kpi_year_from, '-', kpi_month_from)"));

        # hak akses
        if( Auth::user()->can('browse_all', KpiTrxPersonal::class) !== true )
        {
            $employee = new MS_Karyawan;
            $employee = $employee->detail(['NIK' => \Auth::user()->nik]);

            $query->where('department_id', $employee->KodeSeksi);
        }
        else 
        {
            # filter data 
            if( !empty(app('request')->input('department_id')) )
            {
                $query->where('department_id', app('request')->input('department_id'));
            }
        }

        # filter data 
        if( !empty(app('request')->input('periode')) )
        {
            $periode = app('request')->input('periode');
            $periode = explode("_", $periode);
            $period_year_from = explode("-", $periode[0])[0];
            $period_month_from = explode("-", $periode[0])[1];
            $period_year_until = explode("-", $periode[1])[0];
            $period_month_until = explode("-", $periode[1])[1];

            $query->where('kpi_year_from', $period_year_from);
            $query->where('kpi_month_from', $period_month_from);
            $query->where('kpi_year_until', $period_year_until);
            $query->where('kpi_month_until', $period_month_until);
        }

        $data['form_kpi_employees'] = $query->get();

        return view('admin/kpi/form-employee.browse')->with($data);
    }

    public function detail()
    {
        # param
        $employee = new MS_Karyawan;
        $obj_jobdesk = new KpiDepartment;
        $objTrx = new KpiTrxDepartment;
        $objTrxDtl = new KpiTrxDepartmentDetail;
        $data = [];
        $id = app('request')->input('id');

        # ambil data 
        $data['header'] = $objTrx->find($id);

        if( empty($data['header']) )
        {
            return redirect()->back();
        }

        # ambil data part 2
        $data['details'] = $objTrxDtl->select('kpi_department_id')
                                    ->distinct()
                                    ->where('id', $id)
                                    ->orderBy('id_detail')
                                    ->get();
        $data['details_raw'] = $objTrxDtl->where('id', $id)->orderBy('id_detail')->get();
        $data['details_by_key'] = [];
        foreach ($data['details_raw'] as $key => $value) 
        {
            $data['details_by_key'][$value->kpi_department_id][$value->kpi_year."-".$value->kpi_month] = $value;
        }

        # lempar view
        return view('admin/kpi/form-department.detail')->with($data);
    }

    public function create()
    {
        # param 
        $data = [];
        $data['page'] = 'create';

        # lempar view
        return view('admin/kpi/form-employee.create-edit')->with($data);
    }

    public function edit()
    {
        # param
        $objTrx = new KpiTrxPersonal();
        $objTrxJob = new KpiTrxPersonalJobdesk();
        $data = [];
        $data['page'] = 'edit';
        $id = app('request')->input('id');

        # ambil data 
        $data['header'] = $objTrx->find($id);
        $data['details_raw'] = $objTrxJob->where('id', $id)->orderBy('id_detail')->get();
        $data['details_by_key'] = [];
        foreach ($data['details_raw'] as $key => $value) 
        {
            $data['details_by_key'][$value->nik][$value->job_id][$value->kpi_year."-".$value->kpi_month] = $value;
        }

        # ambil data jabatan
        $jabatan = new MS_Jabatan;
        $jabatan = $jabatan->table()->where('kodeJabatan', 'LIKE', $data['header']->department_id . "%")
                        ->orderBy('namaJabatan', 'asc')
                        ->get();
        $jabatan_id = [];
        foreach($jabatan as $kj => $vj)
        {
            $jabatan_id[] = $vj->kodeJabatan;
        }
        $data['jabatans'] = $jabatan;

        # list jobdesk
        $obj_jobdesk = new KpiPersonalJobdesk;
        $master_jobdesk = $obj_jobdesk->whereIn('level_id', $jabatan_id)->get();
        $data['list_jobdesk'] = [];
        foreach($master_jobdesk as $kmj => $vmj)
        {
            if( !empty($data['list_jobdesk'][$vmj->level_id]) ){
                $data['list_jobdesk'][$vmj->level_id][] = $vmj;
            }else{
                $data['list_jobdesk'][$vmj->level_id] = [];
                $data['list_jobdesk'][$vmj->level_id][] = $vmj;
            }
        }

        # list karyawan yang anu ....
        $master_employee = new MS_Karyawan;
        $master_employee = $master_employee->table()
                            ->whereIn('kodeJabatan', $jabatan_id)
                            ->whereRaw('tglPengunduranDiri IS NULL')
                            ->get();
        $data['list_employees'] = [];
        foreach($master_employee as $kme => $vme)
        {
            if( !empty($data['list_employees'][$vme->kodeJabatan]) ){
                $data['list_employees'][$vme->kodeJabatan][] = $vme;
            }else{
                $data['list_employees'][$vme->kodeJabatan] = [];
                $data['list_employees'][$vme->kodeJabatan][] = $vme;
            }
        }

        # ambil data kehadiran
        $form_permohonan = new TR_AbsenTidakMasuk();
        $form_permohonan = $form_permohonan->table('tat')
                                ->select(\DB::raw('COUNT(tat.tanggalTidakMasuk) as total'))
                                ->addSelect('tat.NIK', 'ms_t.namaTidakHadir')
                                ->leftJoin('MS_TidakHadir AS ms_t', 'ms_t.kodeTidakHadir', '=', 'tat.kodeTidakHadir')
                                ->whereYear('tanggalTidakMasuk', '>=', $data['header']->kpi_year_from)
                                ->whereMonth('tanggalTidakMasuk', '>=', $data['header']->kpi_month_from)
                                ->whereYear('tanggalTidakMasuk', '<=', $data['header']->kpi_year_until)
                                ->whereMonth('tanggalTidakMasuk', '<=', $data['header']->kpi_month_until)
                                ->where('NIK', '2019072843')
                                ->whereIn('tat.kodeTidakHadir', [
                                    'S',
                                    'I',
                                    'A',
                                    'C',
                                    'IPC',
                                    'CK'
                                ])
                                ->groupBy(['NIK', 'ms_t.namaTidakHadir'])
                                ->get();
        
        # lempar view
        return view('admin/kpi/form-employee.create-edit')->with($data);
    }

    public function save(Request $request)
    {
        # valid form
        $request->validate([
            'kpi_year_from' => 'required',
            'kpi_year_until' => 'required'
        ]);

        # tangkap input
        $objTrx = new KpiTrxPersonal();
        $objTrxDtl = new KpiTrxPersonalJobdesk();
        $input = $this->_getInput($request);

        # proses simpan
        DB::beginTransaction();
            $objTrx->insert($input['header']);
        DB::commit();

        # alihkan
        $message = ['alert-type' => 'success', "message" => "Berhasil simpan data KPI"];
        return redirect("admin/kpi/form-employee/edit?id=". $input['header']['id'])->with($message);
    }

    public function update(Request $request)
    {
        # param 
        $objTrx = new KpiTrxPersonal;
        $objTrxDtl = new KpiTrxPersonalJobdesk;
        $id = $request->input('id');

        # valid form
        $request->validate([
            'kpi_year_from' => 'required',
            'kpi_year_until' => 'required'
        ]);

        # data before 
        $data['header'] = $objTrx->find($id);

        # tangkap input
        $input = $this->_getInput($request, 'edit');

        # proses simpan
        DB::beginTransaction();
            $objTrx->where('id', $id)->update($input['header']);

            $objTrxDtl->where('id', $id)->delete();
            $objTrxDtl->insert($input['detail']);
        DB::commit();

        # alihkan
        $message = ['alert-type' => 'success', "message" => "Berhasil perbarui data KPI"];
        return redirect("admin/kpi/form-employee/edit?id=". $id)->with($message);
    }

    public function cancel(Request $request, $id)
    {
        # param 
        $objTrx = new KpiTrxDepartment;

        # data sebelum nya 
        $header = $objTrx->find($id);
        
        # valid
        if( Auth::user()->can('cancel', $header) !== true) 
        {
            $message = ['alert-type' => 'error', "message" => "Anda tidak memilik hak akses untuk membatalkan data ini"];
            return redirect()->back()->with($message);
        }

        $objTrx->where('id', $id)->update(['kpi_status' => 'Canceled']);
    }

    public function _getInput($request, $event = 'create')
    {
        $objTrx = new KpiTrxPersonal;
        $objEmp = new MS_Karyawan;
        // .
        if($event == 'create')
        {
            $input['id'] = \ModelInit::pkIncrement($objTrx->getTable(), "id");
            $input['department_id'] = $objEmp->myData()->KodeSeksi;
            $input['created_at'] = date('Y-m-d H:i:s');
            $input['created_by'] = Auth::user()->id;
            $input['kpi_status'] = 'Draft';
        }
        else if($event == 'edit')
        {
            $input['id'] = $request->input('id');
        }

        $raw_periode_from = explode("-", $request->input('kpi_year_from'));
        $input['kpi_year_from'] = $raw_periode_from[0];
        $input['kpi_month_from'] = $raw_periode_from[1];
        $raw_periode_until = explode("-", $request->input('kpi_year_until'));
        $input['kpi_year_until'] = $raw_periode_until[0];
        $input['kpi_month_until'] = $raw_periode_until[1];

        // tinggal ambil detail nya
        $detail = [];

        if($event == 'edit')
        {
            $nik = $request->input('nik');
            $job_id = $request->input('job_id');
            $job_name = $request->input('job_name');
            $kpi_weight = $request->input('kpi_weight');
            $kpi_value = $request->input('kpi_value');

            $jobdesk_custom = $request->input('jobdesk_custom');
            $kpi_weight_custom = $request->input('kpi_weight_custom');
            $kpi_value_custom = $request->input('kpi_value_custom');

            $id_detail = 1;

            foreach($nik as $knik => $vnik)
            {
                if( empty($job_id[$vnik]) ) continue; 

                foreach($job_id[$vnik] as $kjob => $vjob)
                {
                    foreach($kpi_value[$vnik][$vjob] as $k => $v)
                    {
                        if(is_numeric($v) && $v > 5) continue; 
                        
                        $detail[] = [
                            'id' => $input['id'],
                            'id_detail' => $id_detail,
                            
                            'nik' => $vnik,
                            'job_id' => $vjob,
                            'job_name' => $job_name[$vnik][$vjob],
                            'kpi_weight' => $kpi_weight[$vnik][$vjob],
    
                            'kpi_year' => explode("-", $k)[0],
                            'kpi_month' => explode("-", $k)[1],
                            'kpi_value' => $v,
        
                            'is_job_custom' => 'N'
                        ];
    
                        $id_detail++;
                    }
                }

                foreach($jobdesk_custom[$vnik] as $kjob_c => $vjob_c)
                {
                    
                }
            }
        }
        
        return ['header' => $input, 'detail' => $detail];
    }

    public function modal_value_notes()
    {
        # id kpi department 
        $id = app('request')->input('id');

        # data 
        $objMbaMbaJne = new KpiPersonalJobdesk();
        $data = $objMbaMbaJne->find($id);

        return response()->json([
            'success' => true,
            "data" => $data
        ]);
    }

}
