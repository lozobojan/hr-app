@extends('layouts.admin')

@section('title', 'Dashboard')

{{--@section('notifications')

@endsection--}}
@section('content')
    @if($notifications->isNotEmpty())
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h5 class="card-title mt-1 mb-1">Zaposleni kojima uskoro istice ugovor</h5>
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
@endsection


@endsection
