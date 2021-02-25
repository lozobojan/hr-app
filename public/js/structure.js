function getChildren(parentId, data) {
  var res = []
  data.forEach(child => {
    if (child.pid == parentId) {
      res.push(
        {
          "id": child.id,
          "name": child.name,
          "title": child.last_name,
          "parentId": child.pid,
          "children": getChildren(child.id, data),
        }
      )
    }
  })
  return res;
}

$(function () {
  axios.get('/api/employees')
    .then((response) => {
      var employees = response.data.employees;
      var roots = {
        "id": null,
        "name": "Amplitudo",
        "title": "Company",
        "children": getChildren(null, employees),
      };

      $('#chart-container').orgchart({
        'data': roots,
        'nodeContent': 'title',
        // 'exportButton': true,
        // 'exportButtonName': 'Export',
        // 'exportFilename': 'organizaciona-struktura',
        // 'exportFileextension': 'png',
        'direction': 'l2r',
        'zoom': true,
        'pan': true,
      });

    });
});