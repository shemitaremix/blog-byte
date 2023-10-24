<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'publicaciones_id',
        'usuario_id',
        'contenido',
    ];
    /**
     * 
     * Relacion muchos a muchos con la tabla publicaciones
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function publicaciones(){
        return $this->belongsToMany(Publicaciones::class);
    }

    /**
     * Relacion uno a muchos inversa con la tabla usuario
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo(User::class, 'usuario_id');
    }   
}
