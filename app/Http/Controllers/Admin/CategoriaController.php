<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categoria;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class CategoriaController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:categorias.index')->only('index');
        $this->middleware('can:categorias.crear')->only('create', 'store');
        $this->middleware('can:categorias.editar')->only('edit', 'update');
        $this->middleware('can:categorias.eliminar')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = Categoria::all();
        return view('admin.categorias.index',compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categorias.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nombre' => 'required|max:255',
                'slug' => 'required|max:255',
            ]);
            $categoria = Categoria::create($request->all());
            Log::channel('info')->info('Usuario: '.auth()->user()->name.', Creó la categoría: '.$categoria->nombre);
            Session::flash('exito', 'Categoría creada correctamente');
            return redirect()->route('admin.categorias.index');
        } catch (\Exception $e) {
            Log::channel('error')->error('Usuario: '.auth()->user()->name.', Error al crear la categoría: '.$e->getMessage());
            Session::flash('error', 'Error al crear la categoría, contacte al administrador');
            return redirect()->route('admin.categorias.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Categoria $categoria)
    {
        return view('admin.categorias.show',compact('categoria'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Categoria $categoria)
    {
        return view('admin.categorias.edit',compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categoria $categoria)
    {
        try {
            $request->validate([
                'nombre' => 'required|max:255',
                'slug' => 'required|max:255',
            ]);
    
            $categoria->update($request->all());
            Log::channel('info')->info('Usuario: '.auth()->user()->name.', Editó la categoría: '.$categoria->nombre);
            Session::flash('exito', 'Categoría editada correctamente');
            return redirect()->route('admin.categorias.edit',$categoria);
        } catch (\Exception $e) {
            Log::channel('error')->error(' Error al editar la categoría: '.$e->getMessage());
            Session::flash('error', 'Error al editar la categoría, contacte al administrador');
            return redirect()->route('admin.categorias.edit',$categoria);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Categoria $categoria)
    {
        try {
            $delete = Categoria::where('id', $categoria->id)->update(['status' => 2]);//codigo de estatus: 2 es eliminado
            if ($delete) {
                Log::channel('info')->info('Categoria eliminada correctamente'.$categoria->nombre);
                Session::flash('exito', 'La categoria se elimino correctamente');
                return redirect()->route('admin.categorias.index');
            }
        } catch (\Exception $e) {
            Log::channel('error')->error('Error al eliminar categoria: ' . $e->getMessage());
            Session::flash('error', 'Error al eliminar categoria, contacte al administrador');
            return redirect()->route('admin.categorias.index');
        }
    }
}
