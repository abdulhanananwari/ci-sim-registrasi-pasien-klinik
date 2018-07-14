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
        <h2 style="margin-top:0px">Tbl_transaksi_jadwal Read</h2>
        <table class="table">
	    <tr><td>Id Dokter</td><td><?php echo $id_dokter; ?></td></tr>
	    <tr><td>Id Jadwal</td><td><?php echo $id_jadwal; ?></td></tr>
	    <tr><td>Keterangan</td><td><?php echo $keterangan; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('tbl_transaksi_jadwal') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>