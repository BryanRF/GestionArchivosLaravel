document
    .getElementById("form-table")
    .addEventListener("submit", function (event) {
        event.preventDefault();

        let formData = new FormData(this);

        fetch(url_store, {
            method: "POST",
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
                    title: "Registro creada exitosamente!",
                    icon: "success",
                    showCancelButton: true,
                    confirmButtonText: "Seguir Registrando",
                    cancelButtonText: "Regresar a la Lista",
                    reverseButtons: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload(); // Recarga la página para seguir registrando
                    } else {
                        window.location.href = url_lista; // Redirige a la lista de incidencias
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
