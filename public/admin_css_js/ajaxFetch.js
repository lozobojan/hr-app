function fetchData(passData, fetchRoute) {
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
    $.ajax({
        url: fetchRoute,
        type: 'GET',
        data: passData,
        cache: false,
        contentType: false,
        processData: false,
        success: function (returndata) {
            if (typeof showData !== "function") {
                console.log('Funtion missing! - 309');
                return;
            }
            showData(returndata);
        },
        error: function (returndata) {
            var errors = returndata.responseJSON;
            var deepErrors = errors.errors;
            swal("Greška!", String(deepErrors[Object.keys(deepErrors)[0]]), "error");
        }
    });
    return false;
}

$('.show-object-data').click(function () {
    var data = $(this).data('id');
    var fetchRoute = $(this).data('route');
    if (data == null || fetchRoute == '')
        return;
    fetchData(data, fetchRoute);
});
