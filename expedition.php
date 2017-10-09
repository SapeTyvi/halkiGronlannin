<p>Retkikunta</p>

<?php foreach($expeditors as $expeditor) { ?>
	<p>
		<?php echo $expeditor->firstName; ?>
		<a href='?controller=expedition&action=showExpeditors&pId=<?php echo $expeditor->pId; ?>'>Lue lisää</a>
	</p>
<?php } ?>