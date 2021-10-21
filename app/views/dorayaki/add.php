<div class="container">
    <h1>Tambah Dorayaki</h1>
    <div class="content">
        <form action="<?= BASEURL?>/dorayaki/add" method="post" enctype="multipart/form-data">
            <label for="nama">Nama</label><br>
            <input type="text" id="nama" name="nama" required><br>
            <label for="deskripsi">Deskripsi</label><br>
            <textarea name="deskripsi" id="deskripsi" cols="30" rows="10" required></textarea><br>
            <label for="harga">Harga</label><br>
            <input type="number" name="harga" id="harga" required><br>
            <label for="stok">Stok</label><br>
            <input type="number" name="stok" id="stok" required><br>
            <label for="gambar">Gambar</label><br>
            <input type="file" name="gambar" id="gambar" required><br>
            <input type="submit" value="Add" name="add">
        </form>
    </div>
</div>