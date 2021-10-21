<div class="container">
    <div class="content">
        <div>
            <img src="<?=$data['dorayaki']['url']?>">
            <div>
                <h1><?=$data['dorayaki']['nama']?></h1>
                <ul>
                    <li>Tersedia ($data['dorayaki']['stok'])</li>
                    <li>Terjual ()</li>
                </ul>
                <h2>Rp.$data['dorayaki']['harga']</h2>
                <button onclick=''>Beli</button>
                <h2>Deskripsi</h2>
                <div>
                    $data['dorayaki']['deskripsi']
                </div>
            </div>
        </div>
    </div>
</div>