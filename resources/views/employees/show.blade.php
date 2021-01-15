@extends('layouts.admin')
@extends('layouts.modal')



@section('title', $title)


@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <div class="container-fluid ">
        <div class="dashboard-content">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header" id="top">
                        <h2 class="pageheader-title mt-3 text-center"> 
                            <img src="{{ $employee->image }}" alt="..." class="img-thumbnail" style="width: 10%;">
                            {{ $employee->name }} {{$employee->last_name}}</h2>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                    @include('partials.success')



                            <!-- Small boxes (Stat box) -->

                            <div class="row justify-content-around">
                                <div class="col-4">
                                    <div class="card card-default">
                                        <div class="card-header bg-info">
                                            <h3 class="card-title">
                                                <i class="fas fa-info"></i>
                                                Lični podaci
                                            </h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body" style="font-size: 10px;">

                                            <div class="input-group mb-3 border">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                </div>
                                                <h6 class="ml-4 mt-2 mb-2">{{ $employee->name }} {{ $employee->last_name }}</h6>
                                            </div>


                                            <div class="input-group mb-3 border">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                                </div>
                                                <h6 class="ml-4 mt-2 mb-2">{{ $employee->birth_date }}</h6>
                                            </div>

                                            <div class="input-group mb-3 border">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-venus-mars"></i></span>
                                                </div>
                                                <h6 class="ml-4 mt-2 mb-2">{{ $employee->gender == 1? "Ž" : "M" }}</h6>
                                            </div>

                                            <div class="input-group mb-3 border">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                                </div>
                                                <h6 class="ml-4 mt-2 mb-2">
                                                    {{ $employee->home_address}}
                                                </h6>
                                            </div>

                                            <div class="input-group mb-3 border">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                                </div>
                                                <h6 class="ml-4 mt-2 mb-2">{{ $employee->jmbg }}</h6>
                                            </div>

                                            <div class="input-group mb-3 border">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-smile-beam"></i></span>
                                                </div>
                                                <h6 class="ml-4 mt-2 mb-2">{{ $employee->qualifications }}</h6>
                                            </div>

                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="row ">
                                        <div class="col-8">
                                            <div class="card card-default">
                                                <div class="card-header bg-info">
                                                    <h3 class="card-title">
                                                        <i class="fas fa-phone"></i>
                                                        Kontakt
                                                    </h3>
                                                </div>
                                                <!-- /.card-header -->
                                                <div class="card-body">

                                                    <div class="input-group mb-3 border">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                                        </div>
                                                        <h6 class="ml-4 mt-2 mb-2">{{ $employee->email }}</h6>
                                                    </div>


                                                    <div class="input-group mb-3 border">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                                                        </div>
                                                        <h6 class="ml-4 mt-2 mb-2">{{ $employee->mobile_number }}</h6>
                                                    </div>

                                                    <div class="input-group mb-3 border">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-phone-alt"></i></span>
                                                        </div>
                                                        <h6 class="ml-4 mt-2 mb-2">{{ $employee->telephone_number }}</h6>
                                                    </div>

                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                        </div>
                                        <div class="col-4 pb-4">
                                            <div class="h-50 py-2">
                                                <a href="/employees/export/{{$employee->id}}" class="ml-3 btn btn-app w-75 h-100 bg-success">
                                                    <i class="fas fa-file-export"></i> Izvezi
                                                </a>
                                            </div>
                                            <hr class="my-0">
                                            <div class="h-50 py-2">
                                                <a href="javascript:void(0)"
                                                   data-toggle="modal"
                                                   data-id="{{$employee->id}}"
                                                   data-route="/employees/one/{{$employee->id}}"
                                                   data-target="#myModal"
                                                   class="edit show-object-data btn btn-sm btn-outline-primary mt-1 ml-3 btn btn-app w-75 h-100 bg-primary"
                                                >
                                                    <i class="far fa-edit"></i>  Izmeni
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <div class="col-4">

                                            <div class="card card-default">
                                                <div class="card-header bg-dark">
                                                    <h3 class="card-title">
                                                        <i class="fas fa-briefcase"></i>
                                                        Posao
                                                    </h3>
                                                </div>
                                                <!-- /.card-header -->
                                                <div class="card-body">

                                                    <div class="input-group mb-3 border">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-building"></i></span>
                                                        </div>
                                                        <h6 class="ml-4 mt-2 mb-2">{{ $employee->employeeJobDescription->sector->name }}</h6>
                                                    </div>


                                                    <div class="input-group mb-3 border">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-briefcase"></i></span>
                                                        </div>
                                                        <h6 class="ml-4 mt-2 mb-2">{{ $employee->employeeJobDescription->workplace }}</h6>
                                                    </div>

                                                    <div class="input-group mb-3 border">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-user-tie"></i></span>
                                                        </div>
                                                        <h6 class="ml-4 mt-2 mb-2">@isset($employee->parent)
                                                                {{ $employee->parent->name }} {{ $employee->parent->last_name }}
                                                            @else
                                                                                       NO
                                                            @endisset</h6>
                                                    </div>

                                                    <div class="input-group mb-3 border">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-building"></i></span>
                                                        </div>
                                                        <h6 class="ml-4 mt-2 mb-2">{{ $employee->office_number }}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="card card-default">
                                                <div class="card-header bg-dark">
                                                    <h3 class="card-title">
                                                        <i class="fas fa-info-circle"></i>
                                                        Status
                                                    </h3>
                                                </div>
                                                <!-- /.card-header -->
                                                <div class="card-body">

                                                    <div class="input-group mb-3 border">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                                        </div>
                                                     

                                                            <h6 class="ml-4 mt-2 mb-2"> {{ $employee->employeeJobStatus->hireType->type}}</h6>
                                                    
                                                    </div>


                                                    <div class="input-group mb-3 border">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                                        </div>
                                                        <h6 class="ml-4 mt-2 mb-2">{{ $employee->employeeJobStatus->date_hired }}</h6>
                                                    </div>

                                                    <div class="input-group mb-3 border">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-info"></i></span>
                                                        </div>
                                                        <h6 class="ml-4 mt-2 mb-2">{{ $employee->employeeJobStatus->status }}</h6>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="card card-default">
                                                <div class="card-header bg-dark">
                                                    <h3 class="card-title">
                                                        <i class="fas fa-wallet"></i>
                                                        Plata
                                                    </h3>
                                                </div>
                                                <!-- /.card-header -->
                                                <div class="card-body">

                                                    <div class="input-group mb-3 border">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-euro-sign"></i></span>
                                                        </div>
                                                        <h6 class="ml-4 mt-2 mb-2">{{ $employee->employeeSalary->pay }}</h6>
                                                    </div>


                                                    <div class="input-group mb-3 border">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-plus"></i></span>
                                                        </div>
                                                        <h6 class="ml-4 mt-2 mb-2">{{ $employee->employeeSalary->bonus }}</h6>
                                                    </div>

                                                    <div class="input-group mb-3 border">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-university"></i></span>
                                                        </div>
                                                        <h6 class="ml-4 mt-2 mb-2">{{ $employee->employeeSalary->bank_number }}</h6>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- /.row (main row) -->




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
            console.log("test");
        });



        $('.table').DataTable({

            "columnDefs": [
                { orderable: false, targets: [1,2,3,4,5,6,7,8] }
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
            "order": [[ 0, "asc" ]],
            "ordering": true
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
            $('#office_number').val(returndata.office_number );
            $('#additional_info_contact').val(returndata.additional_info_contact );
            $('#pid').val(returndata.pid );
            $('#pid').select2().trigger('change');

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
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                              <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Osnovne infomracije</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Plata</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Status posla</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="contact2-tab" data-toggle="tab" href="#contact2" role="tab" aria-controls="contact2" aria-selected="false">Opis posla</a>
                            </li>
                          </ul>
                          <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                
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
                                    <label class="col-form-label" for="qualifications">Kvalifikacije *</label>
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
                                    <label class="col-form-label" for="jmbg">JMBG *</label>
                                    <input type="number" class="form-control" id="jmbg" name="jmbg" placeholder="JMBG" >
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="col-form-label" for="gender">Pol *</label><br>
                                    <input type="radio" id="male" name="gender" value="0" @if($employee->gender == 0) checked @endif>
                                    <label for="male">Male</label><br>
                                    <input type="radio" id="female" name="gender" value="1" @if($employee->gender == 1) checked @endif>
                                    <label for="female">Female</label><br>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="col-form-label" for="email">Email *</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
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

                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                
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

                            </div>
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                
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

                            </div>
                            <div class="tab-pane fade" id="contact2" role="tabpanel" aria-labelledby="contact2-tab">
                                
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="col-form-label" for="skills">Sektor *</label>
                                    <select class="js-example-basic-single" style="width: 100%; line-height: 36px;" name="sector_id" id="sector_id">
                                        <option value="">Odaberite sektor</option>
                                        @foreach($sectors as $sector)
                                            <option value="{{ $sector->id }}"
                                            >{{ $sector->name }}</option>
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

                            </div>
                          </div>

            



                    </div>
                </div>

@endsection

@endsection
