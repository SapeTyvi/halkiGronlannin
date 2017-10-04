
<p>Tässä kaikki blogipostaukset:</p>

<?php foreach($posts as $post) { ?>
	<p>
		<?php echo $post->$subject; ?>
		<a href='?controller=posts&action=show&id=<?php echo $post->id; ?>'>Katso sisältö</a>
	</p>
<?php } ?>
