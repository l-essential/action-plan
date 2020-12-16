<?php namespace App\Models;

use App\Models\Hris\MS_Department;
use App\Models\Hris\MS_Karyawan;
use App\User;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class Cascade extends Model
{

    public function getCreatedByBrowseAttribute()
    {
        $objUser = new User;
        $user = $objUser->find($this->created_by);
        return !empty($user->name) ? $user->name : '';
    }

    public function getCreatedByReadAttribute()
    {
        $objUser = new User;
        $user = $objUser->find($this->created_by);
        return !empty($user->name) ? $user->name : '';
    }

}