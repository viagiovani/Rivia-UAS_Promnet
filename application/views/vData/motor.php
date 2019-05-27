<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Motor</title>
</head>
<body>
    <a href="<?php echo site_url()?>">kembali</a><br>
    Data Motor:
    <table>
        <tr>
            <th>id_motor</th>
            <th>tipe_motor</th>
            <th>harga_motor</th>
        </tr>
        <?php
            foreach ($motor as $key) {
        ?>
        <tr>
            <td><?= $key->id_motor?></td>
            <td><?= $key->tipe_motor?></td>
            <td><?= $key->harga_motor?></td>
        </tr>
        <?php
        }
        ?>
    </table>
    <br><br>
    Data Lama Cicilan
    <table>
        <tr>
            <th>tenor</th>
            <th>bunga</th>
        </tr>
        <?php
            foreach ($tenor as $key) {
        ?>
        <tr>
            <td><?= $key->tenor?></td>
            <td><?= $key->bunga?></td>
            
        </tr>
        <?php
        }
        ?>
    </table>

    <br><br>
    
    Data Uang Muka

    <table>
        <tr>
            <th>id_uang_muka</th>
            <th>uang_muka</th>
        </tr>
        <?php
            foreach ($dp as $key) {
        ?>
        <tr>
            <td><?= $key->id_uang_muka?></td>
            <td><?= $key->uang_muka?></td>
            
        </tr>
        <?php
        }
        ?>
    </table>


</body>
</html>