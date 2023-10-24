<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagenUsuario extends Model
{
    use HasFactory;

    protected $fillable = ['url','imageableusu_id','imageableusu_type'];

    protected $table ="imagen_usuario"; 

    public function imageableusu(){
        return $this->morphTo();
    }
}
