<?php

use Illuminate\Support\Facades\Route;
/* use App\Models\User; */
/* use App\Http\Controllers\loginController; */
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Models\Publicaciones;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\PublicacionController;
use App\Http\Controllers\Auth\LoginSocialiteController;
use App\Http\Controllers\PublicacionesController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\BuscarController;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * Ruta de limpiado de cache.
 */
Route::get('posts/limpiar', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
});

/**
 *
 * Ruta de inicio de sesion y registro
 */
Auth::routes();


Route::get('/home', [HomeController::class, 'index'])->name('home');  
Route::get('/', [PublicacionesController::class, 'index'])->name('index');


// Rutas del blog
Route::group(['middleware' =>'verified'], function(){
    
    Route::get('/auth', function () {
        $posts = Publicaciones::all();
        return view('usuarios.index', compact('posts'));
    })->middleware('auth');

/**
 *
 * login con redes sociales
 */

//facebook login

Route::get('/login-facebook', [LoginSocialiteController::class, 'login'])->name('login_facebook');

Route::get('/facebook-callback', [LoginSocialiteController::class, 'callback'])->name('facebook_callback');

//github login
Route::get('/login-github', [LoginSocialiteController::class, 'githubLogin'])->name('login_github');
Route::get('/github-callback', [LoginSocialiteController::class, 'githubCallback'])->name('github_callback');

//google login
Route::get('/login-google', [LoginSocialiteController::class, 'googleLogin'])->name('login_google');
Route::get('/google-callback', [LoginSocialiteController::class, 'googleCallback'])->name('google_callback');

//sobre nosotros
Route::get('/sobre-nosotros', [UsuarioController::class, 'sobreNosotros'])->name('sobrenosotros');

/**
 *  Ruta para Crear nuevo usuario
 *
 */
Route::post('/registrar', [UsuarioController::class, 'crear'])->name('usuarios.crear');

Route::get('/editar', [UsuarioController::class, 'actualizar'])->name('usuarios.editar');
Route::post('/editar', [UsuarioController::class, 'actualizarDatos'])->name('usuarios.editarDatos');
Route::put('/actualizar', [UsuarioController::class, 'actualizarDatos'])->name('usuario.actualizar');

/**
 * Rutas para posts
 */
//rutas para crear nueva publicacion
Route::get('/post/crear', [PublicacionController::class, 'crear'])->name('publicacion.crear');
Route::post('/post/nueva', [PublicacionController::class, 'nuevaPublicacion'])->name('publicacion.nueva');
//ruta par mostrar una publicacion
Route::get('post/{publicacion}', [PublicacionesController::class, 'mostrar'])->name('publicaciones.mostrar');

//rutas para registrar comentario y like
Route::post('/comentario',[ComentarioController::class, 'comentario'])->name('publicaciones.comentarios');
Route::post('/like',[PublicacionesController::class, 'meGusta'])->name('publicacion.like');

//rutas para editar publicaciones
Route::get('/posts/{id}/editar', [PublicacionesController::class, 'editar'])->name('publicacion.editar');
Route::put('/post/{id}/editar', [PublicacionesController::class, 'actualizar'])->name('publicacion.actualizar');

//ruta para la vista del autor de la publicacion
Route::get('/autor/{id}', [UsuarioController::class, 'autor'])->name('autor');

//ruta para las categorias
Route::get('/categoria/{id}', [PublicacionesController::class, 'categoria'])->name('categoria');

//ruta para el listado de todas las publicaciones
Route::get('/lista-posts', [PublicacionesController::class, 'lista'])->name('lista-posts');
//guardar publicaciones
Route::post('/guardar', [PublicacionesController::class, 'guardar'])->name('publicacion.guardar');

//buscar publicaciones
Route::post('/buscarpubli', [BuscarController::class, 'buscarpubli'])->name('publicacion.buscar');

Route::get('/post', function() {
    return view('publicaciones.publicacionsencilla');
})->name('publicacion');

Route::get('/catalogo', function() {
    return view('publicaciones.catalogo');
})->name('catalogo');

Route::get('/perfil', [UsuarioController::class, 'perfil'])->name('perfil');

route::get('/editar-perfil', [UsuarioController::class, 'actualizar'])->name('eperfil');

Route::post('/perfil/foto', [PublicacionController::class, 'imagenusurio'])->name('perfil.foto');

});

Auth::routes(['verify' => true]);
 



Route::get('/contacto', [UsuarioController::class, 'contacto'])->name('contacto');



// Recuperar contraseña
Route::get('/recuperar', function() {
    return view('usuarios.recuperar');
})->name('recuperar');

Route::get('/restablecer', function() {
    return view('usuarios.restablecer');
})->name('restablecer');


//ruta para cerrar secion


route::get('/ver', function() {
    return view('layouts.prueba');
});

route::get('/v', [PublicacionesController::class, 'categoriasPopulares'])->name('categoriasPopulares');

Route::get('/veri', function() { 
    return view('auth.verify');
});



