<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    use HasFactory;

     /**
     * Relacion polimorfica 
     * 
     * @return \Illuminate\Database\Eloquent\Relations\morphto
     */

     protected $fillable = ['url'];

    public function imageable(){
        return $this->morphTo();
    }
}
