<?php

namespace App\Http\Controllers\Admin\Kpi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hris\MS_Karyawan;
use App\Models\Kpi\KpiDepartment;
use App\Models\Kpi\KpiTrxDepartment;
use App\Models\Kpi\KpiTrxDepartmentDetail;
use App\User;
use ModelInit;
use Auth;
use DB;

class FormDepartmentController extends Controller
{
    
    public function index()
    {
        # param 
        $data = [];

        $objTrx = new KpiTrxDepartment;
        $query = $objTrx->orderBy(\DB::raw("CONCAT(kpi_year_from, '-', kpi_month_from)"));

        # hak akses
        if( Auth::user()->can('browse_all', KpiTrxDepartment::class) !== true )
        {
            $employee = new MS_Karyawan;
            $employee = $employee->detail(['NIK' => Auth::user()->nik]);

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

        $data['form_kpi_departments'] = $query->get();

        return view('admin/kpi/form-department.browse')->with($data);
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

        # ambil data
        $employee = new MS_Karyawan;
        $obj_jobdesk = new KpiDepartment;
        $data['master_jobdesk'] = $obj_jobdesk
                                    ->orderBy('kpi_order')
                                    ->where('department_id', $employee->myData()->KodeSeksi)
                                    ->get();

        # lempar view
        return view('admin/kpi/form-department.create-edit')->with($data);
    }

    public function edit()
    {
        # param
        $employee = new MS_Karyawan;
        $obj_jobdesk = new KpiDepartment;
        $objTrx = new KpiTrxDepartment;
        $objTrxDtl = new KpiTrxDepartmentDetail;
        $data = [];
        $data['page'] = 'edit';
        $id = app('request')->input('id');

        # ambil data 
        $data['header'] = $objTrx->find($id);
        $data['details_raw'] = $objTrxDtl->where('id', $id)->orderBy('id_detail')->get();
        $data['details_by_key'] = [];
        foreach ($data['details_raw'] as $key => $value) 
        {
            $data['details_by_key'][$value->kpi_department_id][$value->kpi_year."-".$value->kpi_month] = $value;
        }
        $data['master_jobdesk'] = $obj_jobdesk
                                    ->orderBy('kpi_order')
                                    ->where('department_id', $employee->myData()->KodeSeksi)
                                    ->get();
   
        # lempar view
        return view('admin/kpi/form-department.create-edit')->with($data);
    }

    public function save(Request $request)
    {
        # valid form
        $request->validate([
            'kpi_year_from' => 'required',
            'kpi_year_until' => 'required'
        ]);

        # tangkap input
        $objTrx = new KpiTrxDepartment;
        $objTrxDtl = new KpiTrxDepartmentDetail;
        $input = $this->_getInput($request);

        # proses simpan
        DB::beginTransaction();
            $objTrx->insert($input['header']);
            $objTrxDtl->insert($input['detail']);
        DB::commit();

        # alihkan
        $message = ['alert-type' => 'success', "message" => "Berhasil simpan data KPI"];
        return redirect("admin/kpi/form-department/edit?id=". $input['header']['id'])->with($message);
    }

    public function update(Request $request)
    {
        # param 
        $objTrx = new KpiTrxDepartment;
        $objTrxDtl = new KpiTrxDepartmentDetail;
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
        return redirect("admin/kpi/form-department/edit?id=". $id)->with($message);
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
        $objTrx = new KpiTrxDepartment;
        $objEmp = new MS_Karyawan;

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
            $kpi_name = $request->input('kpi_name');

            $grand_bobot = 0;

            $id_detail = 1;
            foreach ($kpi_name as $id_master => $arr_grade)
            {
                $master_kpi = KpiDepartment::find($id_master);
                $summary_value = [];

                foreach ($arr_grade as $year_month => $grade) 
                {
                    $detail[] = [
                        'id' => $input['id'],
                        'id_detail' => $id_detail,
    
                        'kpi_department_id' => $id_master,
                        'kpi_year' => explode("-", $year_month)[0],
                        'kpi_month' => explode("-", $year_month)[1],
                        'kpi_value' => $grade
                    ];

                    $id_detail++;

                    if( is_numeric($grade) ){
                        $summary_value[] = $grade;
                    }
                } 

                if( count($summary_value) > 0 )
                {
                    $avg_value   = (array_sum($summary_value) / count($summary_value));
                    $grand_bobot += $avg_value * ($master_kpi->kpi_percentage / 100);

                    // dd( $avg_value );
                    // dd( ($master_kpi->kpi_percentage / 100) );
                }
            }

            $input['kpi_final_value'] = $grand_bobot;
        }

        return ['header' => $input, 'detail' => $detail];
    }

    public function modal_value_notes()
    {
        # id kpi department 
        $id = app('request')->input('id');

        # data 
        $objMas = new KpiDepartment();
        $data = $objMas->find($id);

        return response()->json([
            'success' => true,
            "data" => $data
        ]);
    }

}
