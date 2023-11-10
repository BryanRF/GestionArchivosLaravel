document
    .getElementById("form-table")
    .addEventListener("submit", function (event) {
        event.preventDefault();

        let formData = new FormData(this);
        console.log(formData);
        fetch(url_update, {
            method: "put",
            body: formData,
        })
            .then((response) => {
                if (!response.ok) {
                    Toast.fire({
                        icon: "error",
                        title: "Ocurrio un error",
                    });
                    throw new Error("Error al registrar ");
                }
                return response.json();
            })
            .then((data) => {
                // Aquí puedes manejar la respuesta de la API
                console.log(data);

                Swal.fire({
                    title: "Actualizacion completada!",
                    icon: "success",
                    showCancelButton: false,
                    confirmButtonText: "Regresar a la Lista",
                    reverseButtons: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = url_lista; // Recarga la página para seguir registrando
                    }
                });
            })
            .catch((error) => {
                // Aquí puedes manejar errores
                console.log(error);
                Swal.fire({
                    title: "Error",
                    text: "Error al registrar",
                    icon: "error",
                });
            });
    });
