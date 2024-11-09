<?php
/**
 * The main template file
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
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

<?php if ( ! is_home() && ! is_front_page() ) { fsvbasic_breadcrumb(); } ?>

<?php if ( have_posts() ) : ?>

<div class="article-group">

<?php while ( have_posts() ) : the_post();

	get_template_part( 'content', get_post_format() );

endwhile; ?>

</div><!-- .article-group -->

<?php else : // if ( have_posts() )

	get_template_part( 'content', 'none' );

endif; // if ( have_posts() ) ?>

<?php fsvbasic_pagination(); ?>

</div><!-- #primary -->

<?php get_sidebar( 'left' ); ?>

</div><!-- #wrapbox -->

<?php get_sidebar( 'right' ); ?>

</div><!-- .component-inner -->

</div><!-- #main -->

<?php get_sidebar( 'footer' ); ?>

<?php get_footer(); ?>
