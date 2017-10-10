<?php 

// Widget class

class ewp_custom_widget extends WP_Widget {

	// Asetetaan widgetin ja kuvaus nimi
	public function __construct() {

		$widget_ops = array(
			'classname'		=> 'ewp-custom-widget',
			'description'	=> 'Custom ewp Profile Widget',

		);
		parent::__construct( 'ewp_profile', 'ewp Profiili', $widget_ops );
	}

	// Widgetin back-end
	public function form( $instance ) {
		echo '<p><strong>Tälle vimpaimelle ei ole asetuksia!</strong></br>Voit muokata asetuksia <a href="http://www.cc.puv.fi/~e1501122/wordpress/wp-admin/admin.php?page=admin_options">Tältä Sivulta</a></p>';
	}

	// Widgetin fornt-end
	public function widget( $args, $instance ) {

		$profilePicture = esc_attr( get_option( 'profile_picture' ) );
	    $firstName = esc_attr( get_option( 'first_name' ) );
	    $lastName = esc_attr( get_option( 'last_name' ) );
	    $fullName = $firstName .' '. $lastName;
	    $description = esc_attr( get_option( 'user_description' ) );

	    $twitter_icon = esc_attr( get_option( 'twitter_handler' ) );
	    $facebook_icon = esc_attr( get_option( 'facebook_handler' ) );
	    $github_icon = esc_attr( get_option( 'github_handler' ) );
	    $instagram_icon = esc_attr( get_option( 'instagram_handler' ) );

		echo $args['before_widget']; ?>
		
		<div class="image-container">
        <div id="profile-picture-preview" class="profile-picture" style="background-image: url(<?php print $profilePicture; ?>);"></div><!-- .profile-picture -->
        </div><!-- .image-container -->
        <h1 class="ewp-username"><?php print $fullName; ?></h1>        
		<div class="icons-wrapper">
                <?php if( !empty( $twitter_icon ) ): ?>
                    <a href="<?php print $twitter_icon; ?>" target="_blank"><span class="ewp-icon-sidebar" style="color: #fff;"><i class="fa fa-twitter" aria-hidden="true"></i></span></a>
                <?php endif; 
                if( !empty( $facebook_icon ) ): ?>
                    <a href="https://www.facebook.com/<?php print $facebook_icon; ?>" target="_blank"><span class="ewp-icon-sidebar" style="color: #fff;"><i class="fa fa-facebook" aria-hidden="true"></i></span></a>               
                <?php endif; 
                 if( !empty( $instagram_icon ) ): ?>
                    <a href="https://www.instagram.com/<?php print $instagram_icon; ?>" target="_blank"><span class="ewp-icon-sidebar" style="color: #fff;"><i class="fa fa-instagram fa-lg" aria-hidden="true"></i></span></a>
                <?php endif;
                 if( !empty( $github_icon ) ): ?>
                    <a href="https://github.com/<?php print $github_icon; ?>" target="_blank"><span class="ewp-icon-sidebar" style="color: #fff;"><i class="fa fa-github" aria-hidden="true"></i>
</span></a>
                <?php endif; ?>
        </div><!-- .icons-wrapper -->
		<h2 class="ewp-description"><?php print $description; ?></h2>
      
	  <?php	echo $args['after_widget'];
	}


}

// Rekisteröidään ja lisätään widget
add_action( 'widgets_init', function() {
	register_widget( 'ewp_custom_widget' );
} );


 ?>