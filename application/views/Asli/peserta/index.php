<b><a href="peserta/create/">Input Peserta Baru</a></b>
<?php foreach ($peserta as $peserta_item) : ?>
	<h2>
		<?php echo $peserta_item['idPeserta'] ?>
	</h2>
	<a href="<?php echo ('update/' . $peserta_item['idPeserta']); ?>">

		<div id="main"> <?php echo $peserta_item['nama'] ?> </div>

	</a>
	<p>
		<a href="view/<?php echo $peserta_item['idPeserta'] ?>">View
			Detail peserta</a>
	</p>
	<td align='center'>
		<a href="<?php echo ('peserta/delete/' . $peserta_item['idPeserta']); ?>">Delete</a>
	</td>

<?php endforeach ?>
<br>