// function navItem(data, route, target){
//     if(data.length == 0){
//         $(`#target-${target}`).append(`<li class="nav-item"><a href="#" class="nav-link"><p>Nema podataka</p></a></li>`);
//     }
//     else{
//         for(var i = 0; i < data.length; i++){
//             $(`#target-${target}`).append(`<li class="nav-item"><a href="/${response.data.files[i].file_path}" target="_blank" class="nav-link"><i class="far fa-circle nav-icon"></i><p>${response.data.files[i].name}</p></a></li>`);
//         }
//     }
// }

$(document).ready(function() {
    $('.preloader').hide();

    axios.get('/api/directories')
        .then((response) => {
            url = `{{url()->current()}}`;
            if(response.data.directories.length == 0){
                $("#target-dir").append(`<li class="nav-item"><a href="#" class="nav-link"><p>Nema foldera</p></a></li>`);
            }
            for(var i = 0; i < response.data.directories.length; i++){
                if(url.substring(22) == 'directory/'+response.data.directories[i].id){
                    $("#target-dir").append(`<li class="nav-item"><a href="/directory/${response.data.directories[i].id}" class="nav-link active"><i class="far fa-circle nav-icon"></i><p>${response.data.directories[i].name}</p></a></li>`);
                    continue;
                }
                $("#target-dir").append(`<li class="nav-item"><a href="/directory/${response.data.directories[i].id}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>${response.data.directories[i].name}</p></a></li>`);
            }
            if(response.data.files.length == 0){
                $("#target-file").append(`<li class="nav-item"><a href="#" class="nav-link"><p>Nema dokumenata</p></a></li>`);
            }
            for(var i = 0; i < response.data.files.length; i++){
                $("#target-file").append(`<li class="nav-item"><a href="/${response.data.files[i].file_path}" target="_blank" class="nav-link"><i class="far fa-circle nav-icon"></i><p>${response.data.files[i].name}</p></a></li>`);
            }
            if(response.data.sectors.length == 0){
                $("#target-sector").append(`<li class="nav-item"><a href="#" class="nav-link"><p>Nema sektora</p></a></li>`);
            }
            for(var i = 0; i < response.data.sectors.length; i++){
                if(url.substring(22) == 'tag/sector/'+response.data.sectors[i].id){
                    $("#target-sector").append(`<li class="nav-item"><a href="/tag/sector/${response.data.sectors[i].id}" class="nav-link active"><i class="far fa-circle nav-icon"></i><p>${response.data.sectors[i].name}</p></a></li>`);
                    continue;
                }
                $("#target-sector").append(`<li class="nav-item"><a href="/tag/sector/${response.data.sectors[i].id}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>${response.data.sectors[i].name}</p></a></li>`);
            }
            for(var i = 0; i < response.data.types.length; i++){
                if(url.substring(22) == 'tag/type/'+response.data.sectors[i].id){
                    $("#target-type").append(`<li class="nav-item"><a href="/tag/type/${response.data.types[i].id}" class="nav-link active"><i class="far fa-circle nav-icon"></i><p>${response.data.types[i].name}</p></a></li>`);
                    continue;
                }
                $("#target-type").append(`<li class="nav-item"><a href="/tag/type/${response.data.types[i].id}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>${response.data.types[i].name}</p></a></li>`);
            }
        });
    $("#search").click(function(){
        var keyword = $("#keyword").val();
        window.location.href = "/search/" + keyword;
    });            
});