
<p>Tässä kaikki blogipostaukset:</p>

<?php foreach($posts as $post) { ?>
	<p>
		<?php echo $post->subject; ?>
		<a href='?controller=posts&action=showPosts&blogId=<?php echo $post->blogId; ?>'>Katso sisältö</a>
	</p>
<?php } ?>
