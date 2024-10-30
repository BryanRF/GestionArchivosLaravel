$("#verEmpleados").on("click", function () {
    $.ajax({
        url: url_empleados,
        type: "GET",
        dataType: "json",
        success: function (response) {
            var table = '<table class="table" id="table_empleados">';
            table +=
                "<thead><tr><th class='text-center'>DNI</th><th class='text-center'>Nombre</th><th class='text-center'>Acciones</th></tr></thead>";
            table += "<tbody>";
            response.data.forEach(function (employee) {
                table += "<tr>";
                table += "<td>" + employee.dni + "</td>";
                table += "<td>" + employee.name + "</td>";
                table += "<td>" + employee.actions + "</td>";
                table += "</tr>";
            });
            table += "</tbody></table>";

            Swal.fire({
                title: "Lista de Empleados",
                html: table,
                showCancelButton: false,
                showConfirmButton: false,
                customClass: "swal-wide",
            });
            $(".table").DataTable({
                paging: true,
                lengthChange: true,
                searching: true,
                ordering: true,
                info: true,
                autoWidth: false,
                responsive: true,
                language: {
                    sProcessing: "Procesando...",
                    sLengthMenu: "Mostrar _MENU_ registros",
                    sZeroRecords: "No se encontraron resultados",
                    sEmptyTable: "Ningún dato disponible en esta tabla",
                    sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    sInfoEmpty:
                        "Mostrando registros del 0 al 0 de un total de 0 registros",
                    sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
                    sInfoPostFix: "",
                    sSearch: "Buscar:",
                    sUrl: "",
                    sInfoThousands: ",",
                    sLoadingRecords: "Cargando...",
                    oPaginate: {
                        sFirst: "Primero",
                        sLast: "Último",
                        sNext: "Siguiente",
                        sPrevious: "Anterior",
                    },
                    oAria: {
                        sSortAscending:
                            ": Activar para ordenar la columna de manera ascendente",
                        sSortDescending:
                            ": Activar para ordenar la columna de manera descendente",
                    },
                    buttons: {
                        copy: "Copiar", // Traducir "Copiar" a "Copiar" en español
                        copyTitle: "Copiado al portapapeles",
                        copySuccess: {
                            _: "%d filas copiadas",
                            1: "1 fila copiada",
                        },
                    },
                },
            });
        },
        error: function (xhr, status, error) {
            Toast.fire({
                icon: "error",
                title: "Error al cargar empleados: " + error,
            });
        },
    });
});

$("#verItems").on("click", function () {
    $.ajax({
        url: url_items,
        type: "GET",
        dataType: "json",
        success: function (response) {
            var table = '<table class="table">';
            table +=
                "<thead><tr><th class='text-center'>Nombre</th><th class='text-center'>Categoria</th><th class='text-center'>Acciones</th></tr></thead>";
            table += "<tbody>";
            response.data.forEach(function (item) {
                table += "<tr>";
                table += "<td>" + item.name + "</td>";
                table += "<td>" + item.category.name + "</td>";
                table += "<td>" + item.actions + "</td>";
                table += "</tr>";
            });
            table += "</tbody></table>";

            Swal.fire({
                title: "Lista de Items",
                html: table,
                showCancelButton: false,
                showConfirmButton: false,
                customClass: "swal-wide",
            });
            $(".table").DataTable({
                paging: true,
                lengthChange: true,
                searching: true,
                ordering: true,
                info: true,
                autoWidth: false,
                responsive: true,
                language: {
                    sProcessing: "Procesando...",
                    sLengthMenu: "Mostrar _MENU_ registros",
                    sZeroRecords: "No se encontraron resultados",
                    sEmptyTable: "Ningún dato disponible en esta tabla",
                    sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    sInfoEmpty:
                        "Mostrando registros del 0 al 0 de un total de 0 registros",
                    sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
                    sInfoPostFix: "",
                    sSearch: "Buscar:",
                    sUrl: "",
                    sInfoThousands: ",",
                    sLoadingRecords: "Cargando...",
                    oPaginate: {
                        sFirst: "Primero",
                        sLast: "Último",
                        sNext: "Siguiente",
                        sPrevious: "Anterior",
                    },
                    oAria: {
                        sSortAscending:
                            ": Activar para ordenar la columna de manera ascendente",
                        sSortDescending:
                            ": Activar para ordenar la columna de manera descendente",
                    },
                    buttons: {
                        copy: "Copiar", // Traducir "Copiar" a "Copiar" en español
                        copyTitle: "Copiado al portapapeles",
                        copySuccess: {
                            _: "%d filas copiadas",
                            1: "1 fila copiada",
                        },
                    },
                },
            });
        },
    });
});
function SeleccionarEmpleados(id, nombre) {
    // Actualizar los campos con los datos del botón
    document.getElementById("employee_id").value = id;
    document.getElementById("employee_aux").value = nombre;
    Swal.close();
    Toast.fire({
        icon: "success",
        title: "Seleccionado correctamente",
    });
}
function SeleccionarItem(id, nombre) {
    // Actualizar los campos con los datos del botón
    document.getElementById("item_id").value = id;
    document.getElementById("item_aux").value = nombre;
    Swal.close();
    Toast.fire({
        icon: "success",
        title: "Seleccionado correctamente",
    });
}

document
    .getElementById("form-incidencia")
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
                    throw new Error("Error al crear la incidencia");
                }
                return response.json();
            })
            .then((data) => {
                // Aquí puedes manejar la respuesta de la API
                console.log(data);

                Swal.fire({
                    title: "¡Incidencia creada exitosamente!",
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
                    text: "Error al crear la incidencia",
                    icon: "error",
                });
            });
    });
