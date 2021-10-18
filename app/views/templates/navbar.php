<div class="navbar">
    <div class="search-bar">
        <form action="">
            <input id="query" type="text">
            <button>Search</button>
        </form>
    </div>
    <div class="menus">
        <?php if ($data['isAdmin']) : ?>
            <a href="#add">Tambah</a>
        <?php else : ?>
            <a href="#history">Daftar</a>
        <?php endif; ?>
        <a href="#logout">Logout</a>
        <a href="#profile"><?= $data['username']?></a>
    </div>
</div>