<div class="navbar">
    <div class="search-bar">
        <input id="query-input" type="text">
        <input type="hidden" id="query" value='<?= $data['query']?>'>
        <button onclick="getSearch()">Search</button>
    </div>
    <div class="menus">
        <?php if ($data['isAdmin']) : ?>
            <a href="<?= BASEURL?>/dorayaki/add">Tambah</a>
        <?php else : ?>
            <a href="<?= BASEURL?>/user/hitory">Daftar</a>
        <?php endif; ?>
        <a href="<?= BASEURL?>/logout">Logout</a>
        <a href="<?= BASEURL?>/user/<?= $data['username']?>"><?= $data['username']?></a>
    </div>
</div>