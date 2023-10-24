<?php

namespace App\Http\Controllers;

use App\Models\ImagenUsuario;
use App\Models\Publicaciones;
use App\Models\Publiguardada;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

use function GuzzleHttp\Promise\all;
use Spatie\Permission\Models\Role;

class UsuarioController extends Controller
{

    public function indexAdmin(){
        return view('admin.usuarios.index');
    }

    /**
     * Muestra la vista de actualizar datos del usuario.
     * 
     * @return \Illuminate\Http\Response
     */
    public function actualizar(){
        $usuario = Auth::user();
        $publicacion = Publicaciones::where('id', '1')->first();
        if (Auth::check()) {
            $usuario_id = Auth::user()->id;
        }else{
            $usuario_id = 0;
        }
        
        return view('usuarios.editarperfil', compact('usuario', 'publicacion', 'usuario_id'));
    }
    /**
     * Funcion para actualizar los datos de usuario en la base de datos.
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function actualizarDAtos(Request $request){

        $usu= Auth::user();

        
        try{
            if( $request->file('file'))
            {
                $archivo = $request->file('file');
                $extension = 'webp';
                $nombreArchivo = Str::random(20). '.' . $extension;
                $imagen = Image::make(File::get($archivo));
                $url = Storage::disk('imgusu')->put(''.'/'.$nombreArchivo, (string)$imagen->encode($extension, 30));
                $avatar = ImagenUsuario::where('imageableusu_id', $usu->id)->first();
                if ($avatar) {
                    $avatar->update([
                        'url' => $nombreArchivo
                    ]);
                }else{
                    $registrarAvatar = ImagenUsuario::create([
                        'url' => $nombreArchivo,
                        'imageableusu_id' => $usu->id,
                        'imageableusu_type' => User::class,
                    ]);
                }
            }

            $validacion = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email',
            ]);
            if ($validacion->fails()) {
                Log::channel('precaucion')->info('No se ingresaron todos los campos');
                return response()->json(['estatus' => 'error', 'text' => 'No se guardaron los datos ingresados, verifique de nuevo', 'icon' => 'error']); 
            }
            $usuario = User::findOrFail(Auth::user()->id);
            $usuario->update([
                'name' => $request->name,
                'email' => $request->email,
                'biografia' => $request->biografia,
                'file' => $request->file,
            ]);
            Log::channel('info')->info('Se ha actualizado los datos del usuario '.auth()->user()->id.': '.$request->name.$request->email.$request->biografia);
            return response()->json(['estatus' => 'exito', 'text' => 'Se ha actualizado los datos del usuario', 'icon' => 'exito']);
        }catch(\Exception $e){
            Log::channel('error')->error('Error al actualizar datos: '.$e->getMessage());
           return response()->json(['estatus' => 'error', 'text' => 'No se actualizaron los datos, contacte al administrador', 'icon' => 'error']);
        
        }
    }

    /** 
        * Funcion para mostrar la vista de asignacion de roles
        * @param Model $usuario
        * @return \Illuminate\Http\Response
    */
    public function editarRoles($usuario){
        $roles = Role::where('name','!=','superAdmin')->get();
        $editar = User::findOrFail($usuario);
        return view('admin.usuarios.editar', compact('editar','roles'));
    }

    /**
     * Funcion para asignar o actualizar los roles de un usuario
     * Parametros roles: roles a asignar, id del usuario
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function actualizarRoles($id, Request $request){
        try{
            $user = User::findOrFail($id);
            $user->roles()->sync($request->roles);
            Log::channel('info')->info('SQL '.$user.' ha actualizado sus roles');
            Session::flash('exito', 'Se han asignado los roles con exito');
            return redirect()->route('admin.usuarios.editar');
        }
        catch(\Exception $e){
            Log::channel('error')->error('Error al actualizar roles: '.$e->getMessage());
            Session::flash('error', 'Error al actualizar los roles');
            return redirect()->back();
        }
    }


    /**
     * Funcion para eliminar un usuario
     * @return \Illuminate\Http\Response
     */
    public function eliminarUsuario(){
        try{
            $user = User::find(auth()->user()->id);
            $user->delete();
            DB::commit();
            Log::channel('info')->info('Usuario'.$user->email.' ha sido eliminado');
            Session::flash('message', 'Usuario eliminado correctamente');
            return redirect()->route('index');
        }catch(\Exception $e){
            DB::rollback();
            Log::channel('error')->error('Error al eliminar usuario: '.$e->getMessage());
            Session::flash('message', 'Error al eliminar el usuario');
        }
    }

    public function login() //retorna la vista de login
    {
        return view('usuarios.login');
    } 

    public function storeinicio()//inicio de sesion de usuario
    {

        if(auth()->attempt(request(['email','password'])) == false)
        {
            return back()->withErrors(['message'=>'El usuario o la contraseña son incorrectos']);
        }
        else
        {
            return redirect()->to('/');
        }
    }

    public function salir()//cierre de sesion de usuario
    {
        auth()->logout();
        return redirect()->to('/login');
    }

    /**
     * Funcion para mostrar la vista de sobre nosotros
     * 
     * @return \Illuminate\Http\Response
     */
    public function sobreNosotros(){
        $publicacion = Publicaciones::where('id', '1')->first();
        if (Auth::check()) {
            $usuario_id = Auth::user()->id;
        }else{
            $usuario_id = 0;
        }
        return view('usuarios.sobrenosotros',compact('publicacion','usuario_id'));
    }

    /**
     * Funcion par mostrar la vista de contacto
     * 
     * @return \Illuminate\Http\Response
     */
    public function contacto(){
        $publicacion = Publicaciones::where('id', '1')->first();
        if (Auth::check()) {
            $usuario_id = Auth::user()->id;
        }else{
            $usuario_id = 0;
        }
        return view('usuarios.contacto',compact('publicacion','usuario_id'));
    }

    /**
     * Muestra el perfil del usuario logueado.
     * 
     * @return \Illuminate\Http\Response
     */
    public function perfil(){
        
        if (Auth::check()) {
            $usuario_id = Auth::user()->id;
        }else{
            $usuario_id = 0;
        }
        $guardadas = $this->publicacionesGuardadas(Auth::user()->id);
        //crear variable array

        $publicaciones = [];
        foreach ($guardadas as $guardada) {
            $publicaciones[] = Publicaciones::where('id', $guardada->publicaciones_id)->first();
        }
        return view('usuarios.perfil',compact('usuario_id','publicaciones'));
    }


    /**
     * Muestra la vista del pefil del autor de la publicacion.
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function autor($id){
        $autor = User::findOrFail($id);
        $publicaciones = $this->publicacionesPerfil($id);
        return view('usuarios.perfiles',compact('autor','publicaciones'));
    }

    /**
     * Funcion para obtener las publicaciones de un perfil
     * 
     * @param int $id
     * @return array
     */
    public function publicacionesPerfil($id){
        //obtener las publicaciones de las mas reciente a la mas antigua 
        $publicaciones = Publicaciones::where('user_id', $id)->where('status', '2')->orderBy('created_at', 'desc')->get();
        return $publicaciones;
    }

    /**
     * Funcion para obtener las publicaciones guardadas por un usuario
     * 
     * @param int $id
     * @return array
     */
    public function publicacionesGuardadas($id){
        $publicaciones = Publiguardada::where('usuario_id', $id)->orderBy('created_at', 'desc')->get();
        return $publicaciones;
    }
}
