
    <script src="<?= BASEURL?>/public/js/script.js"></script>
    <script src="<?= BASEURL?>/public/js/ubahdora.js"></script>
    <?php if (isset($_SESSION['flash'])) : ?>
        <?php Flasher::flash();?>
    <?php endif; ?>
</body>
</html>