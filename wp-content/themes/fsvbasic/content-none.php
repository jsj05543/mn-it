<?php
/**
 * The template for displaying a "No posts found" message
 *
 * @package WordPress
 * @subpackage FSVBASIC
 * @since FSVBASIC 1.0
 */
?>

<article id="post-0" class="post no-results not-found">

<header class="main-content-header">

<h1 class="main-content-title"><?php

if ( is_404() ) :

	_e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'fsvbasic' );

else : //if ( is_404() )

	_e( 'Nothing Found', 'fsvbasic' );

endif; // if ( is_404() ) ?></h1>

</header><!-- .main-content-header -->

<div class="entry-content">

<p><?php

if ( is_search() ) :

	_e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'fsvbasic' );

elseif ( is_404() ) :

	_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'fsvbasic' );

else :

	_e( 'Apologies, but no results were found. Perhaps searching will help find a related post.', 'fsvbasic' );

endif; ?></p>

<?php get_search_form(); ?>

</div><!-- .entry-content -->

</article><!-- #post-0 -->
