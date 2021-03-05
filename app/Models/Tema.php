<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tema extends Model
{

    use HasFactory;

    protected $table = 'temas';
    protected $fillable = [
        'pagina', 'color_primario', 'color_puente', 'color_secundario', 'size_titulo', 'size_subtitulo', 'size_texto', 'family', 'color_letra', 'tablero', 'tablero_letra'
    ];
    
}
