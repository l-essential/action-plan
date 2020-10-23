<?php

namespace App\Policies;

use App\User;
use App\Models\Kpi\KpiTrxDepartment;
use Illuminate\Auth\Access\HandlesAuthorization;

class KpiTrxDepartmentPolicy
{
    use HandlesAuthorization;

    public $table_name = 'kpi_trx_departments';

    public function browse_all(User $user)
    {
        return \ModelInit::canIAccess('browse_all_' . $this->table_name);
    }

    /**
     * Determine whether the user can view the kpi form department.
     *
     * @param  \App\User  $user
     * @param  \App\KpiFormDepartment  $kpiFormDepartment
     * @return mixed
     */
    public function view(User $user)
    {
        
    }

    public function cancel(User $user, KpiTrxDepartment $trx)
    {
        return $user->id == $trx->created_by && $trx->kpi_status == 'Draft';
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
