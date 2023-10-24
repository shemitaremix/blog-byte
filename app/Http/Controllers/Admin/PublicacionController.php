<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Publicaciones;
use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Etiquetas;
use App\Models\User;
use App\Http\Requests\StorePublicacionRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;


class PublicacionController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:publicaciones.index')->only('index');
        $this->middleware('can:publicaciones.crear')->only('crear', 'nuevaPublicacion' );
        $this->middleware('can:publicaciones.editar')->only('editar', 'update');
        $this->middleware('can:publicaciones.eliminar')->only('eliminar');
    }
    /**
     * Muestra la vista de listado de publicaciones del usuario loggeado.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.publicaciones.index');
    }

    /**
     * Muestra la vista de crear una nueva publicacion.
     *
     * @return \Illuminate\Http\Response
     */
    public function crear()
    {
        $categorias = Categoria::pluck('nombre','id');
        $etiquetas = Etiquetas::all();
        $publicacion = Publicaciones::where('status',2)->first();

        if (Auth::check()) {
            $usuario_id = Auth::user()->id;
        }
        else{
            $usuario_id = 0;
        }

        return view('Publicaciones.crearpublicacion', compact('categorias','etiquetas', 'publicacion', 'usuario_id'));
    }

    /**
     * Funcion para registrar una nueva publicacion en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function nuevaPublicacion(Request $request)
    {

        try {
            $request->validate([
                'nombre' => 'required|string|max:255',
                'slug' => 'required|string|max:255',
                'tema' => 'required|string',
                'contenido' => 'required|string',
                'etiquetas' => 'required|array',
                'status' => 'required|integer',
                'user_id' => 'required|integer',
                'categoria_id' => 'required|string',
            ]);
            $post = Publicaciones::create($request->all());

        if( $request->file('file'))
        {

            $archivo = $request->file('file');
            $extension = 'webp';
            $nombreArchivo = Str::random(20). '.' . $extension;
            $imagen = Image::make(File::get($archivo));
            $url = Storage::disk('imgblog')->put(''.'/'.$nombreArchivo, (string)$imagen->encode($extension, 30));

            $post->imagenes()->create([
                'url' => $nombreArchivo,
            ]);   
        }


        $tag = "";
        if ($request->etiquetas) {
            $tag = $post->etiquetas()->attach($request->etiquetas);
        }
        Log::channel('info')->info('Usuario: '.auth()->user()->name.' Creó una nueva publicación: '.$request->nombre);
        Session::flash('exito', 'Publicación creada correctamente');
        return redirect()->route('index');
        } catch (\Exception $e) {
            Log::channel('error')->error('Error al crear la publicación: '.$e->getMessage());
            return redirect()->back()->withInput();
        }
    }



    


    /**
     * funcion para eliminar una publicacion de la base de datos.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function eliminar(Request $request,Publicaciones $publicacion)
    {
        try {
            $delete = Publicaciones::where('id', $request->id)->update(['status' => 3]);//codigo status: 3 para eliminado
            if ($delete) {
                Log::channel('info')->info('Se elimino la publicacion: '.$publicacion->nombre);
                Session::flash('exito', 'Se elimino la publicacion: '.$publicacion->nombre);
                return redirect()->route('admin.publicaciones.index');
            }
        } catch (\Exception $e) {
            Log::channel('error')->error('Error al eliminar la publicacion: '.$e->getMessage());
            Session::flash('error', 'Error al eliminar la publicacion, contacte al administrador');
            return redirect()->route('admin.publicaciones.index');
        }
    }
}
