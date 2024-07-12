<?php

use App\Http\Controllers\ActorController;
use App\Http\Controllers\PeliculaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::prefix('/config')->group(function(){
    Route::prefix('/actor')->group(function(){
        Route::controller(ActorController::class)->group(function(){
            Route::get('/list', 'indexActor')->name('actorIndex');

            Route::get('/create', 'createActor')->name('actorCreate');
            Route::post('/alta', 'storeActor')->name('actorStore');
            
            Route::get('/edit/{actorId}', 'editActor')->name('actorEdit');
            Route::put('/update/{actorId}', 'updateActor')->name('actorUpdate');

            Route::delete('/delete/{actorId}','deleteActor')->name('actorDelete');
        });
    });

    Route::prefix('/pelicula')->group(function(){
        Route::controller(PeliculaController::class)->group(function(){
            Route::get('/list', 'indexPelicula')->name('peliculaIndex');

            Route::get('/create', 'createPelicula')->name('peliculaCreate');
            Route::post('/alta', 'storePelicula')->name('peliculaStore');
            
            Route::get('/edit/{peliculaId}', 'editPelicula')->name('peliculaEdit');
            Route::put('/update/{peliculaId}', 'updatePelicula')->name('peliculaUpdate');

            Route::delete('/delete/{peliculaId}','deletePelicula')->name('peliculaDelete');
        });
    });
});
