<?php


get_header(); ?>

<?php if ( have_posts() ) : ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php

			if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>

			<?php
			endif;

			// Aloitetaan looppi
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', get_post_format() );

			endwhile;

		the_posts_pagination( array(
				'prev_text' => __( '<span class="dashicons dashicons-arrow-left-alt2"></span>', 'ewp' ),
				'next_text' => __( '<span class="dashicons dashicons-arrow-right-alt2"></span>', 'ewp' ),
				'before_page_number' => '<span class="screen-reader-text">' . __( 'Page ', 'ewp' ) . '</span>',
		));

		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php

get_sidebar();
get_footer();



else :

	get_template_part( 'template-parts/content', 'none' );
	return;

endif;