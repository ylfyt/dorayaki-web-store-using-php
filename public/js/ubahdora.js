function editStok(){
    var jmlstok = document.getElementById('jmlstok').value;
    var iddora = document.getElementById('iddora').value;
    var userid = document.getElementById('userid').value;
    var action = 'edit';

    if (jmlstok == '' || iddora == '' || userid == ''){
        setNotification(false, 'Pengubahan gagal');
    }
    else{
        var xhr = new XMLHttpRequest();
        var url = BASEURL + '/dorayaki/buyfromajax';
        xhr.open('POST', url, true);
        
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        xhr.onload = function () {
            if(this.readyState == 4 && this.status == 200) {
                var json = JSON.parse(this.responseText);
                if (json.error == false){
                    updatePagePembelian(jmlstok);
                    setNotification(true, 'Pengubahan stok berhasil');
                }
                else{
                    setNotification(true, 'Pengubahan stok gagal');
                }
            }
        };
    
        
        var params = 'action=' + action + '&' + 'jmlstok=' + jmlstok + '&' + 'iddora=' + iddora + '&' + 'userid=' + userid;  
        xhr.send(params);
    }
}

function buyDora(){
    alert('buy')
}

function setNotification(success, msg){
    if (success){
        var html = '<div class="notification green" id="notification">';
        html += '<div id="close-button" onclick="closeNotification()">x</div>';
        html += '<p id="message">' + msg + '</p></div>';

        document.body.innerHTML += html;
    }
    else{
        var html = '<div class="notification red" id="notification">';
        html += '<div id="close-button" onclick="closeNotification()">x</div>';
        html += '<p id="message">' + msg + '</p></div>';

        document.body.innerHTML += html;
    }
}

function updatePagePembelian(stok){
    if (stok != null){
        document.getElementById('stoktersedia').innerHTML = 'Tersedia ' + stok;
    }
}

