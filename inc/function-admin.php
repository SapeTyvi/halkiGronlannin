<?php

function ewp_add_admin_page() {

    // Luodaan teeman admin sivu
    add_menu_page( 'Theme Options', 'ewp', 'manage_options', 'admin_options', 'ewp_theme_create_page', 'dashicons-money', 110 );

    // luodaan teeman admin ala-sivu
    //add_submenu_page( parent_slug, page_title, menu_title, capability, menu_slug, function )  
    
    add_submenu_page( 'admin_options', 'Yhteystietolomake', 'Yhteydenottolomake', 'manage_options', 'ewp_theme_contact', 'ewp_contact_form_page' );

    // Aktivoidaan mukautetut asetukset
    add_action( 'admin_init', 'ewp_custom_setttings' );
}

add_action( 'admin_menu', 'ewp_add_admin_page' );

function ewp_custom_setttings() {

    //Yhteystietolomakkeen asetukset
    register_setting( 'ewp-contact-options', 'activate_contact' );

    add_settings_section( 'ewp-contact-section', 'Yhteystietolomake', 'ewp_contact_section', 'ewp_theme_contact' );

    add_settings_field( 'activate-form', 'Aktivoi yhteystietolomake', 'ewp_activate_contact', 'ewp_theme_contact', 'ewp-contact-section' );
    
    
    
}

function ewp_contact_section() {
    echo 'Activate and deactivate the built-in contact form';
}

function ewp_activate_contact() {
    $options = get_option( 'activate_contact' );
    $checked = ( @$options == 1 ? 'checked' : '' );
    echo '<label><input type="checkbox" id="" name="activate_contact" value="1" '. $checked .'/> </label>';
}

function ewp_theme_create_page() {
    // Admin sivun luominen
    require_once( get_template_directory() . '/inc/templates/admin-page.php');
}

function ewp_theme_settings_page() {
    // Admin ala-sivun luominen

}

function ewp_contact_form_page(){
    require_once( get_template_directory() . '/inc/templates/ewp-contact-form.php');
}


/* Admin enqueue functions*/

function ewp_load_admin_scripts( $hook ) {

    if( 'toplevel_page_admin_options' != $hook ) {
        return;
    }

    wp_register_style( 'ewp_admin', get_template_directory_uri() . '/inc/admin-styles.css' , false, '1.0.0' );
    wp_enqueue_style( 'ewp_admin' );

    // Enqueue Font Awesome
    wp_register_style( 'font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', false, '1.0.0' );
    wp_enqueue_style( 'font-awesome' );

    wp_enqueue_media();

    wp_register_script( 'ewp-admin-script', get_template_directory_uri() . '/js/ewp.admin.js', array('jquery-core'), false, true );
    wp_enqueue_script( 'ewp-admin-script' );

}

add_action( 'admin_enqueue_scripts', 'ewp_load_admin_scripts' );



?>

