<?php namespace App\Models\Kpi;

use App\Models\Hris\MS_Department;
use App\Models\Hris\MS_Karyawan;
use App\Models\Hris\Tbl_Level;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;
use Auth;

class KpiPersonalJobdesk extends Model
{
    use Translatable;
    protected $translatable = [
        'job_name', 'description', 
        'kpi_notes_1',
        'kpi_notes_2',
        'kpi_notes_3',
        'kpi_notes_4',
        'kpi_notes_5'
    ];

    public function getDepartmentIdBrowseAttribute()
    {
        $depart = new MS_Department;
        $depart = $depart->detail(['KodeSeksi' => $this->department_id]);

        return $depart->namaSeksi ." (". $depart->KodeSeksi .")" ?? '';
    }

    public function getDepartmentIdReadAttribute()
    {
        $depart = new MS_Department;
        $depart = $depart->detail(['KodeSeksi' => $this->department_id]);

        return $depart->namaSeksi ?? '';
    }

    public function getLevelIdBrowseAttribute()
    {
        $level = new Tbl_Level;
        $level = $level->detail(['kode_level' => $this->level_id]);

        return $level->nama_level ?? '';
    }

    public function getLevelIdReadAttribute()
    {
        $level = new Tbl_Level;
        $level = $level->detail(['kode_level' => $this->level_id]);

        return $level->nama_level ?? '';
    }

}