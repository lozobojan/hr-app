@extends('layouts.admin')


@section('title', 'Zaposleni')


@section('content')
    <style>
        .head-light{
            background-color: #ffffff;
        }
        .head-dark{
            background-color: #cbcbcb;
        }
    </style>
    {{--<a class="btn btn-primary" href="{{ URL::to('/pdf/1') }}">Export to PDF</a>--}}
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <div class="container-fluid ">
        <div class="dashboard-content">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header" id="top">
                        <h2 class="pageheader-title">Zaposleni</h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                    @include('partials.success')

                    <div class="card">
                        <div class="card-header">
                            <div class="row advancedSearchOptions d-none">
                                <div class="col">

                                    <form action="{{route('employees.filter')}}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-2 pl-1">
                                                <div class="form-group">
                                                    <label>Tip zaposlenja</label>
                                                    <select name="type"  id="typeFilter" class="form-control">
                                                        <option></option>
                                                        @foreach($types as $type)
                                                            <option value="{{ $type->id }}">
                                                                {{ $type->type }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2 pl-1">
                                                <div class="form-group">
                                                    <label for="sectorFilter">Sektor</label>
                                                    <select name="sector"  id="sectorFilter" class="form-control">
                                                        <option></option>
                                                        @foreach($sectors as $sector)
                                                            <option value="{{ $sector->id }}">
                                                                {{ $sector->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-2 pl-1">
                                                <div class="form-group">
                                                    <label for="bank">Banka</label>
                                                    <input type="text" name="bank_name" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-2 pl-1">
                                                <div class="form-group">
                                                    <label for="salary">Plata > od</label>
                                                    <input type="number" name="salary" class="form-control" placeholder="Plata > od">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="text-center">
                                            <button class="btn btn-success btn-sm" type="submit"><i class="fa fa-filter "></i> Filter</button>

                                            <a class="btn btn-secondary btn-sm filterTableClear"  href="{{route('employees')}}"><i class="fa fa-eraser "></i> Clear Filter</a>
                                        </div>
                                </form>


                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="card-title mt-1 mb-1">Tabela zaposleni {{ $objects->count() }}</h5>
                                </div>
                                <div class="col-6">
                                    <a id="add" class="btn btn-sm btn-primary float-right ml-3" href="javascript:void(0)" data-toggle="modal" data-target="#myModal">
                                        <i class="fas fa-user-plus mr-1"></i> Dodaj zaposlenog
                                    </a>
                                    <a id="advancedSearch" class="btn btn-sm btn-success text-white float-right ml-3">
                                        <i class="fas fa-search-plus mr-1"></i>  Napredna pretraga
                                    </a>
                                    <a href="{{route('employees.export_all')}}" class="btn btn-sm btn-info text-white float-right ml-3">
                                        <i class="fas fa-file mr-1"></i>  Izvezi
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                                <table class="table table-striped table-bordered first">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th colspan="7" class="text-center head-light basic">Osnovne Informacije</th>
                                        <th colspan="5" class="text-center head-dark">Kontakt Informacije</th>
                                        <th colspan="5" class="text-center head-light">Status Zaposlenja</th>
                                        <th colspan="4" class="text-center head-dark">Opis Zaposlenja</th>
                                        <th colspan="4" class="text-center head-light">Plata</th>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        {{--LICNI PODACI--}}
                                        <th class="text-center">ID</th>
                                        <th class="text-center">Ime i prezime</th>
                                        <th class="text-center">Datum rodjenja</th>
                                        <th class="text-center">Kvalifikacije</th>
                                        <th class="text-center">Adresa</th>
                                        <th class="text-center">Grad</th>
                                        <th class="text-center">JMBG</th>

                                        {{--KONTAKT INFORMACIJE--}}
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Fiksni</th>
                                        <th class="text-center">Mobilni</th>
                                        <th class="text-center">Broj kancelarije</th>
                                        <th class="text-center">Dodatne informacije</th>

                                        {{--STATUS ZAPOSLENJA--}}
                                        <th class="text-center">Tip</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Datum zaposlenja</th>
                                        <th class="text-center">Zaposlen do</th>
                                        <th class="text-center">Dodatne informacije</th>

                                        {{--OPIS ZAPOSLENJA--}}
                                        <th class="text-center">Radno mjesto</th>
                                        <th class="text-center">Opis posla</th>
                                        <th class="text-center">Skills</th>
                                        <th class="text-center">Sektor</th>

                                        {{--PLATA--}}
                                        <th class="text-center">Plata</th>
                                        <th class="text-center">Bonus</th>
                                        <th class="text-center">Broj banke</th>
                                        <th class="text-center">Banka</th>


                                        <th class="text-center">Akcije</th>
                                        {{--<th class="text-center">Obriši</th>--}}
                                    </tr>
                                    </thead>
                                    <tbody>
                                 @foreach($objects as $object)
                                        <tr>
                                            <td class="text-center d-inline-block">
                                                <a href="/employees/{{$object->id}}" data-toggle="tooltip" title="Pogledaj zaposlenog" class="btn btn-sm btn-outline-success"><i class="far fa-eye"></i></a>
                                                <a href="/doc/{{$object->id}}" data-toggle="tooltip" title="Ugovor" class="btn btn-sm btn-outline-success mt-1"><i class="far fa-file"></i></a>
                                                <span data-toggle="tooltip" title="Izmijeni zaposlenog" ><a href="javascript:void(0)"
                                                   data-toggle="modal"
                                                   data-id="{{$object->id}}"
                                                   data-route="employees/one/{{$object->id}}"
                                                   data-target="#myModal"
                                                   class="edit show-object-data btn btn-sm btn-outline-primary mt-1"
                                                >
                                                    <i class="far fa-edit"></i>
                                                </a>
                                            </span>


                                                <form class="deleteForm text-center mt-1" action="{{ route('employees/delete', $object->id) }}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <a type="submit" class="delBtn btn btn-sm btn-outline-danger"><i data-toggle="tooltip" title="Obriši zaposlenog" class="far fa-trash-alt"></i></a>
                                                </form>
                                            </td>
                                            {{--LICNI PODACI--}}
                                            <td class="text-center">{{ $object->id }}</td>
                                            <td class="text-center">{{ $object->name}} {{ $object->last_name }}</td>
                                            <td class="text-center">{{ $object->birth_date }}</td>
                                            <td class="text-center">{{ $object->qualifications }}</td>
                                            <td class="text-center">{{ $object->home_address }}</td>
                                            <td class="text-center">{{ $object->city->name }}</td>
                                            <td class="text-center">{{ $object->jmbg }}</td>

                                            {{--KONTAKT INFORMACIJE--}}
                                            <td class="text-center">{{ $object->email }}</td>
                                            <td class="text-center">{{ $object->telephone_number }}</td>
                                            <td class="text-center">{{ $object->mobile_number }}</td>
                                            <td class="text-center">{{ $object->office_number }}</td>
                                            <td class="text-center">{{ $object->additional_info_contact ?? "NaN" }}</td>

                                            {{--STATUS ZAPOSLENJA--}}
                                            <td class="text-center">{{ $object->employeeJobStatus->hireType->type }}</td>
                                            <td class="text-center">{{ $object->employeeJobStatus->status }}</td>
                                            <td class="text-center">{{ $object->employeeJobStatus->date_hired }}</td>
                                            <td class="text-center">{{ $object->employeeJobStatus->date_hired_till }}</td>
                                            <td class="text-center">{{ $object->employeeJobStatus->additional_info ?? "NaN" }}</td>

                                            {{--OPIS ZAPOSLENJA--}}
                                            <td class="text-center">{{ $object->employeeJobDescription->workplace }}</td>
                                            <td class="text-center">{{ $object->employeeJobDescription->job_description }}</td>
                                            <td class="text-center">{{ $object->employeeJobDescription->skills }}</td>
                                            <td class="text-center">{{ $object->employeeJobDescription->sector->name }}</td>

                                            {{--PLATA--}}

                                            <td class="text-center">{{ $object->currentSalary()->pay}}</td>
                                            <td class="text-center">{{ $object->employeeSalary->bonus}}</td>
                                            <td class="text-center">{{ $object->employeeSalary->bank_number}}</td>
                                            <td class="text-center">{{ $object->employeeSalary->bank_name}}</td>


                                            <td class="text-center d-inline-block">
                                                <a href="/employees/{{$object->id}}" data-toggle="tooltip" title="Pogledaj zaposlenog" class="btn btn-sm btn-outline-success"><i class="far fa-eye"></i></a>
                                                <a href="/doc/{{$object->id}}" data-toggle="tooltip" title="Ugovor" class="btn btn-sm btn-outline-success mt-1"><i class="far fa-file"></i></a>
                                                <span data-toggle="tooltip" title="Izmijeni zaposlenog" ><a href="javascript:void(0)"
                                                   data-toggle="modal"
                                                   data-id="{{$object->id}}"
                                                   data-route="employees/one/{{$object->id}}"
                                                   data-target="#myModal"
                                                   class="edit show-object-data btn btn-sm btn-outline-primary mt-1"
                                                >
                                                    <i class="far fa-edit"></i>
                                                </a>
                                            </span>


                                                <form class="deleteForm text-center mt-1" action="{{ route('employees/delete', $object->id) }}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <a type="submit" class="delBtn btn btn-sm btn-outline-danger"><i data-toggle="tooltip" title="Obriši zaposlenog" class="far fa-trash-alt"></i></a>
                                                </form>
                                            </td>

                                         {{--   <td class="text-center">
                                                <form class="deleteForm text-center" action="{{ route('employees/delete', $object->id) }}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="button" class="delBtn btn btn-sm btn-outline-danger"><i class="far fa-trash-alt"></i></button>
                                                </form>
                                            </td>--}}
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection



@section('js')

    <script>


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


        $(".edit").click(function(){
            var url = "{{ route('employees/edit', ':id') }}";
            url = url.replace(':id', $(this).data('id'));
            $('.objectForm').attr('action', url);

        });



        var table = $('.table').DataTable({

            "lengthMenu": [ 10, 25, 50, 75, 100 ],
            "processing": true,
           /* dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'colvisGroup',
                    text: 'Osnovni podaci',
                    className: 'btn-primary',
                    show: [ 1, 2, 3,4,5,6],
                    hide: [ 7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23 ]
                },
                {
                    extend: 'colvisGroup',
                    text: 'Kontakt',
                    className: 'btn-secondary',
                    show: [7,8,9,10,11],
                    hide: [  1, 2, 3,4,5,6,12,13,14,15,16,17,18,19,20,21,22,23 ]
                },
                {
                    extend: 'colvisGroup',
                    text: 'Show all',
                    className: 'btn-success',
                    show: ':hidden'
                }
            ],*/
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

            //console.log($('#sectorFilter option:selected').val());
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
        // In your Javascript (external .js resource or <script> tag)

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
    <style>
        .select2-selection__rendered {
            line-height: 31px !important;
        }
        .select2-container .select2-selection--single {
            height: 35px !important;
        }
        .select2-selection__arrow {
            height: 34px !important;
        }
    </style>
@section('modal-body')
    <div class="modal-header">
        <h4 class="modal-title">Objekat</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>

    <form class="submitForm objectForm" action="{{ route('employees/store') }}">
        @csrf
        <div class="modal-body">
            <div class="container">

                <ul class="nav nav-pills mb-3 nav-tabs-pills" id="pills-tab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Osnovne informacije</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Plata</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Status posla</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="pills-contact2-tab" data-toggle="pill" href="#pills-contact2" role="tab" aria-controls="pills-contact2" aria-selected="false">Opis posla</a>
                    </li>
                  </ul>
                  <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="col-form-label" for="name">Ime *</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Ime" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="col-form-label" for="last_name">Prezime *</label>
                                    <input id="last_name" class="form-control" type="text" placeholder="Prezime" name="last_name">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 text-center">
                                <img width="40%" style="max-height:25%" id="imageHolder"/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="col-form-label" for="image">Fotografija *</label>
                                    <input type="file" id="image" class="form-control" name="image"/>
                                </div>
                            </div>
                        </div>



                 {{--       <div class="row">
                            <div class="col-12">
                                <img width="100%" style="max-height:25%" id="imageHolder"/>
                            </div>
                        </div>--}}

                  {{--      <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="col-form-label" for="image">Fotografija *</label>
                                    <input type="file" id="image" class="form-control" name="image"/>
                                </div>
                            </div>
                        </div>--}}

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="col-form-label" for="birth_date">Datum rodjenja *</label>
                                    <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
                                        <input name="birth_date" id="birth_date" type="text" class="form-control datetimepicker-input" data-target="#datetimepicker4" />
                                        <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="col-form-label" for="text_me">Kvalifikacije *</label>
                                    <textarea class="form-control" id="qualifications" name="qualifications" placeholder="Kvalifikacije" ></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="col-form-label" for="home_address">Adresa *</label>
                                    <input type="text" class="form-control" id="home_address" name="home_address" placeholder="Adresa" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="col-form-label" for="city_id">Grad *</label>
                                    <select class="js-" style="width: 100%;" name="city_id" id="city_id">
                                        <option value="">Odaberite grad</option>
                                       @foreach($cities as $city)
                                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="col-form-label" for="jmbg">JMBG *</label>
                                    <input type="number" class="form-control" id="jmbg" name="jmbg" placeholder="JMBG" >
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="col-form-label" for="text_me">Pol *</label><br>
                                    <input type="radio" id="male" name="gender" value="0" >
                                    <label for="male">Muško</label><br>
                                    <input type="radio" id="female" name="gender" value="1">
                                    <label for="female">Žensko</label><br>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="col-form-label" for="email">Email *</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" >
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="col-form-label" for="pid">Nadredjeni *</label>
                                    <select class="js-" style="width: 100%;" name="pid" id="pid">
                                        <option value="">Odaberite nadredjenog</option>
                                       @foreach($objects as $employee)
                                            <option value="{{ $employee->id }}">{{ $employee->name }} {{ $employee->last_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>


                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="col-form-label" for="additional_info_contact">Dodatne kontakt informacije *</label>
                            <textarea class="form-control" id="additional_info_contact" name="additional_info_contact" placeholder="Dodatne kontakt informacije" ></textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="col-form-label" for="telephone_number">Fiksni broj *</label>
                            <input type="text" class="form-control" id="telephone_number" name="telephone_number" placeholder="Fiksni broj" >
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="col-form-label" for="mobile_number">Mobilni broj *</label>
                            <input type="text" class="form-control" id="mobile_number" name="mobile_number" placeholder="Mobilni broj" >
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="col-form-label" for="office_number">Broj kancelarije *</label>
                            <input type="text" class="form-control" id="office_number" name="office_number" placeholder="Broj kancelarije" >
                        </div>
                    </div>
                </div>

                <div class="row navbuttons pt-5">
                    <div class="col-6 col-sm-auto" id="btnNext">
                        <a class="btn btn-primary text-white btnNext">Sledeći</a>
                    </div>
                </div>
                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">

                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="col-form-label" for="pay">Plata *</label>
                            <input type="number" class="form-control" id="pay" name="pay" placeholder="Plata" />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="col-form-label" for="bonus">Bonus *</label>
                            <input type="number" class="form-control" id="bonus" name="bonus" placeholder="Bonus" />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="col-form-label" for="bank_name">Ime banke *</label>
                            <input type="text" class="form-control" id="bank_name" name="bank_name" placeholder="Ime banke" />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="col-form-label" for="bank_number">Broj banke *</label>
                            <input type="number" class="form-control" id="bank_number" name="bank_number" placeholder="Broj banke" />
                        </div>
                    </div>
                </div>

                <div class="row navbuttons pt-5">
                    <div class="col-6 col-sm-auto" id="btnPrevious">
                        <a class="btn btn-primary text-white btnPrevious">Prethodni</a>
                    </div>
                    <div class="col-6 col-sm-auto" id="btnNext">
                        <a class="btn btn-primary text-white btnNext">Sledeći</a>
                    </div>
                </div>
                    </div>
                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">

                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="col-form-label" for="type">Tip *</label>
                            <select class="js-example-basic-single" style="width: 100%; line-height: 36px;" name="type" id="type">
                                <option value="">Odaberite tip</option>
                                @foreach($types as $type)
                                    <option value="{{ $type->id }}">
                                        {{ $type->type }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="col-form-label" for="status">Status *</label>
                            <input type="text" class="form-control" id="status" name="status" placeholder="Status posla" />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="col-form-label" for="birth_date">Datum zaposlenja *</label>
                            <div class="input-group date" id="datetimepickerdatzap" data-target-input="nearest">
                                <input name="date_hired" id="date_hired" type="text" class="form-control datetimepicker-input" data-target="#datetimepickerdatzap" />
                                <div class="input-group-append" data-target="#datetimepickerdatzap" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="col-form-label" for="birth_date">Zaposlen do *</label>
                            <div class="input-group date" id="datetimepickertill" data-target-input="nearest">
                                <input name="date_hired_till" id="date_hired_till" type="text" class="form-control datetimepicker-input" data-target="#datetimepickertill" />
                                <div class="input-group-append" data-target="#datetimepickertill" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="col-form-label" for="additional_info">Dodatne informacije *</label>
                            <input type="text" class="form-control" id="additional_info" name="additional_info" placeholder="Dodatne informacije" />
                        </div>
                    </div>
                </div>
                <div class="row navbuttons pt-5">
                    <div class="col-6 col-sm-auto" id="btnPrevious">
                        <a class="btn btn-primary text-white btnPrevious">Prethodni</a>
                    </div>
                    <div class="col-6 col-sm-auto" id="btnNext">
                        <a class="btn btn-primary text-white btnNext">Sledeći</a>
                    </div>
                </div>
                    </div>
                    <div class="tab-pane fade" id="pills-contact2" role="tabpanel" aria-labelledby="pills-contact2-tab">

                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="col-form-label" for="skills">Sektor *</label>
                            <select class="js-example-basic-single" style="width: 100%; line-height: 36px;" name="sector_id" id="sector_id">
                                <option value="">Odaberite sektor</option>
                                @foreach($sectors as $sector)
                                    <option value="{{ $sector->id }}">
                                        {{ $sector->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="col-form-label" for="workplace">Radno mjesto *</label>
                            <input type="text" class="form-control" id="workplace" name="workplace" placeholder="Radno mjesto" />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="col-form-label" for="job_description">Opis posla *</label>
                            <input type="text" class="form-control" id="job_description" name="job_description" placeholder="Opis posla" />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="col-form-label" for="skills">Skills *</label>
                            <input type="text" class="form-control" id="skills" name="skills" placeholder="Skills" />
                        </div>
                    </div>
                </div>
                <div class="row navbuttons pt-5">
                    <div class="col-6 col-sm-auto" id="btnPrevious">
                        <a class="btn btn-primary text-white btnPrevious">Prethodni</a>
                    </div>

                </div>

                    </div>
                  </div>








                {{--PLATA--}}




            </div>
        </div>

@endsection

@endsection

@extends('layouts.modal')
