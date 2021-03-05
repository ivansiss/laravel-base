<?php

namespace App\Models;

use App\Models\Post;
use App\Models\TipoImagen;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
    use HasFactory;

    protected $table = 'images';
    protected $appends = ['fecha_formateada', 'tipo_imagen'];


    protected $fillable = [
        'id', 'image', 'description', 'link', 'alt', 'visible', 'tipo_id', 'size', 'created_at', 'updated_at'
    ];
    
    public function posts(){

        return $this->belongsToMany(Post::class,'image_post', 'image_id', 'post_id')->withTimestamps();
    }

    public function tarjetas(){

        return $this->belongsToMany(Post::class,'image_tarjeta', 'image_id', 'tarjeta_id')->withTimestamps();
    }

    public function products(){

        return $this->belongsToMany(Product::class,'image_product', 'image_id', 'producto_id')->withTimestamps();
    }

    public function tipoImagen(){
        return $this->belongsTo(TipoImagen::class, 'tipo_id', 'id' );
    }

    public function getFechaFormateadaAttribute(){
        return optional($this->created_at)->format('d-n-Y');
    }

    public function getTipoImagenAttribute(){
            
        if($this->tipoImagen()->first()){
            return $this->attributes['tipo_imagen'] = $this->tipoImagen()->first(); 
        }

        return null;
             
    }
}
