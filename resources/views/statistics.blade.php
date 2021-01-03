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
                        <h5 class="card-title text-center" id="hbar-target">Zaposleni po sektorima</h5>
                        <canvas id="hBarChart" style="height: 300px"></canvas>
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
                        <h5 class="card-title text-center" id="hbar-target2">Prosjecna plata po sektorima</h5>
                        <canvas id="hBarChart2" style="height: 300px"></canvas>
                    </div>
                </div>

            </div>

            <div class="col-5">
                
                <!-- Pie chart -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center" id="pie-target">Ugovor na odredjeno</h5>
                        <canvas id="pie-chart" class="card-body" style="height: 300px;"></canvas>
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
                        <h5 class="card-title text-center" id="pie-target2">Ugovor na neodredjeno</h5>
                        <canvas id="pie-chart2" class="card-body" style="height: 300px;"></canvas>
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
@section('js')
    <script>

        function getHBarData(data) {
            var sectors = new Array();
            var count = new Array();
            var color = new Array();
            for(var i = 0; i < data.length; i++){
                sectors[i] = data[i].name;
                count[i] = data[i].count;
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
                            }
                        }]
                    }
                }
            };
            return data;
        }

        function getPieChartData(data) {
            var sectors = new Array();
            var count = new Array();
            var color = new Array();
            for(var i = 0; i < data.length; i++){
                sectors[i] = data[i].name;
                count[i] = data[i].count;
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

        function getLineChartData(data) {
            var years = new Array();
            var count = new Array();
            years[0] = data[0].year;
            count[0] = data[0].count;
            for(var i = 1; i < data.length; i++){
                years[i] = data[i].year;
                count[i] =  count[i - 1] + data[i].count;
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
            for(var i = 0; i < response.data.employeeAge.length; i++){
                if(i<5){
                    color[i] = 'rgba(' + Math.floor(Math.random() * 256) +','+ Math.floor(Math.random() * 256) +','+ Math.floor(Math.random() * 256) +','+ 1 + ')';
                }
                switch(true) {
                    case (response.data.employeeAge[i] <=25):
                        count[0]++;
                        break;
                    case (response.data.employeeAge[i] >25 && response.data.employeeAge[i] <=30):
                        count[1]++;
                        break;
                    case (response.data.employeeAge[i] >30 && response.data.employeeAge[i] <=35):
                        count[2]++;
                        break;
                    case (response.data.employeeAge[i] >35 && response.data.employeeAge[i] <=45):
                        count[3]++;
                        break;
                    case (response.data.employeeAge[i] >45):
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
            console.log(response);

            $("#avg-target").val(response.data.avgSalary.salary);
            $("#avg-service-target").val(response.data.avgService.date);
            // Horizontal bar chart
            if(response.data.employeeCountOne.length == 0){
                $( "#hbar-target" ).after( "<br><p>Nema podataka</p>" );
                $( "#hBarChart" ).attr('hidden', true);
            }
            else{
                $( "#hBarChart" ).attr('hidden', false);
                var HBarData = getHBarData(response.data.employeesBySector);
                var ctxH = document.getElementById('hBarChart').getContext('2d');
                var myChart = new Chart(ctxH, HBarData);
            }

            // Horizontal bar chart 2
            if(response.data.employeeCountOne.length == 0){
                $( "#hbar-target2" ).after( "<br><p>Nema podataka</p>" );
                $( "#hBarChart2" ).attr('hidden', true);
            }
            else{
                $( "#hBarChart2" ).attr('hidden', false);
                var HBarData2 = getHBarData(response.data.salaryBySector);
                var ctxH2 = document.getElementById('hBarChart2').getContext('2d');
                var myChart = new Chart(ctxH2, HBarData2);
            }
            
            // Pie chart
            if(response.data.employeeCountOne.length == 0){
                $( "#pie-target" ).after( "<br><p>Nema podataka</p>" );
                $( "#pie-chart" ).attr('hidden', true);
            }
            else{
                $( "#pie-chart" ).attr('hidden', false);
                var PieChartData = getPieChartData(response.data.employeeCountOne);
                var ctxpie = document.getElementById('pie-chart').getContext('2d');
                var myPieChart = new Chart(ctxpie, PieChartData);
            }

            // Pie chart 2
            if(response.data.employeeCountTwo.length == 0){
                $( "#pie-target2" ).after( "<br><p>Nema podataka</p>" );
                $( "#pie-chart2" ).attr('hidden', true);
            }
            else{
                $( "#pie-chart2" ).attr('hidden', false);
                var PieChartData2 = getPieChartData(response.data.employeeCountTwo);
                var ctxpie2 = document.getElementById('pie-chart2').getContext('2d');
                var myPieChart = new Chart(ctxpie2, PieChartData2);
            }

            // Line chart
            if(response.data.employeeBirthYears.length == 0){
                $( "#line-target" ).after( "<br><p>Nema podataka</p>" );
                $( "#lineChart" ).attr('hidden', true);
            }
            else{
                $( "#lineChart" ).attr('hidden', false);
                var lineChartData = getLineChartData(response.data.employeeBirthYears);
                var ctxline = document.getElementById('lineChart').getContext('2d');
                var myLineChart = new Chart(ctxline, lineChartData);
            }

            // Vertical bar chart
            if(response.data.employeeAge.length == 0){
                $( "#bar-target" ).after( "<br><p>Nema podataka</p>" );
                $( "#barChart" ).attr('hidden', true);
            }
            else{
                $( "#barChart" ).attr('hidden', false);
                var barChartData = getBarChartData(response);
                var ctxV = document.getElementById('barChart').getContext('2d');
                var myBarChart = new Chart(ctxV, barChartData);
            }

        });

    </script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
@endsection