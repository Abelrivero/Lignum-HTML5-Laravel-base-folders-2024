<div>
    @component('componentes.modal')
        @slot('modalTitle', 'Editar Pelicula')

        @slot('botonCerrar')
            <button type="button" class="btn-close" wire:click="closeModal()"></button>
        @endslot
        
        @slot('modalBody')
        <form action="" wire:submit="update">
            @if ($urlImagen)
                <img src="{{asset($urlImagen)}}" alt="" width="200" height="200">
                <br>
            @else
                <img src="{{asset('/resources/imagenes/imgDefaultPeliculas.jpg')}}" alt="" width="200" height="200">
                <br>
            @endif
            <label for="titulo">Titulo:</label>
            <input type="text" wire:model="titulo" id="titulo">
            @error('titulo')<span class="error text-danger">{{ $message }}</span>@enderror
            <br>
            <label for="anio">Año:</label>
            <input type="date" wire:model="anio" id="anio">
            @error('anio')<span class="error text-danger">{{ $message }}</span>@enderror
            <br>
            <label for="duracion">Duracion:</label>
            <input type="number" wire:model="duracion" id="duracion">
            @error('duracion')<span class="error text-danger">{{ $message }}</span>@enderror
            <br>
            <label for="sinopsis">Sinopsis:</label>
            <textarea name="" id="" cols="10" rows="5" wire:model="sinopsis" id="sinopsis"></textarea>
            @error('sinopsis')<span class="error text-danger">{{ $message }}</span>@enderror
            <br>
            <label for="">Imagen:</label>
            <input type="text" wire:model="imagen" id="imagen">
            <input type="file" wire:model="imagen">
            <label for=""></label>
            <input type="text" wire:model="actorPrincipalID">
            <button hidden type="submit" id="btnSubmitForm"></button>
        </form>
        @endslot

        @slot('modalCerrar')
            <button type="button" class="btn btn-secondary" wire:click="closeModal()">Cerrar</button>
        @endslot

        @slot('modalBotonGuardar')
            <button class="btn btn-primary" id="btnEditarPelicula">Editar Pelicula</button>
        @endslot
        
    @endcomponent
</div>
