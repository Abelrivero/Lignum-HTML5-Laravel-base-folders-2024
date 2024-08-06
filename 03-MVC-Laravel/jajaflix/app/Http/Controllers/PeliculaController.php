<?php

namespace App\Http\Controllers;

use App\Http\Requests\PeliculaRequest;
use App\Models\Actor;
use App\Models\Pelicula;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
        /* validador en controler
        $request->validate([
            'titulo' => 'required|max:250|min:2',
            'anio' => 'required',
            'duracion' => 'required|max:500',
            'sinopsis' => 'required|max:250',
            'imagen' => 'nullable|image',
            'actorPrincipalID' => 'nullable']); */
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
        //Log::info('Pelicula Creada', ['pelicula' => $pelicula]);
        session()->flash('peliculaCreada', 'Pelicula Creada Exitosamente');
        
        return redirect()->route('peliculaIndex');
    }

    public function editPelicula(Pelicula $peliculaId)
    {
        return view('peliculaViews.edit',['pelicula' => $peliculaId]);
    }

    public function updatePelicula(PeliculaRequest $request,$peliculaId)
    {
        /* validador en controler
        $request->validate([
            'titulo' => 'required|max:250|min:2',
            'anio' => 'required',
            'duracion' => 'required|max:500',
            'sinopsis' => 'required|max:250',
            'imagen' => 'nullable|image',
            'actorPrincipalID' => 'nullable']); */
        $pelicula = Pelicula::find($peliculaId);
        try {
            DB::beginTransaction();  
            if($request->hasFile('imagen')){
                $imagen = $request->file('imagen')->store('public/imagenes');
                $imagen = str_replace('public', '/storage', $imagen);
               /*  $imagenNombre = time().$imagen->getClientOriginalName();
                $ruta = public_path('resources/imagenes/');
                $imagen->move($ruta, $imagenNombre);
                $imagenAnterior = $imagenNombre;
                $rutaEliminar = 'imagenes/'.$peliculaId->imagen; */
                $rutaEliminar = str_replace('/storage', 'public', $pelicula->imagen);
                Storage::delete($rutaEliminar);
            }else{
                $imagen = $pelicula->imagen;
            }
            $pelicula->update([
                'titulo' => $request->titulo,
                'anio' => $request->anio,
                'duracion' => $request->duracion,
                'sinopsis' => $request->sinopsis,
                'imagen' => $imagen,
                'actorPrincipalID' => $request->actorPrincipalID
            ]);
            DB::commit();
            session()->flash('peliculaEditada', 'Pelicula Editada Exitosamente');
        } catch (Exception $ex) {
            Log::info('PeliculaController function updatePelicula');
            Log::info($ex);
            DB::rollBack();
            session()->flash('errorPeliculaEditada', 'Ha Ocurrido un Error, Intente Nuevamente Mas Tarde');
        }

        /* TODO: editar imagen */
        return redirect()->route('peliculaIndex');
    }

    public function deletePelicula($peliculaId)
    {
        try {
            $pelicula = Pelicula::find($peliculaId);
            DB::beginTransaction();
            $pelicula->delete();
            DB::commit();
            session()->flash('peliculaEliminada', 'Pelicula Eliminada Exitosamente');
        } catch (Exception $ex) {
            Log::info('PeliculaController function deletePelicula');
            Log::info($ex);
            DB::rollBack();
            session()->flash('Error', 'Ha Ocurrido un Error');
            //throw $th;
        }
        return redirect()->route('peliculaIndex');
    }
}
