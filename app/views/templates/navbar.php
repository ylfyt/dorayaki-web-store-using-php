<div class="navbar">
    <div class="content">
        <a href="<?= BASEURL?>" class="logo"><img src="<?= BASEURL?>/public/img/tempe.jpg" alt=""></a>
        <?php if (isset($data['dashboard'])): ?>
            <div class="search-bar">
                <input id="query-input" type="text">
                <input type="hidden" id="query" value='<?= $data['query']?>'>
                <button onclick="getSearch()">Search</button>
            </div>
        <?php endif; ?>
    </div>
    
    <div class="menus">
        <?php if ($data['is-admin']) : ?>
            <a href="<?= BASEURL?>/dorayaki/add">Tambah</a>
        <?php else : ?>
            <a href="<?= BASEURL?>/user/hitory">Daftar</a>
        <?php endif; ?>
        <a href="<?= BASEURL?>/user/signout">Logout</a>
        <a href="<?= BASEURL?>/user/<?= $data['username']?>"><?= $data['username']?></a>
    </div>
</div>