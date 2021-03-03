function getChildren(parentId, data) {
  var res = []
  data.forEach(child => {
    if (child.pid == parentId) {
      res.push(
        {
          text: {
            "name": child.name,
            title: child.last_name,
          },
          link: {
            href: '/employees/' + child.id,
            target: "_blank",
          },
          image: child.image,
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
      var chartData = {
        text: {
          "name": "Amplitudo",
          "title": "Company",
        },
        image: 'https://amplitudo.me/images/blogs/KrLhfios-mobile-android-design-goplant.png',
        children: getChildren(null, employees),
      };

      var simple_chart_config = {
        chart: {
          container: "#chart-container",
          scrollbar: 'native',
        },
        nodeStructure: chartData,
      };

      var my_chart = new Treant(simple_chart_config);

    });
});