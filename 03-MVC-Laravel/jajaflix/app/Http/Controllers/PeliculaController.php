<?php

namespace App\Http\Controllers;

use App\Http\Requests\PeliculaRequest;
use App\Models\Actor;
use App\Models\Pelicula;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    public function storePelicula(PeliculaRequest $request)
    {
        $pelicula = new Pelicula;
        $pelicula->titulo = $request->titulo;
        $pelicula->anio = $request->anio;
        $pelicula->duracion = $request->duracion;
        $pelicula->sinopsis = $request->sinopsis;
        $pelicula->actorPrincipalID = $request->actorPrincipalID;
        if($request->hasFile('imagen')){
            $imagen = $request->file('imagen')->store('public/imagenes');
            $imagen = str_replace('public', '/storage', $imagen);
         /*    $path = $request->file('avatar')->store('avatars');
            $imagenNombre = time().$imagen->getClientOriginalName();
            $ruta = public_path('resources/imagenes/');
            $imagen->move($ruta, $imagenNombre); */
            $pelicula->imagen = $imagen;
        }
        $pelicula->save();
        
        return redirect()->route('peliculaIndex');
    }

    public function editPelicula(Pelicula $peliculaId)
    {
        return view('peliculaViews.edit',['pelicula' => $peliculaId]);
    }

    public function updatePelicula(PeliculaRequest $request, Pelicula $peliculaId)
    {
       
        if($request->hasFile('imagen')){
            $imagen = $request->file('imagen')->store('public/imagenes');
            $imagen = str_replace('public', '/storage', $imagen);
           /*  $imagenNombre = time().$imagen->getClientOriginalName();
            $ruta = public_path('resources/imagenes/');
            $imagen->move($ruta, $imagenNombre);
            $imagenAnterior = $imagenNombre;
            $rutaEliminar = 'imagenes/'.$peliculaId->imagen; */
            $rutaEliminar = str_replace('/storage', 'public', $peliculaId->imagen);
            Storage::delete($rutaEliminar);
        }else{
            $imagen = $peliculaId->imagen;
        }
        $peliculaId->update([
            'titulo' => $request->titulo,
            'anio' => $request->anio,
            'duracion' => $request->duracion,
            'sinopsis' => $request->sinopsis,
            'imagen' => $imagen,
            'actorPrincipalID' => $request->actorPrincipalID
        ]);

        /* TODO: editar imagen */
        return redirect()->route('peliculaIndex');
    }

    public function deletePelicula(Pelicula $peliculaId)
    {
        $peliculaId->delete();
        return redirect()->route('peliculaIndex');
    }
}
