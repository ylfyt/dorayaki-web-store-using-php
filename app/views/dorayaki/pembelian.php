<div class="container">
    <div class="content">
        <div class="buy-card">
            <img src="<?=$data['dorayaki']['url']?>">
            <div class="buy-content">
                <h1><?=$data['dorayaki']['nama']?></h1>
                <div id='stokdora'>
                    <p>Tersedia (</p>
                    <p id="stoktersedia"><?=$data['dorayaki']['stok']?></p>
                    <p>)</p>
                </div>
                <h2>Rp.<?=$data['dorayaki']['harga']?></h2>
                <p>Jumlah Dorayaki:</p>

                <div class="btn-amount">
                    <input type="hidden" value="<?=$data['dorayaki']['harga']?>" id="hargadora">
                    <input type="hidden" value="<?=$data['dorayaki']['id']?>" id="iddora" name="iddora">
                    <input type="hidden" value="<?=$_SESSION['user-id']?>" id="userid" name="userid">
                    <?php if ($data['is-admin'] == 1): ?>
                        <div class="btn plus" onclick="incAmount()">+</div>
                        <input id="jmlstok" type="number" min=0 name="jmlstok">
                        <div class="btn delete" onclick="decAmount()">-</div>
                    <?php else: ?>
                        <div class="btn plus" onclick="incAmount()">+</div>
                        <input name="jmlstok" id="jmlstok" type="number" 
                        max=<?=$data['dorayaki']['stok']?> min=1>
                        <div class="btn delete" onclick="decAmount()">-</div>
                    <?php endif; ?>
                </div>

                <h2 id="totalharga">Total Harga:</h2>

                <?php if ($data['is-admin']): ?>
                    <button class="btn" type="submit" name="edit" onclick="editStok()">Ubah Stock</button>
                <?php else: ?>
                    <button class="btn" type="submit" name="buy" onclick="buyDora()">Beli</button>
                <?php endif; ?>
                
                <a class="btn delete" href="<?php echo(BASEURL . '/dorayaki/' . $data['dorayaki']['id'])?>">Batal</a>
            </div>
        </div>
    </div>
</div>