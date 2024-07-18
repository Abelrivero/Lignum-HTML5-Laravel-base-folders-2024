<?php

use App\Http\Controllers\ActorController;
use App\Http\Controllers\PeliculaController;
use App\Http\Controllers\PeliculaFavoritaController;
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
})->name('home');

Route::get('/login',function (){
    return view('login');
})->name('login');

Route::get('/registro',function (){
    return view('registro');
})->name('registro');

Route::get('/principal',function(){
    return view('usersViews.principal');
})->name('userPrincipal');

Route::controller(PeliculaFavoritaController::class)->group(function (){
    Route::get('/favoritas/{usuarioId}', 'indexFavoritas')->name('favoritasIndex');
    
    Route::post('/agregarfavorita/{usuarioId}/{peliculaId}', 'crearFavorita')->name('favoritasCrear');

    Route::delete('/eliminarfavorita/{favId}/{usuarId}', 'eliminarFav')->name('favoritasEliminar');
});

Route::prefix('/config')->group(function(){
    Route::prefix('/actor')->group(function(){
        Route::controller(ActorController::class)->group(function(){
            Route::get('/list', 'indexActor')->name('actorIndex');
            Route::get('/showActor/{actorId}', 'showActor');

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
