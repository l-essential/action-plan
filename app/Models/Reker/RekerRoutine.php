<?php namespace App\Models\Reker;

use App\Models\Hris\MS_Department;
use App\Models\Hris\MS_Karyawan;
use App\User;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;
use Auth;

class RekerRoutine extends Model
{

    public function primaryKeyInc()
    {
        $table = $this->orderBy('id', 'desc')
                    ->first();

        if( empty($table->id) ){
            return 1;
        }else{
            return $table->id + 1;
        }
    }

    public function canIDelete($item)
    {
        $can_access = \ModelInit::canIAccess('delete_'.$this->getTable());
        $periode = session('periode_'.$item->periode_id) == 'N';

        if( $can_access && $item->created_by == Auth::user()->id && $periode ){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function canIEdit($item)
    {
        if( \ModelInit::canIAccess('edit_'.$this->getTable()) && $item->created_by == Auth::user()->id && session('periode_'.$item->periode_id) == 'N' ){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function getPicReadAttribute()
    {
        $objTrxPic = new RekerRoutinePic();

        $details = $objTrxPic->where('id', $this->id)
                            ->get();

        $return_str = "";
        foreach ($details as $key => $value) 
        {
            $objEmp = new MS_Karyawan;
            $employee = $objEmp->table()->where("NIK", $value->nik)->first();
            $return_str .= $employee->namaKaryawan;

            if( ($key+1) != count($details) ){
                $return_str .= ", ";
            }
        }

        return $return_str;
    }

    public function getPicDepartmentReadAttribute()
    {
        $objTrxDepart = new RekerRoutineDepartment();

        $details = $objTrxDepart->where('id', $this->id)
                            ->get();

        $return_str = "";
        foreach ($details as $key => $value) 
        {
            $objDepart = new MS_Department;
            $depart = $objDepart->table()->where("KodeSeksi", $value->department_id)->first();
            $return_str .= $depart->namaSeksi;

            if( ($key+1) != count($details) ){
                $return_str .= ", ";
            }
        }

        return $return_str;
    }

    public function getCreatedByReadAttribute()
    {
        $objUser = new User;
        $objUser = $objUser::find($this->created_by);

        $objEmp = new MS_Karyawan;
        $objEmp = $objEmp->detail(['NIK' => $objUser->nik]);

        return $objEmp->namaKaryawan;
    }

    public function getDepartmentIdReadAttribute()
    {
        $objDepart = new MS_Department;
        $depart = $objDepart->table()->where("KodeSeksi", $this->department_id)->first();
        return !empty($depart->namaSeksi) ? $depart->namaSeksi : '';
    }

    public function getDepartmentIdEditAttribute()
    {
        $objDepart = new MS_Department;
        $depart = $objDepart->table()->where("KodeSeksi", $this->department_id)->first();
        return !empty($depart->namaSeksi) ? $depart->namaSeksi : '';
    }

}