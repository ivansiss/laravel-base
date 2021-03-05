<?php

namespace App\Models;

use App\Models\Post;
use App\Models\TipoImagen;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Video extends Model
{
    use HasFactory;

    protected $table = 'videos';
    protected $appends = ['fecha_formateada', 'tipo_video'];


    protected $fillable = [
        'id', 'titulo', 'miniatura', 'descripcion', 'link', 'visible', 'tipo_id', 'size', 'orden', 'created_at', 'updated_at'
    ];
    
    public function tipoVideo(){
        return $this->belongsTo(TipoVideo::class, 'tipo_id', 'id' );
    }

    public function getFechaFormateadaAttribute(){
        return optional($this->created_at)->format('d-n-Y');
    }

    public function getTipoVideoAttribute(){
            
        if($this->tipoVideo()->first()){
            return $this->attributes['tipo_video'] = $this->tipoVideo()->first(); 
        }

        return null;
             
    }
}
