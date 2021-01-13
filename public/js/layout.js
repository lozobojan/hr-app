function navItem(data, currentURL){
    var keyValues = Object.keys(data);
    var url = ["/directory/","/","/tag/type/","/tag/sector/"];
    for(var j = 0; j < keyValues.length; j++){
        if(data[keyValues[j]].length == 0){
            $(`#target-${keyValues[j]}`).append(`<li class="nav-item"><a href="#" class="nav-link"><p>Nema podataka</p></a></li>`);
        }
        else{
            var deepKeys = Object.keys(data[keyValues[j]][0]);
            for(var i = 0; i < data[keyValues[j]].length; i++){
                $(`#target-${keyValues[j]}`).append(`<li class="nav-item"><a href="${url[j]+data[keyValues[j]][i][deepKeys[0]]}" ${j == 1 ? 'target="_blank"' : ""} class="nav-link ${ currentURL.includes(url[j]+data[keyValues[j]][i][deepKeys[0]]) ? "active" : ""}"><i class="far fa-circle nav-icon"></i><p>${data[keyValues[j]][i][deepKeys[1]]}</p></a></li>`);
            }
        }
    }
    return;
}

$(document).ready(function() {
    $('.preloader').hide();

    axios.get('/api/directories')
        .then((response) => {
            var test = Object.keys(response.data);
            url = window.location.href;
            navItem(response.data, url);

        });
    $("#search").click(function(){
        var keyword = $("#keyword").val();
        window.location.href = "/search/" + keyword;
    });            
});