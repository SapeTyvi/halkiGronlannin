<?php 

// Ajax toiminnot

add_action( 'wp_ajax_nopriv_heartbeat_ewp_save_user_contact_form','ewp_save_user_contact_form' );
add_action ( 'wp_ajax_ewp_save_user_contact_form', 'ewp_save_user_contact_form' );

function ewp_save_user_contact_form(){

	$title = wp_strip_all_tags($_POST['name']);
	$email = wp_strip_all_tags($_POST['email']);
	$message = wp_strip_all_tags($_POST['message']);

	$args = array(
		'post_title'	=> $title,
		'post_author'	=> 1,
		'post_status'	=> 'publish',
		'post_content'	=> $message,
		'post_type'		=> 'ewp-contact',
		'meta_input'	=> array(
			'_contact_email_value_key'	=> $email
			)
	);
	
	$postID = wp_insert_post( $args, $wp_error );

	echo $postID;

	die();

}