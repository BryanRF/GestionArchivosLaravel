t = $("#incidents-table").DataTable({
    ajax: url_api,
    columns: [
        { data: "name", name: "name", orderable: false },
        {
            data: "dni",
            name: "dni",
            orderable: false,
        },
        { data: "role.name", name: "role.name" },
        { data: "address", name: "address" },
        { data: "phone", name: "phone" },
        { data: "email", name: "email" },
        { data: "birthdate", name: "birthdate" },
        {
            data: "actions",
            name: "actions",
            orderable: false,
            searchable: false,
        },
    ],
    paging: true,
    lengthChange: true,
    searching: true,
    ordering: false,
    info: true,
    autoWidth: false,
    responsive: true,
    columnDefs: [
        {
            targets: "no-export",
            exportable: false,
        },
    ],
    dom: "Bflrtip",
    language: {
        sProcessing: "Procesando...",
        sLengthMenu: "Mostrar _MENU_ registros",
        sZeroRecords: "No se encontraron resultados",
        sEmptyTable: "Ningún dato disponible en esta tabla",
        sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
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
    buttons: [
        {
            extend: "excel",
            text: '<i class="fas fa-file-excel"></i> Excel',
            exportOptions: {
                columns: ":not(.no-export)",
            },
            filename: "Lista de " + modulo + " generado el " + day,
            title: "Detalles de " + modulo + "",
        },
        {
            extend: "pdf",
            text: '<i class="fas fa-file-pdf"></i> PDF',
            exportOptions: {
                columns: ":not(.no-export)",
            },
            orientation: "landscape", // Establecer la orientación a 'landscape'
            filename: "Lista de " + modulo + " generado el " + day,
            title: "Detalles de " + modulo + "",
            messageBottom: "\n Reporte generado el " + day,
            header: true,
            footer: true,
            customize: function (doc) {
                doc.styles.title = {
                    fontSize: 16,
                    fontWeight: "bold",
                    alignment: "center",
                };
                doc.styles.tableHeader = {
                    fontSize: 11,
                    fontWeight: "bold",
                    fillColor: "#6699cc",
                    color: "#ffffff",
                    alignment: "center",
                    padding: 5,
                    cellPadding: 5,
                };
                doc.styles.table = {
                    fontSize: 10,
                    alignment: "center",
                    cellPadding: 5,
                    border: "3px solid #646464",
                };
            },
        },
        {
            extend: "print",
            orientation: "landscape",
            pageSize: "LEGAL",
            text: '<i class="fas fa-print"></i> Imprimir',
            exportOptions: {
                columns: ":not(.no-export)",
            },
            filename: "Lista de " + modulo + " generado el " + day,
            title: "Detalles de " + modulo + "",
        },
    ],
    rowCallback: function (row, data, index) {
        $(row).css("background-color", "transparent");
    },
});
