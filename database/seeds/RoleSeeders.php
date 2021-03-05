<?php

namespace Database\Seeders;

use App\User;
use App\Models\Role;
use App\Models\Tema;
use App\Models\Permission;
use App\Models\TipoImagen;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RoleSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //truncate Pone la tabla a 
        DB::statement("SET foreign_key_checks=0");
            DB::table('role_user')->truncate();
            DB::table('permission_role')->truncate();
            Permission::truncate();
            Role::truncate();
        DB::statement("SET foreign_key_checks=1");
        

        //Usuario SUPER -------------------------------------------------------------------------------------
        $usersuper= User::where('email', 'ivancogollos@hotmail.com')->first();

        if($usersuper){
            $usersuper->delete();
        }

        $usersuper = User::create([
              'id' =>1,
            'name' => 'Ivan',
            'email' => 'ivancogollos@hotmail.com',
            'email_verified_at' => "2020-10-26 23:01:11",
            'password' => Hash::make('12345'),
            'email' => 'ivancogollos@hotmail.com',
            'orden' => 0,
            'estado' => 1
        ]);
        
        $rolesuper = Role::create([
            'id' =>1,
            'name' => 'Super',
            'slug' => 'super',
            'description' => 'Es el desarrollador',
            'full_access' => 'yes',
            'orden' => '1'
        ]);
        
        $usersuper->roles()->sync([ $rolesuper->id ]);

        //Usuario ADMIN -------------------------------------------------------------------------------------
        $useradmin= User::where('email', 'admin@hotmail.com')->first();

        if($useradmin){
            $useradmin->delete();
        }

        $useradmin = User::create([
            'id' => 2,
            'name' => 'Admin',
            'email' => 'admin@hotmail.com',
            'email_verified_at' => "2020-10-26 23:01:11",
            'password' => Hash::make('12345'),
            'orden' => 1,
            'estado' => 1
        ]);
        
        $roleadmin = Role::create([
              'id' => 2,
            'name' => 'Admin',
            'slug' => 'admin',
            'description' => 'Es el administrador',
            'full_access' => 'no',
            'orden' => '2'
        ]);
        
        $useradmin->roles()->sync([ $roleadmin->id ]);

         //Usuario USER -------------------------------------------------------------------------------------
         $useruser= User::where('email', 'user@hotmail.com')->first();

         if($useruser){
             $useruser->delete();
         }
 
         $useruser = User::create([
             'id' => 3,
             'name' => 'User',
             'email' => 'user@hotmail.com',
             'email_verified_at' => "2020-10-26 23:01:11",
             'password' => Hash::make('12345'),
             'orden' => 2,
             'estado' => 1
         ]);
         
         $roleuser = Role::create([
               'id' => 3, 
             'name' => 'User',
             'slug' => 'user',
             'description' => 'Es el usuario',
             'full_access' => 'no',
             'orden' => '3'
         ]);
         
         $useruser->roles()->sync([ $roleuser->id ]);


         //Permisos -------------------------------------------------------------------------------------
         

         $permission = Permission::create([
            'id' => 2,
            'name' => 'Acceso Clientes',
            'slug' => 'access.users',
            'description' => 'Acceso a clientes',
            'orden' => '0',
         ]);

         $permission = Permission::create([
            'id' => 1,
            'name' => 'Acceso Roles',
            'slug' => 'access.roles',
            'description' => 'Accesos a roles',
            'orden' => '1',
         ]);
         
         $permission = Permission::create([
            'id' => 3,
            'name' => 'Acceso Permisos',
            'slug' => 'access.permissions',
            'description' => 'Acceso a permisos',
            'orden' => '2',
         ]);
         

         $permission = Permission::create([
            'id' => 4,
            'name' => 'Acceso Imagenes',
            'slug' => 'access.images',
            'description' => 'Acceso a imagenes',
            'orden' => '3',
         ]);
         

         $permission = Permission::create([
            'id' => 5,
            'name' => 'Acceso Posts',
            'slug' => 'access.posts',
            'description' => 'Acceso a posts',
            'orden' => '4',
         ]);

         $permission = Permission::create([
            'id' => 6,
            'name' => 'Acceso Descarga Carpeta',
            'slug' => 'access.des.img',
            'description' => 'Este usuario puede descargar imagenes directas de la carpeta',
            'orden' => '5',
         ]);

         $permission = Permission::create([
            'id' => 7,
            'name' => 'Acceso Productos',
            'slug' => 'access.products',
            'description' => 'Acceso a productos',
            'orden' => '6',
         ]);

         $permission = Permission::create([
            'id' => 8,
            'name' => ' Acceso Tablero',
            'slug' => 'tablero.index',
            'description' => 'Acceso a tablero',
            'orden' => '7',
         ]);

         $permission = Permission::create([
            'id' => 9,
            'name' => 'Acceso Imagen nueva',
            'slug' => 'access.new.images',
            'description' => 'Acceso a crear una nueva imagen',
            'orden' => '8',
         ]);

         $permission = Permission::create([
            'id' => 10,
            'name' => 'Acceso Nuevo Post',
            'slug' => 'access.new.posts',
            'description' => 'Accesos a nuevo post',
            'orden' => '9',
         ]);

         $permission = Permission::create([
            'id' => 11,
            'name' => 'Acceso Detalle Post',
            'slug' => 'access.detalle.posts',
            'description' => 'Acceso al detalle del post',
            'orden' => '10',
         ]);

         $permission = Permission::create([
            'id' => 12,
            'name' => 'Acceso Nuevo Producto',
            'slug' => 'access.new.products',
            'description' => 'Acceso a nuevo producto',
            'orden' => '11',
         ]);

         $permission = Permission::create([
            'id' => 13,
            'name' => 'Acceso Editar Producto',
            'slug' => 'access.edit.products',
            'description' => 'Acceso editar producto',
            'orden' => '12',
         ]);

         $permission = Permission::create([
            'id' => 14,
            'name' => 'Paginationlinks',
            'slug' => 'paginationlinks',
            'description' => 'Paginations',
            'orden' => '13',
         ]);

         $permission = Permission::create([
            'id' => 15,
            'name' => 'Paginator',
            'slug' => 'paginator',
            'description' => 'paginator',
            'orden' => '14',
         ]);

         $permission = Permission::create([
            'id' => 16,
            'name' => 'Acceso general',
            'slug' => 'access.general',
            'description' => 'Acceso general',
            'orden' => '15',
         ]);

         $permission = Permission::create([
            'id' => 17,
            'name' => 'Acceso Sidebar',
            'slug' => 'access.sidebar',
            'description' => 'Acceso al sidebar',
            'orden' => '16',
         ]);

         $permission = Permission::create([
            'id' => 18,
            'name' => 'Acceso Pie',
            'slug' => 'access.pie',
            'description' => 'Acceso al footer',
            'orden' => '17',
         ]);

         $permission = Permission::create([
            'id' => 19,
            'name' => 'Acceso Super',
            'slug' => 'access.super',
            'description' => 'Solo puede acceder el super',
            'orden' => '18',
         ]);

         $permission = Permission::create([
            'id' => 20,
            'name' => 'Acceso Páginas',
            'slug' => 'access.paginas',
            'description' => 'Acceso a las páginas',
            'orden' => '19',
         ]);

         $permission = Permission::create([
            'id' => 21,
            'name' => ' Acceso Editar Páginas',
            'slug' => 'access.edit.paginas',
            'description' => 'Acceso a editar página',
            'orden' => '20',
         ]);

         $permission = Permission::create([
            'id' => 22,
            'name' => ' Acceso Nueva Página',
            'slug' => 'access.new.pagina',
            'description' => 'Acceso a nueva página',
            'orden' => '21',
         ]);

         $permission = Permission::create([
            'id' => 23,
            'name' => ' Acceso Menú Superior',
            'slug' => 'access.menu.sup',
            'description' => 'Acceso menu superior',
            'orden' => '22',
         ]);

         $permission = Permission::create([
            'id' => 24,
            'name' => ' Acceso Videos',
            'slug' => 'access.videos',
            'description' => 'Acceso videos',
            'orden' => '23',
         ]);

         $permission = Permission::create([
            'id' => 25,
            'name' => ' Acceso Imágen Portada',
            'slug' => 'access.portada',
            'description' => 'Acceso portada',
            'orden' => '24',
         ]);


         $rolesuper->permissions()->sync( [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25] );
         $roleadmin->permissions()->sync( [2,4,5,7,8,9,10,11,12,13,14,15,16,17,18,20,21,24,25] );
         $roleuser->permissions()->sync( [] );

         
         //tipoImagen -------------------------------------------------------------------------------------
         

         $tipo_imagen = TipoImagen::create([
            'id' => 5,
            'title' => 'icono',
         ]);
       
         $tipo_imagen = TipoImagen::create([
            'id' => 7,
            'title' => 'sello',
         ]);


         $tipo_imagen = TipoImagen::create([
            'id' => 4,
            'title' => 'web',
         ]);


         $tipo_imagen = TipoImagen::create([
            'id' => 3,
            'title' => 'tarifa',
         ]);


         $tipo_imagen = TipoImagen::create([
            'id' => 8,
            'title' => 'logo',
         ]);


         $tipo_imagen = TipoImagen::create([
            'id' => 1,
            'title' => 'producto',
         ]);


         $tipo_imagen = TipoImagen::create([
            'id' => 6,
            'title' => 'color',
         ]);


    }


}
