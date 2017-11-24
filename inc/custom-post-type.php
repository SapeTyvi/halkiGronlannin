<?php 


$contact = get_option( 'activate_contact' );
if( @$contact == 1 ){

    add_action( 'init', 'ewp_contact_custom_post_type' );
    
    add_filter( 'manage_ewp-contact_posts_columns', 'ewp_set_contact_columns' );
    add_action( 'manage_ewp-contact_posts_custom_column', 'ewp_contact_custom_column', 10, 2 );

    add_action( 'add_meta_boxes', 'ewp_contact_add_meta_box' );
    add_action( 'save_post', 'ewp_save_contact_email_data' );

}


// Viestit osio

function ewp_contact_custom_post_type() {
    $labels = array ( 
        'name'              => 'Viestit',
        'singular_name'     => 'Viesti',
        'menu_name'         => 'Viestit',
        'name_admin_bar'    => 'Viesti',
        'not_found'         => 'Ei viestejä'

     );

     $args = array(
         'labels'           => $labels,
         'show_ui'          => true,
         'show_in_menu'     => true,
         'capability_type'  => 'post',
         'hierarchical'     => false,
         'menu_postition'   => 26, 
         'menu_icon'        => 'dashicons-email-alt',
         'supports'         => array( 'title', 'editor', 'author' )
    );

    register_post_type( 'ewp-contact', $args );

}

function ewp_set_contact_columns( $columns ) {
    $newColumns = array();
    $newColumns['title'] = 'Nimi';
    $newColumns['message'] = 'Viesti';
    $newColumns['email'] = 'Sähköposti';
    $newColumns['date'] = 'Päivämäärä';

    return $newColumns;

}

function ewp_contact_custom_column( $column, $post_id ) {

    switch( $column ) {

        case 'message' :
            echo get_the_excerpt();
            break;

        case 'email' :

        $email = get_post_meta( $post_id, '_contact_email_value_key', true );
            echo '<a href="mailto:'.$email.'">'.$email.'</a>';
            break;


    }
}

// Meta laatikot

function ewp_contact_add_meta_box() {
    add_meta_box( 'contact_email', 'Sähköposti', 'ewp_contact_email_callback', 'ewp-contact', 'side');
}

function ewp_contact_email_callback( $post ) {
    wp_nonce_field( 'ewp_save_contact_email_data', 'ewp_contact_email_meta_box_nonce' );

    $value = get_post_meta( $post->ID, '_contact_email_value_key', true );

    echo '<label for="ewp_contact_email_field"> Sähköposti osoite: </label>';
    echo '<input type="email" id="ewp_contact_email_field" name="ewp_contact_email_field" value="'. esc_attr( $value ) .'" size="25" />';
}

// Sähköposti laatikon tarkistus
function ewp_save_contact_email_data( $post_id ) {

    if( ! isset( $_POST['ewp_contact_email_meta_box_nonce'] ) ) {
        return;
    }

    if( ! wp_verify_nonce( $_POST['ewp_contact_email_meta_box_nonce'], 'ewp_save_contact_email_data' ) ) {
        return;
    }

    if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
        return;
    }

    if( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    if( ! isset( $_POST['ewp_contact_email_field'] ) ) {
        return;
    }

    $my_data = sanitize_text_field( $_POST['ewp_contact_email_field'] );

    update_post_meta( $post_id, '_contact_email_value_key', $my_data );

}

