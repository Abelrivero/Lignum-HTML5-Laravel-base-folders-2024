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

const dropZone = document.querySelector('.drop-zone');
if(dropZone){
    let text = document.createElement('p');
    
    dropZone.addEventListener("dragenter", (ev) => {
        text.textContent = 'suelta el archivo';
        dropZone.appendChild(text);
        
    });
      
    dropZone.addEventListener("dragleave", () => {
        dropZone.removeChild(text);
    });
      
    dropZone.addEventListener("dragover", (ev) => {
        ev.preventDefault();
    
    });
    
    dropZone.addEventListener("drop", (ev) => {
        ev.preventDefault();
        dropZone.removeChild(text);
        console.log(ev.dataTransfer.files);
      });
}