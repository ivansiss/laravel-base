<?php

use Illuminate\Database\Seeder;
use Database\Seeders\PostSeeders;
use Database\Seeders\RoleSeeders;
use Database\Seeders\MenuSupSeeders;
use Database\Seeders\CategorySeeders;
use Database\Seeders\ImagenesSeeders;
use Database\Seeders\productSeeders;
use Database\Seeders\TemaSeeders;
use Database\Seeders\TarjetaSeeders;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
           $this->call(MenuSupSeeders::class);
           $this->call(RoleSeeders::class);
           $this->call(CategorySeeders::class);
           $this->call(ImagenesSeeders::class);
           $this->call(productSeeders::class);
           $this->call(PostSeeders::class);
           $this->call(TemaSeeders::class);
           $this->call(TarjetaSeeders::class);
    }
}
