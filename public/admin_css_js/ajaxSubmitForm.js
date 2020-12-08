$(".submitForm").submit(function(event){
    event.preventDefault();
    $(".submitFormBtn").attr("disabled", true);
    $(".formSpinner").show();
    var formData = new FormData($(this)[0]);
    // if(typeof route === undefined)
    var route = $(this).attr('action');
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $.ajax({
        url: route,
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function (returndata, statusText, xhr) {
          $(".formSpinner").hide();
          $(".submitFormBtn").attr("disabled", false);
          if(xhr.status == 200 &&  statusText == 'success'){
            swal("Poooof!", "Uspješno ste sačuvali podatke!", "success").then((value) => {
              $("form")[0].reset();
              window.location.reload(true);
            });
          }
        },
        error: function (returndata) {
          $(".formSpinner").hide();
          $(".submitFormBtn").attr("disabled", false);
            console.log(returndata.responseJSON)
			var errors = returndata.responseJSON;
			var deepErrors = errors.errors;
			swal("Greška!", String(deepErrors[Object.keys(deepErrors)[0]]) , "error");
        }
    });
    return false;
});

