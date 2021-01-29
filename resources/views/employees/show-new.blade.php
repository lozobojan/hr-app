@extends('layouts.admin')
@section('title', "$employee->name $employee->last_name")

@section('content')
<div class="container-fluid p-4">
    <div class="main-body">


        <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="{{ $employee->image }}" alt="Admin" class="rounded-circle" width="150">
                            <div class="mt-3">
                                <h4>{{ $employee->name }} {{ $employee->last_name }}</h4>
                                <p class="text-muted font-size-sm mb-0">@if($employee->gender == 0) <i class="fa fa-mars"> @else <i class="fa fa-venus"> @endif</i></i></p>
                                <p class="text-secondary mb-1">{{ $employee->employeeJobDescription->workplace }}</p>
                                <p class="text-muted font-size-sm">{{ $employee->home_address }}, {{ $employee->city->name }}</p>
                                <a
                                    href="javascript:void(0)"
                                    data-toggle="modal"
                                    data-id="{{$employee->id}}"
                                    data-route="/employees/one/{{$employee->id}}"
                                    data-target="#myModal"
                                    class="edit show-object-data btn btn-primary"><i class="fa fa-edit"></i> Izmijeni</a>
                                <a href="/employees/export/{{$employee->id}}" class="btn btn-secondary"><i class="fa fa-file"></i> Izvezi</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <ul class="list-group list-group-flush">
                        @isset($employee->parent)
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-github mr-2 icon-inline"> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" /></svg>
                                Nadređeni</h6>
                            <a href="/employees/{{ $employee->parent->id }}"><span class="text-secondary">{{ $employee->parent->name }} {{ $employee->parent->last_name }}</span></a>
                        </li>
                        @endisset
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter mr-2 icon-inline text-info"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>Grad</h6>
                            <span class="text-secondary">{{ $employee->city->name }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-instagram mr-2 icon-inline text-danger">  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                                </svg>Sektor</h6>
                            <span class="text-secondary">{{ $employee->employeeJobDescription->sector->name }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook mr-2 icon-inline text-primary"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>Radno mjesto</h6>
                            <span class="text-secondary">{{ $employee->employeeJobDescription->workplace }}</span>
                        </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook mr-2 icon-inline text-success"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>Broj kancelarije</h6>
                                <span class="text-secondary">{{ $employee->office_number }}</span>
                            </li>
                    </ul>
                </div>

                <div class="card mt-3">
                    <div class="card-body">
                        <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2"></i>Plata</h6>
                        <div class="row">
                            <div class="col-sm-5">
                                <h6 class="mb-0">Plata</h6>
                            </div>
                            <div class="col-sm-7 text-secondary">
                                {{ $employee->employeeSalary->pay }}
                            </div>
                        </div>
                        <hr>
                        @isset($employee->employeeSalary->bonus)
                        <div class="row">
                            <div class="col-sm-5">
                                <h6 class="mb-0">Bonus</h6>
                            </div>
                            <div class="col-sm-7 text-secondary">
                                {{ $employee->employeeSalary->bonus }}
                            </div>
                        </div>
                        <hr>
                        @endisset
                        <div class="row">
                            <div class="col-sm-5">
                                <h6 class="mb-0">Ime banke</h6>
                            </div>
                            <div class="col-sm-7 text-secondary">
                                {{ $employee->employeeSalary->bank_name }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-5">
                                <h6 class="mb-0">Broj računa</h6>
                            </div>
                            <div class="col-sm-7 text-secondary">
                                {{ $employee->employeeSalary->bank_number }}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Ime i prezime</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $employee->name }} {{ $employee->last_name }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Datum rođenja</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $employee->birth_date }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">JMBG</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $employee->jmbg }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Adresa</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $employee->home_address }}, {{ $employee->city->name }}
                            </div>
                        </div>
                        <hr>
                        @isset($employee->qualifications)
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Kvalifikacije</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $employee->qualifications }}
                            </div>
                        </div>
                        <hr>
                        @endisset

                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Telefon/fiksni</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $employee->mobile_number }} / {{ $employee->telephone_number }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Email</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $employee->email }}
                            </div>
                        </div>
                        @isset($employee->additional_info_contact)
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Dodatne kontakt informacije</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $employee->additional_info_contact }}
                            </div>
                        </div>
                        @endisset
                    </div>
                </div>
                <div class="row gutters-sm">
                    <div class="col-md-6">
                        <div class="card ">
                            <div class="card-body">
                                <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2"></i>Status posla</h6>
                                <div class="row">
                                    <div class="col-sm-5">
                                        <h6 class="mb-0">Tip</h6>
                                    </div>
                                    <div class="col-sm-7 text-secondary">
                                        {{ $employee->employeeJobStatus->hireType->type }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-5">
                                        <h6 class="mb-0">Status</h6>
                                    </div>
                                    <div class="col-sm-7 text-secondary">
                                        {{ $employee->employeeJobStatus->status }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-5">
                                        <h6 class="mb-0">Datum zaposlenja</h6>
                                    </div>
                                    <div class="col-sm-7 text-secondary">
                                        {{ $employee->employeeJobStatus->date_hired }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-5">
                                        <h6 class="mb-0">Zaposlen do</h6>
                                    </div>
                                    <div class="col-sm-7 text-secondary">
                                        {{ $employee->employeeJobStatus->date_hired_till }}
                                    </div>
                                </div>
                                @isset($employee->employeeJobStatus->additional_info)
                                <hr>
                                <div class="row">
                                    <div class="col-sm-5">
                                        <h6 class="mb-0">Dodatne informacije</h6>
                                    </div>
                                    <div class="col-sm-7 text-secondary">
                                        {{ $employee->employeeJobStatus->additional_info }}
                                    </div>
                                </div>
                                @endisset
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card ">
                            <div class="card-body">
                                <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2"></i>Opis posla</h6>
                                <div class="row">
                                    <div class="col-sm-5">
                                        <h6 class="mb-0">Sektor</h6>
                                    </div>
                                    <div class="col-sm-7 text-secondary">
                                        {{ $employee->employeeJobDescription->sector->name }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-5">
                                        <h6 class="mb-0">Radno mjesto</h6>
                                    </div>
                                    <div class="col-sm-7 text-secondary">
                                        {{ $employee->employeeJobDescription->workplace }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-5">
                                        <h6 class="mb-0">Opis posla</h6>
                                    </div>
                                    <div class="col-sm-7 text-secondary">
                                        {{ $employee->employeeJobDescription->job_description }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-5">
                                        <h6 class="mb-0">Vještine</h6>
                                    </div>
                                    <div class="col-sm-7 text-secondary">
                                        {{ $employee->employeeJobDescription->skills }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    @include('employees.includes.modal-show')
@endsection

@section('js')
    @include('employees.includes.js')
@endsection


