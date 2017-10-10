<?php

?>
<header class="page-header">
	<h1 class="page-title">
		<?php
		if ( is_404() ) { esc_html_e( 'Page not available', 'ewp' );
		} else if ( is_search() ) {
			/* translators: %s = search query */
			printf( esc_html__( 'Haulla: &ldquo;%s&rdquo; ei löytynyt mitään', 'ewp'), get_search_query() );
		} else {
			esc_html_e( 'Nothing Found', 'ewp' );
		}
		?>
	</h1>
</header><!-- .page-header -->

<section id="primary" class="content-area <?php if ( is_404() ) { echo 'error-404'; } else { echo 'no-results'; } ?> not-found">
	<main id="main" class="site-main" role="main">

		<div class="page-content">
			<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

				<p><?php printf( wp_kses( __( 'Oletko valmis tekemään ensimmäisen julkaisun? <a href="%1$s">Aloita tästä</a>.', 'ewp' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

			<?php elseif ( is_search() ) : ?>

				<p><?php esc_html_e( 'Valitettavasti hakusi ei tuottanut osumia. Kokeile hakemalla uudestaan.', 'ewp' ); ?></p>
				<?php get_search_form(); ?>

			<?php elseif ( is_404() ) : ?>

				<p><?php esc_html_e( 'Näyttää siltä, että olet eksynyt. Löytääksesi mitä etsit, tutustu alla oleviin viimeisimpiin artikkeleihin tai kokeile hakua: ', 'ewp' ); ?></p>
				<?php get_search_form(); ?>

			<?php else : ?>

				<p><?php esc_html_e( 'Näyttää siltä, ettemme löydä mitä etsit. Ehkä haku voi auttaa', 'ewp' ); ?></p>
				<?php get_search_form(); ?>

			<?php endif; ?>
		</div><!-- .page-content -->

		<?php
		if ( is_404() || is_search() ) {
		?>
			<h2 class="page-title secondary-title"><?php esc_html_e( 'Uusimmat julkaisut:', 'ewp' ); ?></h2>
			<?php
			// Nouda 6 viimeisintä julkaisua
			$args = array(
				'posts_per_page' => 6
			);
			$latest_posts_query = new WP_Query( $args );
			// Loop
			if ( $latest_posts_query->have_posts() ) {
					while ( $latest_posts_query->have_posts() ) {
						$latest_posts_query->the_post();
						
						get_template_part( 'template-parts/content', get_post_format() );
					}
			}
			
			wp_reset_postdata();
		} // endif
		?>


	</main><!-- #main -->
</section><!-- #primary -->

<?php
get_sidebar();
get_footer();