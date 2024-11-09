<?php
/**
 * The sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage FSVBASIC
 * @since FSVBASIC 1.0
 */

if ( ( ( is_home() || is_front_page() ) &&  ( is_active_sidebar( 'sidebar-2' ) || is_active_sidebar( 'sidebar-8' ) ) ) || ( ( ! is_home() && ! is_front_page() ) && ( is_active_sidebar( 'sidebar-2' ) ) ) ) : // Widget to check whether it is active ?>

<div id="tertiary" class="sidebar-right">

<?php if ( ( is_home() || is_front_page() ) && ( is_active_sidebar( 'sidebar-8' ) ) ) : ?>

<?php dynamic_sidebar( 'sidebar-8' ); ?>

<?php endif; // is_active_sidebar( 'sidebar-8' ) ?>

<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>

<?php dynamic_sidebar( 'sidebar-2' ); ?>

<?php endif; // is_active_sidebar( 'sidebar-2' ) ?>

</div><!-- #tertiary -->

<?php endif; // Widget to check whether it is active ?>
