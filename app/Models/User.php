<?php

namespace App\Models;


use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use App\Notifications\MyResetPassword;
use App\Notifications\MyVerifyEmail;

use Tymon\JWTAuth\Contracts\JWTSubject;


class User extends Authenticatable implements JWTSubject,MustVerifyEmail
{
    use HasRoles;
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'biografia',
        'email_verified_at',
        'password',
        'red_social_id',
        'foto',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /* public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    } */

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MyResetPassword($token));
    }

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new MyVerifyEmail);
    }

    

    /**
     * relacion de publicaciones guardadas
     *
     * @return mixed
     */
    public function publicacion(){
        return $this->belongsToMany(Publiguardada::class, 'usuario_id');
    }

    /**
     * relacion de comentarios
     *
     * @return mixed
     */
    public function comentario(){
        return $this->hasMany(Comentario::class, 'usuario_id');
    }

    public function adminlte_image()
    {
        return 'https://picsum.photos/300/300';
    }

    /**
     * Relacion con likes 
     */
    public function likes(){
        return $this->hasMany(Like::class, 'usuario_id');
    }

    public function imagenesusu(){
        return $this->morphOne(ImagenUsuario::class, 'imageableusu'); 
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     * @return array
     */
     public function getJWTCustomClaims()
     {
         return [];
     }
}
