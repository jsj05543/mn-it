<?php
/**
 * The sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage FSVBASIC
 * @since FSVBASIC 1.0
 */

if ( ( ( is_home() || is_front_page() ) &&  ( is_active_sidebar( 'sidebar-1' ) || is_active_sidebar( 'sidebar-7' ) ) ) || ( ( ! is_home() && ! is_front_page() ) && ( is_active_sidebar( 'sidebar-1' ) ) ) ) : // Widget to check whether it is active ?>

<div id="secondary" class="sidebar-left">

<?php if ( ( is_home() || is_front_page() ) && ( is_active_sidebar( 'sidebar-7' ) ) ) : ?>

<?php dynamic_sidebar( 'sidebar-7' ); ?>

<?php endif; // is_active_sidebar( 'sidebar-7' ) ?>

<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>

<?php dynamic_sidebar( 'sidebar-1' ); ?>

<?php endif; // is_active_sidebar( 'sidebar-1' ) ?>

</div><!-- #secondary -->

<?php endif; // Widget to check whether it is active ?>
