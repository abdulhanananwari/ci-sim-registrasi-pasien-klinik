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
        <h2 style="margin-top:0px">Tbl_pasien List</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('pasien/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('pasien/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('pasien'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Category Pasien Id</th>
		<th>Name</th>
		<th>Number</th>
		<th>Address</th>
		<th>Nik</th>
		<th>Date</th>
		<th>Note</th>
		<th>Image</th>
		<th>Category Card Id</th>
		<th>Exp Card</th>
		<th>Active</th>
		<th>Created At</th>
		<th>Action</th>
            </tr><?php
            foreach ($pasien_data as $pasien)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $pasien->category_pasien_id ?></td>
			<td><?php echo $pasien->name ?></td>
			<td><?php echo $pasien->number ?></td>
			<td><?php echo $pasien->address ?></td>
			<td><?php echo $pasien->nik ?></td>
			<td><?php echo $pasien->date ?></td>
			<td><?php echo $pasien->note ?></td>
			<td><?php echo $pasien->image ?></td>
			<td><?php echo $pasien->category_card_id ?></td>
			<td><?php echo $pasien->exp_card ?></td>
			<td><?php echo $pasien->active ?></td>
			<td><?php echo $pasien->created_at ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('pasien/read/'.$pasien->id),'Read'); 
				echo ' | '; 
				echo anchor(site_url('pasien/update/'.$pasien->id),'Update'); 
				echo ' | '; 
				echo anchor(site_url('pasien/delete/'.$pasien->id),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
				?>
			</td>
		</tr>
                <?php
            }
            ?>
        </table>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
		<?php echo anchor(site_url('pasien/excel'), 'Excel', 'class="btn btn-primary"'); ?>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
    </body>
</html>