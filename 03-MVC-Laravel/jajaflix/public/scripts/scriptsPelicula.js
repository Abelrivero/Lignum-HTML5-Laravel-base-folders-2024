/* script para mostrar imagen seleccionada */
function cargarImagen(){
    const fileImagen = document.getElementById('imagen');
    const imgSelectd = document.getElementById('imgSelected');
    const inputImagenAnterior = document.getElementById('imagenAnterior');
    let rutaImagenAnterior = ""
    if(inputImagenAnterior){
        const imagenAnterior = inputImagenAnterior.value
        rutaImagenAnterior = imagenAnterior
    }else{
        rutaImagenAnterior = '/resources/imagenes/imgDefaultPeliculas.jpg'
    }
    fileImagen.click();
    fileImagen.addEventListener('change', e => {
        if(e.target.files[0]){
            const reader = new FileReader();
            reader.onload = function(e){
                imgSelectd.src = e.target.result;
            }
            reader.readAsDataURL(e.target.files[0]);
        }else{
            imgSelectd.src = rutaImagenAnterior
        } 
    });
}

/* Funcion para guardar favoritos */

function guardarFavorito(peliculaId, usuarioId){
    let csrf = $('#tokenselect').val();
    let ruta = '/agregarfavorita/'+usuarioId+'/'+peliculaId
    $.ajax({
        type: "POST",
        url: ruta,
        headers: {"X-CSRF-TOKEN": csrf},
        data: {
            'peliculaId': peliculaId,
            'usuarioId': usuarioId
        },
        success: function (response) {
            alert(response);
        },
        error: function(res){
            console.log('Error '+ res.status);
        }
    });
}

function eliminarFavorita($favId){
    let csrf = $('#tokenselect').val();
    $('#btnEliminarFav').unbind();
    console.log($favId);
    console.log(csrf);
    $.ajax({
        method: 'DELETE',
        url: "/eliminarfavorita/"+$favId,
        headers: {"X-CSRF-TOKEN": csrf},
        success: function (response) {
            console.log(response);
        },
        error: function(res){
            console.log(res);
        }
    });
} 



document.addEventListener('livewire:init', () => {
    Livewire.on('openModal', (event) => {
        $('#componenteModal').modal('show');
        $('#componenteModal').on("change", function(e){
            e.preventDefault();
        })
    });
    Livewire.on('closeModal', (event) => {
        $('#componenteModal').modal('hide');
    });
    /* Livewire.on('successPeliculaEdit', (event) => {
        alert('Pelicula Editada Correctamente');
        $('#listPelicula').load(' #listPelicula');
    }); */
    Livewire.on('errorPeliculaFind', (event) =>{
        alert('Ocurrio un Error, Intente Nuevamente Mas Tarde');
    });
});

$('#btnEditarPelicula').on('click', function() {
    alertSwalConfirm(
        titulo = "Desea Guardar los Cambios Realizados",
        btnConfirm = "Si, Guardar",
        btnCancel = "Cancelar",
        text = "",
        () => {
            $('#btnSubmitForm').click();
        }
    )
    /* $('#btnSubmitForm').click(); */
})

$('.formEliminarPelicula').submit(function (e) { 
    e.preventDefault();
    alertSwalConfirm(
        titulo = 'Desea Eliminar Esta Pelicula',
        btnConfirm = 'Si, Eliminar',
        btnCancel = 'No, Cancelar',
        text = 'La Pelicula se Eliminara de Forma Permanente',
        () => {
            this.submit();
        } 
    )
});
