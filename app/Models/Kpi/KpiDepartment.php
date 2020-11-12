<?php namespace App\Models\Kpi;

use App\Models\Hris\MS_Department;
use App\Models\Hris\MS_Karyawan;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;
use Auth;

class KpiDepartment extends Model
{
    use Translatable;
    protected $translatable = ['kpi_name', 'description'];
    // public $additional_attributes = ['kpi_notes_value'];

    // public function getDepartNameAttribute()
    // {
    //     $departs = new MS_Department;
    //     $departs = $departs->table()->get();

    //     foreach ($departs as $key => $value) 
    //     {
    //         if($value->KodeSeksi == $this->department_id){
    //             return $value->namaSeksi;
    //         }
    //     }
    // }

    public function getDepartmentIdBrowseAttribute()
    {
        $depart = new MS_Department;
        $depart = $depart->detail(['KodeSeksi' => $this->department_id]);

        if(!empty($depart)){
            return $depart->namaSeksi ." (". $depart->KodeSeksi .")" ?? '';   
        }else{
            return "";
        }
    }

    public function getDepartmentIdReadAttribute()
    {
        $depart = new MS_Department;
        $depart = $depart->detail(['KodeSeksi' => $this->department_id]);

        return $depart->namaSeksi ." (". $depart->KodeSeksi .")" ?? '';
    }

    public function scopeCurrentUser($query)
    {
        if( Auth::user()->cannot('browse_all', $this) )
        {
            $employee = new MS_Karyawan;
            $employee = $employee->detail(['NIK' => Auth::user()->nik]);

            return $query->where('department_id', $employee->KodeSeksi);
        }

        return null;
    }

}