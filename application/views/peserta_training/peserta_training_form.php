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
        <h2 style="margin-top:0px">Peserta_training <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">IdPeserta <?php echo form_error('idPeserta') ?></label>
            <input type="text" class="form-control" name="idPeserta" id="idPeserta" placeholder="IdPeserta" value="<?php echo $idPeserta; ?>" />
        </div>
	    <div class="form-group">
            <label for="char">StatusPembayaran <?php echo form_error('statusPembayaran') ?></label>
            <input type="text" class="form-control" name="statusPembayaran" id="statusPembayaran" placeholder="StatusPembayaran" value="<?php echo $statusPembayaran; ?>" />
        </div>
	    <input type="hidden" name="idTraining" value="<?php echo $idTraining; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('peserta_training') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>