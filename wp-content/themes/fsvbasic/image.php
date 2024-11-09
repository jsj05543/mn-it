<?php
/**
 * The template for displaying image attachments
 *
 * @package WordPress
 * @subpackage FSVBASIC
 * @since FSVBASIC 1.0
 */
?>

<?php get_header(); ?>

<div id="main" class="main-content-area">

<div class="component-inner">

<div id="wrapbox" class="main-content-wrap">

<div id="primary" class="main-content-site" role="main">

<?php fsvbasic_breadcrumb() ;

while ( have_posts() ) : the_post(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'image-attachment' ); ?>>

<header class="main-content-header">

<h1 class="main-content-title"><?php the_title(); ?></h1>

<div class="entry-meta"><?php

	$metadata = wp_get_attachment_metadata();

	printf( __( '<span class="meta-prep meta-prep-entry-date">Published </span> <span class="entry-date"><time class="entry-date" datetime="%1$s">%2$s</time></span> at <a href="%3$s" title="Link to full-size image">%4$s &times; %5$s</a> in <a href="%6$s" title="Return to %7$s">%8$s</a>.', 'fsvbasic' ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( wp_get_attachment_url() ),
		$metadata['width'],
		$metadata['height'],
		esc_url( get_permalink( $post->post_parent ) ),
		esc_attr( strip_tags( get_the_title( $post->post_parent ) ) ),
		get_the_title( $post->post_parent )
	);

	edit_post_link( __( 'Edit', 'fsvbasic') , '<p>', '</p>' ); ?>

</div><!-- .entry-meta -->

</header><!-- .main-content-header -->

<div class="entry-content">

<div class="attachment">

<?php
	/**
	* Filter the image attachment size to use.
	*
	* @param array $size {
	*     @type int The attachment height in pixels.
	*     @type int The attachment width in pixels.
	* }
	*/
	$attachment_size = apply_filters( 'fsvbasic_attachment_size', array( 1200, 1200 ) );
	echo wp_get_attachment_image( $post->ID, $attachment_size );

?>

</div><!-- .attachment -->

<?php

	if ( ! empty( $post->post_excerpt ) ) { the_excerpt(); }

	the_content();

	wp_link_pages( array( 'before' => '<div class="page-links">', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) );

?>

</div><!-- .entry-content -->

<div class="clear"></div>

</article><!-- #post -->

<?php endwhile; // end of the loop.

comments_template(); ?>

</div><!-- #primary -->

<?php get_sidebar( 'left' ); ?>

</div><!-- #wrapbox -->

<?php get_sidebar( 'right' ); ?>

</div><!-- .component-inner -->

</div><!-- #main -->

<?php get_sidebar( 'footer' ); ?>

<?php get_footer(); ?>
