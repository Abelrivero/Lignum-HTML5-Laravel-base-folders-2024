<?php

namespace App\Livewire;

use App\Models\Actor;
use App\Models\Pelicula;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class PeliculaEdit extends Component
{
    use WithFileUploads;

    public $titulo, $anio, $duracion, $sinopsis, $imagen, $actorPrincipalID, $actorPrincipalNombre, $peliculaId, $urlImagen;
    public $actors;
    public $isOpen = 0;

    public function mount()
    {
        $this->actors = Actor::all();
    }

    /* public function openModal()
    {
        $this->isOpen = true;
    } */

    /* public function closeModal()
    {
        $this->isOpen = false;
        $this->resetValidation();
    } */

    #[On('showPelicula')]
    public function show($idPelicula)
    {
        $pelicula = Pelicula::find($idPelicula);
        if($pelicula){
           /*  $this->openModal(); */
            $this->dispatch('openModal');
            $this->peliculaId = $pelicula->id;
            $this->titulo = $pelicula->titulo;
            $this->anio = $pelicula->anio;
            $this->duracion = $pelicula->duracion;
            $this->sinopsis = $pelicula->sinopsis;
            $this->urlImagen = $pelicula->imagen;
            $this->actorPrincipalNombre = $pelicula->actor->nombre;
            $this->actorPrincipalID = $pelicula->actorPrincipalID;
        }else{
            $this->dispatch('errorPeliculaFind');
        }
    }

    public function update()
    {
        $pelicula = Pelicula::find($this->peliculaId);
        
        if($this->imagen){
            $imagen = $this->imagen->store('public/imagenes');
            $imagen = str_replace('public', '/storage', $imagen);
            $rutaEliminar = str_replace('/storage', 'public', $pelicula->imagen);
            Storage::delete($rutaEliminar);
        }else{
            $imagen = $pelicula->imagen;
            /* $this->imagen str_replace('public', '/storage', $this->imagen); */
        }
        $validated = $this->validate([
            'titulo' => 'required|min:2|max:250',
            'anio' => 'required',
            'duracion' => 'required',
            'sinopsis' => 'required|min:5|max:500'
        ]);
        $pelicula->update([
            'titulo' => $this->titulo,
            'anio' => $this->anio,
            'duracion' => $this->duracion,
            'sinopsis' => $this->sinopsis,
            'imagen' => $imagen,
            'actorPrincipalID' => $this->actorPrincipalID,
        ]);
        $this->dispatch('successPeliculaEdit');
        $this->redirectRoute('peliculaIndex');
        $this->closeModal(); 
        $this->reset('titulo', 'anio', 'duracion', 'sinopsis', 'imagen', 'actorPrincipalID');
    }
    
    public function closeModal(){
        $this->dispatch('closeModal');
        $this->resetValidation();
    } 

    public function render()
    {

        return view('livewire.pelicula-edit');
    }
}
