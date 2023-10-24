<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Publicaciones;
use App\Models\User;
use App\Http\Requests\ComentarioRequest;
use App\Models\Comentario;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class ComentarioController extends Controller
{

    /**
     * Registra un nuevo comentario en la base de datos.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function comentario(Request $request){
        
        try {
           
            if ($request->usuario_id != 0) {
                $comentario = Comentario::create([
                    'publicaciones_id' => $request->publicaciones_id,
                    'usuario_id' => $request->usuario_id,
                    'contenido' => $request->contenido,
                ]);
                Log::channel('info')->info('Comentario creado'.$request->contenido);
                Session::flash('success', 'Comentario creado correctamente');
                return redirect()->back();
            }else{
                Log::channel('info')->info('Comentario no guardado, usuario no loggeado');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            Log::channel('error')->error('Error al comentar: '.$e->getMessage());
            Session::flash('error', 'Error al comentar "'.$e->getMessage().'"');
            return redirect()->back();
        }
    }
}
