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

    switch (type) {
        
        case (0):
        case (1):
            for (var i = 0; i < data.length; i++) {
                labels[i] = data[i].name;
                count[i] = data[i].count;
                color[i] = randomColor();
            }
            break;
        
        case (2):
            count = [0, 0, 0, 0, 0];
            labels = ['<25', '25-30', '30-35', '35-45', '45+'];
            for (var i = 0; i < data.length; i++) {
                if (i < 5) {
                    color[i] = randomColor();
                }
                switch (true) {
                    case (data[i] <= 25):
                        count[0]++;
                        break;
                    case (data[i] > 25 && data[i] <= 30):
                        count[1]++;
                        break;
                    case (data[i] > 30 && data[i] <= 35):
                        count[2]++;
                        break;
                    case (data[i] > 35 && data[i] <= 45):
                        count[3]++;
                        break;
                    case (data[i] > 45):
                        count[4]++;
                        break;
                }
            }
            break;

        case (3):
            labels[0] = data[0].year;
            count[0] = data[0].count;
            for (var i = 1; i < data.length; i++) {
                labels[i] = data[i].year;
                count[i] = count[i - 1] + data[i].count;
            }
            break;
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

axios.get('/api/employees-sector')
    .then((response) => {
        console.log(response);

        $("#avg-target").val(response.data.avgSalary.salary);
        $("#avg-service-target").val(response.data.avgService.date);

        // Horizontal bar chart
        checkForData(response.data.employeeCountOne, 'hbar', 1);

        // Horizontal bar chart 2
        checkForData(response.data.salaryBySector, 'hbar2', 1);

        // Pie chart
        checkForData(response.data.employeeCountOne, 'pie', 0);

        // Pie chart 2
        checkForData(response.data.employeeCountTwo, 'pie2', 0);

        // Line chart
        checkForData(response.data.employeeBirthYears, 'line', 3);

        // Vertical bar chart
        checkForData(response.data.employeeAge, 'bar', 2);

    });
    