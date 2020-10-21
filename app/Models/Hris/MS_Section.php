<?php namespace App\Models\Hris;

use App\Models\ModelInit;

class MS_Section extends ModelInit
{

    public $table = 'MS_Divisi';
    public $conn = 'hris';

    public function getSectionNameByNik($nik)
    {
        $employee = new MS_Karyawan;
        $employee = $employee->detail(['NIK' => $nik]);

        if(!empty($employee))
        {
            $section = $this->detail(['kodeDivisi' => $employee->kodeDivisi]);

            if(!empty($section)){
                return $section->namaDivisi;
            }
        }
    }

}