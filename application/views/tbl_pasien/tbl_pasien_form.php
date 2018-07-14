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
        <h2 style="margin-top:0px">Tbl_pasien <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">Category Pasien Id <?php echo form_error('category_pasien_id') ?></label>
            <input type="text" class="form-control" name="category_pasien_id" id="category_pasien_id" placeholder="Category Pasien Id" value="<?php echo $category_pasien_id; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Name <?php echo form_error('name') ?></label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?php echo $name; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Number <?php echo form_error('number') ?></label>
            <input type="text" class="form-control" name="number" id="number" placeholder="Number" value="<?php echo $number; ?>" />
        </div>
	    <div class="form-group">
            <label for="tinytext">Address <?php echo form_error('address') ?></label>
            <input type="text" class="form-control" name="address" id="address" placeholder="Address" value="<?php echo $address; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Nik <?php echo form_error('nik') ?></label>
            <input type="text" class="form-control" name="nik" id="nik" placeholder="Nik" value="<?php echo $nik; ?>" />
        </div>
	    <div class="form-group">
            <label for="timestamp">Date <?php echo form_error('date') ?></label>
            <input type="text" class="form-control" name="date" id="date" placeholder="Date" value="<?php echo $date; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Note <?php echo form_error('note') ?></label>
            <input type="text" class="form-control" name="note" id="note" placeholder="Note" value="<?php echo $note; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Image <?php echo form_error('image') ?></label>
            <input type="text" class="form-control" name="image" id="image" placeholder="Image" value="<?php echo $image; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Category Card Id <?php echo form_error('category_card_id') ?></label>
            <input type="text" class="form-control" name="category_card_id" id="category_card_id" placeholder="Category Card Id" value="<?php echo $category_card_id; ?>" />
        </div>
	    <div class="form-group">
            <label for="date">Exp Card <?php echo form_error('exp_card') ?></label>
            <input type="text" class="form-control" name="exp_card" id="exp_card" placeholder="Exp Card" value="<?php echo $exp_card; ?>" />
        </div>
	    <div class="form-group">
            <label for="enum">Active <?php echo form_error('active') ?></label>
            <input type="text" class="form-control" name="active" id="active" placeholder="Active" value="<?php echo $active; ?>" />
        </div>
	    <div class="form-group">
            <label for="date">Created At <?php echo form_error('created_at') ?></label>
            <input type="text" class="form-control" name="created_at" id="created_at" placeholder="Created At" value="<?php echo $created_at; ?>" />
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('tbl_pasien') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>