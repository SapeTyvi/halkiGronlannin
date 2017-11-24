<?php

if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php
	
	if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf( 
					esc_html( _nx( 'Yksi kommentti', '%1$s kommenttia', get_comments_number(), 'comments title', 'ewp' ) ),
					number_format_i18n( get_comments_number() ),
					'<span>' . get_the_title() . '</span>'
				);
			?>
		</h2><!-- .comments-title -->
		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'      => 'ol',
					'short_ping' => true,
					'avatar_size' => '96',
				) );
			?>
		</ol><!-- .comment-list -->

		<?php 
			// Kommenttien vigointi
			if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Tarkistetaan onko kommentteja mitä selata

			?>
		<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'ewp' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'ewp' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'ewp' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-below -->
		<?php
		endif; // Tarkistaa onko navigointia

	endif; // Tarkistaa have_comments().


	// Jos kommentit ei ole näkyvissä
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

		<p class="no-comments"><?php esc_html_e( 'Kommentointi on suljettu.', 'ewp' ); ?></p>
	<?php
	endif;

	comment_form();
	?>

</div><!-- #comments -->
