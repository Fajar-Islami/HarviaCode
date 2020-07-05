<b><a href="train/create/">Input Training Baru</a></b>
<?php foreach ($trains as $trains_item) : ?>
	<h2>
		<?php echo $trains_item['idTraining'] ?>
	</h2>
	<a href="<?php echo ('train/update/' . $trains_item['idTraining']); ?>">

		<div id="main"> <?php echo $trains_item['nama'] ?> </div>

	</a>
	<p>
		<a href="train/view/<?php echo $trains_item['idTraining'] ?>">View
			Detail Training</a>
	</p>
	<td align='center'>
		<a href="<?php echo ('train/delete/' . $trains_item['idTraining']); ?>">Delete</a>
	</td>

<?php endforeach ?>
<br>