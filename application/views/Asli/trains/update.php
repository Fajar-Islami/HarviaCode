<h2>Update Training</h2>
<?php echo validation_errors(); ?>
<?php echo form_open('train/update/'.$trains_item['idTraining']) ?>
<table border="0" >
<tr>	
	<td><label for="id"></label></td>
	<td><input type="hidden" name="id" value="<?php echo $trains_item['idTraining'] ?>"/><br /></td>
</tr>
<tr>
	<td><label for="nama">Nama Training</label></td>
	<td><input type="input" name="nama" value="<?php echo $trains_item['nama'] ?>"/><br /></td>
</tr>
<tr>
	<td><label for="jenis">Jenis Training</label></td>
	<td>
<?php
$options = array(
                  '1'  => 'Pemrograman',
                  '2'    => 'Pelatihan Office',
                  '3'   => 'Desain Web',
                  '4' => 'Database',
                );
echo form_dropdown('jenis', $options, $trains_item['jenis']);
?>	
	<!input type="input" name="jenis" /><br /></td>
</tr>
<tr>
	<td><label for="tempat">Tempat</label></td> 
	<td><input type="input" name="tempat" value="<?php echo $trains_item['tempat'] ?>"/><br /></td>
</tr>
<tr>
	<td><label for="tglMulai">Tanggal Mulai</label></td>
	<td><input type="input" name="tglMulai" id="datepicker" value="<?php echo $trains_item['tglMulai'] ?>"/><br /></td>
</tr>
<tr>
	<td><label for="tglAkhir">Tanggal Akhir</label></td> 
	<td><input type="input" name="tglAkhir" value="<?php echo $trains_item['tglAkhir'] ?>"/><br /></td>
</tr>
<tr>
	<td><label for="kapasitas">Kapasitas</label></td> 
	<td><input type="input" name="kapasitas" value="<?php echo $trains_item['kapasitas'] ?>"/><br /></td>
</tr>
<tr>	
	<td  colspan = 2 align="right"><input type="submit" name="submit" value="Input" /></tr>
</tr>
</table>
</form>
