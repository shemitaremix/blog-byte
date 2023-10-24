<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Etiquetas extends Model
{
    use HasFactory;
    use Searchable;
    protected $fillable = ['nombre', 'slug', 'color'];
     /**
     * 
     * Relacion muchos a muchos con la tabla posts
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function publicaciones(){
        return $this->belongsToMany(Publicaciones::class);
    }

    /**
     * Buscador por arreglo
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return [
            'nombre' => $this->nombre,
        ];
    }
}
