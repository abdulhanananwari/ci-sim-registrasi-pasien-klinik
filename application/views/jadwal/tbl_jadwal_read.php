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
        <h2 style="margin-top:0px">Tbl_jadwal Read</h2>
        <table class="table">
	    <tr><td>Tanggal</td><td><?php echo $tanggal; ?></td></tr>
	    <tr><td>Hari</td><td><?php echo $hari; ?></td></tr>
	    <tr><td>Detal</td><td><?php echo $detal; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('jadwal') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>