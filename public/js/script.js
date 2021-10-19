var BASEURL = "http://localhost/if-3110-2021-01-23";

// Get the input field
var input = document.getElementById("query-input");

input.addEventListener("keyup", function(event) {
  if (event.keyCode === 13) {
    event.preventDefault();
    getSearch();
  }
});

function next(){
    var page = document.getElementById('page-number').innerText;
    var query = document.getElementById('query').value;

    if (query == ''){
        query = 'null';
    }
    search(page, query);
}

function prev(){
    var page = document.getElementById('page-number').innerText;
    var query = document.getElementById('query').value;

    if (query == ''){
        query = 'null';
    }
    search(page-2, query);
}

function getSearch(){
    var query = document.getElementById('query-input').value;
    document.getElementById('query-input').value = '';
    document.getElementById('query').value = query;
    if (query == ''){
        query = 'null';
    }
    var page = 0;
    search(page, query);
}


function search(page, query){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200){
            var resJson = JSON.parse(this.responseText);
            updateDashboard(resJson);
        }
    }
    var url = BASEURL + "/searchdorayaki/" + query + "/" + page;

    xhttp.open("GET", url);
    xhttp.send();
}

function updateDashboard(data){

    var dorayaki = data.dorayaki;
    var container = document.getElementById('dorayaki-container');
    container.innerHTML = "";

    dorayaki.forEach(dora => {
        var card = '<a href="' + BASEURL + '/dorayaki/' + dora.id + '">'
        card += '<div class="card">'
        card += '<img src="' + dora.url + '" alt="">'
        card += '<div class="info">'
        card += '<div class="name">' + dora.nama + '</div>'
        card += '<div class="price">Rp. ' + dora.harga + '</div>'
        card += '<div class="desc">' + dora.deskripsi + '</div>'
        card += '</div></div></a>';

        container.innerHTML += card;
    });

    var pageNav = document.getElementById('page-navigator');
    pageNav.innerHTML = "";
    if (dorayaki.length != 0){
        if (!data.first){
            pageNav.innerHTML += '<div id="prev" onclick="prev();"><</div>';
        }
        var number = parseInt(data.page) + 1
        pageNav.innerHTML += '<p id="page-number">' + number + '</p>';
        if (!data.last){
            pageNav.innerHTML += '<div id="next" onclick="next();">></div>';
        }
    }
    else{
        container.innerHTML += '<p>Dorayaki Tidak ditemukan</p>';
    }
}

    