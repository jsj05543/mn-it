<?php
/**
 * Top Page template file
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage FSVBASIC
 * @since FSVBASIC 1.1
 */
?>

<?php get_header(); ?>

<div id="main" class="main-content-area">

<div class="component-inner">

<div id="wrapbox" class="main-content-wrap">

<div id="primary" class="main-content-site" role="main"><?php

$options = fsvbasic_get_theme_options();

if ( !isset( $options[ 'welcome_title' ] ) ) { $opWelcomeTitle = 'Welcome Title'; }
else { $opWelcomeTitle = $options[ 'welcome_title' ]; }

if ( !isset( $options[ 'welcome_text' ] ) ) { $opWelcomeText = 'Welcome To Our Site!'; }
else { $opWelcomeText = $options[ 'welcome_text' ]; }

if ( ( $opWelcomeTitle ) || ( $opWelcomeText ) ) : ?>

<div id="topmain-welcome-area" class="topmain-welcome-area">

<?php if ( $opWelcomeTitle ) : ?><h2 class="topmain-welcome-title"><?php echo $opWelcomeTitle; ?></h2><?php endif;
if ( $opWelcomeText ) : ?><div class="topmain-welcome-contents"><?php echo $opWelcomeText; ?></div><?php endif; ?>

</div><!-- #topmain-welcome-area -->

<?php

endif; // if ( ( $opWelcomeTitle ) || ( $opWelcomeText ) ) ?>

<div id="topmain-widget-area" class="topmain-widget-area">
<?php

if ( is_active_sidebar( 'sidebar-6' ) ) :

	dynamic_sidebar( 'sidebar-6' );

else : // is_active_sidebar( 'sidebar-6' ) ?>

<section class="widget widget_recent_entries">

<h2 class="widget-title"><?php _e( 'Recent Posts', 'fsvbasic' ); ?></h2>

<?php

	$args = array(
		'ignore_sticky_posts' => true, 
		'posts_per_page' => 5
	);

	$the_query = new WP_Query( $args );

	if ( $the_query->have_posts() ) : ?>

<ul><?php

		while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
<li><span class="post-date"><?php echo get_the_date(); ?></span><span class="post-title-date-on"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span></li><?php
		endwhile; ?>

</ul><?php

	else: // if ( $the_query->have_posts() ) ?>

<p><?php _e( 'There are currently no posts.', 'fsvbasic' ); ?></p><?php

	endif; // if ( $the_query->have_posts() )

	wp_reset_postdata(); ?>

</section><!-- .widget_recent_entries -->

<?php endif; // is_active_sidebar( 'sidebar-6' ) ?>

</div><!-- #topmain-widget-area -->

</div><!-- #primary -->

<?php get_sidebar( 'left' ); ?>

</div><!-- #wrapbox -->

<?php get_sidebar( 'right' ); ?>

</div><!-- .component-inner -->

</div><!-- #main -->

<?php get_sidebar( 'footer' ); ?>

<?php get_footer(); ?>
