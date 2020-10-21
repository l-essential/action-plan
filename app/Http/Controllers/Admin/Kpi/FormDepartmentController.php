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
        $data['form_kpi_departments'] = $objTrx->orderBy(\DB::raw("CONCAT(kpi_year_from, '-', kpi_month_from)"))
                                            ->get();

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
        return redirect("admin/kpi/form-department/edit?id=". $input['header']['id']);
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
        return redirect("admin/kpi/form-department/edit?id=". $id);
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

            $id_detail = 1;
            foreach ($kpi_name as $id_master => $arr_grade)
            {
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
                } 
            }
        }

        return ['header' => $input, 'detail' => $detail];
    }

}
