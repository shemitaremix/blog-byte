<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\CategoriaController;
use App\Http\Controllers\Admin\EtiquetaController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\PublicacionController;
use App\Http\Controllers\UsuarioController;

Route::get('/admin',[HomeController::class, 'index'])->name('admin.home');
Route::resource('categorias', CategoriaController::class)->names('admin.categorias');

/*
|rutas de usuario
|
*/
Route::get('/admin/usuarios',[UsuarioController::class, 'indexAdmin'])->name('admin.usuarios');
Route::get('/admin/usuarios/{id}',[UsuarioController::class, 'editarRoles'])->name('admin.usuarios.editar');
Route::post('/admin/usuarios/{id}/actualizar',[UsuarioController::class, 'actualizarRoles'])->name('admin.usuarios.actualizar');


/*
| Rutas de administrador para las publicaciones
|
*/
Route::get('/admin/posts', [PublicacionController::class, 'index'])->name('admin.publicaciones.index');
Route::get('/admin/posts/crear', [PublicacionController::class, 'crear'])->name('admin.publicaciones.crear');
Route::get('/admin/posts/{id}/editar', [PublicacionController::class, 'editar'])->name('admin.publicaciones.editar');
Route::delete('/admin/posts/{id}', [PublicacionController::class, 'eliminar'])->name('admin.publicaciones.eliminar');

/*
/ Rutas de administrador para las etiquetas
/
*/
Route::get('/admin/etiquetas', [EtiquetaController::class, 'index'])->name('admin.etiquetas.index');
Route::get('/admin/etiquetas/crear', [EtiquetaController::class, 'crear'])->name('admin.etiquetas.crear');
Route::get('/admin/etiquetas/{id}/editar', [EtiquetaController::class, 'editar'])->name('admin.etiquetas.editar');
Route::delete('/admin/etiquetas/{id}', [EtiquetaController::class, 'eliminar'])->name('admin.etiquetas.eliminar');
Route::post('/admin/etiquetas/agregar', [EtiquetaController::class, 'agregar'])->name('admin.etiquetas.agregar');
Route::post('/admin/etiquetas/{id}/actualizar', [EtiquetaController::class, 'actualizar'])->name('admin.etiquetas.actualizar');
Route::put('/admin/etiquetas/{id}/actualizar', [EtiquetaController::class, 'actualizar'])->name('admin.etiquetas.actualizar');

