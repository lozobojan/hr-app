@extends('layouts.admin')

@section('title', 'Statistika')

@section('js')

<script src="{{ asset('js/statistics.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

@endsection

@section('content')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
<!-- Chart's container -->
<div class="container-fluid">
    <div class="row mt-3">

        <div class="col-7">

            <!-- Horizontal bar chart -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center" id="hbar-target">Zaposleni po sektorima</h5>
                    <canvas id="hbarChart" style="height: 300px"></canvas>
                </div>
            </div>

            <!-- Line chart -->
            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="card-title text-center" id="line-target">Broj zaposlenih</h5>
                    <canvas id="lineChart" style="height: 300px"></canvas>
                </div>
            </div>

            <!-- Horizontal bar chart 2 -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center" id="hbar2-target">Prosjecna plata po sektorima</h5>
                    <canvas id="hbar2Chart" style="height: 300px"></canvas>
                </div>
            </div>

        </div>

        <div class="col-5">

            <!-- Pie chart -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center" id="pie-target">Ugovor na odredjeno</h5>
                    <canvas id="pieChart" class="card-body" style="height: 300px;"></canvas>
                </div>
            </div>

            <!-- Vertical bar chart -->
            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="card-title text-center" id="bar-target">Starost zaposlenih</h5>
                    <canvas id="barChart" class="card-body" style="height: 300px;"></canvas>
                </div>
            </div>

            <!-- Pie chart 2 -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center" id="pie2-target2">Ugovor na neodredjeno</h5>
                    <canvas id="pie2Chart" class="card-body" style="height: 300px;"></canvas>
                </div>
            </div>

            <!-- AVG salary -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center"> Prosjecna plata: <input type="text form-control" disabled id="avg-target"></h5>
                </div>
            </div>


            <!-- AVG years of service -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center"> Prosjecan radni staz: <input type="text form-control" disabled id="avg-service-target"></h5>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="row mt-3">
    <div class="col-7">

    </div>
</div>
@endsection