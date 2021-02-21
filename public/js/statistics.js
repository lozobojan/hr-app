
function displayError(id){
    $(`#${id}-target`).after("<br><p>Nema podataka</p>");
    $(`#${id}Chart`).attr('hidden', true);
}

function randomColor() {
    return `rgba(${Math.floor(Math.random() * 256)},${Math.floor(Math.random() * 256)},${Math.floor(Math.random() * 256)},1)`;
}

function getChartData(data, type){

    var types = ["pie", "horizontalBar", "bar", "line"];
    var options = [
        { legend: { labels: { fontSize: 18 } } },
        { legend: { display: false }, scales: { yAxes: [{ gridLines: { color: "rgba(0, 0, 0, 0)", }, ticks: { beginAtZero: true} }], xAxes: [{ ticks: { beginAtZero: true } }] } },
        { legend: { display: false }, scales: { yAxes: [{ ticks: { beginAtZero: true, stepSize: 1 } }], xAxes: [{ gridLines: { color: "rgba(0, 0, 0, 0)", } }] } },
        { legend: { display: false } }
    ];

    var color = new Array();
    for (var i = 0; i < data.name.length; i++) {
        color[i] = randomColor();
    }

    var data = {
        type: types[type],
        data: {
            labels: data.name,
            datasets: [{
                data: data.count,
                backgroundColor: color
            }]
        },
        options: options[type],
    };
    return data;
    
}

function checkForData(data, id, type) {
    try{
        if(data.name.length == 0){
            throw new Error();
        }
        $(`#${id}Chart`).attr('hidden', false);
        var chartData = getChartData(data, type);
        var ctxH = document.getElementById(`${id}Chart`).getContext('2d');
        var myChart = new Chart(ctxH, chartData);
    }catch{
        displayError(id);
    }
}

axios.get('/api/employees-statistics')
    .then((response) => {

        $("#avg-target").val(`${response.data.avgSalary.salary} €`);
        $("#avg-service-target").val(`${response.data.avgService.date} godina`);
        
        // Employee count horizontal bar chart 
        var tempData = {
            name: response.data.bySector.map(({name}) => name),
            count: response.data.bySector.map(({count}) => count),
        };
        checkForData(tempData, 'hbar', 1);
        
        // Salary horizontal bar chart
        tempData = {
            name: response.data.bySector.map(({name}) => name),
            count: response.data.bySector.map(({pay}) => pay),
        };
        checkForData(tempData, 'hbar2', 1);

        // Pie chart
        tempData = response.data.byHireType.filter(x => x.type == 1);
        tempData = {
            name: tempData.map(({name}) => name),
            count: tempData.map(({count}) => count),
        };
        checkForData(tempData, 'pie', 0);

        // Pie chart 2
        tempData = response.data.byHireType.filter(x => x.type == 2);
        tempData = {
            name: tempData.map(({name}) => name),
            count: tempData.map(({count}) => count),
        };
        checkForData(tempData, 'pie2', 0);

        // Pie chart 3
        tempData = response.data.byHireType.filter(x => x.type == 3);
        tempData = {
            name: tempData.map(({name}) => name),
            count: tempData.map(({count}) => count),
        };
        checkForData(tempData, 'pie3', 0);
        
        // Pie chart 4
        tempData = response.data.byHireType.filter(x => x.type == 4);
        tempData = {
            name: tempData.map(({name}) => name),
            count: tempData.map(({count}) => count),
        };
        checkForData(tempData, 'pie4', 0);

        // Line chart
        tempData = {
            name: response.data.employeeCountPerYear.map(({name}) => name),
            count: response.data.employeeCountPerYear.map(({count}) => count),
        };
        console.log(tempData);
        checkForData(tempData, 'line', 3);

        // Vertical bar chart
        var temp = [];
        temp.push(response.data.employeeAge.filter(x => x.age < 25).length);
        temp.push(response.data.employeeAge.filter(x => x.age >= 25 && x.age < 30).length);
        temp.push(response.data.employeeAge.filter(x => x.age >= 30 && x.age < 35).length);
        temp.push(response.data.employeeAge.filter(x => x.age >= 35 && x.age < 45).length);
        temp.push(response.data.employeeAge.filter(x => x.age >= 45).length);
        tempData = {
            name: ['-25', '25-29', '30-34', '35-44', '45+'],
            count: temp,
        };
        checkForData(tempData, 'bar', 2);

    }).catch(error => {
        swal("Greška!", "Desila se greška na serveru! Pokušajte kasnije.", "error")
    });
    