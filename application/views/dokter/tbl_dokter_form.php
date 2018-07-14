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
        <h2 style="margin-top:0px">Tbl_dokter <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Nama Dokter <?php echo form_error('nama_dokter') ?></label>
            <input type="text" class="form-control" name="nama_dokter" id="nama_dokter" placeholder="Nama Dokter" value="<?php echo $nama_dokter; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Alamat <?php echo form_error('alamat') ?></label>
            <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat" value="<?php echo $alamat; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Jenis Dokter <?php echo form_error('jenis_dokter') ?></label>
            <input type="text" class="form-control" name="jenis_dokter" id="jenis_dokter" placeholder="Jenis Dokter" value="<?php echo $jenis_dokter; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">No Hp <?php echo form_error('no_hp') ?></label>
            <input type="text" class="form-control" name="no_hp" id="no_hp" placeholder="No Hp" value="<?php echo $no_hp; ?>" />
        </div>
	    <div class="form-group">
            <label for="foto">Foto <?php echo form_error('foto') ?></label>
            <textarea class="form-control" rows="3" name="foto" id="foto" placeholder="Foto"><?php echo $foto; ?></textarea>
        </div>
	    <input type="hidden" name="id_dokter" value="<?php echo $id_dokter; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('dokter') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>