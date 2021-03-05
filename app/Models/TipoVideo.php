<<<<<<< HEAD
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoVideo extends Model
{
    use HasFactory;
    protected $table = 'tipo_video';

    protected $fillable = [
        'title'
    ];

    public function videos(){
        return $this->hasMany(Video::class, 'id', 'tipo_id' );
    }

}
=======
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoVideo extends Model
{
    use HasFactory;
    protected $table = 'tipo_video';

    protected $fillable = [
        'title'
    ];

    public function videos(){
        return $this->hasMany(Video::class, 'id', 'tipo_id' );
    }

}
>>>>>>> e82a5fbc1bfb0f06169fa8025500f4026917e1b9
