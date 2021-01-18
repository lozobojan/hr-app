function randomColor() {
    return `rgba(${Math.floor(Math.random() * 256)},${Math.floor(Math.random() * 256)},${Math.floor(Math.random() * 256)},1)`;
}

function getChartData(data, type){

    var types = ["pie", "horizontalBar", "bar", "line"];
    var options = [
        { legend: { labels: { fontSize: 18 } } },
        { legend: { display: false }, scales: { yAxes: [{ gridLines: { color: "rgba(0, 0, 0, 0)", }, ticks: { beginAtZero: true } }], xAxes: [{ ticks: { beginAtZero: true, } }] } },
        { legend: { display: false }, scales: { yAxes: [{ ticks: { beginAtZero: true } }], xAxes: [{ gridLines: { color: "rgba(0, 0, 0, 0)", } }] } },
        { legend: { display: false } }
    ];
    var color = new Array();
    var labels = new Array();
    var count = new Array();

    for (var i = 0; i < data.length; i++) {
        labels[i] = data[i].name;
        count[i] = data[i].count;
        color[i] = randomColor();
    }

    var data = {
        type: types[type],
        data: {
            labels: labels,
            datasets: [{
                data: count,
                backgroundColor: color
            }]
        },
        options: options[type],
    };
    return data;
    
}

function checkForData(data, id, type) {
    if (data.length == 0) {
        $(`#${id}-target`).after("<br><p>Nema podataka</p>");
        $(`#${id}Chart`).attr('hidden', true);
    }
    else {
        $(`#${id}Chart`).attr('hidden', false);
        var chartData = getChartData(data, type);
        var ctxH = document.getElementById(`${id}Chart`).getContext('2d');
        var myChart = new Chart(ctxH, chartData);
    }
}

axios.get('/api/employees-statistics')
    .then((response) => {
        console.log(response);

        $("#avg-target").val(`${response.data.avgSalary.salary} €`);
        $("#avg-service-target").val(`${response.data.avgService.date} godina`);

        // Horizontal bar chart
        checkForData(response.data.employeesBySector, 'hbar', 1);

        // Horizontal bar chart 2
        checkForData(response.data.salaryBySector, 'hbar2', 1);

        // Pie chart
        checkForData(response.data.employeeCountOne, 'pie', 0);

        // Pie chart 2
        checkForData(response.data.employeeCountTwo, 'pie2', 0);

        // Pie chart 3
        checkForData(response.data.employeeCountThree, 'pie3', 0);
        
        // Pie chart 4
        checkForData(response.data.employeeCountFour, 'pie4', 0);

        // Line chart
        checkForData(response.data.employeeCountPerYear, 'line', 3);

        // Vertical bar chart
        checkForData(response.data.employeeAge, 'bar', 2);

    });
    