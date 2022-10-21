$(document).ready(function () {
    $("#btnPlus").on("click", function () {
        $("#rowInsertProduct").show();
    });

    $("#btnCancel").on("click", function () {
        window.location.reload();
    });
});
