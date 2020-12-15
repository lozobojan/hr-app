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
                                    <h5 class="card-title mt-1 mb-1">Tabela zaposleni</h5>
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
                                        <th class="text-center">ID</th>
                                        <th class="text-center">Ime i prezime</th>
                                        <th class="text-center">Datum rodjenja</th>
                                        <th class="text-center">Kvalifikacije</th>
                                        <th class="text-center">Adresa</th>
                                        <th class="text-center">JMBG</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Plata</th>
                                        <th class="text-center">Izmijeni</th>
                                        <th class="text-center">Obriši</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                 @foreach($objects as $object)
                                        <tr>
                                            <td class="text-center">{{ $object->id }}</td>
                                            <td class="text-center">{{ $object->name}} {{ $object->last_name }}</td>
                                            <td class="text-center">{{ $object->birth_date }}</td>
                                            <td class="text-center">{{ $object->qualifications }}</td>
                                            <td class="text-center">{{ $object->home_address }}</td>
                                            <td class="text-center">{{ $object->jmbg }}</td>
                                            <td class="text-center">{{ $object->email }}</td>
                                            <td class="text-center">{{ $object->employeeSalary->pay }}</td>
                                            <td class="text-center">
                                                <form>
                                                    <a href="javascript:void(0)" 
                                                    data-toggle="modal" 
                                                    data-id="{{$object->id}}" 
                                                    data-route="employees/{{$object->id}}"
                                                    data-target="#myModal" 
                                                    class="edit show-object-data btn btn-sm btn-outline-primary"
                                                    >
                                                       <i class="far fa-edit"></i>
                                                    </a>
                                                </form>
                                            </td>
                                            <td class="text-center">
                                                <form class="deleteForm text-center" action="{{ route('employees/delete', $object->id) }}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button class="btn btn-sm btn-outline-danger"><i class="far fa-trash-alt"></i></button>
                                                </form>
                                            </td>
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
            $('#image_path').val(returndata.image_path );
            $('#pay').val(returndata.employee_salary.pay );
            $('#bonus').val(returndata.employee_salary.bonus );
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

                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="col-form-label" for="text_me">Slika URL *</label>
                            <textarea class="form-control" id="image_path" name="image_path" placeholder="Slika url" ></textarea>
                        </div>
                    </div>
                </div>

            </div>
        </div>

@endsection

@endsection
