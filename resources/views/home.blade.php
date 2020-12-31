@extends('layouts.admin')

@section('title', 'Dashboard')

{{--@section('notifications')

@endsection--}}
@section('content')


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.0/main.css"/>


    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow text-white"><i class="fas fa-users"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Broj zaposlenih</span>
                        <span class="info-box-number">{{$employeesCount}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-danger"><i class="fas fa-venus-mars"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Pol</span>
                        <span class="info-box-number"><i class="fas fa-mars"></i> {{ $gender['male'] }}</span>
                        <span class="info-box-number"><i class="fas fa-venus"></i> {{ $gender['female'] }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-secondary"><i class="fas fa-birthday-cake"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Prosjek godina</span>
                        <span class="info-box-number">{{ $avgAge }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-primary"><i class="fas fa-money-bill"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Prosjecna plata</span>
                        <span class="info-box-number">{{ $avgSalary }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
        </div>


    </div>


    @if($notifications->isNotEmpty())
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">

                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h5 class="card-title mt-1 mb-1">Zaposleni kojima uskoro istice ugovor</h5>
                            <span class="badge badge-danger">New</span>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table table-striped table-bordered first">
                            <thead>

                            <tr>

                                {{--LICNI PODACI--}}
                                <th class="text-center">ID</th>
                                <th class="text-center">Ime i prezime</th>
                                <th class="text-center">Datum rodjenja</th>
                                <th class="text-center">Kvalifikacije</th>
                                <th class="text-center">Adresa</th>
                                <th class="text-center">JMBG</th>
                                <th class="text-center">Ističe za</th>
                                <th class="text-center"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($notifications as $notification)
                                <tr>


                                    {{--LICNI PODACI--}}
                                    <td class="text-center">{{ $notification->id }}</td>
                                    <td class="text-center">{{ $notification->name}} {{ $notification->last_name }}</td>
                                    <td class="text-center">{{ $notification->birth_date }}</td>
                                    <td class="text-center">{{ $notification->qualifications }}</td>
                                    <td class="text-center">{{ $notification->home_address }}</td>
                                    <td class="text-center">{{ $notification->jmbg }}</td>
                                    <td class="text-center">{{ $notification->days_till }} dana</td>



                                    <td class="text-center d-inline-block">
                                        <a href="/employees/{{$notification->id}}" class="btn btn-sm btn-outline-success"><i class="far fa-eye"></i></a>

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
    @endif

    <style>
        .tooltip { position: fixed!important; }
    </style>
    <div class="container">
        <div class="row">
            <div class="col-md-12 ">

                <div class="panel panel-default">
                    <div class="legend-red d-inline-block m-0" style="width: 15px; height: 15px; background-color: #f05050"></div> <p class="d-inline-block">Rodjendan</p>
                    <div class="legend-red d-inline-block m-0" style="width: 15px; height: 15px; background-color: #32a852"></div> <p class="d-inline-block">Ugovor</p>
                    <div class="panel-body">
                        {!! $calendar->calendar() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>





@section('js')
    <script>


        $('.table').DataTable({
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
                    "previous":   "ahahah"
                },
            },
            "paging":   false,
            "ordering": false,
            "info":     false,
            "bFilter": false
        });


    </script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.0/main.min.js"></script>
    <script src="https://unpkg.com/popper.js/dist/umd/popper.min.js"></script>
    <script src="https://unpkg.com/tooltip.js/dist/umd/tooltip.min.js"></script>





    {!! $calendar->script() !!}


@endsection


@endsection
