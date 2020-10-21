<?php namespace App\Models;

use DB;

class ModelInit
{

    public $table = '';
    public $conn = 'default';

    public function table($as = '')
    {
        $table = $this->table;
        $table .= !empty($as) ? " AS $as" : "";
        return DB::connection($this->conn)->table($table);
    }

    public function detail($where)
    {
        return DB::connection($this->conn)->table($this->table)->where($where)->first();
    }

    public function insert($data)
    {
        return $this->table()->insert($data);
    }

    public function insertGetId($data)
    {
        return $this->table()->insertGetId($data);
    }

    public function primaryKeyInc($field, $where = '')
    {
      $query = DB::connection($this->conn)->table($this->table)->orderBy($field, 'DESC');

      if(!empty($where)) $query->where($where);

      $query = $query->first();

      if(empty($query)) return 1;

      return $query->$field + 1;
    }

    public static function pkIncrement($table, $field, $where = '', $conn = 'mysql')
    {
      $query = DB::connection($conn)->table($table)->orderBy($field, 'DESC');

      if(!empty($where)) $query->where($where);

      $query = $query->first();

      if(empty($query)) return 1;

      return $query->$field + 1;
    }

    public static function canIAccess($key)
    {
        $role = \DB::table('permission_role')
                    ->join('permissions', 'permissions.id', '=', 'permission_role.permission_id')
                    ->where('permission_role.role_id', \Auth::user()->role_id)
                    ->where('permissions.key', $key)
                    ->first();

        if(!empty($role)){
            return true;
        }else{
            return false;
        }
    }

    public static function monthName($int)
    {
        switch ($int) 
        {
            case 1:
                return "Januari";
                break;

            case 2:
                return "Februari";
                break;

            case 3:
                return "Maret";
                break;

            case 4:
                return "April";
                break;

            case 5:
                return "Mei";
                break;

            case 6:
                return "Juni";
                break;

            case 7:
                return "Juli";
                break;

            case 8:
                return "Agustus";
                break;

            case 9:
                return "September";
                break;

            case 10:
                return "Oktober";
                break;

            case 11:
                return "Nopember";
                break;

            case 12:
                return "Desember";
                break;
        }
    }

}
