<h1>Yhteystietolomake</h1>
<?php settings_errors(); ?>

<p>Käytä tätä <strong>lyhennettä</strong> jotta saat käyttöön Yhteydenottolomakkeen sivulla tai julkaisussa</p>
<p><code>[contact_form]</code></p>

<form method="post" action="options.php" class="ewp-general-form" >
    <?php settings_fields( 'ewp-contact-options' ); ?>
    <?php do_settings_sections( 'ewp_theme_contact' ); ?>
    <?php submit_button(); ?>
</form>

