<?php foreach ($entries as $entry): ?>
	<?php echo date('H:i:s', strtotime($entry['Log']['time'])); ?>
	<strong><?php echo $entry['Log']['username']; ?>:</strong>
	<?php echo $entry['Log']['text']; ?>
	<br />
<?php endforeach; ?>