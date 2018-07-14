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
        <h2 style="margin-top:0px">Tbl_dokter Read</h2>
        <table class="table">
	    <tr><td>Nama Dokter</td><td><?php echo $nama_dokter; ?></td></tr>
	    <tr><td>Alamat</td><td><?php echo $alamat; ?></td></tr>
	    <tr><td>Jenis Dokter</td><td><?php echo $jenis_dokter; ?></td></tr>
	    <tr><td>No Hp</td><td><?php echo $no_hp; ?></td></tr>
	    <tr><td>Foto</td><td><?php echo $foto; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('tbl_dokter') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>