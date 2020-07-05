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
        <h2 style="margin-top:0px">Training <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Nama <?php echo form_error('nama') ?></label>
            <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" />
        </div>
	    <div class="form-group">
            <label for="char">Jenis <?php echo form_error('jenis') ?></label>
            <input type="text" class="form-control" name="jenis" id="jenis" placeholder="Jenis" value="<?php echo $jenis; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Tempat <?php echo form_error('tempat') ?></label>
            <input type="text" class="form-control" name="tempat" id="tempat" placeholder="Tempat" value="<?php echo $tempat; ?>" />
        </div>
	    <div class="form-group">
            <label for="date">TglMulai <?php echo form_error('tglMulai') ?></label>
            <input type="text" class="form-control" name="tglMulai" id="tglMulai" placeholder="TglMulai" value="<?php echo $tglMulai; ?>" />
        </div>
	    <div class="form-group">
            <label for="date">TglAkhir <?php echo form_error('tglAkhir') ?></label>
            <input type="text" class="form-control" name="tglAkhir" id="tglAkhir" placeholder="TglAkhir" value="<?php echo $tglAkhir; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Kapasitas <?php echo form_error('kapasitas') ?></label>
            <input type="text" class="form-control" name="kapasitas" id="kapasitas" placeholder="Kapasitas" value="<?php echo $kapasitas; ?>" />
        </div>
	    <input type="hidden" name="idTraining" value="<?php echo $idTraining; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('training') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>