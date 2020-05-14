<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

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

    protected function insertar($r)
    {
        $u = $this;
        $u->name = $r->nombres.' '.$r->apellidos;
        $u->email = $r->nombres[0].$r->apellidos[0].rand(1,9999).'@gmail.com';
        $u->password = bcrypt('123456');
        $u->rol = 2;
        if ($u->save()) {
            return [
                'estado' => true,
                'user' => $u
            ];
        }
        return [
            'estado' => false,
            'user' => null
        ];
    }
}
