<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Categoria extends Model
{
    use HasFactory;
    use Searchable;
    protected $fillable = ['nombre','slug', 'id'];
    public function getRouteKeyName()
    {
        return "slug";
    }

    /**
     * 
     * Relacion uno a muchos con la tabla posts
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function publicaciones(){
        return $this->hasMany(Publicaciones::class);
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
            'nomcat' => $this->nomcat,
        ];
    }

}
