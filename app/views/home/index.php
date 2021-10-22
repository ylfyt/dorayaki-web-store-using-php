<div class="container">
    <h1>Dashboard</h1>
    <?php if (count($data['dorayaki']) >= 0) : ?>
        <div class="page-navigator" id="page-navigator">
            <?php if (!$data['first']) : ?>
                <div id="prev" onclick="prev();"><</div>
            <?php endif; ?>
            <p id="page-number"><?= $data['page']+1; ?></p>
            <?php if (!$data['last']) : ?>
                <div id="next" onclick="next();">></div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <div class="dorayaki-container" id="dorayaki-container">
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


<div class="notification red" id="notification">
    <div id="close-button" onclick="closeNotification()">x</div>
    <p id="message">Dorayaki gagal dihapus</p>
</div>
