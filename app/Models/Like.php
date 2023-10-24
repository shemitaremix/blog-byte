<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $table = 'likes';
    protected $fillable = [
        'publicaciones_id',
        'usuario_id',
        'likes',
    ];

    /**
     * Relacion de muchos a uno con la tabla publicaciones
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function publicacion()
    {
        return $this->belongsToMany(Publicaciones::class,'likes','id', 'publicaciones_id');
    }

    /**
     * Relacion de muchos a uno con la tabla usuarios
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo(User::class);
    }
}
