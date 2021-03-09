<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Seo extends Model
{
    use HasFactory;

    protected $table = 'seo';
    protected $appends = ['fecha_formateada'];


    protected $fillable = [
        'pagina', 'titulo', 'title', 'description', 'h1', 'h2', 'orden', 'extra', 'created_at', 'updated_at'
    ];
    
    public function getFechaFormateadaAttribute(){
        return optional($this->updated_at)->format('d-n-Y');
    }
}
