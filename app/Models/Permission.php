<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $table = 'permissions';
    protected $fillable = [
        'name', 'slug', 'description', 'orden', 'created_at', 'updated_at'
    ];
    protected $appends = ['fecha_formateada'];

    public function roles(){

        return $this->belongsToMany(Role::class,'permission_role','role_id', 'permission_id')->withTimestamps();
    }

    public function getFechaFormateadaAttribute(){
        $fecha = $this->updated_at->modify('+1 hours');
        return optional($this->updated_at)->format('d-n-Y H:i');// 
    }
}
