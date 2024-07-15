/* script para mostrar imagen seleccionada */
function cargarImagen(){
    const fileImagen = document.getElementById('imagen');
    const imgSelectd = document.getElementById('imgSelected');
    const imgDefaultPeliculas = imgSelectd.src
    fileImagen.click();
    fileImagen.addEventListener('change', e => {
        if(e.target.files[0]){
            const reader = new FileReader();
            reader.onload = function(e){
                imgSelectd.src = e.target.result;
            }
            reader.readAsDataURL(e.target.files[0]);
        }else{
            imgSelectd.src = imgDefaultPeliculas
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

/* function eliminarFavorita($favId){
    let csrf = $('#tokenselect').val();
    console.log($favId);
    console.log(csrf);
    $.ajax({
        type: 'DELETE',
        url: "/eliminarfavorita/"+$favId,
        headers: {"X-CSRF-TOKEN": csrf},
        success: function (response) {
            console.log(response);
        },
        error: function(res){
            console.log(res);
        }
    });
} */