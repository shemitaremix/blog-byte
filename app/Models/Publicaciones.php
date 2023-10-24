<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Publicaciones extends Model
{
    use HasFactory;
    use Searchable;
    protected $fillable = ['nombre','tema','slug','contenido','status','categoria_id','user_id'];

    protected $table = 'publicaciones';

    protected $guarded = ['id','create_at','update_at'];
    /**
     * Relacion uno a muchos inversa con la tabla usuario
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo(User::class);
    }

    /**
     * Relacion uno a muchos con la tabla categoria
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categoria(){
        return $this->belongsTo(Categoria::class);
    }

    /**
     * Relacion muchos a muchos con la tabla tags
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function etiquetas(){
        return $this->belongsToMany(Etiquetas::class);
    }

    /**
     * Relacion uno a uno  polimorfica
     *
     * @return \Illuminate\Database\Eloquent\Relations\morphOne
     */

    public function imagenes(){
        return $this->morphOne(Imagen::class, 'imageable'); 
    }

    /**
     * Relacion muchos a muchos con la tabla comentarios
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function comentarios(){
        return $this->hasMany(Comentario::class);
    }

    /**
     * Relacion muchos a muchos con la tabla publicaciones guardadas
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function publicacionGuadada(){
        return $this->belongsToMany(Publiguardada::class);
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

    /**
     *  Relacion muchos a muchos con la tabla likes
     * 
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */

    public function likes(){
        return $this->belongsToMany(Like::class,'publicaciones','id','id');
    }
}
