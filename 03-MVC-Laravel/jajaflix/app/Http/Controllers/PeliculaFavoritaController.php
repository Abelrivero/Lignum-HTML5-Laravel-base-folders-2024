<?php

namespace App\Http\Controllers;

use App\Models\PeliculaFavorita;
use Illuminate\Http\Request;

class PeliculaFavoritaController extends Controller
{
    public function indexFavoritas($usuarioId)
    {
        $peliculasFav = PeliculaFavorita::where('usuarioId', $usuarioId)->get();       
        return view('usersViews.favoritasIndex', ['peliculasFav' => $peliculasFav]);
    }

    public function crearFavorita($usuarioId, $peliculaId)
    {
        $existFav = PeliculaFavorita::where('usuarioId', $usuarioId)->where('peliculaId', $peliculaId)->first();
        if(!$existFav){
            $favorita = new PeliculaFavorita;
            $favorita->usuarioId = $usuarioId;
            $favorita->peliculaId = $peliculaId;
            $favorita->save();
    
            return response('Pelicula Agregada a Favorita', 200);
        }else{
            return response('La Pelicula ya es Favorita');
        };

    }

    public function eliminarFav(PeliculaFavorita $favId)
    {
        dd($favId);
        /* $favId->delete();
        return redirect()->route('favoritasIndex',$usuarioId)->with('success', 'Pelicula Eliminada'); */
    }
}
