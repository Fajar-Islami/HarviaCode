<h2>Membuat Form Input Peserta</h2>
<?php echo validation_errors(); ?>
<?php echo form_open('Peserta/create') ?>
<table border="0">
	<tr>
		<td><label for="id">ID Peserta</label></td>
		<td><input type="input" name="id" /><br /></td>
	</tr>
	<tr>
		<td><label for="nama">Nama Peserta</label></td>
		<td><input type="input" name="nama" /><br /></td>
	</tr>
	<tr>
		<td><label for="jenis">Alamat</label></td>
		<td><input type="input" name="alamat" /><br /></td>
	</tr>
	<tr>
		<td><label for="jenis">Hp</label></td>
		<td><input type="input" name="hp" /><br /></td>
	</tr>
	<tr>
		<td colspan=2 align="right"><input type="submit" name="submit" value="Input" />
	</tr>
	</tr>
</table>
</form>