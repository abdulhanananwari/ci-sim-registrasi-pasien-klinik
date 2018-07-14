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
        <h2 style="margin-top:0px">V_jadwal <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">Id Transaksi Jadwal <?php echo form_error('id_transaksi_jadwal') ?></label>
            <input type="text" class="form-control" name="id_transaksi_jadwal" id="id_transaksi_jadwal" placeholder="Id Transaksi Jadwal" value="<?php echo $id_transaksi_jadwal; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Nama Dokter <?php echo form_error('nama_dokter') ?></label>
            <input type="text" class="form-control" name="nama_dokter" id="nama_dokter" placeholder="Nama Dokter" value="<?php echo $nama_dokter; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Jenis Dokter <?php echo form_error('jenis_dokter') ?></label>
            <input type="text" class="form-control" name="jenis_dokter" id="jenis_dokter" placeholder="Jenis Dokter" value="<?php echo $jenis_dokter; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Keterangan <?php echo form_error('keterangan') ?></label>
            <input type="text" class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan" value="<?php echo $keterangan; ?>" />
        </div>
	    <div class="form-group">
            <label for="foto">Foto <?php echo form_error('foto') ?></label>
            <textarea class="form-control" rows="3" name="foto" id="foto" placeholder="Foto"><?php echo $foto; ?></textarea>
        </div>
	    <div class="form-group">
            <label for="varchar">Hari <?php echo form_error('hari') ?></label>
            <input type="text" class="form-control" name="hari" id="hari" placeholder="Hari" value="<?php echo $hari; ?>" />
        </div>
	    <input type="hidden" name="" value="<?php echo $; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('v_jadwal') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>