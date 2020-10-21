<?php namespace App\Models\Hris;

use App\Models\ModelInit;

class MS_Karyawan extends ModelInit
{

    public $table = 'MS_Karyawan';
    public $conn = 'hris';

    public function nonResign()
    {
        return $this->table()
                    ->orderBy('namaKaryawan')
                    ->whereRaw('tglPengunduranDiri IS NULL');
    }

    public function myData()
    {
        return $this->detail(['NIK' => \Auth::user()->nik]);
    }

}