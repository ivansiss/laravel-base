<?php

namespace App\Traits;

use App\Models\Role;

trait UserTrait{

    public function roles(){

        return $this->belongsToMany(Role::class,'role_user','user_id', 'role_id')->withTimestamps();
    }

    public function havePermission($permission){
        
        foreach($this->roles as $role){
           //dd($permission);exit;
            if($role['full_access'] == 'yes'){
                 
                return true;
            }

            foreach($role->permissions as $perm){
                if($perm->slug == $permission){
                    return true;
                }
            }
        }
        return false;
 }
}
