<h2>Membuat Form Input Training</h2>
<?php echo validation_errors(); ?>
<?php echo form_open('train/create') ?>
<table border="0" >
<tr>	
	<td><label for="id">ID Training</label></td>
	<td><input type="input" name="id" /><br /></td>
</tr>
<tr>
	<td><label for="nama">Nama Training</label></td>
	<td><input type="input" name="nama" /><br /></td>
</tr>
<tr>
	<td><label for="jenis">Jenis Training</label></td>
	<td><input type="input" name="jenis" /><br /></td>
</tr>
<tr>
	<td><label for="tempat">Tempat</label></td> 
	<td><input type="input" name="tempat" /><br /></td>
</tr>
<tr>
	<td><label for="tglMulai">Tanggal Mulai</label></td>
	<td><input type="input" name="tglMulai" /><br /></td>
</tr>
<tr>
	<td><label for="tglAkhir">Tanggal Akhir</label></td> 
	<td><input type="input" name="tglAkhir" /><br /></td>
</tr>
<tr>
	<td><label for="kapasitas">Kapasitas</label></td> 
	<td><input type="input" name="kapasitas" /><br /></td>
</tr>
<tr>	
	<td  colspan = 2 align="right"><input type="submit" name="submit" value="Input" /></tr>
</tr>
</table>
</form>
