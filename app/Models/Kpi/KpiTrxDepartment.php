<?php namespace App\Models\Kpi;

use App\Models\Hris\MS_Karyawan;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;
use Auth;

class KpiTrxDepartment extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User', 'created_by');
    }
}