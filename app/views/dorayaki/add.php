<div class="container">
    <div class="add-container">
        <h1>Tambah Dorayaki</h1>
        <div class="content">
            <form action="<?= BASEURL?>/dorayaki/add" method="post" enctype="multipart/form-data">
                <input class="input-text" type="text" id="nama" name="nama" required placeholder="Nama">
                <textarea class="input-text" name="deskripsi" id="deskripsi" cols="30" rows="7" required placeholder="Deskripsi"></textarea>
                <input class="input-text" type="number" name="harga" id="harga" required placeholder="Harga">
                <input class="input-text" type="number" name="stok" id="stok" required placeholder="Stok">
                <div class="input-gambar">
                    <label for="gambar">Gambar</label>
                    <input type="file" name="gambar" id="gambar" required>
                </div>
                <div class="button-wrapper">
                    <input type="submit" value="Add" name="add">
                </div>
            </form>
        </div>
    </div>
</div>

<?php if (isset($_SESSION['flash'])) : ?>
<?php Flasher::flash();?>
<?php endif; ?>