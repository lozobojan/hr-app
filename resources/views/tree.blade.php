<!DOCTYPE html>

<html>
<head>
    <meta name="viewport" content="width=device-width" />
    <title>Basic - OrgChart JS | BALKANGraph</title>
    <style id="myStyles">
        html, body {
    margin: 0px;
    padding: 0px;
    width: 100%;
    height: 100%;
    overflow: hidden;
}

#tree {
    width: 100%;
    height: 100%;
}

    </style>

</head>
<body>
    
<script src="https://balkangraph.com/js/latest/OrgChart.js"></script>

<div id="tree"></div>
    <script>
    var chart = new OrgChart(document.getElementById("tree"), {
    nodeBinding: {
        field_0: "name"
    },
    nodes: [
        { id: 1, name: "Amplitudo" },
        { id: 2, pid: 1, name: "Bojan" },
        { id: 3, pid: 1, name: "Milena" },
        { id: 4, pid: 2, name: "Radule" },
        { id: 5, pid: 2, name: "Marko" },
        { id: 6, pid: 3, name: "Filip" },
        { id: 7, pid: 3, name: "Zeljko" }
    ]
});
    </script>
</body>
</html>