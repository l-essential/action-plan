<?php

namespace App\Policies;

use App\User;
use App\Models\Kpi\KpiFormDepartment;
use Illuminate\Auth\Access\HandlesAuthorization;

class KpiFormDepartmentPolicy
{
    use HandlesAuthorization;

    public $table_name = 'kpi_trx_departments';

    /**
     * Determine whether the user can view the kpi form department.
     *
     * @param  \App\User  $user
     * @param  \App\KpiFormDepartment  $kpiFormDepartment
     * @return mixed
     */
    public function view(User $user, KpiFormDepartment $kpiFormDepartment)
    {
        //
    }

    /**
     * Determine whether the user can create kpi form departments.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return \ModelInit::canIAccess('create_' . $this->table_name);
    }

    /**
     * Determine whether the user can update the kpi form department.
     *
     * @param  \App\User  $user
     * @param  \App\KpiFormDepartment  $kpiFormDepartment
     * @return mixed
     */
    public function update(User $user, KpiFormDepartment $kpiFormDepartment)
    {
        //
    }

    /**
     * Determine whether the user can delete the kpi form department.
     *
     * @param  \App\User  $user
     * @param  \App\KpiFormDepartment  $kpiFormDepartment
     * @return mixed
     */
    public function delete(User $user, KpiFormDepartment $kpiFormDepartment)
    {
        //
    }

    /**
     * Determine whether the user can restore the kpi form department.
     *
     * @param  \App\User  $user
     * @param  \App\KpiFormDepartment  $kpiFormDepartment
     * @return mixed
     */
    public function restore(User $user, KpiFormDepartment $kpiFormDepartment)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the kpi form department.
     *
     * @param  \App\User  $user
     * @param  \App\KpiFormDepartment  $kpiFormDepartment
     * @return mixed
     */
    public function forceDelete(User $user, KpiFormDepartment $kpiFormDepartment)
    {
        //
    }
}
