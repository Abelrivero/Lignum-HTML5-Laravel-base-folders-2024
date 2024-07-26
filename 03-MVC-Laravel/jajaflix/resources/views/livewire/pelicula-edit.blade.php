<div>
    {{-- @if($isOpen) --}}
    @component('componentes.modal')
        @slot('modalTitle', 'Editar Pelicula')

        @slot('botonCerrar')
            <button type="button" class="btn-close" wire:click="closeModal()"></button>
        @endslot
        
        @slot('modalBody')
        <form action="" wire:submit="update">
            <div class="d-flex justify-content-center">
                <div class="col-11">
                    @if ($imagen)
                        <img src="{{asset($imagen->temporaryUrl())}}" alt="" width="200" height="200" class="rounded">
                        <br>
                    @else
                        <img src="{{asset($urlImagen ?? '/resources/imagenes/imgDefaultPeliculas.jpg')}}" alt="" width="200" height="200" class="rounded">
                        <br>
                    @endif
                    <label for="titulo" class="label">
                        <input type="text" placeholder=" " class="input @error('titulo') border border-danger @enderror" id="titulo" wire:model="titulo" name="titulo" value="{{old('titulo')}}">
                        <span class="spanName">Titulo:</span>
                    </label>
                    @error('titulo')<span class="error text-danger">{{ $message }}</span>@enderror
                    <label for="anio" class="label">
                        <input type="date" placeholder=" " class="input @error('anio') border border-danger @enderror" id="anio" wire:model="anio">
                        <span class="spanName">Año:</span>
                    </label>
                    @error('anio')<span class="error text-danger">{{ $message }}</span>@enderror
                    <label for="duracion" class="label">
                        <input type="number" placeholder=" " class="input @error('duracion') border border-danger @enderror" id="duracion" wire:model="duracion">
                        <span class="spanName">Duracion:</span>
                    </label>
                    @error('duracion')<span class="error text-danger">{{ $message }}</span>@enderror
                    <span class="spanNameTextArea">Sinopsis:</span>
                    <label for="sinopsis" class="label">
                        <textarea name="" id="floatingTextarea2" cols="30" rows="10" placeholder=" " wire:model="sinopsis" class="input @error('sinopsis') border border-danger @enderror"></textarea>
                    </label>
                    @error('sinopsis')<span class="error text-danger">{{ $message }}</span>@enderror
                    <br>
                    <input type="file" wire:model="imagen">
                    <br>
                    <label for="actorPrincipal">Actor Principal:</label>
                    <select name="" id="actorPrincipal" wire:model="actorPrincipalID">
                        <option value="" selected disabled>Actor Principal</option>
                        @foreach ($actors as $actor)
                        <option value="{{$actor->id}}">{{$actor->nombre}}</option>
                        @endforeach
                    </select>
                    <button hidden type="submit" id="btnSubmitForm"></button>
                </div>
            </div>
            </form>
        @endslot

        @slot('modalCerrar')
            <button type="button" class="btn btn-secondary" wire:click="closeModal()">Cerrar</button>
        @endslot

        @slot('modalBotonGuardar')
            <button class="btn btn-primary" id="btnEditarPelicula">Editar Pelicula</button>
        @endslot
        
    @endcomponent
    {{-- @endif --}}
</div>
