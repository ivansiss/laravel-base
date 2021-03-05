<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pie extends Model
{
    use HasFactory;

    protected $table = 'footer';
    protected $appends = ['fecha_formateada'];


    protected $fillable = [
        'empresa', 'texto', 'novedades1', 'novedades2', 'novedades3', 'enlace1', 'enlace2', 'enlace3', 'direccion', 'email', 'telefono', 'fax', 'horario', 'created_at', 'updated_at'
    ];
    
    public function getFechaFormateadaAttribute(){
        return optional($this->updated_at)->format('d-n-Y');
    }
}
