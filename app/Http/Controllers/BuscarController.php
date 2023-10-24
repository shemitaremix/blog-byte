<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publicaciones;
use App\Models\Categoria;
use App\Models\Etiquetas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;



class BuscarController extends Controller
{
    //

    /**
     * buscar por publicacion nombre
     */
    public function buscarpubli(Request $request)
    {
        $search = $request->buscador;
        $publi=Publicaciones::search($search)->get();

        if($publi->count()>0){
            return view('usuarios.busqueda',compact('publi'));
        }else{
            session()->flash('error','No se encontraron resultados: '. $search);
            return view('usuarios.busqueda', compact('publi'));
        };

        return view('usuarios.busqueda', compact('publi'));

        
    }


}
