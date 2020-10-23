<?php namespace App\Models\Hris;

use App\Models\ModelInit;

class MS_Division extends ModelInit
{

    public $table = 'MS_Department';
    public $conn = 'hris';

    public function getDivisiNameByNik($nik)
    {
        $employee = new MS_Karyawan;
        $employee = $employee->detail(['NIK' => $nik]);

        if(!empty($employee))
        {
            $division = $this->detail(['kodeDepartment' => $employee->kodeDepartment]);

            if(!empty($division)){
                return $division->namaDepartment;
            }
        }
    }

}