<?php
/**
 * The Template for displaying all single posts
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

<?php fsvbasic_breadcrumb() ; ?>

<?php while ( have_posts() ) : the_post(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'individual-post' ); ?>>

<header class="main-content-header">

<h1 class="main-content-title"><?php the_title(); ?></h1>

<div class="entry-meta">

<?php fsvbasic_entry_meta(); ?>

<?php if ( is_user_logged_in() ) : ?><?php edit_post_link( __( 'Edit', 'fsvbasic' ), '<p class="post-edit-link-base">', '</p>' ); ?></p><?php endif; ?>

</div><!-- .entry-meta -->

</header><!-- .main-content-header -->

<div class="entry-content">

<?php if ( has_post_thumbnail() ) : ?>

<div class="attachment"><?php

	$thumbnail_id = get_post_thumbnail_id($post->ID);
	fsvbasic_resize_attachment( $thumbnail_id );

?></div><!-- .attachment -->

<?php

endif; // if ( has_post_thumbnail() )

the_content();

wp_link_pages( array( 'before' => '<div class="page-links">', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) );

?></div><!-- .entry-content -->

<div class="clear"></div>

<nav class="nav-single">

<!-- <div class="nav-previous"><?php

if ( get_adjacent_post( false , '' , true ) ) :

	previous_post_link( '%link' , __( 'Previous Post', 'fsvbasic' ) );

else: // if ( get_adjacent_post( false , '' , true ) )

	echo '<a name="no-pager-links" class="no-pager-links">&nbsp;</a>';

endif; // if ( get_adjacent_post( false , '' , true ) )

 ?></div>.nav-previous

<div class="nav-next"><?php

if ( get_adjacent_post( false , '' , false ) ) :

	next_post_link( '%link' , __( 'Next Post', 'fsvbasic' ) );

else: // if ( get_adjacent_post( false , '' , false ) )

	echo '<a name="no-pager-links" class="no-pager-links">&nbsp;</a>';

endif; // if ( get_adjacent_post( false , '' , false ) )

 ?></div><!-- .nav-next --> 

</nav><!-- .nav-single -->

</article><!-- #post -->

<?php endwhile; // end of the loop. ?>

<?php comments_template( '', true ); ?>

</div><!-- #primary -->

<?php get_sidebar( 'left' ); ?>

</div><!-- #wrapbox -->

<?php get_sidebar( 'right' ); ?>

</div><!-- .component-inner -->

</div><!-- #main -->

<?php get_sidebar( 'footer' ); ?>

<?php get_footer(); ?>
