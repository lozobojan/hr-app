@extends('layouts.admin')
@extends('layouts.modal')

@section('title', 'Zaposleni')


@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <div class="container-fluid ">
        <div class="dashboard-content">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header" id="top">
                        <h2 class="pageheader-title mt-3 text-center"> {{ $employee->name }} {{$employee->last_name}}</h2>
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
                                                <h6 class="ml-4 mt-2 mb-2">{{ $employee->gender = 1? "Ž" : "M" }}</h6>
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
                                                <a class="btn btn-app w-75 h-100 bg-primary ml-3">
                                                    <i class="fas fa-edit"></i> Izmijeni
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
                                                        <h6 class="ml-4 mt-2 mb-2">{{ $employee->parent->name }} {{ $employee->parent->last_name }}</h6>
                                                    </div>

                                                    <div class="input-group mb-3 border">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-smile-beam"></i></span>
                                                        </div>
                                                        <h6 class="ml-4 mt-2 mb-2">{{ $employee->employeeJobDescription->skills }}</h6>
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
                                                        <h6 class="ml-4 mt-2 mb-2">{{ $employee->parent->name }}</h6>
                                                    </div>


                                                    <div class="input-group mb-3 border">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                                        </div>
                                                        <h6 class="ml-4 mt-2 mb-2">29.03.2020</h6>
                                                    </div>

                                                    <div class="input-group mb-3 border">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-info"></i></span>
                                                        </div>
                                                        <h6 class="ml-4 mt-2 mb-2">{{ $employee->employeeJobStatus->hire_date }}</h6>
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
            $('#name').val(returndata.name );
            $('#last_name').val(returndata.last_name );
            $('#birth_date').val(returndata.birth_date );
            $('#jmbg').val(returndata.jmbg );
            $('#qualifications').val(returndata.qualifications );
            $('#home_address').val(returndata.home_address );
            $('#email').val(returndata.email );
            $('#imageHolder').attr({ 'src': returndata.image });
            $('#pay').val(returndata.employee_salary.pay );
            $('#bonus').val(returndata.employee_salary.bonus );
            $('#input_date').val(returndata.employee_salary.input_date );
            $('#bank_number').val(returndata.employee_salary.bank_number );
            /* $('#cover_image').val(returndata.cover_image );*/
            $('#myModal').modal('show');

        }

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
                    <div class="col-12">
                        <img width="100%" style="max-height:25%" id="imageHolder"/>
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
                            <textarea class="form-control" id="jmbg" name="jmbg" placeholder="JMBG" ></textarea>
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
                            <label class="col-form-label" for="bank_number">Broj banke *</label>
                            <input type="number" class="form-control" id="bank_number" name="bank_number" placeholder="Broj banke" />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="col-form-label" for="input_date">Input date *</label>
                            <div class="input-group date" id="datetimepicker2" data-target-input="nearest">
                                <input name="input_date" id="input_date" type="text" class="form-control datetimepicker-input" data-target="#datetimepicker4" />
                                <div class="input-group-append" data-target="#datetimepicker2" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>

@endsection

@endsection
