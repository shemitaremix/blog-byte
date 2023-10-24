<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publiguardada extends Model
{
    use HasFactory;

    protected $fillable = ['id','publicaciones_id','usuario_id','estatus'];

    public function publicacion(){
        return $this->hasMany(Publicaciones::class, "publicaciones_id");
    }

    public function usuario(){
        return $this->hasMany(User::class, "usuario_id");
    }
}
