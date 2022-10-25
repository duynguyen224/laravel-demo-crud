$(document).ready(function () {
    // Button add new row
    $("#btnPlus").on("click", function () {
        $("#rowInsertProduct").show();
    });

    // Button cancel
    $("#btnCancel").on("click", function () {
        window.location.reload();
    });

    // Sortable
    $(function () {
        $("#sortable1, #sortable2")
            .sortable({
                placeholder: "ui-state-highlight",
                // handle: ".drag-handler",
                connectWith: ".connectedSortable",
                receive: function (event, ui) {
                    // Hide two last column when drag
                    $("#sortable2 tr td:nth-last-child(2)").hide();
                    $("#sortable2 tr td:last-child").hide();
                },
            })
            .disableSelection();
    });

    // Delete items in sortable list
    $("#btnDeleteSortableList").on("click", function () {
        // Retrieve all the id of items
        const rows = $("#sortable2 tr");
        let itemIds = [];
        rows.each(function (index) {
            let id = $(this).find("td:first").text().trim();
            if (id.length > 0) {
                itemIds.push(parseInt(id));
            }
        });

        // Ajax call
        $.ajax({
            url: "http://127.0.0.1:8000/api/products/delete-list-products",
            headers: {
                "Content-Type": "application/json",
            },
            method: "POST",
            dataType: "json",
            data: JSON.stringify({ listId: itemIds }),
            success: function (msg) {
                $("#success-ajax").show();
                $("#success-ajax").text("Deleting ...");
                setTimeout(() => {
                    $("#success-ajax").hide();
                    window.location.reload();
                }, 1000);
            },
            error: function (err) {
                alert(err);
            },
        });
    });
});
