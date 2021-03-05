<?php

namespace App;


use App\Traits\UserTrait;

use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;



class User extends Authenticatable
{
    use Notifiable, UserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';
    protected $fillable = [
        'name', 'email', 'email_verified_at', 'orden', 'estado', 'remember_token', 'password',
    ];

    protected $appends = ['fecha_formateada', 'verif_email'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getFechaFormateadaAttribute(){
        $fecha = $this->updated_at->modify('+1 hours');
        return optional($this->updated_at)->format('d-n-Y H:i');// 
    }

    public function getVerifEmailAttribute(){
        return optional($this->email_verified_at)->format('d-n-Y H:i');// 
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }


    //Hemas creado un trait para no cargar esta clase
    //Creamos en App/Traits/UserTrait.php

   
}
