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
        <h2 style="margin-top:0px">Tbl_jadwal <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="date">Tanggal <?php echo form_error('tanggal') ?></label>
            <input type="text" class="form-control" name="tanggal" id="tanggal" placeholder="Tanggal" value="<?php echo $tanggal; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Hari <?php echo form_error('hari') ?></label>
            <input type="text" class="form-control" name="hari" id="hari" placeholder="Hari" value="<?php echo $hari; ?>" />
        </div>
	    <div class="form-group">
            <label for="timestamp">Detal <?php echo form_error('detal') ?></label>
            <input type="text" class="form-control" name="detal" id="detal" placeholder="Detal" value="<?php echo $detal; ?>" />
        </div>
	    <input type="hidden" name="id_jadwal" value="<?php echo $id_jadwal; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('tbl_jadwal') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>