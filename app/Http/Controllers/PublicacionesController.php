<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Publicaciones;
use App\Models\User;
use App\Http\Requests\ComentarioRequest;
use App\Models\Categoria;
use App\Models\Comentario;
use App\Models\Etiquetas;
use App\Models\Like;
use App\Models\Publiguardada;
use App\Models\Imagen;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class PublicacionesController extends Controller
{
    public function index(){
        $publicaciones = Publicaciones::where('status',2)->latest('id')->paginate(5);
        if (Auth::check()) {
            $usuario_id = Auth::user()->id;
        }else{
            $usuario_id = 0;
        }
        foreach ($publicaciones as $publicacion) {
            $publicacion->like = Like::where('publicaciones_id', $publicacion->id)->count();
            if (Like::where('publicaciones_id',$publicacion->id)->where('usuario_id',$usuario_id)->where('likes',1)->first() != null) {
                $publicacion->usuario_likeo = true;
            }else{
                $publicacion->usuario_likeo = false;
            }
            if (Publiguardada::where('publicaciones_id',$publicacion->id)->where('usuario_id',$usuario_id)->first() != null) {
                $publicacion->guardado = true;
            }
            else{
                $publicacion->guardado = false;
            }
        }
        $publicaciones_populares = $this->publicacionesPopulares();
        $categorias = $this->categoriasPopulares();
       /*  $publicaciones = Publicaciones::where('id','>=',1)->where('id','<=',3)->first();   */
        /* return $publicaciones; */
        return view('usuarios.index', compact('publicaciones', 'usuario_id', 'categorias', 'publicaciones_populares'));

    }




    public function mostrar(Publicaciones $publicacion){

        $publicacion->user;

        $publicacion->comentarios;

        $user = User::pluck('name','id');
        $p_id = $publicacion->id;


        $user = User::all();
        if (Auth::check()) {
            $usuario_id = Auth::user()->id;
        }
        else{
            $usuario_id = 0;
        }
        $buscarLikes = like::where('publicaciones_id',$publicacion->id)->first();
        if ($buscarLikes == null) {
            $likes = 0;
        }else{
            $likes = like::where('publicaciones_id',$publicacion->id)->sum('likes');
        }
        if (Like::where('publicaciones_id',$publicacion->id)->where('usuario_id',$usuario_id)->where('likes',1)->first() != null) {
            $usuario_likeo = true;
        }else{
            $usuario_likeo = false;
        }
        if (Publiguardada::where('publicaciones_id',$publicacion->id)->where('usuario_id',$usuario_id)->first() != null) {
            $publi_guardado = true;
        }
        else{
            $publi_guardado = false;
        }
        $categoria = Categoria::pluck('nombre', 'id')->where('id',$publicacion->categoria_id)->first();
        $publicaciones_populares = $this->publicacionesPopulares();
        $categorias = $this->categoriasPopulares();
        $publicaciones = Publicaciones::where('status',2)->latest('id')->take(5)->get();
        return view('usuarios.publicacion', compact('publicacion','usuario_id','user', 'likes','categorias', 'publicaciones_populares', 'publicaciones', 'usuario_likeo', 'publi_guardado', 'categoria', 'p_id'));
    }


    //guardar publicacion
    public function guardar(Request $request)
    {
        try {
            if ($request->usuario_id != 0) {
                $verificar = Publiguardada::where('usuario_id', $request->usuario_id)->where('publicaciones_id', $request->publicaciones_id)->first();
                if ($verificar != null) {
                    //eliminar registro de guardado
                    $verificar->delete();
                    return response()->json(['status' => 'ok',
                        'estado' => '2']);
                } else{
                    $guardada = Publiguardada::create($request->all());
                    if ($guardada) {
                        Log::channel('info')->info('Publicacion guardada');
                        return response()->json(['status' => 'ok',
                            'estado' => '1',
                            'text' => 'La publicacion se guardo correctamente',
                            'icon' => 'success']);
                    }else{
                        Log::channel('error')->error('Publicacion no guardada');
                        return response()->json(['estatus' => 'error', 'text' => 'Publicacion no guardada, contacte al administrador', 'icon' => 'error']);
                    }
                }
            }else{
                Log::channel('info')->info('Publicacion no guardada, '.$request->usuario_id.' no loggeado');
                return response()->json(['estatus' => 'error',
                    'text' => 'Publicacion no guardada, no estas loggeado',
                    'icon' => 'error']);
            }
        } catch (\Exception $e) {
            Log::channel('error')->error('Publicacion no guardada: ' . $e->getMessage());
            return response()->json(['estatus' => 'error',
                'mensaje' => 'Publicacion no guardada, contacte al administrador',
                'icon' => 'error']);
        }

    }

    /**
     *  Funcion para registrar los likes
     *
     * @param Request
     *
     * @return json
     */
    public function meGusta(Request $request){
        try {
            $request->validate([
                'publicaciones_id' => 'required',
                'usuario_id' => 'required',
                'likes' => 'required',
            ]);
            if ($request->usuario_id == 0) {
                Log::channel('info')->info('Like no registrado, usuario no loggeado');
                Session::flash('Usuario no loggeado');
                return response()->json([
                    'status' => 'error',
                    'mensaje' => 'usuario no loggeado',
                ]);
            }else{
                if (like::where('usuario_id', $request->usuario_id)->where('publicaciones_id', $request->publicaciones_id)->count() > 0) {
                    $like = Like::where('usuario_id', $request->usuario_id)->where('publicaciones_id', $request->publicaciones_id)->first();
                    $like->delete();
                    //traer el numero de likes actualizado y retornarlo
                    $likes = like::where('publicaciones_id',$request->publicaciones_id)->sum('likes');
                    return response()->json([
                        'status' => 'ok',
                        'likes' => $likes,
                    ]);
                }else{
                    $like = Like::create($request->all());
                    if ($like) {
                        $likes = like::where('publicaciones_id',$request->publicaciones_id)->sum('likes');
                        Log::channel('info')->info('Like registrado en la publicacion con el id: '.$request->publicaciones_id);
                        return response()->json([
                            'status' => 'ok',
                            'likes' => $likes,
                        ]);
                    }
                }
            }
        } catch (\Exception $e) {
            Log::channel('error')->error('Like no registrado: ' . $e->getMessage());
            return response()->json(['estatus' => 'error',
                'mensaje' => 'Like no registrado, contacte al administrador',
                'icon' => 'error']);
        }
    }

    /**
     * Funcion para editar la publicacion
     *
     * @param int $id
     * @return \Illuminate\Http\View
     */
    public function editar($id){
        $publicaciones = Publicaciones::find($id);
        $categorias = Categoria::pluck('nombre','id');
        $etiquetas = Etiquetas::all();
        return view('Publicaciones.editarpubli', compact('publicaciones', 'categorias', 'etiquetas'));
    }

    /**
     * Funcion para actualizar la publicacion
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function actualizar($id, Request $request){
        try {
            $validacion = $request->validate([
                'nombre' => 'required',
                'slug' => 'required',
                'tema' => 'required',
                'contenido' => 'required',
                'categoria_id' => 'required',
                'etiquetas' => 'required',
            ]);
            $post = Publicaciones::where('id', $id)->first();
            if( $request->file('file'))
            {
                $url = Storage::disk('imgblog')->put('', $request->file('file'));
                $liga = Imagen::where('imageable_id', $id)->first();
                if ($liga) {
                    $post->imagenes()->update([
                        'url' => $url
                    ]);
                }else{
                    $post->imagenes()->create([
                        'url' => $url
                    ]);
                }
            }
            if ($validacion) {
                $publicaciones = Publicaciones::where('id', $id)->first();
                if ($publicaciones->slug == $request->slug) {
                    $publicaciones->update([
                        'tema' => $request->tema,
                        'contenido' => $request->contenido,
                        'categoria_id' => $request->categoria_id,
                    ]);
                }else{
                    $publicaciones->update([
                        'nombre' => $request->nombre,
                        'slug' => $request->slug,
                        'tema' => $request->tema,
                        'contenido' => $request->contenido,
                        'categoria_id' => $request->categoria_id,
                    ]);
                }
                if ($request->etiquetas) {
                    $publicaciones->etiquetas()->sync($request->etiquetas);
                }
                Log::channel('info')->info('Publicacion actualizada');

                return redirect()->route('index')->with('success', 'Publicacion actualizada correctamente');
            }
        } catch (\Exception $e) {
            Log::channel('error')->error('Publicacion no actualizada: ' . $e->getMessage());

            return redirect()->route('index')->with('error', 'Publicacion no actualizada, contacte al administrador');
        }
    }

    /**
     * Funcion para mostrar la vista de la categoria seleccionada
     *
     * @Param int $id
     *
     * @return \Illuminate\Http\View
     */
    public function categoria($id){
        $categoria = Categoria::find($id);
        $publicaciones = Publicaciones::where('categoria_id', $id)->paginate(5);
        //obtener los likes de la publicacion para mostrarlo en la vista
        foreach ($publicaciones as $publicacion) {
            $publicacion->likes = like::where('publicaciones_id', $publicacion->id)->sum('likes');
        }
        return view('Publicaciones.categorias', compact('categoria', 'publicaciones'));
    }


    //funciones de obtencion de datos

    /**
     * Funcion para obtener las publicaciones mas populares
     *
     * @return \Illuminate\Http\ArrayResponse
     */
    public function publicacionesPopulares(){
        //de la tabla likes obtenemos el id de las publicaciones mas populares
        $likes = Like::select('publicaciones_id')->groupBy('publicaciones_id')->orderBy('likes', 'desc')->take(3)->get();
        $publicaciones_populares = [];
        if ($likes->count() > 0) {
            foreach ($likes as $like) {
                $publicaciones_populares[] = Publicaciones::where('id', $like->publicaciones_id)->first();
            }
        }
        return $publicaciones_populares;
    }

    /**
     * Funcion de categorias mas populares
     *
     * @return \Illuminate\Http\ArrayResponse
     */
    public function categoriasPopulares(){
        //obtener las categorias de acuerdo a los likes de las publicaciones
        $populares = Publicaciones::where('status', '2')->get();
        $cat_id = 0;
        foreach ($populares as $popular) {
            $popular->numero_likes = $popular->likes->count();
        }
        $populares->sortByDesc('numero_likes');
        $categorias = $populares->groupBy('categoria_id');
        $categorias_populares = [];
        foreach ($categorias as $categoria) {
            $categorias_populares[] = Categoria::where('id', $categoria->first()->categoria_id)->first();
        }
        return $categorias_populares;
    }

    /**
     * Funcion para la vista de todas las publicaciones
     * 
     * @return \Illuminate\Http\View
     */
    public function lista(){
        $publicaciones = Publicaciones::where('status', '2')->paginate(5);
        //obtener los likes de la publicacion para mostrarlo en la vista
        foreach ($publicaciones as $publicacion) {
            $publicacion->likes = like::where('publicaciones_id', $publicacion->id)->sum('likes');
        }
        return view('Publicaciones.lista-publicaciones', compact('publicaciones'));
    }

    /**
     * Funcion de pruebas
     *
     * @return \Illuminate\Http\ArrayResponse
     */
    public function pruebas(){
        dd($this->categoriasPopulares());
    }
}
