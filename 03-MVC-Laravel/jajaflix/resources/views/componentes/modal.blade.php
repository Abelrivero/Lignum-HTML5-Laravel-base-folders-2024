<div class="modal fade" id="componenteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5 text-dark" id="exampleModalLabel">{{$modalTitle}}</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          {{$modalBody}}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          {{$modalBotonGuardar}}
        </div>
      </div>
    </div>
  </div>

@section('scripts')
  <script src="{{asset('/scripts/scriptsActor.js')}}"></script>
@endsection