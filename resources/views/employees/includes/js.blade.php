<script>
    $('[data-toggle="tooltip"]').tooltip({
        trigger : 'hover'
    })


    $("#advancedSearch").click(function(){
        $(".advancedSearchOptions").toggleClass('d-none');
    });
    /*$(window).load(function()
    {
        $("#preloaders").fadeOut(2000);
    });*/

    $('#myModal').on('hidden.bs.modal', function () {
        $(".submitForm")[0].reset();
        var $image = $("#imageHolder");
        $("#imageHolder").removeAttr("src").replaceWith($image.clone());
    });
    $('#cityHistory').on('hidden.bs.modal', function () {
        $(".submitForm")[0].reset();
    });


    $(".edit").click(function(){
        var url = "{{ route('employees/edit', ':id') }}";
        url = url.replace(':id', $(this).data('id'));
        $('.objectForm').attr('action', url);

    });



    var table = $('.table').DataTable({

        "lengthMenu": [ 10, 25, 50, 75, 100 ],
        "processing": true,
        "columnDefs": [
            { orderable: false, targets: [0,2,3,4,5,6,7,8] }
        ],
        "language": {
            "emptyTable": "Nema podataka",
            "info": "Prikazano _START_ do _END_ od _TOTAL_ unosa",
            "lengthMenu": "Prikaži _MENU_ unosa",
            "search": "Pretraži:",
            "infoFiltered": "(filtrirano od _MAX_ unosa)",
            "infoEmpty":      "Prikazano 0 do 0 od 0 unosa",
            "zeroRecords": "Nema podataka",
            "paginate": {
                "first":      "Prva",
                "last":       "Poslednja",
                "next":       "Slijedeća",
                "previous":   "Prethodna"
            },
        },
        "order": [[ 1, "asc" ]],
        "ordering": true,
        stateSave: true
    });
    $('.filterTable').click(function() {
        table.column(12).search("");
        table.column(20).search("");
        console.log("cleared");
        table.draw();
        if($("#typeFilter").val() == "Odaberi tip"){
            table.column(20).search($('#sectorFilter option:selected').val());
        }
        else if($("#sectorFilter").val() == "Odaberi sektor"){
            table.column(12).search($('#typeFilter option:selected').val());
            console.log("TIP SE BIRA");
            console.log("^"+$('#typeFilter option:selected').val()+"$");
        }
        else{
            table.column(12).search("^"+$('#typeFilter option:selected').val()+"$");
            table.column(20).search($('#sectorFilter option:selected').val());
        }

        table.draw();
    });
    $('.filterTableClear').click(function() {
        table.column(12).search("");
        table.column(20).search("");
        console.log("cleared");
        table.draw();

    });


    function showData(returndata){
        /*Osnovne informacije*/
        $('#name').val(returndata.name );
        $('#last_name').val(returndata.last_name );
        $('#birth_date').val(returndata.birth_date );
        $('#jmbg').val(returndata.jmbg );
        $('#qualifications').val(returndata.qualifications );
        $('#home_address').val(returndata.home_address );
        $('#email').val(returndata.email );
        $('#imageHolder').attr({ 'src': returndata.image });
        $('#telephone_number').val(returndata.telephone_number );
        $('#mobile_number').val(returndata.mobile_number );
        $('#additional_info_contact').val(returndata.additional_info_contact );
        $('#office_number').val(returndata.office_number );
        $('#pid').val(returndata.pid );
        $('#pid').select2().trigger('change');
        $('#city_id').val(returndata.city_id );
        $('#city_id').select2().trigger('change');
        $("input[name=gender][value=" + returndata.gender + "]").prop('checked', true);

        /*Plata*/
        $('#pay').val(returndata.employee_salary.pay );
        $('#bonus').val(returndata.employee_salary.bonus );
        $('#bank_number').val(returndata.employee_salary.bank_number );
        $('#bank_name').val(returndata.employee_salary.bank_name );

        /*Job status*/
        $('#type').val(returndata.employee_job_status.type);
        $('#status').val(returndata.employee_job_status.status);
        $('#date_hired').val(returndata.employee_job_status.date_hired);
        $('#date_hired_till').val(returndata.employee_job_status.date_hired_till);
        $('#additional_info').val(returndata.employee_job_status.additional_info);
        $('#type').val(returndata.employee_job_status.type);
        $('#type').select2().trigger('change');

        /*Job description*/
        $('#workplace').val(returndata.employee_job_description.workplace);
        $('#job_description').val(returndata.employee_job_description.job_description);
        $('#skills').val(returndata.employee_job_description.skills);
        $('#sector_id').val(returndata.employee_job_description.sector_id);
        $('#sector_id').select2().trigger('change');
        /* $('#cover_image').val(returndata.cover_image );*/
        $('#myModal').modal('show');
        console.log(returndata);

    }
    $('.js-example-basic-single').select2();

    $('.btnNext').click(function() {
        $('.nav-tabs-pills .active').parent().next('li').find('a').trigger('click');
        $("#myModal").delay(400).animate({ scrollTop: 0 }, "normal");

    });

    $('.btnPrevious').click(function() {
        $('.nav-tabs-pills .active').parent().prev('li').find('a').trigger('click');

        $("#myModal").delay(400).animate({ scrollTop: 0 }, "normal");
    });
</script>
