<?php
/**
 * The template for displaying Comments
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to fsvbasic_comment() which is
 * located in the functions.php file.
 *
 * @package WordPress
 * @subpackage FSVBASIC
 * @since FSVBASIC 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */

if ( post_password_required() )
	return;
?>

<?php if ( have_comments() || comments_open() ) : ?>

<section id="comments" class="comments-area"><?php

	if ( have_comments() ) : ?>

<h2 class="comments-title"><?php

		printf( _n( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'fsvbasic' ),
		number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );

?></h2><!-- .comments-title -->

<ol class="commentlist"><?php

		wp_list_comments( array( 'callback' => 'fsvbasic_comment', 'style' => 'ol' ) );

?></ol><!-- .commentlist -->

<?php

		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>

<nav id="comment-nav-below" class="nav-single">

<h3 class="assistive-text section-heading"><?php _e( 'Comment navigation', 'fsvbasic' ); ?></h3>

<?php

			$previous_comments_link = get_previous_comments_link( __( 'Previous Comments', 'fsvbasic' ) );
			$next_comments_link = get_next_comments_link( __( 'Next Comments', 'fsvbasic' ) ); ?>

<div class="nav-previous"><?php

			if ( isset($previous_comments_link) ) :

				echo $previous_comments_link;

			else: // if ( isset($previous_comments_link) ) ?>

<a name="no-pager-links" class="no-pager-links">&nbsp;</a><?php

			endif; // if ( isset($previous_comments_link) ) ?>

</div><!-- .nav-previous -->

<div class="nav-next"><?php

			if ( isset($next_comments_link) ) :

				echo $next_comments_link;

			else: // if ( isset($next_comments_link) ) ?>

<a name="no-pager-links" class="no-pager-links">&nbsp;</a><?php

			endif; // if ( isset($next_comments_link) ) ?>

</div><!-- .nav-next -->

</nav><!-- #comment-nav-below --><?php

		endif; // are there comments to navigate through

		if ( ! comments_open() && get_comments_number() ) : ?>

<p class="nocomments"><?php _e( 'Comments are closed.' , 'fsvbasic' ); ?></p><?php

		endif; // if ( ! comments_open() && get_comments_number() )

	else: // have_comments()

		if ( ! comments_open() ) : ?>

<p class="nocomments-accept"><?php _e( 'Comments are closed.' , 'fsvbasic' ); ?></p><?php

		endif; // if ( ! comments_open() )

	endif; // have_comments()

	$comments_args = array(

		'fields' => array(

			'author' => "\n\n" . '<div class="comment-fields">' . "\n" . '<p class="comment-form-author"><span class="form_content">' . __( 'Name', 'fsvbasic' ) . ( $req ? ' *' : '' ) . '</span><input placeholder="' . __( 'Name', 'fsvbasic' ) . ( $req ? ' *' : '' ) . '" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . ($req ? ' aria-required="true"' : '') . ' /></p>',

			'email' => '<p class="comment-form-email"><span class="form_content">' . __( 'Email', 'fsvbasic' ) . ( $req ? ' *' : '' ) . '</span><input placeholder="' . __( 'Email', 'fsvbasic' ) . ( $req ? ' *' : '' ) . '" id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . ($req ? ' aria-required="true"' : '') . ' /></p>',

			'url' => '<p class="comment-form-url"><span class="form_content">' . __( 'Website', 'fsvbasic' ) . '</span><input placeholder="' . __( 'Website', 'fsvbasic' ) . '" id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>'. "\n" . '</div>'. "\n",

		),

		'comment_field' => '<div class="comment-area">' . "\n" . '<p class="comment-form-comment"><span class="form_content">'. __( 'Comment', 'fsvbasic' ) . '</span><textarea placeholder="'. __( 'Comment', 'fsvbasic' ) . '" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>' . "\n" . '</div>' . "\n",

		'must_log_in' => "\n\n" . '<p class="comment-notes">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'fsvbasic' ), wp_login_url( apply_filters( 'the_permalink', get_permalink() ) ) ) . '</p>'. "\n\n",

		'logged_in_as' => "\n\n" . '<p class="comment-notes">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'fsvbasic' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink() ) ) ) . '</p>' . "\n\n",

	);

	comment_form( $comments_args ); ?>

</section><!-- #comments .comments-area -->

<?php endif; // if ( have_comments() || comments_open() ) ?>
