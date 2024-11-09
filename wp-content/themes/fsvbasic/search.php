<?php
/**
 * The template for displaying Search Results pages
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

<?php if ( have_posts() ) : ?>

<header class="main-content-header">

<h1 class="main-content-title"><?php printf( __( 'Search Results for : %s', 'fsvbasic' ), get_search_query() ); ?></h1>

</header><!-- .main-content-header -->

<div class="article-group">

<?php while ( have_posts() ) : the_post();

	get_template_part( 'content', get_post_format() );

endwhile; ?>

</div><!-- .article-group -->

<?php else : // have_posts() check

	get_template_part( 'content', 'none' );

endif; // end have_posts() check ?>

<?php fsvbasic_pagination(); ?>

</div><!-- #primary -->

<?php get_sidebar( 'left' ); ?>

</div><!-- #wrapbox -->

<?php get_sidebar( 'right' ); ?>

</div><!-- .component-inner -->

</div><!-- #main -->

<?php get_sidebar( 'footer' ); ?>

<?php get_footer(); ?>
