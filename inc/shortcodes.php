<?php

/*Yhteydenottolomakkeen shortcode*/

function ewp_contact_form( $atts, $content = null ) {

	//Noutaa attribuutit
	$atts = shortcode_atts( 
		array(),
		$atts,
		'contact_form'
   
	);

	// palauttaa html
	ob_start();
	include 'templates/contact-form.php';
	
	return ob_get_clean();
}

add_shortcode( 'contact_form', 'ewp_contact_form' );

?>