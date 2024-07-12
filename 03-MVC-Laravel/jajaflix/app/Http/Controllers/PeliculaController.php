<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\Pelicula;
use Illuminate\Http\Request;

class PeliculaController extends Controller
{
    public function indexPelicula()
    {
        $peliculas = Pelicula::all();
        return view('peliculaViews.index', ['peliculas' => $peliculas]);
    }

    public function showPelicula()
    {

    }

    public function createPelicula()
    {
        $actores = Actor::all();
        return view('peliculaViews.create', ['actores' => $actores]);
    }   

    public function storePelicula(Request $request)
    {
        $pelicula = new Pelicula;
        $pelicula->titulo = $request->titulo;
        $pelicula->anio = $request->anio;
        $pelicula->duracion = $request->duracion;
        $pelicula->sinopsis = $request->sinopsis;
        $pelicula->imagen = $request->imagen;
        $pelicula->actorPrincipalID = $request->actorPrincipalID;
        $pelicula->save();
        
        return redirect()->route('peliculaIndex');
    }

    public function editPelicula(Pelicula $peliculaId)
    {
        return view('peliculaViews.edit',['pelicula' => $peliculaId]);
    }

    public function updatePelicula(Request $request, Pelicula $peliculaId)
    {
        $peliculaId->update([
            'titulo' => $request->titulo,
            'anio' => $request->anio,
            'duracion' => $request->duracion,
            'sinopsis' => $request->sinopsis,
            'imagen' => $request->imagen,
            'actorPrincipalID' => $request->actorPrincipalID
        ]);
        return redirect()->route('peliculaIndex');
    }

    public function deletePelicula(Pelicula $peliculaId)
    {
        $peliculaId->delete();
        return redirect()->route('peliculaIndex');
    }
}
