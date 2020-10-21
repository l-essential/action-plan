<?php namespace App\Models\Kpi;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;
use Auth;

class KpiTrxDepartmentDetail extends Model
{
    public function master_kpi()
    {
        return $this->hasOne('App\Models\Kpi\KpiDepartment', 'id', 'kpi_department_id');
    }
}