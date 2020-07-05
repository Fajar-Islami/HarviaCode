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
        <h2 style="margin-top:0px">Training Read</h2>
        <table class="table">
	    <tr><td>Nama</td><td><?php echo $nama; ?></td></tr>
	    <tr><td>Jenis</td><td><?php echo $jenis; ?></td></tr>
	    <tr><td>Tempat</td><td><?php echo $tempat; ?></td></tr>
	    <tr><td>TglMulai</td><td><?php echo $tglMulai; ?></td></tr>
	    <tr><td>TglAkhir</td><td><?php echo $tglAkhir; ?></td></tr>
	    <tr><td>Kapasitas</td><td><?php echo $kapasitas; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('training') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>