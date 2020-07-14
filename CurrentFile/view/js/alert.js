window.setTimeout(function () {
    $(".alert-success").fadeTo(500, 0).slideUp(500, function () {
        $(this).remove();
    });
}, 5000);

window.setTimeout(function () {
    $(".alert-warning").fadeTo(500, 0).slideUp(500, function () {
        $(this).remove();
    });
}, 5000);