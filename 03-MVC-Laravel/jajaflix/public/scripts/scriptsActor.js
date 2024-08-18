$(function(){
    let urlListado = "/config/actor/listadoActor"
    ajaxTablaActor(urlListado)
})

function ajaxTablaActor(urlListado){
        $.ajax({
            type: "GET",
            url: urlListado,
            success: function (response) {
                generarLinks(response.links);
                generarTablaActor(response.data);
                
            }
        });
}
function generarTablaActor(actores){
    let tbodyTablaActor = $('#tbodyTablaActor');
    tbodyTablaActor.empty();
    actores.map(function(element){
        tbodyTablaActor.append('<tr><td>'+element.id+'</td><td>'+element.nombre+'</td><td>'+element.fechaNacimiento+'</td><td><button class="btn btn-primary me-3" onclick="showActor('+element.id+')">Editar</button><button class="btn btn-danger" onclick="eliminarActor('+element.id+')">Eliminar</button>')
    })
}

function generarLinks(links){
    let ulLinks = $('#ulLinks');
    ulLinks.empty();
    links.map(function(element){
        if(element.url != null){
           ulLinks.append(`<li class="page-item"><a class="page-link" onclick="ajaxTablaActor('${element.url}')">${element.label}</a></li>`)
        }
    })
}


$('#buscador').on("keyup",debounce(function(){
    let buscado = $(this).val(); 
   
    
    if(buscado.length < 3){
        $('#textBuscador').empty();
        $('#tbodyTablaActor').show();
        $('#tbodyVacio').empty();
    }   
    if(buscado.length > 3){
        $.ajax({
            type: "GET",
            url: "/config/actor/buscarActor",
            data: { data: buscado },
            success: function (response) {
                if(response.length == 0){
                    $('#textBuscador').text('No Existe el Actor');

                }else{
                    generarTablaActorBuscado(response)               
                }
            },error: function(res){
                let title = 'Ha Ocurrido un Error ';
                let text = 'Error '+res.status+', Intente Nuevamente Mas Tarde';
                alertSwalError(title, text);
            }
        });        
    }//TODO:terminar buscador con ajax
}, 700)) 


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

function eliminarActor(idActor){
    alertSwalConfirm(
        titulo = 'Desea Eliminar Este Actor',
        btnConfirm = 'Si, Eliminar',
        btnCancel = 'No, Cancelar',
        text = 'El Actor se Eliminara de Forma Permanente',
        () => {
            $.ajaxSetup({
                headers:
                { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });
           $.ajax({
            type: "DELETE",
            url: "/config/actor/delete/"+ idActor,
            data: "data",
            success: function (response) {
                alertSwalSuccess(response);
                $("#listActor").load(" #listActor");
            },error: function(res){
                let title = 'Ha Ocurrido un Error ';
                let text = 'Error '+res.status+', Intente Nuevamente Mas Tarde';
                alertSwalError(title, text);
            }
           });
        } 
    )
}

/* $('.formEliminarActor').submit(function (e) { 
    e.preventDefault();
    alertSwalConfirm(
        titulo = 'Desea Eliminar Este Actor',
        btnConfirm = 'Si, Eliminar',
        btnCancel = 'No, Cancelar',
        text = 'El Actor se Eliminara de Forma Permanente',
        () => {
            this.submit();
        } 
    )
}); */

function cerrarModal(){
    let ulErrors = $('#ulErrors');
    $('#componenteModal').modal('hide');
    ulErrors.empty();
    $('input').removeClass('border border-danger');
}

function debounce(funct, await){
    let timer;
    return function(...args){
       const context = this;
       clearTimeout(timer);
       timer = setTimeout(()=>funct.apply(context,args),await)
    };
}

function generarTablaActorBuscado(acotres){
    let tbodyVacio = $('#tbodyVacio');
    let tbodyTablaActor = $('#tbodyTablaActor');
    acotres.map(function(element){
        tbodyVacio.append('<tr><td>'+element.id+'</td><td>'+element.nombre+'</td><td>'+element.fechaNacimiento+'</td><td><button class="btn btn-primary me-3" onclick="showActor('+element.id+')">Editar</button><button class="btn btn-danger" onclick="eliminarActor('+element.id+')">Eliminar</button>')
    })
    tbodyTablaActor.hide();
}

let invetir = false;
function ordenarTabla(){
    invetir = !invetir;
    $.ajax({
        type: "GET",
        url: "/config/actor/listadoActor",
        data: {data: invetir},
        success: function (response) {
            console.log(response.links.reverse());
            generarLinks(response.links);
            generarTablaActor(response.data);
            

            
            /* $('#tbodyVacio').html(response); */
           
        }
    });    
    
    
}