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
        <h2 style="margin-top:0px">Jenis_berobat <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Jenis Pasien <?php echo form_error('jenis_pasien') ?></label>
            <input type="text" class="form-control" name="jenis_pasien" id="jenis_pasien" placeholder="Jenis Pasien" value="<?php echo $jenis_pasien; ?>" />
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('jenis_berobat') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>