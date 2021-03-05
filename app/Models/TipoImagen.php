<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoImagen extends Model
{
    use HasFactory;
    protected $table = 'tipo_imagens';

    protected $fillable = [
        'title'
    ];

    public function imagenes(){
        return $this->hasMany(Image::class, 'id', 'tipo_id' );
    }

}
