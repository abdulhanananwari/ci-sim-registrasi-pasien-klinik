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
        <h2 style="margin-top:0px">V_jadwal List</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('v_jadwal/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('v_jadwal/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('v_jadwal'); ?>" class="btn btn-default">Reset</a>
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
		<th>Id Transaksi Jadwal</th>
		<th>Nama Dokter</th>
		<th>Jenis Dokter</th>
		<th>Keterangan</th>
		<th>Foto</th>
		<th>Hari</th>
		<th>Action</th>
            </tr><?php
            foreach ($v_jadwal_data as $v_jadwal)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $v_jadwal->id_transaksi_jadwal ?></td>
			<td><?php echo $v_jadwal->nama_dokter ?></td>
			<td><?php echo $v_jadwal->jenis_dokter ?></td>
			<td><?php echo $v_jadwal->keterangan ?></td>
			<td><?php echo $v_jadwal->foto ?></td>
			<td><?php echo $v_jadwal->hari ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('v_jadwal/read/'.$v_jadwal->),'Read'); 
				echo ' | '; 
				echo anchor(site_url('v_jadwal/update/'.$v_jadwal->),'Update'); 
				echo ' | '; 
				echo anchor(site_url('v_jadwal/delete/'.$v_jadwal->),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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
		<?php echo anchor(site_url('v_jadwal/excel'), 'Excel', 'class="btn btn-primary"'); ?>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
    </body>
</html>