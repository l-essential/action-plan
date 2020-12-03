<?php namespace App\Models\Kpi;

use App\Models\Hris\MS_Karyawan;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;
use Auth;

class KpiTrxPersonal extends Model
{

    public function user()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    // public function produktivitas($NIK,$periode1,$periode2){
    //     $this->db->select('count(distinct tanggalTidakMasuk) as total, namaTidakHadir,tanggalTidakMasuk');
    //     $this->db->from('TR_AbsenTidakMasuk');
    //     $this->db->join('MS_TidakHadir', 'TR_AbsenTidakMasuk.kodeTidakHadir = MS_TidakHadir.kodeTidakHadir', 'LEFT');
    //     $this->db->where('NIK',$NIK);
    //     $this->db->where('tanggalTidakMasuk >=',$periode1);
    //     $this->db->where('tanggalTidakMasuk <=',$periode2);
    //     $this->db->where("(TR_AbsenTidakMasuk.kodeTidakHadir='S' OR TR_AbsenTidakMasuk.kodeTidakHadir='I' OR TR_AbsenTidakMasuk.kodeTidakHadir='A' OR TR_AbsenTidakMasuk.kodeTidakHadir='C' OR TR_AbsenTidakMasuk.kodeTidakHadir='IPC' OR TR_AbsenTidakMasuk.kodeTidakHadir ='CK')", NULL, FALSE);
    //     $this->db->group_by('namaTidakHadir');
    //     $this->db->group_by('tanggalTidakMasuk');
    //     $query = $this->db->get();
    //     return $query->result();    
    //  }

}