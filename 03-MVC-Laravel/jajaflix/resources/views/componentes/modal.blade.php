<div wire:ignore.self  class="modal fade" id="componenteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 text-dark" id="exampleModalLabel">{{$modalTitle}}</h1>
        {{$botonCerrar}}
      </div>
      <div class="modal-body text-dark">
        {{$modalBody}}
      </div>
      <div class="modal-footer">
        {{$modalCerrar}}
        {{$modalBotonGuardar}}
      </div>
    </div>
  </div>
</div>