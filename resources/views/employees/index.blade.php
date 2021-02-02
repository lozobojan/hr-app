@extends('layouts.admin')
@section('title', 'Zaposleni')



@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
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
                    {{-- Includng the success message--}}
                    @include('partials.success')

                    <div class="card">
                        <div class="card-header">
                            {{-- Includng the advanced search options--}}
                            @include('employees.includes.advanced-search')

                            <div class="row">
                                <div class="col-6">
                                    <h5 class="card-title mt-1 mb-1">Tabela zaposleni {{ $objects->count() }}</h5>
                                </div>
                                <div class="col-6">
                                    <a id="add" class="btn btn-sm btn-primary float-right ml-3"
                                       href="javascript:void(0)" data-toggle="modal" data-target="#myModal">
                                        <i class="fas fa-user-plus mr-1"></i> Dodaj zaposlenog
                                    </a>
                                    <a id="advancedSearch" class="btn btn-sm btn-success text-white float-right ml-3">
                                        <i class="fas fa-search-plus mr-1"></i> Napredna pretraga
                                    </a>
                                    <a href="{{route('employees.export_all')}}"
                                       class="btn btn-sm btn-info text-white float-right ml-3">
                                        <i class="fas fa-file mr-1"></i> Izvezi
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
                                                <a href="/employees/{{$object->id}}" data-toggle="tooltip"
                                                   title="Pogledaj zaposlenog" class="btn btn-sm btn-outline-success"><i
                                                        class="far fa-eye"></i></a>
                                                <button onclick='generate("{{$object->name}}","{{$object->last_name}}","{{$object->jmbg}}","{!! preg_replace('/\r?\n|\r/', "", $object->home_address) !!}","{{$object->city->name}}", "{!! date("d.m.Y.") !!}")' data-toggle="tooltip" title="Ugovor"
                                                   class="btn btn-sm btn-outline-success mt-1"><i
                                                        class="far fa-file"></i></button>
                                                <span data-toggle="tooltip" title="Izmijeni zaposlenog"><a
                                                        href="javascript:void(0)"
                                                        data-toggle="modal"
                                                        data-id="{{$object->id}}"
                                                        data-route="employees/one/{{$object->id}}"
                                                        data-target="#myModal"
                                                        class="edit show-object-data btn btn-sm btn-outline-primary mt-1"
                                                    >
                                                    <i class="far fa-edit"></i>
                                                </a>
                                            </span>


                                                <form class="deleteForm text-center mt-1"
                                                      action="{{ route('employees/delete', $object->id) }}"
                                                      method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <a type="submit" class="delBtn btn btn-sm btn-outline-danger"><i
                                                            data-toggle="tooltip" title="Obriši zaposlenog"
                                                            class="far fa-trash-alt"></i></a>
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
                                                <a href="/employees/{{$object->id}}" data-toggle="tooltip"
                                                   title="Pogledaj zaposlenog" class="btn btn-sm btn-outline-success"><i
                                                        class="far fa-eye"></i></a>
                                                <a href="/doc/{{$object->id}}" data-toggle="tooltip" title="Ugovor"
                                                   class="btn btn-sm btn-outline-success mt-1"><i
                                                        class="far fa-file"></i></a>
                                                <span data-toggle="tooltip" title="Izmijeni zaposlenog"><a
                                                        href="javascript:void(0)"
                                                        data-toggle="modal"
                                                        data-id="{{$object->id}}"
                                                        data-route="employees/one/{{$object->id}}"
                                                        data-target="#myModal"
                                                        class="edit show-object-data btn btn-sm btn-outline-primary mt-1"
                                                    >
                                                    <i class="far fa-edit"></i>
                                                </a>
                                            </span>
                                                <form class="deleteForm text-center mt-1"
                                                      action="{{ route('employees/delete', $object->id) }}"
                                                      method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <a type="submit" class="delBtn btn btn-sm btn-outline-danger"><i
                                                            data-toggle="tooltip" title="Obriši zaposlenog"
                                                            class="far fa-trash-alt"></i></a>
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
    @include('employees.includes.modal-employee')
@endsection


@section('js')

    @include('employees.includes.js')
    @include('employees.docs.contract')

@endsection


