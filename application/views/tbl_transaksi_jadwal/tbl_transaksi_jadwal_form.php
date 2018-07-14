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
        <h2 style="margin-top:0px">Tbl_transaksi_jadwal <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">Id Dokter <?php echo form_error('id_dokter') ?></label>
            <input type="text" class="form-control" name="id_dokter" id="id_dokter" placeholder="Id Dokter" value="<?php echo $id_dokter; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Id Jadwal <?php echo form_error('id_jadwal') ?></label>
            <input type="text" class="form-control" name="id_jadwal" id="id_jadwal" placeholder="Id Jadwal" value="<?php echo $id_jadwal; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Keterangan <?php echo form_error('keterangan') ?></label>
            <input type="text" class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan" value="<?php echo $keterangan; ?>" />
        </div>
	    <input type="hidden" name="id_transaksi_jadwal" value="<?php echo $id_transaksi_jadwal; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('tbl_transaksi_jadwal') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>