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
        <form action="<?= BASEURL ?>/dorayaki/buy/<?=$data['dorayaki']['id']?>" method="post">
        <div>
            <input type="hidden" value="<?=$data['dorayaki']['harga']?>" id="hargadora">
            <input type="hidden" value="<?=$data['dorayaki']['id']?>" id="iddora" name="iddora">
            <?php if ($data['is-admin'] == 1): ?>
                <div onclick="incAmount()">+</div>
                <input id="jmlstok" type="number" min=0 name="jmlstok">
                <div onclick="decAmount()">-</div>
            <?php else: ?>
                <div onclick="incAmount()">+</div>
                <input name="jmlstok" id="jmlstok" type="number" 
            max=<?=$data['dorayaki']['stok']?> min=1>
            <div onclick="decAmount()">-</div>
            <?php endif; ?>
        </div>
        
        <h2 id="totalharga">Total Harga:</h2>


        <?php if ($data['is-admin']): ?>
            <button type="submit" name="edit">Ubah Stock</button>
        <?php else: ?>
            <button type="submit" name="buy">Beli</button>
        <?php endif; ?>
        </form>
        
        <a href="<?php echo(BASEURL . '/dorayaki/' . $data['dorayaki']['id'])?>">Batal</a>
    
    </div>
</div>