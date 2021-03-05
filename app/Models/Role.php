<?php

namespace App\Models;

use App\User;
use App\Models\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';
    protected $fillable = [
        'name', 'slug', 'description', 'full_access', 'orden', 'created_at', 'updated_at'
    ];

    protected $appends = ['fecha_formateada'];

    public function users(){

        return $this->belongsToMany(User::class,'role_user','role_id', 'user_id')->withTimestamps();
    }

    public function permissions(){

        return $this->belongsToMany(Permission::class,'permission_role', 'role_id', 'permission_id')->withTimestamps();
    }

    public function getFechaFormateadaAttribute(){
        $fecha = $this->updated_at->modify('+1 hours');
        return optional($fecha)->format('d-n-Y H:i');
    }
}


