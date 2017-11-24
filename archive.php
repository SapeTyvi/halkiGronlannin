<?php


get_header(); ?>

<?php
if ( have_posts() ) : ?>

	<header class="page-header">
		<?php
			the_archive_title( '<h1 class="page-title">', '</h1>' );
			the_archive_description( '<div class="archive-description">', '</div>' );
		?>
	</header><!-- .page-header -->

<?php
else :

	get_template_part( 'template-parts/content', 'none' );
	return;

endif; ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
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
