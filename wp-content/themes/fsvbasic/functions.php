<?php
/**
 * FSVBASIC functions and definitions
 *
 * @package WordPress
 * @subpackage FSVBASIC
 * @since FSVBASIC 1.1
 */

/**
 * FSVBASIC setup.
 *
 * @since FSVBASIC 1.0
 */
function fsvbasic_setup() {

	/*
	 * Makes FSVBASIC available for translation.
	 */
	load_theme_textdomain( 'fsvbasic', get_template_directory() . '/languages' );

	// Load up our theme options page and related code.
	require( get_template_directory() . '/inc/theme-options.php' );

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'menus' );

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// This feature allows themes to add document title tag to HTML <head>.
	add_theme_support( 'title-tag' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Primary Menu', 'fsvbasic' ) );

	// This theme styles the visual editor to resemble the theme style.
	add_editor_style( 'css/editor-style.css' );

	/*
	 * This theme supports custom background color and image,
	 * and here we also set up the default background color.
	 */
	add_theme_support( 'custom-background', array(
		'default-color' => 'ffffff',
	) );

	// This theme uses a custom image size for featured images, displayed on "standard" posts.
	add_theme_support( 'post-thumbnails' );
	// set_post_thumbnail_size( 624, 9999 ); // Unlimited height, soft crop

}
add_action( 'after_setup_theme', 'fsvbasic_setup' );

/**
 * This setting is for cutting the image to fit the theme.
 *
 * @since FSVBASIC 1.0
 */
require_once( get_template_directory() .'/inc/aqua-resizer.php' );

if ( ! function_exists( 'fsvbasic_img_resize' ) ) :

function fsvbasic_img_resize( $args ) {

	// Archive Image Size
	if( $args == 'img_archive_width' ) return '400';
	if( $args == 'img_archive_height' ) return '300';
	if( $args == 'img_archive_crop' ) return true;

	// Singular Image Size
	if( $args == 'img_post_width' ) return '1200';
	if( $args == 'img_post_height' ) return '1200';
	if( $args == 'img_post_crop' ) return false;

}

endif;

/**
 * These codes are resizing attachment image.
 *
 * @since FSVBASIC 2.0
 */
if ( ! function_exists( 'fsvbasic_resize_attachment' ) ) :

function fsvbasic_resize_attachment( $thumbnail_id ) {

	$image_ary = wp_get_attachment_image_src( $thumbnail_id, 'full' );

	$img_src = $image_ary[0]; 
	$img_width = $image_ary[1];
	$img_height = $image_ary[2];

	if ( is_page() || is_single() ) :

		if ( ( $img_width < intval( fsvbasic_img_resize('img_post_width') ) ) || ( $img_height < intval( fsvbasic_img_resize('img_post_height') ) ) ) :

			the_post_thumbnail();

		else : // $img_width img_post_crop ?>

<img src="<?php echo aq_resize( wp_get_attachment_url( get_post_thumbnail_id() ), fsvbasic_img_resize('img_post_width'), fsvbasic_img_resize('img_post_height'),  fsvbasic_img_resize('img_post_crop') ); ?>" alt="<?php echo the_title(); ?>" /><?php

		endif; // $img_width img_post_crop

	else: // if ( is_page() || is_single() )

		if ( ( $img_width >= intval( fsvbasic_img_resize('img_archive_width') ) ) && ( $img_height >= intval( fsvbasic_img_resize('img_archive_height') ) ) ): ?>

<img src="<?php echo aq_resize( wp_get_attachment_url( get_post_thumbnail_id() ), fsvbasic_img_resize('img_archive_width'), fsvbasic_img_resize('img_archive_height'),  fsvbasic_img_resize('img_archive_crop') ); ?>" alt="<?php echo the_title(); ?>" /><?php

		else : // $img_width img_archive_crop ?>

<img src="<?php echo aq_resize( wp_get_attachment_url( get_post_thumbnail_id() ), fsvbasic_img_resize('img_archive_width'), fsvbasic_img_resize('img_archive_height'),  fsvbasic_img_resize('img_archive_crop') , $single = true, $upscale = true ); ?>" alt="<?php echo the_title(); ?>" /><?php

		endif; // $img_width img_archive_crop

	endif; // if ( is_page() || is_single() )

}

endif;

/**
 * Enqueue scripts and styles for front-end.
 *
 * @since FSVBASIC 1.1
 */
function fsvbasic_scripts_styles() {

	global $wp_styles;

	// Adds JavaScript to pages with the comment form to support
	// sites with threaded comments (when in use).
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	// Loads our main stylesheet.
	wp_enqueue_style( 'fsvbasic-style', get_stylesheet_uri() );

	// Add the script / style sheet for the responsive jQuery content slider.
	wp_enqueue_script( 'jquery-bxslider', get_template_directory_uri() . '/js/jquery.bxslider.min.js', array('jquery'), true );
	wp_enqueue_style( 'jquery-bxslider-styles', get_template_directory_uri() . '/css/jquery.bxslider.css' );

	// Add the script to make entire site responsive.
	wp_enqueue_script( 'jquery-responsive', get_template_directory_uri() . '/js/responsive.js', array('jquery'), true );

	// Loads the overwrite stylesheet.
	wp_enqueue_style( 'fsvbasic-overwrite', get_template_directory_uri() . '/css/overwrite.css' );

	// Loads Web-Fonts stylesheet.
	wp_enqueue_style( 'dashicons' );

}
add_action( 'wp_enqueue_scripts', 'fsvbasic_scripts_styles' );

/**
 * Filter the page menu arguments.
 *
 * @since FSVBASIC 1.0
 */
function fsvbasic_page_menu_args( $args ) {

	if ( ! isset( $args['show_home'] ) )
		$args['show_home'] = true;

	return $args;

}
add_filter( 'wp_page_menu_args', 'fsvbasic_page_menu_args' );

/**
 * These codes are to display breadcrumb navigations.
 *
 * @since FSVBASIC 1.0
 */
if ( ! function_exists( 'fsvbasic_breadcrumb' ) ) :

function fsvbasic_breadcrumb() {

	global $post;

	$connector = '&nbsp;&gt;&nbsp;&nbsp;' ; ?>

<div id="breadcrumb" class="main-breadcrumb">

<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" rel="home">TOP</a>

<?php

	if ( is_404() ) : 

		echo $connector; ?><span class="currentpage"><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'fsvbasic' ); ?></span>

	<?php elseif ( is_search() ) :

		echo $connector; ?><span class="currentpage"><?php printf( __( 'Search Results for : %s', 'fsvbasic' ), get_search_query() ); ?></span>

	<?php elseif ( is_day() ) :

		echo $connector; ?><span class="currentpage"><?php printf( __( 'Daily Archives : %s', 'fsvbasic' ), get_the_date() ); ?></span>

	<?php elseif ( is_month() ) :

		echo $connector; ?><span class="currentpage"><?php printf( __( 'Monthly Archives : %s', 'fsvbasic' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'fsvbasic' ) ) ); ?></span>

	<?php elseif ( is_year() ) :

		echo $connector; ?><span class="currentpage"><?php printf( __( 'Yearly Archives : %s', 'fsvbasic' ), get_the_date( _x( 'Y', 'yearly archives date format', 'fsvbasic' ) ) ); ?></span>

	<?php elseif ( is_author() ) :

		echo $connector; ?><span class="currentpage"><?php printf( __( 'Author Archives : %s', 'fsvbasic' ), get_the_author() ); ?></span>

	<?php elseif ( is_tag() ) : 

		echo $connector; ?><span class="currentpage"><?php printf( __( 'Tag Archives : %s', 'fsvbasic' ), single_tag_title( '', false ) ); ?></span>

	<?php elseif ( is_category() ) :

		$cat = get_queried_object();

		if ( $cat->parent != 0 ):

			$ancestors = array_reverse( get_ancestors( $cat->cat_ID, 'category' ) ); // get parent categories

			foreach( $ancestors as $ancestor ) : // parent categories loop

			echo $connector; ?><a href="<?php echo get_category_link( $ancestor ); ?>"><?php echo get_cat_name( $ancestor ); ?></a>

			<?php endforeach;

		endif;

		echo $connector; ?><span class="currentpage"><?php printf( __( '%s', 'fsvbasic' ) , $cat->cat_name ); ?></span>

	<?php elseif ( is_attachment() ) :

		if($post -> post_parent != 0 ):

			echo $connector; ?><a href="<?php echo get_permalink( $post->post_parent); ?>"><?php echo get_the_title( $post->post_parent ); ?></a>

		<?php endif;

		echo $connector; ?><span class="currentpage"><?php echo $post->post_title; ?></span>

	<?php elseif ( is_single() ) :

		$categories = get_the_category( $post->ID );
		$cat = $categories[0];

		if( $cat->parent != 0 ) :

			$ancestors = array_reverse( get_ancestors( $cat->cat_ID, 'category' ) ) ; // get parent categories

			foreach($ancestors as $ancestor): // parent categories loop

				echo $connector; ?><a href="<?php echo get_category_link( $ancestor ); ?>"><?php echo get_cat_name( $ancestor ); ?></a>

			<?php endforeach;

		endif; ?>

		<?php echo $connector; ?><a href="<?php echo get_category_link( $cat->cat_ID ); ?>"><?php echo $cat->cat_name ; ?></a>

		<?php echo $connector; ?><span class="currentpage"><?php echo $post->post_title; ?></span>

	<?php elseif ( is_page() ) :

		if( $post->post_parent != 0 ) : 

			$ancestors = array_reverse( $post->ancestors );

			foreach($ancestors as $ancestor):

				echo $connector; ?><a href="<?php echo get_permalink( $ancestor ); ?>"><?php echo get_the_title( $ancestor ); ?></a>

			<?php endforeach;

		endif;

		echo $connector; ?><span class="currentpage"><?php echo $post->post_title; ?></span>

	<?php else :

		echo $connector; ?><span class="currentpage"><?php echo $post->post_title; ?></span>

	<?php endif; ?>

</div><!-- #breadcrumb -->

<?php }

endif;

/**
 * These codes are used to display the pager in the archive page.
 *
 * @since FSVBASIC 1.0
 */
if ( ! function_exists( 'fsvbasic_pagination' ) ) :

function fsvbasic_pagination() {

	global $paged;

	global $wp_query;
	$pages = $wp_query->max_num_pages;

	if ( $pages > 1 ) : ?>

<nav class="nav-single">

<div class="nav-previous">

			<?php if ( $paged < $pages ) :

				echo next_posts_link( __( 'Older Posts', 'fsvbasic' ) ); 

			else: ?>

<a name="no-pager-links" class="no-pager-links">&nbsp;</a>

			<?php endif; ?>

</div>

<div class="nav-next">

			<?php if ( $paged > 1 ) :

				echo previous_posts_link( __( 'Newer Posts', 'fsvbasic' ) );

			else: ?>

<a name="no-pager-links" class="no-pager-links">&nbsp;</a>

			<?php endif; ?>

</div>

</nav><!-- .nav-single -->

	<?php endif;

}

endif;

/**
 * Register sidebars.
 *
 * @since FSVBASIC 1.0
 */
function fsvbasic_widgets_init() {

	register_sidebar( array(
		'name' => __( 'Sidebar Area (Left)', 'fsvbasic' ),
		'id' => 'sidebar-1',
		'description' => __( 'The sidebar that appears on the left of all pages. If nothing is set up, the sidebar is not displayed.', 'fsvbasic' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Sidebar Area (Right)', 'fsvbasic' ),
		'id' => 'sidebar-2',
		'description' => __( 'The sidebar that appears on the right of all pages. If nothing is set up, the sidebar is not displayed.', 'fsvbasic' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Area (Left)', 'fsvbasic' ),
		'id' => 'sidebar-3',
		'description' => __( 'The area that appears on the left of the footer. It nothing is set up, the list of categories is displayed.', 'fsvbasic' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Area (Center)', 'fsvbasic' ),
		'id' => 'sidebar-4',
		'description' => __( 'The area that appears on the center of the footer. It nothing is set up, the list of pages is displayed.', 'fsvbasic' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Area (Right)', 'fsvbasic' ),
		'id' => 'sidebar-5',
		'description' => __( 'The area that appears on the right of the footer. It nothing is set up, the latest posts are displayed.', 'fsvbasic' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Top Main Area', 'fsvbasic' ),
		'id' => 'sidebar-6',
		'description' => __( 'The area that contains the main menu, at the top of the page. If nothing is set up, the latest posts are automatically displayed.', 'fsvbasic' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );

	register_sidebar( array(
		'name' => __( 'Top Sidebar Area (Left)', 'fsvbasic' ),
		'id' => 'sidebar-7',
		'description' => __( 'The sidebar that appears on the left of the top page. If nothing is set up, this area is not displayed.', 'fsvbasic' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Top Sidebar Area (Right)', 'fsvbasic' ),
		'id' => 'sidebar-8',
		'description' => __( 'The sidebar that appears on the right of the top page. If nothing is set up, this area is not displayed.', 'fsvbasic' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );


}
add_action( 'widgets_init', 'fsvbasic_widgets_init' );

/**
 * Register Original Widgets.
 *
 * @since FSVBASIC 1.0
 */

/**
 * Register Widget "Text block".
 *
 * @since FSVBASIC 1.0
 */
class fsvbasic_w_framedtext extends WP_Widget {

	function __construct() {

		$widget_ops = array( 'classname' => 'widget_framedtext' , 'description' => __( 'Textarea enclosed by a frame.', 'fsvbasic' ) );
		parent::__construct( false , $name = __( 'Text block', 'fsvbasic' ) , $widget_ops );

	}

	function widget( $args , $instance ) {

		extract( $args );

		$title = apply_filters( 'widget_title', empty( $instance[ 'title' ] ) ? '' : $instance[ 'title' ], $instance, $this->id_base );
		$text = apply_filters( 'widget_text', empty( $instance[ 'text' ] ) ? '' : $instance[ 'text' ], $instance );

		echo $before_widget;

		if ( $title ) { echo $args['before_title'] . $title . $args['after_title']; } ?>

			<div class="textwidget"><?php echo !empty( $instance[ 'filter' ] ) ? wpautop( $text ) : $text; ?></div>

		<?php

		echo $after_widget;

	}

	function update( $new_instance , $old_instance ) {

		$instance = $old_instance;
		$instance[ 'title' ] = strip_tags( $new_instance[ 'title' ]);

		if ( current_user_can( 'unfiltered_html' ) ) {

			$instance['text'] = $new_instance['text'];

		} else {

			$instance['text'] = stripslashes( wp_filter_post_kses( addslashes( $new_instance[ 'text' ] ) ) );

		}

		$instance['filter'] = isset($new_instance['filter']);

		return $instance;

	}

	function form( $instance ) {

		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '' ) );

		$title = strip_tags( $instance[ 'title' ] );
		$text = esc_textarea( $instance[ 'text' ] ); ?>

		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'fsvbasic' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>
 
		<textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo $text; ?></textarea>
 
		<p><input id="<?php echo $this->get_field_id( 'filter' ); ?>" name="<?php echo $this->get_field_name( 'filter' ); ?>" type="checkbox" <?php checked(isset($instance[ 'filter' ]) ? $instance[ 'filter' ] : 0); ?> />&nbsp;<label for="<?php echo $this->get_field_id( 'filter' ); ?>"><?php _e( 'Automatically add paragraphs', 'fsvbasic' ); ?></label></p>

	<?php

	}

}
add_action( 'widgets_init', function() {
    return register_widget( 'fsvbasic_w_framedtext' );
} );
/**
 * Register Widget "Tagged posts".
 *
 * @since FSVBASIC 1.0
 */
class fsvbasic_w_tag_posts extends WP_Widget {

	function __construct() {

		$widget_ops = array( 'classname' => 'widget_tagposts' , 'description' => __( 'The list of tagged posts', 'fsvbasic' ) );
		parent::__construct( 'posttag' , $name = __( 'Tagged posts', 'fsvbasic' ) , $widget_ops );

	}

	function widget( $args , $instance ) {

		$title = apply_filters( 'widget_title', empty( $instance[ 'title' ] ) ? '' : $instance[ 'title' ], $instance, $this->id_base );
		$posttag = empty( $instance[ 'posttag' ] ) ? '' : $instance[ 'posttag' ];

		echo $args[ 'before_widget' ];

		$r = new WP_Query( array(
			'tag_id' => $posttag,
			'post_status'  => 'publish',
			'ignore_sticky_posts' => true
		) );

		if ( $r->have_posts() ) : 

			if ( $title ) { echo $args['before_title'] . $title . $args['after_title']; } ?>

<ul><?php

				while ( $r->have_posts() ) : $r->the_post(); ?>

<li><?php

					$options = fsvbasic_get_theme_options();

					if ( has_post_thumbnail() ) : ?>

<div class="img_tag_posts"><a href="<?php the_permalink(); ?>"><?php

						$thumbnail_id = get_post_thumbnail_id();
						fsvbasic_resize_attachment( $thumbnail_id );

?></a></div><!-- .img_tag_posts --><?php

					else: ?>

<div class="img_tag_posts_none">
<a href="<?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/default_noimage.png" alt="No Image" /></a>
</div><!-- .img_tag_posts_none --><?php

					endif; ?>

<div class="ex_tag_posts">

<p class="ex_tag_link"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>

<?php the_excerpt(); ?>

<p class="ex_tag_button"><a href="<?php the_permalink(); ?>"><?php _e( 'More', 'fsvbasic' ); ?></a></p>

</div><!-- .ex_tag_posts -->

</li><?php

				endwhile; ?>

</ul>

		<?php endif;

		wp_reset_postdata();

		echo $args[ 'after_widget' ];

	}

	function update( $new_instance , $old_instance ) {

		$instance = $old_instance;

		if ( ! empty( $new_instance['title'] ) ) {
			$instance['title'] = strip_tags( stripslashes($new_instance['title']) );
		}

		if ( ! empty( $new_instance[ 'posttag' ] ) ) {
			$instance[ 'posttag' ] = (int) $new_instance[ 'posttag' ];
		}

		return $instance;

	}

	function form( $instance ) {

		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$posttag = isset( $instance['posttag'] ) ? $instance['posttag'] : '';

		$taglists = get_tags(); ?>

		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'fsvbasic' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'posttag' ); ?>"><?php _e( 'Tag:', 'fsvbasic' ); ?></label>
			<select id="<?php echo $this->get_field_id( 'posttag' ); ?>" name="<?php echo $this->get_field_name( 'posttag' ); ?>">
				<option value="0"><?php _e( '&mdash; Select &mdash;', 'fsvbasic' ) ?></option>
				<?php foreach ( $taglists as $taglist ) { echo '<option value="' . $taglist->term_id . '"' . selected( $posttag, $taglist->term_id, false ) . '>' . esc_html( $taglist->name ) . '</option>'; } ?>
			</select>
		</p>

	<?php

	}

}
add_action( 'widgets_init', function() {
    register_widget( 'fsvbasic_w_tag_posts' );
} );

/**
 * Register Widget "Category list".
 *
 * @since FSVBASIC 1.0
 */
class fsvbasic_w_category extends WP_Widget {

	function __construct() {

		$widget_ops = array( 'classname' => 'widget_catposts' , 'description' => __( 'The list of page categories', 'fsvbasic' ) );
		parent::__construct( 'catid' , $name = __( 'Category list', 'fsvbasic' ) , $widget_ops );

	}

	function widget( $args , $instance ) {

		$title = apply_filters( 'widget_title', empty( $instance[ 'title' ] ) ? '' : $instance[ 'title' ], $instance, $this->id_base );

		$number = ( ! empty( $instance[ 'number' ] ) ) ? absint( $instance[ 'number' ] ) : 5;
		if ( ! $number ) { $number = 5; }

		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;

		$catid = empty( $instance[ 'catid' ] ) ? '' : $instance[ 'catid' ];

		echo $args[ 'before_widget' ];

		$p = new WP_Query( array(
			'cat' => $catid,
			'posts_per_page' => $number,
			'post_status' => 'publish',
			'ignore_sticky_posts' => true
		) );

		if ( $p->have_posts() ) :

			if ( $title ) { echo $args['before_title'] . $title . $args['after_title']; } ?>

			<ul>

				<?php while ( $p->have_posts() ) : $p->the_post(); ?>

					<li>
						<?php if ( $show_date ) : ?><span class="post-date"><?php echo get_the_date(); ?></span><?php endif; ?>
						<span class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>
					</li>

				<?php endwhile; ?>

			</ul>

		<?php endif;

		wp_reset_postdata();

		echo $args[ 'after_widget' ];

	}

	function update( $new_instance , $old_instance ) {

		$instance = $old_instance;

		if ( ! empty( $new_instance['title'] ) ) {
			$instance['title'] = strip_tags( stripslashes($new_instance['title']) );
		}

		$instance[ 'number' ] = (int) $new_instance[ 'number' ];
		$instance[ 'show_date' ] = isset( $new_instance[ 'show_date' ] ) ? (bool) $new_instance[ 'show_date' ] : false;

		if ( ! empty( $new_instance[ 'catid' ] ) ) {
			$instance[ 'catid' ] = (int) $new_instance[ 'catid' ];
		}

		return $instance;

	}

	function form( $instance ) {

		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;

		$catid = isset( $instance['catid'] ) ? $instance['catid'] : '';

		$catlists = get_categories(); ?>

		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'fsvbasic' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:', 'fsvbasic' ); ?></label>
		<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>

		<p><label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Display post date?', 'fsvbasic' ); ?></label>
		<input class="checkbox" type="checkbox" <?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'catid' ); ?>"><?php _e( 'Category:', 'fsvbasic' ); ?></label>

			<select id="<?php echo $this->get_field_id( 'catid' ); ?>" name="<?php echo $this->get_field_name( 'catid' ); ?>">
				<option value="0"><?php _e( '&mdash; Select &mdash;', 'fsvbasic' ) ?></option>
				<?php foreach ( $catlists as $catlist ) { echo '<option value="' . $catlist->cat_ID . '"' . selected( $catid, $catlist->cat_ID, false ) . '>' . esc_html( $catlist->name ) . '</option>'; } ?>
			</select>
		</p>

	<?php

	}

}
add_action( 'widgets_init', function() {
    register_widget( 'fsvbasic_w_category' );
} );

/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own fsvbasic_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since FSVBASIC 1.0
 */
if ( ! function_exists( 'fsvbasic_comment' ) ) :

function fsvbasic_comment( $comment, $args, $depth ) {

	$GLOBALS['comment'] = $comment;

	switch ( $comment->comment_type ) :

		case 'pingback' :
		case 'trackback' :

			// Display trackbacks differently than normal comments.	?>

			<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">

				<p><?php _e( 'Pingback : ', 'fsvbasic' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'fsvbasic' ), '| ', '' ); ?></p><?php

			break;

		default :

			// Proceed with normal comments.
			global $post; ?>

			<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">

				<article id="comment-id-<?php comment_ID(); ?>" class="comment"><?php

						echo get_avatar( $comment, 45 );
						echo "\n" ; ?>

					<section class="comment-content comment"><?php 

						printf( '<p class="comment-meta comment-author vcard"><b class="fn"><a href="%1$s">%4$s</a></b> %5$s<br /><time datetime="%2$s">%3$s</time></p>',
							esc_url( get_comment_link( $comment->comment_ID ) ),
							get_comment_time( 'c' ),
							/* translators: 1: date, 2: time */
							sprintf( __( '%1$s at %2$s', 'fsvbasic' ), get_comment_date(), get_comment_time() ),
							get_comment_author_link(),
							// If current post author is also comment author, make it known visually.
							( $comment->user_id === $post->post_author ) ? '<span class="post-author">' . __( 'Post author', 'fsvbasic' ) . '</span>' : ''
						);

						echo "\n" ;

						if ( '0' == $comment->comment_approved ) : ?>
						<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'fsvbasic' ); ?></p>
						<?php endif; ?>

						<?php comment_text(); ?>

						<p class="comment-meta"><?php edit_comment_link( __( 'Edit', 'fsvbasic' ), '', ' | ' ); ?><?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'fsvbasic' ), 'before' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></p>

					</section><!-- .comment-content -->

				</article><!-- #comment-## --><?php

			break;

	endswitch; // end comment_type check
}

endif;

/**
 * Set up post entry meta.
 *
 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 * Create your own fsvbasic_entry_meta() to override in a child theme.
 *
 * @since FSVBASIC 1.0
 */

if ( ! function_exists( 'fsvbasic_entry_meta' ) ) :

function fsvbasic_entry_meta() {
	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list();

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list();

	$date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	$author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'fsvbasic' ), get_the_author() ) ),
		get_the_author()
	);

	// Translators: 1 is category, 2 is tag, 3 is the date and 4 is the author's name.
	if ( $tag_list ) {
		$utility_text = __( '<p class="meta-postdate">%3$s</p>%1$s<div class="clear"></div>%2$s<span class="by-author"> by %4$s.</span><div class="clear"></div>', 'fsvbasic' );
	} elseif ( $categories_list ) {
		$utility_text = __( '<p class="meta-postdate">%3$s</p>%1$s<span class="by-author"> by %4$s.</span><div class="clear"></div>', 'fsvbasic' );
	} else {
		$utility_text = __( '<p class="meta-postdate">%3$s</p><span class="by-author"> by %4$s.</span><div class="clear"></div>', 'fsvbasic' );
	}

	printf(
		$utility_text,
		$categories_list,
		$tag_list,
		$date,
		$author
	);
}

endif;

/**
 * Extend the default WordPress body classes.
 *
 * Extends the default WordPress body class to denote:
 * 1. Page Layout ( Relationship between Sidebar and Main Column )
 * 2. White or empty background color to change the layout and spacing.
 *
 * @since FSVBASIC 1.0
 *
 * @param array $classes Existing class values.
 * @return array Filtered class values.
 */
function fsvbasic_body_class( $classes ) {

	// 1. Page Layout ( Relationship between Sidebar and Main Column )
	if ( is_page_template( 'page-templates/full-width.php' ) ) :

		$classes[] = 'full-width';

	else :

		if ( is_home() || is_front_page() ) :

			if ( ! is_active_sidebar( 'sidebar-1' ) && ! is_active_sidebar( 'sidebar-2' ) && ! is_active_sidebar( 'sidebar-7' ) && ! is_active_sidebar( 'sidebar-8' ) ) :

				$classes[] = 'full-width';

			elseif ( ( is_active_sidebar( 'sidebar-1' ) && ! is_active_sidebar( 'sidebar-2' ) && is_active_sidebar( 'sidebar-7' ) && ! is_active_sidebar( 'sidebar-8' ) ) ||
			( ! is_active_sidebar( 'sidebar-1' ) && ! is_active_sidebar( 'sidebar-2' ) && is_active_sidebar( 'sidebar-7' ) && ! is_active_sidebar( 'sidebar-8' ) ) ||
			( is_active_sidebar( 'sidebar-1' ) && ! is_active_sidebar( 'sidebar-2' ) && ! is_active_sidebar( 'sidebar-7' ) && ! is_active_sidebar( 'sidebar-8' ) ) ) :

				$classes[] = 'column-2l';

			elseif ( ( ! is_active_sidebar( 'sidebar-1' ) && is_active_sidebar( 'sidebar-2' ) && ! is_active_sidebar( 'sidebar-7' ) && is_active_sidebar( 'sidebar-8' ) ) ||
			( ! is_active_sidebar( 'sidebar-1' ) && ! is_active_sidebar( 'sidebar-2' ) && ! is_active_sidebar( 'sidebar-7' ) && is_active_sidebar( 'sidebar-8' ) ) ||
			( ! is_active_sidebar( 'sidebar-1' ) && is_active_sidebar( 'sidebar-2' ) && ! is_active_sidebar( 'sidebar-7' ) && ! is_active_sidebar( 'sidebar-8' ) ) ) :

				$classes[] = 'column-2r';

			else :

				$classes[] = 'column-3';

			endif;

		else :

			if ( ! is_active_sidebar( 'sidebar-1' ) && ! is_active_sidebar( 'sidebar-2' ) ) :

				$classes[] = 'full-width';

			elseif ( is_active_sidebar( 'sidebar-1' ) && ! is_active_sidebar( 'sidebar-2' ) ) :

				$classes[] = 'column-2l';

			elseif ( ! is_active_sidebar( 'sidebar-1' ) && is_active_sidebar( 'sidebar-2' ) ) :

				$classes[] = 'column-2r';

			else :

				$classes[] = 'column-3';

			endif;

		endif;

	endif;

	// 2. White or empty background color to change the layout and spacing.
	$background_color = get_background_color();
	$background_image = get_background_image();

	if ( empty( $background_image ) ) :

		if ( empty( $background_color ) ) :

			$classes[] = 'custom-background-empty';

		elseif ( in_array( $background_color, array( 'fff', 'ffffff' ) ) ) :

			$classes[] = 'custom-background-white';

		endif;

	endif;

	return $classes;
}
add_filter( 'body_class', 'fsvbasic_body_class' );

/**
 * These codes are used to include the number of posts in <a> tag in the category widget.
 *
 * @since FSVBASIC 1.0
 */
function fsvbasic_num_categories( $output ) {
  $output = preg_replace('/<\/a>\s*\((\d+)\)/',' <span class="articles_count">($1)</span></a>',$output);
  return $output;
}
add_filter( 'wp_list_categories', 'fsvbasic_num_categories', 10, 2 );

/**
 * These codes are used to include the number of posts in <a> tag in the archives widget.
 *
 * @since FSVBASIC 1.0
 */
function fsvbasic_num_archives( $output ) {
  $output = preg_replace('/<\/a>\s*(&nbsp;)\((\d+)\)/',' <span class="articles_count">($2)</span></a>',$output);
  return $output;
}
add_filter( 'get_archives_link', 'fsvbasic_num_archives' );

// Set up the content width value based on the theme's design and stylesheet.
if ( ! isset( $content_width ) )
	$content_width = 1200;


function my_contact_enqueue_scripts(){
wp_deregister_script('contact-form-7');
wp_deregister_style('contact-form-7');
if (is_page('contact')) {
if (function_exists( 'wpcf7_enqueue_scripts')) {
        wpcf7_enqueue_scripts();
}
if ( function_exists( 'wpcf7_enqueue_styles' ) ) {
wpcf7_enqueue_styles();
}
}
}
add_action( 'wp_enqueue_scripts', 'my_contact_enqueue_scripts');

?>



