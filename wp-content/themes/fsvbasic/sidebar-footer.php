<?php
/**
 * The sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage FSVBASIC
 * @since FSVBASIC 1.0
 */
?>

<div id="sub" class="footer-widget-area" role="complementary">

<div class="component-inner">

<div id="footer-widget-area-1" class="widget-area">

<?php if ( is_active_sidebar( 'sidebar-3' ) ) : ?>

<?php dynamic_sidebar( 'sidebar-3' ); ?>

<?php else : // is_active_sidebar( 'sidebar-3' ) ?>

<aside class="widget widget_categories">

<h3 class="widget-title"><?php _e( 'Category List', 'fsvbasic' ); ?></h3>

<ul>
<?php wp_list_categories( 'orderby=name&title_li=' ); ?>
</ul>

</aside><!-- .widget .widget_categories -->

<?php endif; // is_active_sidebar( 'sidebar-1' ) ?>

</div><!-- #footer-widget-area-1 -->

<div id="footer-widget-area-2" class="widget-area">

<?php if ( is_active_sidebar( 'sidebar-4' ) ) : ?>

<?php dynamic_sidebar( 'sidebar-4' ); ?>

<?php else : // is_active_sidebar( 'sidebar-4' ) ?>

<aside class="widget widget_pages">

<h3 class="widget-title"><?php _e( 'Page List', 'fsvbasic' ); ?></h3>

<ul>
<?php  wp_list_pages( 'title_li=' ); ?>
</ul>

</aside><!-- .widget .widget_pages -->

<?php endif; // is_active_sidebar( 'sidebar-2' ) ?>

</div><!-- #footer-widget-area-2 -->

<div id="footer-widget-area-3" class="widget-area">

<?php if ( is_active_sidebar( 'sidebar-5' ) ) : ?>

<?php dynamic_sidebar( 'sidebar-5' ); ?>

<?php else : // is_active_sidebar( 'sidebar-5' ) ?>

<aside class="widget widget_recent_entries">

<h3 class="widget-title"><?php _e( 'Recent Posts', 'fsvbasic' ); ?></h3>

<?php

$args = array(
	'ignore_sticky_posts' => true, 
	'posts_per_page' => 5
);

$the_query = new WP_Query( $args );

if ( $the_query->have_posts() ) : ?>

<ul>
<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
<li><span class="post-date"><?php echo get_the_date(); ?></span><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
<?php endwhile; ?>
</ul>

<?php else: // if ( $the_query->have_posts() ) ?>

<p class="post-item-none"><?php _e( 'There are currently no posts.', 'fsvbasic' ); ?></p>

<?php endif; // if ( $the_query->have_posts() )

wp_reset_postdata(); ?>

</aside><!-- .widget .widget_recent_entries -->

<?php endif; // is_active_sidebar( 'sidebar-5' ) ?>

</div><!-- #footer-widget-area-3 -->

</div><!-- .component-inner -->

<div class="clear"></div>

</div><!-- #sub -->
