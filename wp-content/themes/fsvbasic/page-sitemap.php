<?php
/**
 * Template Name: Sitemap Page Template
 *
 * Description: Template to create a sitemap page.
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

<?php if ( !( is_home() || is_front_page() ) ) { fsvbasic_breadcrumb(); } else { ?><div id="breadcrumb">&nbsp;</div><?php } ?>

<?php while ( have_posts() ) : the_post(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<header class="main-content-header">

<h1 class="main-content-title"><?php the_title(); ?></h1>

<?php if ( is_user_logged_in() ) : ?>
<div class="entry-meta">
<?php edit_post_link( __( 'Edit', 'fsvbasic') , '<p>', '</p>' ); ?>
</div><!-- .entry-meta -->
<?php endif; ?>

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

</article><!-- #post -->

<?php endwhile; // end of the loop. ?>

<article id="post-sitemap" <?php post_class( 'post-sitemap-list' ); ?>>

<h3 class="widget-title"><?php _e( 'Category List', 'fsvbasic' ); ?></h3>

<ul class="archive-list">
<?php wp_list_categories('exclude=&title_li='); ?>
</ul>

<h3 class="widget-title"><?php _e( 'Page List', 'fsvbasic' ); ?></h3>

<ul class="archive-list">
<?php wp_list_pages('exclude=&title_li='); ?>
</ul>

</article><!-- #post-sitemap -->

<?php comments_template( '', true ); ?>

</div><!-- #primary -->

<?php get_sidebar( 'left' ); ?>

</div><!-- #wrapbox -->

<?php get_sidebar( 'right' ); ?>

</div><!-- .component-inner -->

</div><!-- #main -->

<?php get_sidebar( 'footer' ); ?>

<?php get_footer(); ?>
