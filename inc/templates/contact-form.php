<form id="js-ewp-contact-form" class="ewp-contact-form" action="#" method="post" data-url="<?php echo admin_url('admin-ajax.php'); ?>">
	<div class="form-group">
		<input type="text" id="name" name="name" placeholder="Nimi">
		<small class="form-name-control-message form-control-messag" style="display: none;">Täytä Nimi kenttä</small>
	</div>
	<div class="form-group">
		<input type="email" id="email" name="email" placeholder="Sähköposti">
		<small class="form-email-control-message form-control-messag" style="display: none;">Täytä Sähköposti kenttä</small>
	</div>
	<div class="form-group">
		<textarea id="message" name="message" placeholder="Viesti"></textarea>
		<small class="form-message-control-message form-control-message" style="display: none;">Täytä viesti kenttä</small>
	</div>
	<div class="form-group">
		<button type="submit">Lähetä</button>		
	</div>

</form>