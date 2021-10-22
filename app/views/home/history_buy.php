<div class="container">
    <h2>Riwayat</h2>

    <?php if (count($data['history']) > 0) : ?>

        <table>
            <tr>
                <th>Nama</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
                <th>Waktu</th>
            </tr>

            <?php foreach($data['history'] as $log): ?>
                <tr>
                    <td><?= $log['nama']?></td>
                    <td><?= $log['num']?></td>
                    <td><?= $log['total']?></td>
                    <td><?= $log['timestamp']?></td>
                </tr>
            <?php endforeach; ?>

        </table>
    <?php else: ?>
        <p>Riwayat kosong</p>
    <?php endif; ?>

    
</div>