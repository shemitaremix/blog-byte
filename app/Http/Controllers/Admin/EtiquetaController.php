<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Etiquetas;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class EtiquetaController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:etiquetas.index')->only('index');
        $this->middleware('can:etiquetas.crear')->only('crear', 'agregar');
        $this->middleware('can:etiquetas.editar')->only('editar', 'actualizar');
        $this->middleware('can:etiquetas.eliminar')->only('eliminar');
    }
    /**
     * Muestra la vista de listado de etiquetas.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $etiquetas = Etiquetas::all();
        return view('admin.etiqueta.index', compact('etiquetas'));
    }

    /**
     * Funcion de la vista para crear una nueva etiqueta.
     *
     * @return \Illuminate\Http\Response
     */
    public function crear()
    {
        $colores = [
            'blue' => 'Azul',
            'red' => 'Rojo',
            'green' => 'Verde',
            'yellow' => 'Amarillo',
            'purple' => 'Morado'
        ];
        return view('admin.etiqueta.crear', compact('colores'));
    }

    /**
     * Funcion para registrar una nueva etiqueta en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function agregar(Request $request)
    {
        try {
            $request->validate( [
                'nombre' => 'required',
                'slug' => 'required|unique:etiquetas',
                'color' => 'required'
            ]);
            $etiqueta = Etiquetas::create($request->all());
            Session::flash('success', 'Etiqueta creada correctamente');
            return redirect()->route('admin.etiquetas.index');
        } catch (\Exception $e) {
            Session::flash('error', 'Error al crear la etiqueta');
            return redirect()->route('admin.etiquetas.index');
        }
    }

    /**
     * Muestra la vista singular de una etiqueta.
     *
     * @param  int  $Etiqueta
     * @return \Illuminate\Http\Response
     */
    public function show(Etiquetas $etiqueta)
    {
        return view('admin.etiqueta.ver', compact('etiqueta'));
    }

    /**
     * Funcion para la vista de edicion de una etiqueta.
     *
     * @param  int  $Etiqueta
     * @return \Illuminate\Http\Response
     */
    public function editar( $id)
    {
        $colores = [
            'blue' => 'Azul',
            'red' => 'Rojo',
            'green' => 'Verde',
            'yellow' => 'Amarillo',
            'purple' => 'Morado'
        ];
        $etiqueta = Etiquetas::findOrFail($id);
        return view('admin.etiqueta.editar', compact('etiqueta','colores'));
    }

    /**
     * Funcion para actualizar una etiqueta en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $Etiqueta
     * @return \Illuminate\Http\Response
     */
    public function actualizar(Request $request, Etiquetas $etiqueta)
    {
        try {
            $request->validate( [
                'nombre' => 'required',
                'slug' => 'required',
                'color' => 'required'
            ]);
    
            //actualizar el registro con solo el nombre slug y color
            $update = Etiquetas::where('id', $request->id)->update([
                'nombre' => $request->nombre,
                'slug' => $request->slug,
                'color' => $request->color
            ]);
            Log::channel('info')->info('Etiqueta'.$request->nombre.' actualizada correctamente');
            Session::flash('exito', 'Etiqueta actualizada correctamente');
            return redirect()->route('admin.etiquetas.editar', $request->id);
        } catch (\Exception $e) {
            Log::channel('error')->error('Error al actualizar la etiqueta: '.$e->getMessage());
            Session::flash('error', 'Error al actualizar la etiqueta');
            return redirect()->route('admin.etiquetas.editar', $request->id);
        }
    }

    /**
     * Funcion para eliminar una etiqueta de la base de datos.
     *
     * @param  int  $Etiqueta
     * @return \Illuminate\Http\Response
     */
    public function eliminar(Request $request, Etiquetas $etiqueta)
    {
        //encontrar el registro y cambiar el status a 2
        $delete = Etiquetas::where('id', $request->id)->update(['status' => 2]);//estatus 2: eliminado
        if ($delete) {
            return redirect()->route('admin.etiquetas.index')->with('mensaje', 'Etiqueta eliminada correctamente');
        } else {
            return redirect()->route('admin.etiquetas.index')->with('error', 'Error al eliminar la etiqueta');
        }
    }
}
