<?php
use App\Charts\SampleChart;
use App\Http\Controllers\ChartJsController;
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;

use App\Http\Controllers\SignedRouteController;
use App\Http\Controllers\Forgotten;
use App\Http\Controllers\Comentarios;
use App\Models\User;
use App\Models\Grade;
use App\Models\Coments;
use App\Models\Niveledu;
use App\Models\Rol;
use App\Models\Section;
use App\Models\Lesson;
use App\Models\Group;
use App\Models\Evaluation;
use App\Models\Encuestas;
use App\Http\Controllers\Admin\{
    ProfileController,
    MailSettingController,
    PostController,
    Marcas,
    Concesionario,
    EncuestasController,
    GradeController,
    SectionController,
    GroupController
   
};





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

    //Rutas a las que se permitirá acceso
   

    //Route::middleware(['web'])->group(function () {
       

      
            // Tus rutas aquí
            Route::get('/', function () {
                return view('welcome');
            })->name('home'); 
   // });



require __DIR__.'/front_auth.php';


Route::get('/chartjs', function () {
    return view('Grafica');
});
// Admin routes
Route::get('/admin/dashboard', function () {
   

    $totalUsers = User::count();
    $totalGrades = Grade::count();
    $totalSeccion = Section::count();
    $currentDate = Carbon::now();
    $totalNivel = 5;
    $totalRol = Rol::count();
    $totalComentarios = 3;

    $adminCount = 3;
    $ultimasEncuestas = Encuestas::latest()->take(5)->get();

    //return view('home.index', ['currentDate' => $currentDate]);
    return view('dashboard', ['totalUsers' => $totalUsers,'currentDate' => $currentDate,
    'totalComentarios' => $totalComentarios, 'totalRol' => $totalRol,
    'totalNivel' => $totalNivel,'totalSeccion' => $totalSeccion,
    'totalGrades' => $totalGrades,'adminCount' => $adminCount,
    'ultimasEncuestas' => $ultimasEncuestas,
]);
    //return view('dashboard');
})->middleware(['auth'])->name('admin.dashboard');

require __DIR__.'/auth.php';


Route::get('chartjs', [ChartJsController::class, 'index'])->name('chartjs.index');
Route::get('password', [Forgotten::class, 'index'])->name('password.index');
Route::post('/enviar-correo', [Forgotten::class, 'enviarCorreo'])->name('enviar.correo');


Route::get('/firmada', [SignedRouteController::class, 'SignedRoute'])->name('firmada');

Route::namespace('App\Http\Controllers\Admin')->name('admin.')->prefix('admin')
    ->group(function(){
        Route::get('comentarios', [Comentarios::class, 'index'])->name('comentarios.index');
        Route::resource('encuestas','EncuestasController');
        Route::resource('roles','RoleController');
        Route::resource('permissions','PermissionController');
        Route::resource('users','UserController');
        Route::resource('soft','VerificacionEliminarController');
        Route::resource('posts','PostController')->except(['edit']);
        Route::resource('marcas','Marcas');
        Route::resource('grades','GradeController');
        Route::resource('section','SectionController');
        Route::resource('concesionarios','Concesionario');
        Route::resource('educativos','Educacion');
        Route::resource('groups','GroupController');
        Route::get('/posts/{post}/verify-code', 'PostController@verifyCode')->name('posts.verify-code');
        Route::get('/posts/{post}/edit', 'PostController@edit')->name('posts.edit');
        Route::get('/posts/{post}/destruir', 'PostController@destruir')->name('posts.destruir');
        Route::resource('codes','VerificationController');
        Route::get('/verificar',[PostController::class, 'verificar'])->name('verificar');
        Route::post('/verificar',[PostController::class, 'guardarPeticion'])->name('pedirc');
        Route::get('/verificareliminar',[PostController::class, 'verificarelim'])->name('verificareliminar');
        Route::post('/verificareliminar',[PostController::class, 'guardarPeticionEliminar'])->name('pedireliminar');
       // Route::resource('codes','PostController');
        Route::get('/profile',[ProfileController::class,'index'])->name('profile');
        Route::put('/profile-update',[ProfileController::class,'update'])->name('profile.update');
        Route::get('/mail',[MailSettingController::class,'index'])->name('mail.index');
        Route::put('/mail-update/{mailsetting}',[MailSettingController::class,'update'])->name('mail.update');
});
Route::post('/concesionarios/{id}/cambiar-estado', [Concesionario::class, 'cambiarestado'])->name('concesionarios.cambiarestado');
Route::post('/section/{id}/cambiar-estado', [SectionController::class, 'cambiarestado'])->name('section.cambiarestado');
Route::post('/marcas/{id}/cambiar-estado', [Marcas::class, 'cambiarestado'])->name('marcas.cambiarestado');
Route::post('/grades/{id}/cambiar-estado', [GradeController::class, 'cambiarestado'])->name('grades.cambiarestado');
Route::post('/groups/{id}/cambiar-estado', [GroupController::class, 'cambiarestado'])->name('groups.cambiarestado');
Route::post('/encuestas/{id}/cambiar-estado', [EncuestasController::class, 'cambiarestado'])->name('encuestas.cambiarestado');
