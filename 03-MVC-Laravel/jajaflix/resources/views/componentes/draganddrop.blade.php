<div>
    <div class="drop-zone text-dark">
        <p>Arraste y Suelte su Imagen</p>
        <button onclick="cargarImagen()" type="button">Subir Imagen</button>
    </div>
</div>

@section('scripts')
    <script src="{{asset('/scripts/draganddropScripts.js')}}"></script>
@endsection