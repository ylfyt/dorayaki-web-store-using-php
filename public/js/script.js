var BASEURL = "http://localhost/if-3110-2021-01-23";

function search(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200){
            var resJson = JSON.parse(this.responseText);
            updateDorayakiContainer(resJson);
        }
    }

    var query = document.getElementById('query').value;
    if (query == ''){
        query = 'null';
    }

    xhttp.open("GET", BASEURL + "/dorayaki/getndorayakisortedfilter/" + query + "/10/0");
    xhttp.send();
}

function updateDorayakiContainer(dorayaki){
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
} 

    