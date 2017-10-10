<?php

?>

	</div><!-- #content -->

	<?php get_sidebar( 'footer' ); ?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-footer__wrap">

			<?php
			// Varmistetaan että on social menu
			if ( has_nav_menu( 'social' ) ) { ?>
			<nav class="social-menu">
				<?php
					wp_nav_menu( array(
						'theme_location' => 'social',
						'menu_class'     => 'social-links-menu'
						) );
				?>
			</nav><!-- .social-menu -->
			<?php } ?>

			<div class="site-info">
				<div><a href="<?php echo esc_url( __( 'https://wordpress.org/', 'ewp' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'ewp' ), 'WordPress' ); ?></a></div>
				<div><?php printf( esc_html__( 'Theme: %1$s by %2$s', 'ewp' ), 'ewp', 'Ricardo Oksa' ); ?></div>
			</div><!-- .site-info -->
		</div><!-- .site-footer__wrap -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
