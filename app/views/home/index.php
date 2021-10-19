<div class="container">
    <h1>Dashboard</h1>
    <?php if (count($data['dorayaki']) >= 0) : ?>
        <div class="page-navigator">
            <?php if (!$data['first']) : ?>
                <a href="<?= BASEURL ?>/<?= $data['page']-1 ?>"><</a>
            <?php endif; ?>
            <p id="page-number"><?= $data['page']+1; ?></p>
            <?php if (!$data['last']) : ?>
                <a href="<?= BASEURL ?>/<?= $data['page']+1 ?>">></a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
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