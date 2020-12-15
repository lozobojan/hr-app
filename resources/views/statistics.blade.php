@extends('layouts.admin')

@section('title', 'Statistika')
    

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
                        <h5 class="card-title text-center">Zaposleni po sektorima</h5>
                        <canvas id="hBarChart" style="height: 300px"></canvas>
                    </div>
                </div>

                <!-- Line chart -->
                <div class="card mt-4">
                    <div class="card-body">
                        <h5 class="card-title text-center">Broj zaposlenih</h5>
                        <canvas id="lineChart" style="height: 300px"></canvas>
                    </div>
                </div>

            </div>

            <div class="col-5">
                
                <!-- Pie chart -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">Ugovor na (ne)odredjeno</h5>
                        <canvas id="chart3" class="card-body" style="height: 300px;"></canvas>
                    </div>
                </div>

                <!-- Vertical bar chart -->
                <div class="card mt-4">
                    <div class="card-body">
                        <canvas id="barChart" class="card-body" style="height: 300px;"></canvas>
                        <h5 class="card-title text-center">Starost zaposlenih</h5>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-7">

        </div>
    </div>
    <script>


        // Vertical bar chart
        var ctxV = document.getElementById('barChart').getContext('2d');
        var myBarChart = new Chart(ctxV, {
            type: 'bar',
            data: {
                labels: ['Sektor 1', 'Sektor 2', 'Sektor 3'],
                datasets: [{
                    data: [12, 19, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)'
                    ],
                }]
            },
            options: {
                legend: {
                    display: false
                }
            }
        });

        // Pie chart
        var ctxpie = document.getElementById('chart3').getContext('2d');
        var myPieChart = new Chart(ctxpie, {
            type: 'pie',
            data: {
                labels: ['Sektor 1', 'Sektor 2', 'Sektor 3'],
                datasets: [{
                    data: [12, 19, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)'
                    ],
                }]
            },
        });

        // Horizontal bar chart
        var ctxH = document.getElementById('hBarChart').getContext('2d');
        var myChart = new Chart(ctxH, {
            type: 'horizontalBar',
            data: {
                labels: ['Sektor 1', 'Sektor 2', 'Sektor 3'],
                datasets: [{
                    data: [12, 19, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)'
                    ],
                }]
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        gridLines: {
                            color: "rgba(0, 0, 0, 0)",
                        },
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        // Line chart
        var ctxline = document.getElementById('lineChart').getContext('2d');
        var myLineChart = new Chart(ctxline, {
            type: 'line',
            data: {
                labels: ['2015', '2016', '2017', '2018', '2019', '2020'],
                datasets: [{
                    data: [12, 19, 25, 30, 25, 35],
                }]
            },
            options: {
                legend: {
                    display: false
                }
            }
        });


    </script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
@endsection