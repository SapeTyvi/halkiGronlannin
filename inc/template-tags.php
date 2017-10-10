<?php

if ( ! function_exists( 'ewp_posted_on' ) ) :
// Tulostaa postaus pvm ja postaaja html metatiedoilla 

 
function ewp_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		/* translators: %s: post date. */
		esc_html_x( 'Julkaistu %s', 'post date', 'ewp' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		/* translators: %s: post author. */
		esc_html_x( 'Kirjoittanut: %s', 'post author', 'ewp' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="byline"> ' . $byline . '</span> <span class="posted-on">' . $posted_on . '</span>';

		if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo ' <span class="comments-link">';
		comments_popup_link(
			sprintf(
				wp_kses(
					/* translators: %s: post title */
					__( 'Jätä kommentti<span class="screen-reader-text"> on %s</span>', 'ewp' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			)
		);
		echo '</span>';
	}


	edit_post_link(
		sprintf(
			wp_kses(
				/* translators: %s: Name of current post */
				__( 'Muokkaa <span class="screen-reader-text">%s</span>', 'ewp' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		),
		' <span class="edit-link">',
		'</span>'
	);

}
endif;

if ( ! function_exists( 'ewp_entry_footer' ) ) :

function ewp_entry_footer() {
	// Piilottaa tag tekstin sivuja varten
	if ( 'post' === get_post_type() ) {
		
	
		$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'ewp' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( '%1$s', 'ewp' ) . '</span>', $tags_list );
		}
	}

}
endif;
// Näyttää kategoria listan

function ewp_the_category_list () {
	
		$categories_list = get_the_category_list( esc_html__( ', ', 'ewp' ) );
		if ( $categories_list && ewp_categorized_blog() ) {		
			printf( '<span class="cat-links">' . esc_html__( '%1$s', 'ewp' ) . '</span>', $categories_list );
		}
}

 // Palauttaa true jos blogilla on enemmän kuin 1 kategoria
function ewp_categorized_blog() {
	$all_the_cool_cats = get_transient( 'ewp_categories' );
	if ( false === $all_the_cool_cats ) {
		// Luodaan array jossa on julkaisun kategoriat
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,			
			'number'     => 2,
		) );

		// Laskee julkaisun kategoriat
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'ewp_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 || is_preview() ) {
		// Blogilla on enemmän kuin 1 kategoria joten so ewp_categorized_blog palauttaa false
		return true;
	} else {
		// Blogilla on vain 1 kategoria joten so ewp_categorized_blog palauttaa false
		return false;
	}
}

function ewp_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	
	delete_transient( 'ewp_categories' );
}
add_action( 'edit_category', 'ewp_category_transient_flusher' );
add_action( 'save_post',     'ewp_category_transient_flusher' );

// Julkaisujen navigointi edellinen/seuraava
function ewp_post_navigation() {
	the_post_navigation( array(
		'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( '<span class="dashicons dashicons-arrow-right-alt2"></span>', 'ewp' ) . '</span> ' .
			'<span class="screen-reader-text">' . __( 'Seuraava julkaisu:', 'ewp' ) . '</span> ' .
			'<span class="post-title">%title</span>',
		'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( '<span class="dashicons dashicons-arrow-left-alt2"></span>', 'ewp' ) . '</span> ' .
			'<span class="screen-reader-text">' . __( 'Edellinen julkaisu:', 'ewp' ) . '</span> ' .
			'<span class="post-title">%title</span>',
	) );
}

function ewp_excerpt_more ( $more ) {
	return "...";
}

add_filter( 'excerpt_more', 'ewp_excerpt_more' );

function ewp_excerpt_length ( $length) {
	return 55;

}

add_filter( 'excerpt_length', 'ewp_excerpt_length' );