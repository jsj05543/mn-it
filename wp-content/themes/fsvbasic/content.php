<?php
/**
 * The default template for displaying content
 *
 * @package WordPress
 * @subpackage FSVBASIC
 * @since FSVBASIC 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'archive-post' ); ?>>
<?php

if ( ! is_attachment() ) :

	if ( has_post_thumbnail() ) :

?>

<div class="entry-image">

<a href="<?php the_permalink(); ?>" rel="bookmark"><?php

		$thumbnail_id = get_post_thumbnail_id($post->ID);
		fsvbasic_resize_attachment( $thumbnail_id );

?></a>

</div><!-- .entry-image -->
<?php

	endif; // if ( has_post_thumbnail() )

endif; // if ( ! is_attachment() )

?>

<div class="entry-summary">

<h2 class="excerpt-title"><?php echo get_the_date(); ?>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

</div><!-- .entry-summary -->

</article><!-- #post -->
