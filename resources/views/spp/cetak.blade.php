<html>
    <body>
        <table width='100%' border="0">
            <tr>
                <th colspan="2">Kwintansi Pembayaran</th>
            </tr>
            <tr>
                <td>Telah terima dari</td>
                <td><?= $data->nama ?></td>
            </tr>
            <tr>
                <td>Sejumlah</td>
                <td><?= $data->biaya ?></td>
            </tr>
            <tr>
                <td>Keterangan</td>
                <td>Pembayaran Spp</td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td><?= $data->tanggal ?></td>
            </tr>
        </table>

    </body>
</html>