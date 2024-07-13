/* script para mostrar imagen seleccionada */
const fileImagen = document.getElementById('imagen');
const imgSelectd = document.getElementById('imgSelected');
const imgDefaultPeliculas = imgSelectd.src
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