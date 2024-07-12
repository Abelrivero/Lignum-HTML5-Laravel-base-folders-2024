<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use Illuminate\Http\Request;

class ActorController extends Controller
{
    public function indexActor()
    {
        $actores = Actor::all();
        return view('actorViews.index', ['actores' => $actores]);
    }

    public function showActor()
    {

    }

    public function createActor()
    {
        return view('actorViews.create');
    }

    public function storeActor(Request $request)
    {
        $actor = new Actor;
        $actor->nombre = $request->nombre;
        $actor->fechaNacimiento = $request->fechaNacimiento;
        $actor->save();

        return redirect()->route('actorIndex');
    }

    public function editActor(Actor $actorId)
    {
        return view('actorViews.edit', ['actor' => $actorId]);
    }

    public function updateActor(Request $request, Actor $actorId)
    {
    
        $actorId->update([
            'nombre' => $request->nombre,
            'fechaNacimiento' => $request->fechaNacimiento
        ]);
        return redirect()->route('actorIndex');
    }

    public function deleteActor(Actor $actorId)
    {
        $actorId->delete();
        return redirect()-route('actorIndex');
    }
}
