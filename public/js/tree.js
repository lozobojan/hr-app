
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

    $(".fa-plus").click(function () {
        $('input[type=radio]').prop('checked', false);
        $("#name").val('');
        $('#parent_id').val($(this).data('id'));
    });

    $(".fa-folder-minus").click(function () {
        var id = $(this).data("id");
        console.log(id);
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

    $("#add").click(function () {
        $('input[type=radio]').prop('checked', false);
        $("#name").val('');
        $("#expiration_date").val('');
        $("#type_id").val('');
        $("#sector_id").val('');
        $('#parent_id').val("{{ isset($id) ? $id : '0' }}");
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

    $('#file_input').hide();
});