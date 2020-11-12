<?php namespace App\Models\Reker;

use App\Models\Hris\MS_Department;
use App\Models\Hris\MS_Karyawan;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;
use Auth;

class RekerPeriode extends Model
{

    public $additional_attributes = ['periode'];

    public function getPeriodeAttribute()
    {
        return "{$this->periode_from} s/d {$this->periode_until}";
    }

}