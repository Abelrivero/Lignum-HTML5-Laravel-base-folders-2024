function alertSwalError(title, text){
    Swal.fire({
        icon: "error",
        title: title,
        text: text
    });
}

function alertSwalSuccess(title){
    Swal.fire({
        position: "top-end",
        icon: "success",
        title: title,
        showConfirmButton: false,
        timer: 1500
      });
}


function alertSwalConfirm(titulo, btnConfirm, btnCancel, text, confirm){
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: "btn btn-success",
          cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
      });
      swalWithBootstrapButtons.fire({
        title: titulo,
        text: text,
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: btnConfirm,
        cancelButtonText: btnCancel,
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
            confirm();
            /* swalWithBootstrapButtons.fire({
            title: "Deleted!",
            text: "Your file has been deleted.",
            icon: "success"
          }); */
        } else if (
          /* Read more about handling dismissals below */
          result.dismiss === Swal.DismissReason.cancel
        ) {
          swalWithBootstrapButtons.fire({
            title: "Cancelled",
            text: "Your imaginary file is safe :)",
            icon: "error"
          });
        }
      });
}

