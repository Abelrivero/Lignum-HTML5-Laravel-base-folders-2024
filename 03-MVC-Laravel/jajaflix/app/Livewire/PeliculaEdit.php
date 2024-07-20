<?php

namespace App\Livewire;

use App\Models\Pelicula;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class PeliculaEdit extends Component
{
    use WithFileUploads;

    public $titulo, $anio, $duracion, $sinopsis, $imagen, $actorPrincipalID, $actorPrincipalNombre, $peliculaId, $urlImagen;

    #[On('showPelicula')]
    public function show($idPelicula)
    {
        $pelicula = Pelicula::find($idPelicula);
        $this->peliculaId = $pelicula->id;
        $this->titulo = $pelicula->titulo;
        $this->anio = $pelicula->anio;
        $this->duracion = $pelicula->duracion;
        $this->sinopsis = $pelicula->sinopsis;
        $this->urlImagen = $pelicula->imagen;
        $this->actorPrincipalNombre = $pelicula->actor->nombre;
        $this->actorPrincipalID = $pelicula->actorPrincipalID;
        $this->dispatch('openModal');
    }

    public function update()
    {
        $pelicula = Pelicula::find($this->peliculaId);
        $imagen = $this->imagen;
        dd($imagen);
        if($imagen == null){
            $imagen = $pelicula->imagen;
        }else{
            $this->imagen->store('public/imagenes');
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
            'imagen' => $this->imagen,
            'actorPrincipalID' => $this->actorPrincipalID,
            dd($this->imagen->filename)
        ]);
        session()->flash('success', 'Pelicula Editada Correctamente');
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
