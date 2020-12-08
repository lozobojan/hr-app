

<!DOCTYPE html>

<html>
<head>
    <meta name="viewport" content="width=device-width" />
    <title>Organizaciona struktura</title>
    <style id="myStyles">
        html, body {
    margin: 0px;
    padding: 0px;
    width: 100%;
    height: 100%;
    overflow: hidden;
    font-family: Helvetica;
}

#tree {
    width: 100%;
    height: 100%;
}
    </style>

</head>
<body>

    <div id="tree"></div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://balkangraph.com/js/latest/OrgChart.js"></script>
    <script>
    var datas;

    axios.get('/api/employees')
    .then((response) => {
        datas = response.data.employees;
        for (i = 0; i < datas.length; i++) {
            datas[i] = { id: datas[i].id, pid: datas[i].pid , Name: datas[i].name, "Last Name": datas[i].last_name, Photo: datas[i].image_path};
        }
        var chart = new OrgChart(document.getElementById("tree"), {
            template: "ula",
            nodeBinding: {
                field_0: "Name",
                field_1: "Last Name",
                img_0: "Photo"
            },
            nodeMenu: {
                details: { text: "Details" },
                edit: { text: "Edit" },
                add: { text: "Add" },
                remove: { text: "Remove" }
            }           
        });
        nodes = datas;
        chart.load(nodes);    
    
    });
    </script>
    <script>

    </script>
</body>
</html>