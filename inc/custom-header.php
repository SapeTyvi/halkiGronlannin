<?php

function ewp_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'ewp_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => 'ffffff',
		'width'                  => 2000,
		'height'                 => 850,
		'flex-height'            => true,
		'wp-head-callback'       => 'ewp_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'ewp_custom_header_setup' );

