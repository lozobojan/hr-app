function createRequest(url, type) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: url,
        type: type,
        cache: false,
        contentType: false,
        processData: false,
        success: function (returndata) {
            window.location = returndata;
        },
        error: function (returndata) {
            console.log(returndata);
        }
    });
}
