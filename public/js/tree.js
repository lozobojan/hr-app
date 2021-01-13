function resetModal(){
    $('input[type=radio]').prop('checked', false);
    $("#name").val('');
    $('#name').attr("placeholder", "Naziv direktorijuma ili fajla");
    $("#expiration_date").val('');
    $("#type_id").val('');
    $("#sector_id").val('');
    $('#file_input').hide();
}

$(function () {

    $('.tree li:has(ul)').addClass('parent_li').find(' > span').attr('title', 'Collapse this branch');
    $('.tree li.parent_li > span').on('click', function (e) {
        var children = $(this).parent('li.parent_li').find(' > ul > li');
        if (children.is(":visible")) {
            children.hide('fast');
            $(this).attr('title', 'Expand this branch').find(' > i').addClass('fa-plus').removeClass('fa-minus');
        } else {
            children.show('fast');
            $(this).attr('title', 'Collapse this branch').find(' > i').addClass('fa-minus').removeClass('fa-plus');
        }
        e.stopPropagation();
    });
    
    $("#add").click(function () {
        resetModal();
        $('#parent_id').val($(this).data('id'));
    });

    $(".fa-plus").click(function () {
        resetModal();
        $('#parent_id').val($(this).data('id'));
    });

    $(".fa-folder-minus").click(function () {
        var id = $(this).data("id");
        if(id == 1){
            swal("Brisanje foldera nije moguce!");
            return;    
        }
        swal("Da li želite da izbrišete i sadržaj foldera?", {
            buttons: {
                da: {
                    text: "Da!",
                    value: "1",
                },
                ne: {
                    text: 'Ne!',
                    value: '2',
                },
                cancel: "Otkaži",
            },
        }).then((value) => {
            if (value == 1) {
                window.location.href = "/directory/delete-all/" + id;
            }
            else if (value == 2) {
                window.location.href = "/directory/delete-dir/" + id;
            }
        });
    });

    $(".fa-trash-alt").click(function () {
        var id = $(this).data("id");
        swal("Da li želite da izbrišete dokument?", {
            buttons: {
                da: {
                    text: "Da!",
                    value: "1",
                },
                cancel: "Otkaži",
            },
        }).then((value) => {
            if (value == 1) {
                window.location.href = "/directory/delete/" + id;
            }
        });
    });


    $('input[type=radio][name=is_folder]').change(function () {
        if (this.value == '1') {
            $('#name').attr("placeholder", "Naziv direktorijuma");
            $('#file_input').hide();
        }
        else if (this.value == '0') {
            $('#name').attr("placeholder", "Naziv fajla");
            $('#file_input').show();
        }
    });
});