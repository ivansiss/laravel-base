<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $appends = ['mis_imagenes', 'fecha_formateada'];

    protected $table = 'products';
    protected $fillable = [
        'titulo', 'resena', 'subtitulo', 'contenido', 'pdf', 'precio_ahora', 'precio_antes', 'precio_liquidacion', 'estado', 'stock', 'slug', 'num_ventas', 'orden', 'padre'
    ];

    public function images(){
        return $this->belongsToMany(Image::class,'image_product', 'producto_id', 'image_id')->withTimestamps();
    }

    public function getMisImagenesAttribute(){
        
        if($this->images){
            return optional($this->images);
        }
        return ;
    }

    public function getFechaFormateadaAttribute(){
        return optional($this->created_at)->format('d-n-Y H:i');
    }

    public static function menuLateral()
    {
        $menu = new Product();
        $data= $menu->optionsMenu();

        $menuAll = [];
        foreach ($data as $line) {
            $item = [ array_merge($line, ['submenu' => $menu->getChildren($data, $line) ]) ];
            
            $menuAll = array_merge($menuAll, $item);
        }
        return $menuAll;
    }

    public function optionsMenu()
    {
        return $this->orderby('padre')
            ->orderby('orden')
            ->orderby('titulo')
            ->get()
            ->toArray();
    }

    public function getChildren($data, $line)
    {
        $children = [];
        foreach ($data as $line1) {
            if ($line['id'] == $line1['padre']) {
                $children = array_merge($children, [ array_merge($line1, ['submenu' => $this->getChildren($data, $line1) ]) ]);
            }
        }
        return $children;
    }
   
}