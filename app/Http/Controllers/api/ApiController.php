<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Imagen;
use App\Models\Publicaciones;
use App\Models\User;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function index(){
        $publicaciones = Publicaciones::where('status', '=', '2')->select('id', 'nombre', 'tema','contenido', 'created_at')->get();
        foreach ($publicaciones as $publicacion) {

            $publicacion->imagenes = Imagen::where('imageable_id', '=', $publicacion->id)->select('url', 'imageable_id', 'imageable_type')->get();
            $publicacion->likes = $publicacion->likes()->count();
        }
        return response()->json(['message' => 'API blog AndoCodeando', 'data' => $publicaciones], 200);
    }

    public function publiacion($id){
        $publicacion = Publicaciones::find($id);
        $publicacion->imagenes = Imagen::where('imageable_id', '=', $publicacion->id)->select('url', 'imageable_id', 'imageable_type')->get();
        $publicacion->likes = $publicacion->likes()->count();
        if ($publicacion->comentarios()->count() == 0) {
            $publicacion->comentarios = "No hay comentarios";
        } else {
            $publicacion->comentarios = $publicacion->comentarios()->select('id', 'contenido', 'created_at', 'usuario_id')->get();
        }
        $publicacion->autor = $publicacion->user()->select('name')->get();
        return response()->json(['message' => 'API blog AndoCodeando', 'data' => $publicacion], 200);
    }

    public function categoria($id){
        $categoria = Categoria::find($id)->select('id', 'nombre', 'slug', 'status')->get();
        $publicaciones = Publicaciones::where('categoria_id', '=', $id)->where('status', '=', '2')->select('id', 'nombre', 'tema','contenido', 'created_at')->get();
        foreach ($publicaciones as $publicacion) {
            $publicacion->imagenes = Imagen::where('imageable_id', '=', $publicacion->id)->select('url', 'imageable_id', 'imageable_type')->get();
            $publicacion->likes = $publicacion->likes()->count();
        }
        return response()->json(['message' => 'API blog AndoCodeando', 'Categoria' => $categoria, 'publicaciones' => $publicaciones], 200);
    }

    public function categorias(){
        $categorias = Categoria::select('id', 'nombre', 'slug', 'status')->get();
        return response()->json(['message' => 'API blog AndoCodeando', 'data' => $categorias], 200);
    }

    public function perfil($id){
        $perfil = User::where('id', $id)->select('name', 'email', 'created_at')->first();
        $publicaciones = Publicaciones::where('user_id', $id)->where('status', '2')->select('id', 'nombre', 'tema','contenido', 'created_at')->get();
        foreach ($publicaciones as $publicacion) {
            $publicacion->imagenes = Imagen::where('imageable_id', '=', $publicacion->id)->select('url', 'imageable_id', 'imageable_type')->get();
            $publicacion->likes = $publicacion->likes()->count();
        }
        return response()->json(['message' => 'API blog AndoCodeando', 'data' => $perfil,'publicaciones del perfil'=>$publicaciones], 200);
    }
}
