let idActor;

function showActor(actorID){
    $.ajaxSetup({
        headers:
        { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });
    $.ajax({
        type: "GET",
        url: "/config/actor/showActor/" + actorID,
        success: function (response) {
            $('#componenteModal').modal('show')
            $('#nombre').val(response.nombre);
            $('#fechaNacimiento').val(response.fechaNacimiento);
            idActor = response.id;
        },
        error: function(res){
            let title = 'Ha Ocurrido un Error ';
            let text = 'Error '+res.status+', Intente Nuevamente Mas Tarde';
            alertSwalError(title, text);
        }   
    });
}

function guardarActor() {
    let nombre = $('#nombre');
    let fechaNacimiento = $('#fechaNacimiento');
    let ulErrors = $('#ulErrors');
    
    alertSwalConfirm(
        titulo = 'Desear Guardar Los Cambios',
        btnConfirm = 'Guardar los cambios',
        btnCancel = 'Cancelar',
        text = '',
        function(){ 
             $.ajax({
                 type: "PUT",
                 url: "/config/actor/update/"+idActor,
                 data:{
                     'nombre': nombre.val(),
                     'fechaNacimiento': fechaNacimiento.val(),
                 },
                 success: function (response) {
                     alertSwalSuccess(response);
                     $("#listActor").load(" #listActor");
                     $('#componenteModal').modal('hide');
                 },
                 error: function(res){
                     ulErrors.empty();
                     let errors = res.responseJSON.errors;
                     for (let field in errors) {
                         if (errors.hasOwnProperty(field)) {
                             let inputField = $('#' + field);
                             if (inputField.length) {
                                 inputField.addClass('border border-danger');   
                             }
                             errors[field].forEach(error => {
                                 let li = $('<li></li>').text(error);
                                 li.addClass('text-dark');
                                 ulErrors.append(li);
                             });
                         }
                     }
                 }
             });
        }
    )
}

$('.formEliminarActor').submit(function (e) { 
    e.preventDefault();
    alertSwalConfirm(
        titulo = 'Desea Eliminar Este Actor',
        btnConfirm = 'Si, Eliminar',
        btnCancel = 'No, Cancelar',
        text = 'El Actor se Eliminara de Forma Permanente',
        () => {
            alertSwalSuccess('Actor Eliminado Correctamente');
            setTimeout(()=>{
                this.submit();
            }, 1500)
            /* $("#listActor").load(" #listActor"); */
         
        } 
    )
});

function cerrarModal(){
    let ulErrors = $('#ulErrors');
    $('#componenteModal').modal('hide');
    ulErrors.empty();
    $('input').removeClass('border border-danger');
}