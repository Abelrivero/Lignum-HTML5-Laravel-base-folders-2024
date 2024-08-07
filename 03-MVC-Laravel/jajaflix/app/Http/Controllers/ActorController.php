<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActorRequest;
use App\Models\Actor;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ActorController extends Controller
{
    public function indexActor()
    {
        $actores = Actor::paginate(10);
        return view('actorViews.index', ['actores' => $actores]);
    }

    public function buscarActor(Request $request)
    {
        if($request->all()){
            $nombreActor = $request->input('data');
            $actor = Actor::where('nombre', 'like', '%'.$nombreActor.'%')->get();
            return response($actor);
        }
    }

    public function showActor($actorId)
    {
        $actor = Actor::find($actorId);
        return response($actor);
    }

    public function createActor()
    {
        return view('actorViews.create');
    }

    public function storeActor(ActorRequest $request)
    {
        /* $request->rules(); */
        try {
            DB::beginTransaction();
            $actor = new Actor;
            $actor->nombre = $request->nombre;
            $actor->fechaNacimiento = $request->fechaNacimiento;
            $actor->save();
            session()->flash('storeActor', 'Actor Creado Exitosamente');
            DB::commit();
        } catch (Exception $ex) {
            Log::info('ActorController function storeActor');
            Log::info($ex);
            session()->flash('errorStoreActor', 'Ha Ocurrido un Error');
            DB::rollBack();
        }

        return redirect()->route('actorIndex');
    }

    public function editActor(Actor $actorId)
    {
        return view('actorViews.edit', ['actor' => $actorId]);
    }

    public function updateActor(ActorRequest $request, $actorId)
    {
        try {
            DB::beginTransaction();
            $actor = Actor::find($actorId);
            $actor->update([
                'nombre' => $request->nombre,
                'fechaNacimiento' => $request->fechaNacimiento
            ]);
            session()->flash('updateActor', 'Actor Editado Correctamente');
            DB::commit();

        } catch (Exception $ex) {
            Log::info('ActorController function UpdateActor');
            Log::info($ex);
            session()->flash('errorUpdateActor', 'Ha Ocurrido un Error');
            DB::rollBack();
        }
        /* return redirect()->route('actorIndex'); */ //redireccion cuando se hace con laravel
        return response('Actor Editado Correctamente', 200);
    }

    public function deleteActor($actorId)
    {
        $actor = Actor::find($actorId);
        $actor->delete();
        session()->flash('actorDelete', 'Actor Eliminado Correctamente');
        /* try {
            DB::beginTransaction();
            DB::commit();
        } catch (Exception $ex) {
            Log::info('ActorController function deleteActor');
            Log::info($ex);
            session()->flash('errorActorDelete', 'Ha Ocurrido un Error');
            DB::rollBack();
        } */
        /* return response('Actor Eliminado Correctamente', 200); */
        /* return redirect()->route('actorIndex'); */
    }
}
