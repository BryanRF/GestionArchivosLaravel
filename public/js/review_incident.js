function reviewIncident(id) {
    Swal.fire({
        title: "Revisión de Incidencia",
        html: `
            <form id="reviewForm">
                <div class="mb-3">
                    <label class="form-label">Observaciones</label>
                    <textarea class="form-control" id="review_notes" required></textarea>
                </div>
            </form>
        `,
        showCancelButton: true,
        confirmButtonText: "Confirmar Revisión",
        cancelButtonText: "Cancelar",
        preConfirm: () => {
            return {
                notes: document.getElementById("review_notes").value,
            };
        },
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`/api/incidents/${id}/review`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector(
                        'meta[name="csrf-token"]'
                    ).content,
                },
                body: JSON.stringify({
                    notes: result.value.notes,
                    review_date: new Date().toISOString(),
                }),
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.status === "success") {
                        Toast.fire({
                            icon: "success",
                            title: "Incidencia revisada correctamente",
                        });
                        window.LaravelDataTables[
                            "incidents-table"
                        ].ajax.reload();
                    }
                });
        }
    });
}
