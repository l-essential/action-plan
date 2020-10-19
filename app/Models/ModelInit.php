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

}
