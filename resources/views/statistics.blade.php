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
                        <h5 class="card-title text-center">Ugovor na odredjeno</h5>
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
@endsection
@section('js')
    <script>

        function getHBarData(response) {
            var sectors = new Array();
            var count = new Array();
            var color = new Array();
            for(var i = 0; i < response.data.employeesBySector.length; i++){
                sectors[i] = response.data.sectorSalaries[response.data.employeesBySector[i].sector_id - 1].name;
                count[i] = response.data.employeesBySector[i].count;
                color[i] = 'rgba(' + Math.floor(Math.random() * 256) +','+ Math.floor(Math.random() * 256) +','+ Math.floor(Math.random() * 256) +','+ 1 + ')';
            }
            var data = {
                type: 'horizontalBar',
                data: {
                    labels: sectors, 
                    datasets:[{
                        data: count,
                        backgroundColor: color,
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
                        }],
                        xAxes: [{
                            ticks: {
                                beginAtZero: true,
                                stepSize: 1
                            }
                        }]
                    }
                }
            };
            return data;
        }

        function getPieChartData(response) {
            var sectors = new Array();
            var count = new Array();
            var color = new Array();
            for(var i = 0; i < response.data.EmployeeCount.length; i++){
                sectors[i] = response.data.sectorSalaries[response.data.EmployeeCount[i].sector_id - 1].name;
                count[i] = response.data.EmployeeCount[i].count;
                color[i] = 'rgba(' + Math.floor(Math.random() * 256) +','+ Math.floor(Math.random() * 256) +','+ Math.floor(Math.random() * 256) +','+ 1 + ')';
            }
            var data = {
                type: 'pie',
                data: {
                    labels: sectors, 
                    datasets:[{
                        data: count,
                        backgroundColor: color,
                    }]
                },
                options: {
                    legend: {
                        labels: {
                            fontSize: 18
                        }
                    }
                }
            };
            return data;
        }

        function getLineChartData(response) {
            var years = new Array();
            var count = new Array();
            years[0] = response.data.employeeBirthYears[0].year;
            count[0] = response.data.employeeBirthYears[0].count;
            for(var i = 1; i < response.data.employeeBirthYears.length; i++){
                years[i] = response.data.employeeBirthYears[i].year;
                count[i] =  count[i - 1] + response.data.employeeBirthYears[i].count;
            }
            var data = {
                type: 'line',
                data: {
                    labels: years,
                    datasets: [{
                        data: count,
                    }]
                },
                options: {
                    legend: {
                        display: false
                    }
                }
            }
            return data;
        }

        function getBarChartData(response){
            var count = [0, 0, 0, 0, 0];
            var color = new Array();
            for(var i = 0; i < response.data.employeeBirthDates.length; i++){
                if(i<5){
                    color[i] = 'rgba(' + Math.floor(Math.random() * 256) +','+ Math.floor(Math.random() * 256) +','+ Math.floor(Math.random() * 256) +','+ 1 + ')';
                }
                let birthday = new Date(response.data.employeeBirthDates[i].birth_date.substring(6), response.data.employeeBirthDates[i].birth_date.substring(3, 5), response.data.employeeBirthDates[i].birth_date.substring(0, 2))
                var ageDifMs = Date.now() - birthday.getTime();
                var ageDate = new Date(ageDifMs);
                switch(true) {
                    case (Math.abs(ageDate.getUTCFullYear() - 1970) <=25):
                        count[0]++;
                        break;
                    case (Math.abs(ageDate.getUTCFullYear() - 1970) >25 && Math.abs(ageDate.getUTCFullYear() - 1970) <=30):
                        count[1]++;
                        break;
                    case (Math.abs(ageDate.getUTCFullYear() - 1970) >30 && Math.abs(ageDate.getUTCFullYear() - 1970) <=35):
                        count[2]++;
                        break;
                    case (Math.abs(ageDate.getUTCFullYear() - 1970) >35 && Math.abs(ageDate.getUTCFullYear() - 1970) <=45):
                        count[3]++;
                        break;
                    case (Math.abs(ageDate.getUTCFullYear() - 1970) >45):
                        count[4]++;
                        break;
                }                
            }
            var data = {
                type: 'bar',
                data: {
                    labels: ['0-25', '25-30', '30-35', '35-45', '45+'],
                    datasets: [{
                        data: count,
                        backgroundColor: color,
                    }]
                },
                options: {
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }],
                        xAxes: [{
                            gridLines: {
                                color: "rgba(0, 0, 0, 0)",
                            }
                        }]
                    }
                }
            }
            return data;
        }

        axios.get('/api/employees-sector')
        .then((response) => {
            
            // Horizontal bar chart
            var HBarData = getHBarData(response);
            var ctxH = document.getElementById('hBarChart').getContext('2d');
            var myChart = new Chart(ctxH, HBarData);
            
            // Pie chart
            var PieChartData = getPieChartData(response);
            var ctxpie = document.getElementById('chart3').getContext('2d');
            var myPieChart = new Chart(ctxpie, PieChartData);

            // Line chart
            var lineChartData = getLineChartData(response);
            var ctxline = document.getElementById('lineChart').getContext('2d');
            var myLineChart = new Chart(ctxline, lineChartData);
            
            // Vertical bar chart
            var barChartData = getBarChartData(response);
            var ctxV = document.getElementById('barChart').getContext('2d');
            var myBarChart = new Chart(ctxV, barChartData);
        });

    </script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
@endsection