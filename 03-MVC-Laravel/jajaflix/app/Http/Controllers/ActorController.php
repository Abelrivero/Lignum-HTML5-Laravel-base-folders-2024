<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActorRequest;
use App\Models\Actor;
use Illuminate\Http\Request;

class ActorController extends Controller
{
    public function indexActor()
    {
        $actores = Actor::all();
        return view('actorViews.index', ['actores' => $actores]);
    }

    public function showActor(Actor $actorId)
    {
        //TODO: agregar documentacion ya que $actorID es una id y se devuelve un objeto con el actor 

        return response($actorId);
    }

    public function createActor()
    {
        return view('actorViews.create');
    }

    public function storeActor(ActorRequest $request)
    {
        /* $request->rules(); */
        $actor = new Actor;
        $actor->nombre = $request->nombre;
        $actor->fechaNacimiento = $request->fechaNacimiento;
        $actor->save();
        session()->flash('exito', 'Actor Creado Exitosamente');

        return redirect()->route('actorIndex');
    }

    public function editActor(Actor $actorId)
    {
        return view('actorViews.edit', ['actor' => $actorId]);
    }

    public function updateActor(ActorRequest $request, Actor $actorId)
    {
    
        $actorId->update([
            'nombre' => $request->nombre,
            'fechaNacimiento' => $request->fechaNacimiento
        ]);
        /* return redirect()->route('actorIndex'); */ //redireccion cuando se hace con laravel
        return response('Actor Editado Correctamente', 200);
    }

    public function deleteActor(Actor $actorId)
    {
        $actorId->delete();
        /* return response('Actor Eliminado Correctamente', 200); */
        return redirect()->route('actorIndex');
    }
}
