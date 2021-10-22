<div class="container">
    <div class="content">
        <div>
            <img src="<?=$data['dorayaki']['url']?>">
        </div>
        <div>
            <h1><?=$data['dorayaki']['nama']?></h1>
            <p>Tersedia (<?=$data['dorayaki']['stok']?>)</p>
            <h2>Rp.<?=$data['dorayaki']['harga']?></h2>
        </div>
        <p>Jumlah Dorayaki:</p>
        <div>
            <button onclick="incAmount()">+</button>
            <?php if ($data['is-admin']): ?>
                <input id="jmlstok" type="number" min=0>
            <?php else: ?>
                <input id="jmlstok" type="number" 
            max=<?=$data['dorayaki']['stok']?> min=1>
            <?php endif; ?>
            <input id="jmlstok" type="number" 
            max=<?=$data['dorayaki']['stok']?> min=1>
            <button onclick="decAmount()">-</button>
        </div>
        <h2>Total Harga: XXXXX rupiah</h2>
        <?php if ($data['is-admin']): ?>
            <a href="<?php echo(BASEURL . '/dorayaki/' . $data['dorayaki']['id'])?>">Ubah Stock</a>
        <?php else: ?>
            <a href="<?php echo(BASEURL . '/dorayaki/' . $data['dorayaki']['id'])?>">Beli</a>
        <?php endif; ?>
        <a href="<?php echo(BASEURL . '/dorayaki/' . $data['dorayaki']['id'])?>">Batal</a>
    </div>
</div>