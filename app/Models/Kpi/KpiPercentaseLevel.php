<?php namespace App\Models\Kpi;

use App\Models\Hris\Tbl_Level;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class KpiPercentaseLevel extends Model
{

    use Translatable;
    protected $translatable = ['description'];

    public function getLevelIdBrowseAttribute()
    {
        $level = new Tbl_Level;
        $level = $level->detail(['kode_level' => $this->level_id]);

        return $level->nama_level;
    }

    public function getLevelIdReadAttribute()
    {
        $level = new Tbl_Level;
        $level = $level->detail(['kode_level' => $this->level_id]);

        return $level->nama_level;
    }

}