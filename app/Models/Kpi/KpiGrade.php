<?php namespace App\Models\Kpi;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class KpiGrade extends Model
{
    use Translatable;
    protected $translatable = ['description'];
}