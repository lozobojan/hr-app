@extends('layouts.admin')
@extends('layouts.modal')

@section('title', 'Zaposleni')


@section('content')
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
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="card-title mt-1 mb-1">Tabela zaposleni {{ $objects->count() }}</h5>
                                </div>
                                <div class="col-6">
                                    <a id="add" class="btn btn-sm btn-info float-right ml-3" href="javascript:void(0)" data-toggle="modal" data-target="#myModal">
                                        Dodaj zaposlenog
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                                <table class="table table-striped table-bordered first">
                                    <thead>
                                    <tr>
                                        <td></td>
                                        {{--LICNI PODACI--}}
                                        <th class="text-center">ID</th>
                                        <th class="text-center">Ime i prezime</th>
                                        <th class="text-center">Datum rodjenja</th>
                                        <th class="text-center">Kvalifikacije</th>
                                        <th class="text-center">Adresa</th>
                                        <th class="text-center">JMBG</th>

                                        {{--KONTAKT INFORMACIJE--}}
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Fiksni</th>
                                        <th class="text-center">Mobilni</th>
                                        <th class="text-center">Broj kancelarije</th>
                                        <th class="text-center">Dodatne informacije</th>

                                        {{--KONTAKT INFORMACIJE--}}
                                        <th class="text-center">Tip</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Datum zaposlenja</th>
                                        <th class="text-center">Dodatne informacije</th>

                                        <th class="text-center">Plata</th>


                                        <th class="text-center">Akcije</th>
                                        {{--<th class="text-center">Obriši</th>--}}
                                    </tr>
                                    </thead>
                                    <tbody>
                                 @foreach($objects as $object)
                                        <tr>
                                            <td class="text-center d-inline-block">
                                                <a href="/employees/{{$object->id}}" class="btn btn-sm btn-outline-success"><i class="far fa-eye"></i></a>

                                                <a href="javascript:void(0)"
                                                   data-toggle="modal"
                                                   data-id="{{$object->id}}"
                                                   data-route="employees/one/{{$object->id}}"
                                                   data-target="#myModal"
                                                   class="edit show-object-data btn btn-sm btn-outline-primary mt-1"
                                                >
                                                    <i class="far fa-edit"></i>
                                                </a>


                                                <form class="deleteForm text-center mt-1" action="{{ route('employees/delete', $object->id) }}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <a type="submit" class="delBtn btn btn-sm btn-outline-danger"><i class="far fa-trash-alt"></i></a>
                                                </form>
                                            </td>
                                            {{--LICNI PODACI--}}
                                            <td class="text-center">{{ $object->id }}</td>
                                            <td class="text-center">{{ $object->name}} {{ $object->last_name }}</td>
                                            <td class="text-center">{{ $object->birth_date }}</td>
                                            <td class="text-center">{{ $object->qualifications }}</td>
                                            <td class="text-center">{{ $object->home_address }}</td>
                                            <td class="text-center">{{ $object->jmbg }}</td>

                                            {{--KONTAKT INFORMACIJE--}}
                                            <td class="text-center">{{ $object->email }}</td>
                                            <td class="text-center">{{ $object->telephone_number }}</td>
                                            <td class="text-center">{{ $object->mobile_number }}</td>
                                            <td class="text-center">{{ $object->office_number }}</td>
                                            <td class="text-center">{{ $object->additional_info_contact ?? "NaN" }}</td>

                                            {{--STATUS ZAPOSLENJA--}}
                                            <td class="text-center">{{ $object->employeeJobStatus->type }}</td>
                                            <td class="text-center">{{ $object->employeeJobStatus->status }}</td>
                                            <td class="text-center">{{ $object->employeeJobStatus->date_hired }}</td>
                                            <td class="text-center">{{ $object->employeeJobStatus->additional_info ?? "NaN" }}</td>

                                            <td class="text-center">{{ $object->employeeSalary->pay}}</td>
                                            <td class="text-center d-inline-block">
                                                <a href="/employees/{{$object->id}}" class="btn btn-sm btn-outline-success"><i class="far fa-eye"></i></a>

                                                    <a href="javascript:void(0)"
                                                    data-toggle="modal"
                                                    data-id="{{$object->id}}"
                                                    data-route="employees/one/{{$object->id}}"
                                                    data-target="#myModal"
                                                    class="edit show-object-data btn btn-sm btn-outline-primary mt-1"
                                                    >
                                                       <i class="far fa-edit"></i>
                                                    </a>


                                                <form class="deleteForm text-center mt-1" action="{{ route('employees/delete', $object->id) }}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <a type="submit" class="delBtn btn btn-sm btn-outline-danger"><i class="far fa-trash-alt"></i></a>
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



        $('.table').DataTable({

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

            /*Plata*/
            $('#pay').val(returndata.employee_salary.pay );
            $('#bonus').val(returndata.employee_salary.bonus );
            $('#bank_number').val(returndata.employee_salary.bank_number );
            $('#bank_name').val(returndata.employee_salary.bank_name );

            /*Job status*/
            $('#type').val(returndata.employee_job_status.type);
            $('#status').val(returndata.employee_job_status.status);
            $('#date_hired').val(returndata.employee_job_status.date_hired);
            $('#additional_info').val(returndata.employee_job_status.additional_info);

            /*Job description*/
            $('#workplace').val(returndata.employee_job_description.workplace);
            $('#job_description').val(returndata.employee_job_description.job_description);
            $('#skills').val(returndata.employee_job_description.skills);
            /* $('#cover_image').val(returndata.cover_image );*/
            $('#myModal').modal('show');
            console.log(returndata);

        }
        // In your Javascript (external .js resource or <script> tag)

            $('.js-example-basic-single').select2();

    </script>

@section('modal-body')
    <div class="modal-header">
        <h4 class="modal-title">Objekat</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>

    <form class="submitForm objectForm" action="{{ route('employees/store') }}">
        @csrf
        <div class="modal-body">
            <div class="container">

                <div class="card-header bg-dark">
                    Osnovne informacije
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="col-form-label" for="text_me">Ime *</label>
                            <textarea class="form-control" id="name" name="name" placeholder="Ime" ></textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="col-form-label" for="text_en">Prezime *</label>
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
                            <label class="col-form-label" for="text_me">Adresa *</label>
                            <textarea class="form-control" id="home_address" name="home_address" placeholder="Adresa" ></textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="col-form-label" for="text_me">JMBG *</label>
                            <input type="number" class="form-control" id="jmbg" name="jmbg" placeholder="JMBG" >
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="col-form-label" for="text_me">Email *</label>
                            <textarea class="form-control" id="email" name="email" placeholder="Email" ></textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="col-form-label" for="pid">Nadredjeni *</label>
                            <select class="js-example-basic-single" style="width: 100%;" name="pid" id="pid">
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



                {{--PLATA--}}

                <div class="card-header bg-dark">
                    Plata
                </div>

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



                {{--JOB STATUS--}}

                <div class="card-header bg-dark">
                    Status posla
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="col-form-label" for="type">Tip *</label>
                            <input type="text" class="form-control" id="type" name="type" placeholder="Tip posla" />
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
                            <label class="col-form-label" for="date_hired">Datum zaposljenja *</label>
                            <input type="text" class="form-control" id="date_hired" name="date_hired" placeholder="Datum zaposlenja" />
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


                {{--JOB DESCRIPTIONS--}}

                <div class="card-header bg-dark">
                    Opis posla
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

                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="col-form-label" for="skills">Sektor *</label>
                            <select class="js-example-basic-single" style="width: 100%; line-height: 36px;" name="sector_id" id="sector_id">
                                <option value="">Odaberite sektor</option>
                                @foreach($sectors as $sector)
                                    <option value="{{ $sector->id }}">{{ $sector->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

            </div>
        </div>

@endsection

@endsection
