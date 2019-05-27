<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Penjualan</title>
</head>
<body>
    <a href="<?php echo site_url()?>">kembali</a><br>

    <br><br>
    Tambah Penjualan Baru
    <form action="<?php echo site_url('C_Motor/add'); ?>" method="post">
    <table>
        <tr>
            <td>id_motor</td>
            <td>
                <select name="motor">
                <option value="" disabled selected >Pilih motor</option>
                    <?php 
                        foreach ($motor as $key) {
                    ?>
                    <option value="<?=$key->id_motor?>"><?=$key->tipe_motor?></option>
                    <?php
                    } 
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>id_cicil</td>
            <td>
                <select name="cicil">
                <option value="" disabled selected >Pilih tenor</option> bulan
                    <?php 
                        foreach ($tenor as $key) {
                    ?>
                    <option value="<?=$key->id_cicil?>"><?=$key->tenor?></option>
                    <?php
                    } 
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>id_uang_muka</td>
            <td>
                <select name="dp">
                <option value="" disabled selected >Pilih Uang Muka</option> bulan
                    <?php 
                        foreach ($dp as $key) {
                    ?>
                    <option value="<?=$key->id_uang_muka?>"><?=$key->uang_muka?></option>
                    <?php
                    } 
                    ?>
                </select>
            </td>
        </tr>
    
    </table>
    <input id="tombol" type="submit" class="btn btn-success" value="Add">
    
    </form>
    <br><br>
    <table>
        <tr>
            <th>tipe_motor</th>
            <th>harga_motor</th>
            <th>tenor</th>
            <th>uang_muka</th>
            <th>cicilan_pokok</th>
            <th>cicilan_bunga</th>
            <th>cicilan_total</th>
        </tr>
        <?php foreach ($jual as $key) { ?>
            <tr>
                <td><?= $key->tipe_motor?></td>
                <td><?= $key->harga_motor?></td>
                <td><?= $key->tenor?></td>
                <td><?= $key->uang_muka?></td>
                <td><?= $key->cicilan_pokok?></td>
                <td><?= $key->cicilan_bunga?></td>
                <td><?= $key->cicilan_total?></td>
            </tr>
        <?php }?>
        
    
    </table>
</body>
</html>