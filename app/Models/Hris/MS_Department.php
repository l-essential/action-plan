<?php namespace App\Models\Hris;

use App\Models\ModelInit;

class MS_Department extends ModelInit
{

    public $table = 'MS_Seksi';
    public $conn = 'hris';

    public function getDepartByNik($nik)
    {
        $employee = new MS_Karyawan;
        $employee = $employee->detail(['NIK' => $nik]);

        if(!empty($employee))
        {
            $department = new MS_Department;
            $department = $department->detail(['KodeSeksi' => $employee->KodeSeksi]);

            if(!empty($department)){
                return $department;
            }
        }
    }

    public function getDepartNameByNik($nik)
    {
        $employee = new MS_Karyawan;
        $employee = $employee->detail(['NIK' => $nik]);

        if(!empty($employee))
        {
            $department = new MS_Department;
            $department = $department->detail(['KodeSeksi' => $employee->KodeSeksi]);

            if(!empty($department)){
                return $department->namaSeksi;
            }
        }
    }

}