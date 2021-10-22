var BASEURL = "http://localhost/if-3110-2021-01-23";

// Get the input field
var input = document.getElementById("query-input");
if (input != null){
    input.addEventListener("keyup", function(event) {
        if (event.keyCode === 13) {
          event.preventDefault();
          getSearch();
        }
    });
}


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

function validateEmail(){
    var emailInput = document.getElementById('email');

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200){
            var resJson = JSON.parse(this.responseText);
            if (!resJson.error){
                emailInput.style['outline-color'] = '#00FF00';
            }
            else{
                emailInput.style['outline-color'] = '#FF0000';
            }
        }

    }
    var url = BASEURL + "/user/isvalidemail/" + emailInput.value;

    xhttp.open("GET", url);
    xhttp.send();
}

function validateUsername(){
    var usernameInput = document.getElementById('username');

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200){
            var resJson = JSON.parse(this.responseText);
            if (!resJson.error && regexValidUsername(usernameInput.value)){
                usernameInput.style['outline-color'] = '#00FF00';
            }
            else{
                usernameInput.style['outline-color'] = '#FF0000';
            }
        }

    }
    var url = BASEURL + "/user/searchusername/" + usernameInput.value;

    xhttp.open("GET", url);
    xhttp.send();
}


function regexValidUsername(string){
    if(string.includes('_') && /[a-z]/i.test(string) && /\d/.test(string)){
        return true;
    }
    return false;
}

function regexValidEmail(string){
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
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

function incAmount() {
    document.getElementById('jmlstok').stepUp();
}


function decAmount() {
    document.getElementById('jmlstok').stepDown();
}

function calculatePrice(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        var total  = document.getElementById('stockInput');
    }

    xhttp.open();
    xhttp.send();
}    