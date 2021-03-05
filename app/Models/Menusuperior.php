<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menusuperior extends Model
{
    use HasFactory;
    
    protected $table = "menusup";

    protected $fillable = [
        'btn', 'route', 'padre', 'icono', 'orden', 'activado', 'tipo'
    ];

    public static function menuSup($tipo)
    {
        $menu = new Menusuperior();
        $data= $menu->optionsMenu($tipo);

        $menuAll = [];
        foreach ($data as $line) {
            $item = [ array_merge($line, ['submenu' => $menu->getChildren($data, $line) ]) ];
            $menuAll = array_merge($menuAll, $item);
        }
        return $menu_sup = $menuAll;
    }

    public function optionsMenu($tipo)
    {
        return $this->where('activado', 1)->where('tipo', $tipo)
            ->orderby('padre')
            ->orderby('orden')
            ->orderby('btn')
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
