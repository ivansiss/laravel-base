<?php

namespace App\Policies;

use App\Models\Role;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $usera
     * @return mixed
     */
    public function viewAny(User $usera)
    {
        
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $usera
     * @param  \App\Models\Models\Role  $role
     * @return mixed
     */
    public function view(User $usera, Role $role)
    {
      //para saber si esta utentificado 
        //return $usera->id > 0;
        //si el usuario autenticado es igual al usuario que queremos ver es true
        return $usera->id === $role->id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $usera
     * @return mixed
     */
    public function create(User $usera)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $usera
     * @param  \App\Models\Models\Role  $role
     * @return mixed
     */
    public function update(User $usera, Role $role)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $usera
     * @param  \App\Models\Models\Role  $role
     * @return mixed
     */
    public function delete(User $usera, Role $role)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $usera
     * @param  \App\Models\Models\Role  $role
     * @return mixed
     */
    public function restore(User $usera, Role $role)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $usera
     * @param  \App\Models\Models\Role  $role
     * @return mixed
     */
    public function forceDelete(User $usera, Role $role)
    {
        //
    }
}
