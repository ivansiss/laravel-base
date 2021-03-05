<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cat = new Category();

        $cat->id = 1;
        $cat->title = 'post';
        $cat->url_clean = 'post';
        
        $cat->save();

        $cat = new Category();

        $cat->id = 2;
        $cat->title = 'carrousel';
        $cat->url_clean = 'carrousel';
        
        $cat->save();

        $cat = new Category();

        $cat->id = 3;
        $cat->title = 'imagen sola';
        $cat->url_clean = 'imagen1';
        
        $cat->save();

        $cat = new Category();

        $cat->id = 4;
        $cat->title = 'grid';
        $cat->url_clean = 'grid';
        
        $cat->save();

        $cat = new Category();

        $cat->id = 5;
        $cat->title = '3 imagenes';
        $cat->url_clean = 'imagenes3';
        
        $cat->save();
    }
}
