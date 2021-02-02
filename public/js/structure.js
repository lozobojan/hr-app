axios.get('/api/employees')
.then((response) => {
    var data = response.data;
    for (i = 0; i < data.length; i++) {
        data[i] = { id: data[i].id,
            pid: data[i].pid ,
            Name: data[i].name,
            "Last Name": data[i].last_name,
            Photo: data[i].image,
            Email: data[i].email,
            "Mobile number": data[i].mobile_number,
            "Telephone number": data[i].telephone_number,
            "Office number": data[i].office_number,
            "Gender": (data[i].gender ? "Male" : "Female"),
            Birthday: data[i].birth_date,
        };
    }
    var chart = new OrgChart(document.getElementById("tree"), {
        template: "ula",
        nodeBinding: {
            field_0: "Name",
            field_1: "Last Name",
            img_0: "Photo",
        }
    });
    nodes = data;
    chart.load(nodes);
});