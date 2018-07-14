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
        <h2 style="margin-top:0px">Tbl_pasien Read</h2>
        <table class="table">
	    <tr><td>Category Pasien Id</td><td><?php echo $category_pasien_id; ?></td></tr>
	    <tr><td>Name</td><td><?php echo $name; ?></td></tr>
	    <tr><td>Number</td><td><?php echo $number; ?></td></tr>
	    <tr><td>Address</td><td><?php echo $address; ?></td></tr>
	    <tr><td>Nik</td><td><?php echo $nik; ?></td></tr>
	    <tr><td>Date</td><td><?php echo $date; ?></td></tr>
	    <tr><td>Note</td><td><?php echo $note; ?></td></tr>
	    <tr><td>Image</td><td><?php echo $image; ?></td></tr>
	    <tr><td>Category Card Id</td><td><?php echo $category_card_id; ?></td></tr>
	    <tr><td>Exp Card</td><td><?php echo $exp_card; ?></td></tr>
	    <tr><td>Active</td><td><?php echo $active; ?></td></tr>
	    <tr><td>Created At</td><td><?php echo $created_at; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('tbl_pasien') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>