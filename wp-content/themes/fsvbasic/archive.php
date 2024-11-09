<?php
/**
 * The template for displaying Category, Tag, Date, Author Archive pages.
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

<?php

fsvbasic_breadcrumb();

if ( have_posts() ) : // have_posts() check ?>

<header class="main-content-header">

<h1 class="main-content-title"><?php

	if ( is_day() ) : // Title Output Daily Archive

		printf( __( 'Daily Archives : %s', 'fsvbasic' ), get_the_date() );

	elseif ( is_month() ) : // Title Output Month Archive

		printf( __( 'Monthly Archives : %s', 'fsvbasic' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'fsvbasic' ) ) );

	elseif ( is_year() ) : // Title Output Yeary Archive

		printf( __( 'Yearly Archives : %s', 'fsvbasic' ), get_the_date( _x( 'Y', 'yearly archives date format', 'fsvbasic' ) ) );

	elseif ( is_author() ) : // Title Output Author Archive

		printf( __( 'Author Archives : %s', 'fsvbasic' ), get_the_author() );

	elseif ( is_category() ) : // Title Output Category Archive

		printf( __( '%s', 'fsvbasic' ), single_cat_title( '', false ) );

	elseif ( is_search() ): // Title Output Search Page

		printf( __( 'Search Results for : %s', 'fsvbasic' ), get_search_query() );

	elseif ( is_tag() ): // Title Output Tag Archive

		printf( __( 'Tag Archives : %s', 'fsvbasic' ), single_tag_title( '', false ) ); 

	else : // Title Output Other Pages

		_e( 'Archives', 'fsvbasic' );

	endif; // Title Output

?></h1><!-- .main-content-title -->

<?php if ( ( is_category() ) && ( category_description() ) ) : // Show an optional category description ?>

<div class="entry-meta">
<?php echo category_description(); ?>
</div><!-- .entry-meta -->

<?php endif; // Show an optional category description ?>

<?php if ( ( is_tag() ) && ( tag_description() ) ) : // Show an optional tag description ?>

<div class="entry-meta">

<?php echo tag_description(); ?>

</div><!-- .entry-meta -->

<?php endif; // Show an optional tag description ?>

</header><!-- .main-content-header -->

<div class="article-group">

<?php

	while ( have_posts() ) : the_post();

		get_template_part( 'content', get_post_format() );

	endwhile;

?>

</div><!-- .article-group -->

<?php

else : // have_posts() check

	get_template_part( 'content', 'none' );

endif; // end have_posts() check

fsvbasic_pagination();

?>

</div><!-- #primary -->

<?php get_sidebar( 'left' ); ?>

</div><!-- #wrapbox -->


<?php get_sidebar( 'right' ); ?>

</div><!-- .component-inner -->

</div><!-- #main -->

<?php get_sidebar( 'footer' ); ?>


<?php get_footer(); ?>
