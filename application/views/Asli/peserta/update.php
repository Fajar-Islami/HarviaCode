<h2>Update Peserta</h2>
<?php echo validation_errors(); ?>
<?php echo form_open('peserta/update/' . $peserta_item['idPeserta']) ?>
<table border="0">
	<tr>
		<td><label for="id"></label></td>
		<td><input type="hidden" name="id" value="<?php echo $peserta_item['idPeserta'] ?>" /><br /></td>
	</tr>
	<tr>
		<td><label for="nama">Nama Peserta</label></td>
		<td><input type="input" name="nama" value="<?php echo $peserta_item['nama'] ?>" /><br /></td>
	</tr>
	<tr>
		<td><label for="alamat">Alamat</label></td>
		<td><input type="input" name="alamat" value="<?php echo $peserta_item['alamat'] ?>" /><br /></td>
	</tr>
	<tr>
		<td><label for="hp">Nomor Hp</label></td>
		<td><input type="input" name="hp" value="<?php echo $peserta_item['hp'] ?>" /><br /></td>
	</tr>
	<tr>
		<td colspan=2 align="right"><input type="submit" name="submit" value="Input" />
	</tr>
	</tr>
</table>
</form>