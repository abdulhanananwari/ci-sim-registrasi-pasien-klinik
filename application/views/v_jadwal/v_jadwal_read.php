<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">V_jadwal Read</h2>
        <table class="table">
	    <tr><td>Id Transaksi Jadwal</td><td><?php echo $id_transaksi_jadwal; ?></td></tr>
	    <tr><td>Nama Dokter</td><td><?php echo $nama_dokter; ?></td></tr>
	    <tr><td>Jenis Dokter</td><td><?php echo $jenis_dokter; ?></td></tr>
	    <tr><td>Keterangan</td><td><?php echo $keterangan; ?></td></tr>
	    <tr><td>Foto</td><td><?php echo $foto; ?></td></tr>
	    <tr><td>Hari</td><td><?php echo $hari; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('v_jadwal') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>