<div class="container">
    <h1>Dashboard</h1>
    <div class="dorayaki-container">
        <?php if (count($data['dorayaki']) > 0) : ?>
            <?php foreach($data['dorayaki'] as $dora) : ?>
                <a href="<?= BASEURL?>/dorayaki/<?= $dora['id']?>">
                    <div class="card">
                        <img src="<?= $dora['url']?>" alt="">
                        <div class="info">
                            <div class="name"><?= $dora['nama']?></div>
                            <div class="price">Rp. <?= $dora['harga']?></div>
                            <div class="desc"><?= $dora['deskripsi']?></div>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Dorayaki Kosong</p>
        <?php endif; ?>
    </div>
</div>