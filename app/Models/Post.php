<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Image;

class Post extends Model
{
    use HasFactory;
    protected $appends = ['mis_imagenes', 'fecha_formateada'];

    protected $fillable = [
        'orden', 'title', 'subtitulo', 'url_clean', 'content', 'posted', 'category_id', 'created_at', 'updated_at'
    ];

    public function categories(){
        return $this->belongsTo(Category::class)->withTimestamps();
    }

    public function images(){
        return $this->belongsToMany(Image::class,'image_post', 'post_id', 'image_id')->withTimestamps();
    }

    public function getMisImagenesAttribute(){
        
        if($this->images){
            return optional($this->images);
        }
        return ;
    }

    public function getFechaFormateadaAttribute(){
        return optional($this->updated_at)->format('d-n-Y H:i');
    }

}
