<?php namespace App\Models\Kpi;

use App\Models\Hris\MS_Department;
use App\Models\Hris\MS_Division;
use App\Models\Hris\MS_Jabatan;
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

    public function getDivisionIdBrowseAttribute()
    {
        $depart = new MS_Division;
        $depart = $depart->detail(['kodeDepartment' => $this->division_id]);

        return $depart->namaDepartment ?? '';
    }

    public function getDivisionIdReadAttribute()
    {
        $depart = new MS_Division;
        $depart = $depart->detail(['kodeDepartment' => $this->division_id]);

        return $depart->namaDepartment ." (". $depart->kodeDepartment .")" ?? '';
    }

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
        $level = new MS_Jabatan;
        $level = $level->detail(['kodeJabatan' => $this->level_id]);

        return $level->namaJabatan ?? '';
    }

    public function getLevelIdReadAttribute()
    {
        $level = new MS_Jabatan;
        $level = $level->detail(['kodeJabatan' => $this->level_id]);

        return $level->namaJabatan ?? '';
    }

}