<?php namespace App\Models\Reker;

use App\Models\Hris\MS_Department;
use App\Models\Hris\MS_Karyawan;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;
use Auth;

class Reker extends Model
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
        $periode = session('periode_'.$item->periode_id) == 'Y';
        
        if( $can_access && $item->created_by == Auth::user()->id && $periode ){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function canIEdit($item)
    {
        if( \ModelInit::canIAccess('edit_'.$this->getTable()) && $item->created_by == Auth::user()->id && session('periode_'.$item->periode_id) == 'Y' ){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function getPicReadAttribute()
    {
        $objTrxPic = new RekerPic();

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
        $objTrxDepart = new RekerDepartment();

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

}