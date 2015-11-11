<?php

add_filter( 'body_class', function( $classes ){

	global $wp_query;

	if (is_singular())
		$classes = bs_post_class($classes);

	if ( is_tax() || is_category() || is_tag() )
		$classes = bs_term_classes( get_queried_object(), $classes );

	return array_unique($classes);

} );

add_filter( 'post_class', 'bs_post_class' );
function bs_post_class( $classes ){

	global $post;

	// Add slug
	$classes[] = $post->post_name;

	// Add all taxonomy terms and their parents
	$taxonomies = get_object_taxonomies($post);
	$terms = wp_get_object_terms($post->ID, $taxonomies);
	foreach ( $terms as $term )
		$classes = bs_term_classes( $term, $classes );

	return array_unique($classes);

}

/*
** Creates "taxonomy-term" classes
**
** $term     object
** $classes  array
*/
function bs_term_classes( $term, $classes ) {

	do {

		// Add the passed term
		$classes[] = sprintf( '%s-%s', $term->taxonomy, $term->slug );

		// Add all ancestor terms, too
		$term = get_term_by( 'id', $term->parent, $term->taxonomy );

	// When we run out of ancestors, quit
	} while( $term );

	return $classes;

}