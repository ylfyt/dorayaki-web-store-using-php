<div class="container">
    <div class="content">
        <a class="btn" href="<?php echo(BASEURL)?>">Back</a>
        <div class="desc-card">
            <img src="<?=$data['dorayaki']['url']?>">
            <div class="desc-content">
                <h1 class=><?=$data['dorayaki']['nama']?></h1>
                <ul>
                    <li>Tersedia (<?=$data['dorayaki']['stok']?>)</li>
                    <li>Terjual (<?=$data['dorayaki']['sold']?>)</li>
                </ul>
                <h2>Rp.<?=$data['dorayaki']['harga']?></h2>
                <!-- <button onclick=''>Beli</button> -->
                <?php if ($data['is-admin']): ?>
                    <a class="btn" href="<?php echo(BASEURL . '/dorayaki/buy/' . $data['dorayaki']['id'])?>">Ubah Stock</a>
                <?php else: ?>
                    <a class="btn" href="<?php echo(BASEURL . '/dorayaki/buy/' . $data['dorayaki']['id'])?>">Beli</a>
                <?php endif; ?>
                <h2>Deskripsi</h2>
                <div class="paragraf">
                <?=$data['dorayaki']['deskripsi']?>
                </div>
                <?php if ($data['is-admin']) :?>
                <form action="<?= BASEURL ?>/dorayaki/delete/" method="post">
                    <input type="hidden" name='id' value="<?=$data['dorayaki']['id']?>">
                    <input class="btn delete" type="submit" name='delete' value="Delete" onclick="return confirm('Yakin?');">
                </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>