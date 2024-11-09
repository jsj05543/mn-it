<?php
/**
 * FSVBASIC Theme Options
 *
 * @package WordPress
 * @subpackage FSVBASIC
 * @since FSVBASIC 1.1
 */

/**
 * Register the form setting for our fsvbasic_options array.
 * This function is attached to the admin_init action hook.
 *
 * @since FSVBASIC 1.0
 */
function fsvbasic_theme_options_init() {

	register_setting(
		'fsvbasic_options',       // Options group
		'fsvbasic_theme_options', // Database option, see fsvbasic_get_theme_options()
		'fsvbasic_theme_options_validate' // The sanitization callback, see fsvbasic_theme_options_validate()
	);

}
add_action( 'admin_init', 'fsvbasic_theme_options_init' );

/**
 * Change the capability required to save the 'fsvbasic_options' options group.
 *
 * @param string $capability The capability used for the page, which is manage_options by default.
 * @return string The capability to actually use.
 */
function fsvbasic_option_page_capability( $capability ) {
	return 'edit_theme_options';
}
add_filter( 'option_page_capability_fsvbasic_options', 'fsvbasic_option_page_capability' );

/**
 * Return an array of color schemes registered for FSVBASIC.
 *
 * @since FSVBASIC 2.0
 */
/*if ( ! function_exists( 'fsvbasic_color_schemes' ) ) :

function fsvbasic_color_schemes() {

	$color_scheme_options = array(
		'blue' => array(
			'value' => 'blue',
			'label' => __( 'blue', 'fsvbasic' ),
		),
		'green' => array(
			'value' => 'green',
			'label' => __( 'green', 'fsvbasic' ),
		),
		'orange' => array(
			'value' => 'orange',
			'label' => __( 'orange', 'fsvbasic' ),
		),
		'pink' => array(
			'value' => 'pink',
			'label' => __( 'pink', 'fsvbasic' ),
		),
		'black' => array(
			'value' => 'black',
			'label' => __( 'black', 'fsvbasic' ),
		),
	);

	return apply_filters( 'fsvbasic_color_schemes', $color_scheme_options );
}

endif; // if ( ! function_exists( 'fsvbasic_color_schemes' ) ) : */

/**
 * Return the default options for FSVBASIC.
 *
 * @return array An array of default theme options.
 *
 * @since FSVBASIC 1.1
 */
if ( ! function_exists( 'fsvbasic_get_default_theme_options' ) ) :

function fsvbasic_get_default_theme_options() {

	$default_theme_options = array(
		//'color_scheme' => 'blue',

		'main_color' => '#1177ba',
		'link_color' => '#0e67a3',
		'sub_light_color' => '#b8dcf1',
		'footer_widget_color' => '#f5f5f5',
		'text_main_color' => '#333333',
		'line_icon_color' => '#cccccc',
		'text_sub_color' => '#ffffff',

		'header_logo' => '',
		'link_sitemap' => '#',
		'link_contact' => 'mailto:',
		'head_text' => 'texttexttexttexttext',
		'head_large_text' => 'TEL:0120-00-0000',

		'slide1_url' => '#',
		'slide1_pic' => get_template_directory_uri() . '/images/header_001.jpg',
		'slide1_cap' => 'slide1 caption',

		'slide2_url' => '#',
		'slide2_pic' => get_template_directory_uri() . '/images/header_002.jpg',
		'slide2_cap' => 'slide2 caption',

		'slide3_url' => '#',
		'slide3_pic' => get_template_directory_uri() . '/images/header_003.jpg',
		'slide3_cap' => 'slide3 caption',

		'slide4_url' => '#',
		'slide4_pic' => get_template_directory_uri() . '/images/header_004.jpg',
		'slide4_cap' => 'slide4 caption',

		'slide5_url' => '#',
		'slide5_pic' => get_template_directory_uri() . '/images/header_005.jpg',
		'slide5_cap' => 'slide5 caption',

		'welcome_title' => 'Welcome Title',
		'welcome_text' => 'Welcome To Our Site!',
		'welcome_bg_color' => '#b8dcf1',

		'foot_text' => 'Copyright',
	);

	return apply_filters( 'fsvbasic_default_theme_options', $default_theme_options );
}

endif; // if ( ! function_exists( 'fsvbasic_get_default_theme_options' ) ) :

/**
 * Return the options array for FSVBASIC.
 *
 * @since FSVBASIC 1.0
 */
if ( ! function_exists( 'fsvbasic_get_theme_options' ) ) :

function fsvbasic_get_theme_options() {
	return get_option( 'fsvbasic_theme_options', fsvbasic_get_default_theme_options() );
}

endif; // if ( ! function_exists( 'fsvbasic_get_theme_options' ) )

/**
 * Sanitize and validate form input.
 *
 * @see fsvbasic_theme_options_init()
 * @todo set up Reset Options action
 *
 * @since FSVBASIC 1.0
 */
if ( ! function_exists( 'function fsvbasic_theme_options_validate' ) ) :

function fsvbasic_theme_options_validate( $input ) {

	$output = $defaults = fsvbasic_get_default_theme_options();

	// Color scheme must be in our array of color scheme options
	/*if ( isset( $input['color_scheme'] ) && array_key_exists( $input['color_scheme'], fsvbasic_color_schemes() ) )
		$output['color_scheme'] = $input['color_scheme'];*/

	$output['main_color'] = $input['main_color'];
	$output['link_color'] = $input['link_color'];
	$output['sub_light_color'] = $input['sub_light_color'];
	$output['footer_widget_color'] = $input['footer_widget_color'];
	$output['text_main_color'] = $input['text_main_color'];
	$output['line_icon_color'] = $input['line_icon_color'];
	$output['text_sub_color'] = $input['text_sub_color'];

	$output['header_logo'] = $input['header_logo'];

	$output['link_sitemap'] = $input['link_sitemap'];
	$output['link_contact'] = $input['link_contact'];
	$output['head_text'] = $input['head_text'];
	$output['head_large_text'] = $input['head_large_text'];

	$output['slide1_url'] = $input['slide1_url'];
	$output['slide1_pic'] = $input['slide1_pic'];
	$output['slide1_cap'] = $input['slide1_cap'];

	$output['slide2_url'] = $input['slide2_url'];
	$output['slide2_pic'] = $input['slide2_pic'];
	$output['slide2_cap'] = $input['slide2_cap'];

	$output['slide3_url'] = $input['slide3_url'];
	$output['slide3_pic'] = $input['slide3_pic'];
	$output['slide3_cap'] = $input['slide3_cap'];

	$output['slide4_url'] = $input['slide4_url'];
	$output['slide4_pic'] = $input['slide4_pic'];
	$output['slide4_cap'] = $input['slide4_cap'];

	$output['slide5_url'] = $input['slide5_url'];
	$output['slide5_pic'] = $input['slide5_pic'];
	$output['slide5_cap'] = $input['slide5_cap'];

	$output['welcome_title'] = $input['welcome_title'];
	$output['welcome_text'] = $input['welcome_text'];
	$output['welcome_bg_color'] = $input['welcome_bg_color'];

	$output['foot_text'] = $input['foot_text'];

	return apply_filters( 'fsvbasic_theme_options_validate', $output, $input, $defaults );
}

endif; // if ( ! function_exists( 'function fsvbasic_theme_options_validate' ) )

/**
 * Enqueue the styles for the current color scheme.
 *
 * @since FSVBASIC 1.0
 */
/*if ( ! function_exists( 'fsvbasic_enqueue_color_scheme' ) ) :

function fsvbasic_enqueue_color_scheme() {

	$options = fsvbasic_get_theme_options();
	$color_scheme = $options['color_scheme'];

	if ( 'green' == $color_scheme ) :

		wp_enqueue_style( 'green', get_template_directory_uri() . '/css/style-green.css', array(), null );

	elseif ( 'orange' == $color_scheme ) :

		wp_enqueue_style( 'orange', get_template_directory_uri() . '/css/style-orange.css', array(), null );

	elseif ( 'pink' == $color_scheme ) :

		wp_enqueue_style( 'pink', get_template_directory_uri() . '/css/style-pink.css', array(), null );

	elseif ( 'black' == $color_scheme ) :

		wp_enqueue_style( 'black', get_template_directory_uri() . '/css/style-black.css', array(), null );

	endif;

	do_action( 'fsvbasic_enqueue_color_scheme', $color_scheme );
}
add_action( 'wp_enqueue_scripts', 'fsvbasic_enqueue_color_scheme' );

endif; // if ( ! function_exists( 'fsvbasic_enqueue_color_scheme' ) ) */

/**
 * Add a style block to the theme for the current color.
 *
 * This function is attached to the wp_head action hook.
 *
 * @since FSVBASIC 2.0
 */
function fsvbasic_print_color_style() {

	$options = fsvbasic_get_theme_options();

	$main_color = $options['main_color'];
	$link_color = $options['link_color'];
	$sub_light_color = $options['sub_light_color'];
	$footer_widget_color = $options['footer_widget_color'];
	$text_main_color = $options['text_main_color'];
	$line_icon_color = $options['line_icon_color'];
	$text_sub_color = $options['text_sub_color'];

	$welcome_bg_color = $options['welcome_bg_color'];

	$default_options = fsvbasic_get_default_theme_options(); ?>

<style type="text/css">
<?php
	// Don't do anything if the current main color is the default.
	if ( $default_options['main_color'] != $main_color ) {
?>
/* Main Color */
#header-nav-area,
.nav-previous a::before,
.nav-next a::after,
.page-links > span,
.main-content-header .main-content-title::before,
.topmain-widget-area .widget-title::after,
.post-sitemap-list .widget-title::after,
.sidebar-left .widget-title::after,
.sidebar-right .widget-title::after,
.comments-title::after,
.comment-reply-title::after,
.widget_rss .widget-title .rss-widget-icon-link::after,
#wp-calendar caption,
#wp-calendar tfoot #prev a::before,
#wp-calendar tfoot #next a::before,
.widget_archive select[name=archive-dropdown],
.widget_categories select.postform,
.footer-copy-area,
a[rel*="category"],
#pagetop {
	background-color:<?php echo $main_color; ?>;
}

#site-navigation ul li a:hover,
.menu-load-button a,
#header-menu-button button span,
.hw_link1 a::before,
.hw_link2 a::before,
.post-sitemap-list ul li::before,
.widget_archive ul li::before,
.widget_categories ul li::before,
.widget_nav_menu ul li::before,
.widget_pages ul li::before,
.widget_meta ul li::before,
.post-sitemap-list .children li::before,
.widget_nav_menu .sub-menu li::before,
.widget_pages .children li::before,
.widget_categories .children li::before,
#searchform::before {
	color:<?php echo $main_color; ?>;
}

input[type="text"],
input[type="password"],
input[type="search"],
input[type="tel"],
input[type="url"],
input[type="email"],
input[type="number"],
textarea,
.site-header-area,
.page-links > span {
	border-color:<?php echo $main_color; ?>;
}
<?php } // $main_color
	// Don't do anything if the current link color is the default.
	if ( $default_options['link_color'] != $link_color ) {
?>
/* Link Color */
a {
	color:<?php echo $link_color; ?>;
}
<?php } // $link_color
	// Don't do anything if the current sub light color is the default.
	if ( $default_options['sub_light_color'] != $sub_light_color ) {
?>
/* Sub Light Color */
#site-navigation ul li a:hover,
input[type="text"],
input[type="password"],
input[type="search"],
input[type="tel"],
input[type="url"],
input[type="email"],
input[type="number"],
textarea {
	background-color:<?php echo $sub_light_color; ?>;
}

<?php } // $sub_light_color
	// Don't do anything if the current footer widget area color is the default.
	if ( $default_options['footer_widget_color'] != $footer_widget_color ) {
?>
#wp-calendar td,
.topmain-welcome-area th,
.textwidget th,
.entry-content th,
.comment-content th,
.widget_framedtext {
	background-color:<?php echo $footer_widget_color?>;
}
<?php } // $footer_widget_color
	// Don't do anything if the current main text color is the default.
	if ( $default_options['text_main_color'] != $text_main_color ) {
?>
/* Main Text Color */
del,
body,
.meta-postdate a,
.page-links > a,
.main-content-header .main-content-title,
.topmain-widget-area .widget-title,
.widget_rss .widget-title .rsswidget,
.widget_framedtext .widget-title,
.topmain-welcome-area th a,
.textwidget th a,
.entry-content th a,
.comment-content th a {
	color:<?php echo $text_main_color; ?>;
}
<?php } // $text_main_color
	// Don't do anything if the current line & icon color is the default.
	if ( $default_options['line_icon_color'] != $line_icon_color ) {
?>
/* Line & Icon Color */
.mu_register h2,
.widget_recent_comments ul li::before,
.tagcloud a::before {
    color:<?php echo $line_icon_color; ?>;
}

hr,
a[rel*="tag"],
.page-links > a:hover,
.post-author {
	background-color:<?php echo $line_icon_color; ?>;
}

button,
input,
select,
textarea,
.header-title-only,
.header-title-area,
.header-image-area,
.main-content-area,
.topmain-welcome-area abbr,
.textwidget abbr,
.entry-content abbr,
.comment-content abbr,
.topmain-welcome-area dfn,
.textwidget dfn,
.entry-content dfn,
.comment-content dfn,
.topmain-welcome-area acronym,
.textwidget acronym,
.entry-content acronym,
.comment-content acronym,
.topmain-welcome-area table,
.textwidget table,
.entry-content table,
.comment-content table,
.topmain-welcome-area th,
.textwidget th,
.entry-content th,
.comment-content th,
.topmain-welcome-area td,
.textwidget td,
.entry-content td,
.comment-content td,
.page-links > a,
.nav-single,
.nav-previous a,
.nav-next a,
.comments-title,
.comment-reply-title,
article.comment,
.comment .children,
.nocomments,
.archive-post,
.widget,
.widget-title,
.post-sitemap-list .widget-title,
.post-sitemap-list ul li,
.widget_archive ul li,
.widget_categories ul li,
.widget_nav_menu ul li,
.widget_pages ul li,
.widget_meta ul li,
.widget_recent_entries ul li,
.widget_rss ul li,
.widget_recent_comments ul li,
.widget_tagposts ul li,
.widget_tagpages ul li,
.widget_catposts ul li,
.hw_link1,
.hw_link2,
.hw_link2 a,
.post-sitemap-list .children,
.widget_nav_menu .sub-menu,
.widget_pages .children,
.widget_categories .children,
.topmain-welcome-area pre,
.textwidget pre,
.entry-content pre,
.comment-content pre,
.main-content-header .main-content-title,
.topmain-widget-area .widget-title,
.post-sitemap-list .widget-title,
.sidebar-left .widget-title,
.sidebar-right .widget-title,
.comments-title,
.comment-reply-title {
	border-color:<?php echo $line_icon_color; ?>;
}
<?php } // $line_icon_color
	// Don't do anything if the current sub text color is the default.
	if ( $default_options['text_sub_color'] != $text_sub_color ) {
?>
#wp-calendar th {
	background-color:<?php echo $text_sub_color; ?>;
}

#site-navigation ul li a,
a[rel*="category"],
a[rel*="tag"],
.page-links > span,
.nav-previous a::before,
.nav-next a::after,
.post-author,
.widget_rss .widget-title .rss-widget-icon-link::after,
.widget_archive select[name=archive-dropdown],
.widget_categories select.postform,
#wp-calendar caption,
#wp-calendar tfoot #prev a::before,
#wp-calendar tfoot #next a::before,
.footer-copy-area .footer-copy,
.footer-copy-area .footer-copy a,
#pagetop {
	color:<?php echo $text_sub_color; ?>;
}

#site-navigation div.menu,
#site-navigation ul li,
div.attachment img,
.wp-caption img,
img.main-tile,
img.alignleft,
img.alignright,
img.aligncenter,
img.alignnone,
.archive-post img {
	border-color:<?php echo $text_sub_color; ?>;
}
<?php } // $text_sub_color
	// Don't do anything if the current welcome message background color is the default.
	if ( $default_options['welcome_bg_color'] != $welcome_bg_color ) {
?>
.topmain-welcome-area {
	background-image: radial-gradient(<?php echo $welcome_bg_color; ?> 20%, transparent 20%),radial-gradient(<?php echo $welcome_bg_color; ?> 20%, transparent 20%);
}

@-moz-document url-prefix() {

	.topmain-welcome-area{
		background-image: radial-gradient(<?php echo $welcome_bg_color; ?> 10%, transparent 10%),radial-gradient(<?php echo $welcome_bg_color; ?> 10%, transparent 10%);
	}

}
<?php } // $welcome_bg_color ?>
@media screen and (min-width:786px) {
<?php
	// Don't do anything if the current main color is the default.
	if ( $default_options['main_color'] != $main_color ) {
?>
	/* Main Color */
	#site-navigation div.menu > ul > li:hover li:hover > a,
	#site-navigation ul li:hover ul li ul li:hover > a  {
		color:<?php echo $main_color; ?>;
	}

	.topmain-widget-area .widget_tagposts ul li .ex_tag_button,
	.topmain-widget-area .widget_tagpages ul li .ex_tag_button {
		background-color:<?php echo $main_color; ?>;
	}

	#site-navigation ul li ul li a {
		border-color:<?php echo $main_color; ?>;
	}
<?php } // $main_color
	// Don't do anything if the current link color is the default.
	if ( $default_options['link_color'] != $link_color ) {
?>
	/* Link Color */
	#site-navigation div.menu > ul > li:hover > a,
	#site-navigation ul li ul li ul li a,
	#site-navigation div.menu > ul > li:hover > ul > li {
		background-color:<?php echo $link_color; ?>;
	}
<?php } // $link_color
 	// Don't do anything if the current sub light color is the default.
	if ( $default_options['sub_light_color'] != $sub_light_color ) {
?>
	/* Sub Light Color */
	#site-navigation div.menu > ul > li:hover li:hover > a,
	#site-navigation ul li:hover ul li ul li:hover > a  {
		background-color:<?php echo $sub_light_color; ?>;
	}
<?php } // $sub_light_color
 	// Don't do anything if the current footer widget area color is the default.
	if ( $default_options['footer_widget_color'] != $footer_widget_color ) {
?>
	.footer-widget-area {
		background-color:<?php echo $footer_widget_color?>;
	}
<?php } // $footer_widget_color
 	// Don't do anything if the current line & icon color is the default.
	if ( $default_options['line_icon_color'] != $line_icon_color ) {
?>
	.comments-area,
	.article-group,
	.post-sitemap-list ul,
	.widget_archive ul,
	.widget_categories ul,
	.widget_nav_menu ul,
	.widget_pages ul,
	.widget_meta ul,
	.widget_recent_entries ul,
	.widget_rss ul,
	.widget_recent_comments ul,
	.widget_tagposts ul,
	.widget_tagpages ul,
	.widget_catposts ul,
	.post-sitemap-list ul li:last-child,
	.widget_archive ul li:last-child,
	.widget_categories ul li:last-child,
	.widget_nav_menu ul li:last-child,
	.widget_pages ul li:last-child,
	.widget_meta ul li:last-child,
	.widget_recent_entries ul li:last-child,
	.widget_rss ul li:last-child,
	.widget_recent_comments ul li:last-child,
	.widget_tagposts ul li:last-child,
	.widget_tagpages ul li:last-child,
	.widget_catposts ul li:last-child,
	#footer-widget-area-1,
	#footer-widget-area-2,
	.widget_framedtext {
		border-color:<?php echo $line_icon_color; ?>;
	}
<?php } // $line_icon_color
	// Don't do anything if the current sub text color is the default.
	if ( $default_options['text_sub_color'] != $text_sub_color ) {
?>
	#site-navigation div.menu > ul > li:hover > a,
	#site-navigation div.menu > ul > li::before,
	#site-navigation div.menu > ul > li:last-child::after,
	.topmain-widget-area .widget_tagposts ul li .ex_tag_button a,
	.topmain-widget-area .widget_tagpages ul li .ex_tag_button a {
		color:<?php echo $text_sub_color; ?>;
	}
<?php } // $text_sub_color ?>
}
</style>
<?php
}
add_action( 'wp_head', 'fsvbasic_print_color_style' );

/**
 * Register postMessage support.
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 *
 * @since FSVBASIC 1.1
 */

if ( ! function_exists( 'fsvbasic_customize_register' ) ) :

function fsvbasic_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	$options  = fsvbasic_get_theme_options();
	$defaults = fsvbasic_get_default_theme_options();

	// Color Scheme Settings
	/*$wp_customize->add_setting( 'fsvbasic_theme_options[color_scheme]', array(
		'default'    => $defaults['color_scheme'],
		'type'       => 'option',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'esc_html',
	) );

	$schemes = fsvbasic_color_schemes();
	$choices = array();

	foreach ( $schemes as $scheme ) {
		$choices[ $scheme['value'] ] = $scheme['label'];
	}

	$wp_customize->add_control( 'fsvbasic_color_scheme', array(
		'label'    => __( 'Color Scheme', 'fsvbasic' ),
		'section'  => 'colors',
		'settings' => 'fsvbasic_theme_options[color_scheme]',
		'type'     => 'radio',
		'choices'  => $choices,
		'priority' => 5,
	) );*/

	// Main Color (added to Color Scheme section in Customizer)
	$wp_customize->add_setting( 'fsvbasic_theme_options[main_color]', array(
		'default'           => $defaults['main_color'],
		'type'              => 'option',
		'sanitize_callback' => 'sanitize_hex_color',
		'capability'        => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'main_color', array(
		'label'    => __( 'Main Color', 'fsvbasic' ),
		'description'    => __( 'Colors used in the major components.<br>Main Menu, Pager, Calendar Header etc...', 'fsvbasic' ),
		'section'  => 'colors',
		'settings' => 'fsvbasic_theme_options[main_color]',
	) ) );

	// Link Color (added to Color Scheme section in Customizer)
	$wp_customize->add_setting( 'fsvbasic_theme_options[link_color]', array(
		'default'           => $defaults['link_color'],
		'type'              => 'option',
		'sanitize_callback' => 'sanitize_hex_color',
		'capability'        => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
		'label'    => __( 'Link - Main Color', 'fsvbasic' ),
		'description'    => __( 'Colors used in link components.<br>Text Link, Main Menu Hover(for PC) etc...', 'fsvbasic' ),
		'section'  => 'colors',
		'settings' => 'fsvbasic_theme_options[link_color]',
	) ) );

	// Sub Light Color (added to Color Scheme section in Customizer)
	$wp_customize->add_setting( 'fsvbasic_theme_options[sub_light_color]', array(
		'default'           => $defaults['sub_light_color'],
		'type'              => 'option',
		'sanitize_callback' => 'sanitize_hex_color',
		'capability'        => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sub_light_color', array(
		'label'    => __( 'Link - Sub Color', 'fsvbasic' ),
		'description'    => __( 'Colors used in mainly link components.<br>Main Menu Hover(for Smart Devices), Sub Menu Hover, Form Components Background etc...', 'fsvbasic' ),
		'section'  => 'colors',
		'settings' => 'fsvbasic_theme_options[sub_light_color]',
	) ) );

	// Footer Widget Area Color (added to Color Scheme section in Customizer)
	$wp_customize->add_setting( 'fsvbasic_theme_options[footer_widget_color]', array(
		'default'           => $defaults['footer_widget_color'],
		'type'              => 'option',
		'sanitize_callback' => 'sanitize_hex_color',
		'capability'        => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_widget_color', array(
		'label'    => __( 'Background - Footer Widget Area', 'fsvbasic' ),
		'description'    => __( 'Colors used in Footer Widget Area and other.<br>Framed Text Background, Table Header Cell etc...', 'fsvbasic' ),
		'section'  => 'colors',
		'settings' => 'fsvbasic_theme_options[footer_widget_color]',
	) ) );

	// Main Text Color (added to Color Scheme section in Customizer)
	$wp_customize->add_setting( 'fsvbasic_theme_options[text_main_color]', array(
		'default'           => $defaults['text_main_color'],
		'type'              => 'option',
		'sanitize_callback' => 'sanitize_hex_color',
		'capability'        => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'text_main_color', array(
		'label'    => __( 'Text - Main Color', 'fsvbasic' ),
		'description'    => __( 'Colors used in the major sentence.', 'fsvbasic' ),
		'section'  => 'colors',
		'settings' => 'fsvbasic_theme_options[text_main_color]',
	) ) );

	// Sub Text Color (added to Color Scheme section in Customizer)
	$wp_customize->add_setting( 'fsvbasic_theme_options[text_sub_color]', array(
		'default'           => $defaults['text_sub_color'],
		'type'              => 'option',
		'sanitize_callback' => 'sanitize_hex_color',
		'capability'        => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'text_sub_color', array(
		'label'    => __( 'Text - Sub Color', 'fsvbasic' ),
		'description'    => __( 'Text color to match the main color.<br>Main Menu Text,Pager Arrow Icon etc...', 'fsvbasic' ),
		'section'  => 'colors',
		'settings' => 'fsvbasic_theme_options[text_sub_color]',
	) ) );


	// Line & Icon Color (added to Color Scheme section in Customizer)
	$wp_customize->add_setting( 'fsvbasic_theme_options[line_icon_color]', array(
		'default'           => $defaults['line_icon_color'],
		'type'              => 'option',
		'sanitize_callback' => 'sanitize_hex_color',
		'capability'        => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'line_icon_color', array(
		'label'    => __( 'Line & Icon Color', 'fsvbasic' ),
		'description'    => __( 'Colors used in list mark icons and other.<br>Comments Icon, Tag Cloud Icon, Content Title & List Underline, Table Line etc...', 'fsvbasic' ),
		'section'  => 'colors',
		'settings' => 'fsvbasic_theme_options[line_icon_color]',
	) ) );

	// Header Logo Setting - Add Section
	$wp_customize->add_section( 'fsvbasic_header_logo' , array(
		'title'		=> __( 'Logo', 'fsvbasic' ),
		'priority'	=> 80,
	) );

	// Header Logo Setting - Header Logo Image Control
	$wp_customize->add_setting( 'fsvbasic_theme_options[header_logo]' , array(
		'default'   => $defaults['header_logo'],
		'type'      => 'option',
		'capability'=> 'edit_theme_options',
		'sanitize_callback' => 'esc_url',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'fsvbasic_header_logo', array(
		'label'		=> __('Image Logo','fsvbasic'),
		'description'    => __('Images recommends 300 pixels or less width.', 'fsvbasic'),
		'section'	=> 'fsvbasic_header_logo',
		'settings'	=> 'fsvbasic_theme_options[header_logo]',
	) ) );


	// Header Text Area - Add Section
	$wp_customize->add_section( 'fsvbasic_header_settings' , array(
		'title'    => __( 'Header Text Area', 'fsvbasic' ),
		'priority' => 81,
	) );

	// Header Text Area - Link Sitemap
	$wp_customize->add_setting( 'fsvbasic_theme_options[link_sitemap]' , array(
		'default'   => $defaults['link_sitemap'],
		'type'      => 'option',
		'capability'=> 'edit_theme_options',
		'sanitize_callback' => 'esc_url',
	) );

	$wp_customize->add_control( 'fsvbasic_link_sitemap' , array(
		'label'    => __('Header Sitemap Link URL', 'fsvbasic'),
		'description'    => __('Paste or Type URL.', 'fsvbasic'),
		'section'  => 'fsvbasic_header_settings',
		'settings' => 'fsvbasic_theme_options[link_sitemap]',
		'type'     => 'text',
		'priority' => 1,
	) );

	// Header Text Area - Link Contact
	$wp_customize->add_setting( 'fsvbasic_theme_options[link_contact]' , array(
		'default'   => $defaults['link_contact'],
		'type'      => 'option',
		'capability'=> 'edit_theme_options',
		'sanitize_callback' => 'esc_url',
	) );

	$wp_customize->add_control( 'fsvbasic_link_contact' , array(
		'label'    => __('Contact Page Link URL', 'fsvbasic'),
		'description'    => __('Paste or Type URL.', 'fsvbasic'),
		'section'  => 'fsvbasic_header_settings',
		'settings' => 'fsvbasic_theme_options[link_contact]',
		'type'     => 'text',
		'priority' => 2,
	) );

	// Header Text Area - Normal Text
	$wp_customize->add_setting( 'fsvbasic_theme_options[head_text]' , array(
		'default'   => $defaults['head_text'],
		'type'      => 'option',
		'capability'=> 'edit_theme_options',
		'sanitize_callback' => 'fsvbasic_text_sanitize',
	) );

	$wp_customize->add_control( 'fsvbasic_head_text' , array(
		'label'    => __('Header Information Text (Small Size)', 'fsvbasic'),
		'description'    => __('You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: &lt;a href="" target="" class="" id="" title=""&gt; &lt;br&gt; &lt;em&gt; &lt;strong&gt; &lt;span class="" id="" style=""&gt; &lt;img src="" height="" width="" alt=""&gt;', 'fsvbasic'),
		'section'  => 'fsvbasic_header_settings',
		'settings' => 'fsvbasic_theme_options[head_text]',
		'type'     => 'text',
		'priority' => 3,
	) );

	// Header Text Area - Large Text
	$wp_customize->add_setting( 'fsvbasic_theme_options[head_large_text]' , array(
		'default'   => $defaults['head_large_text'],
		'type'      => 'option',
		'capability'=> 'edit_theme_options',
		'sanitize_callback' => 'fsvbasic_text_sanitize',
	) );

	$wp_customize->add_control( 'fsvbasic_head_large_text' , array(
		'label'    => __('Header Information Text (Large Size)', 'fsvbasic'),
		'description'    => __('You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: &lt;a href="" target="" class="" id="" title=""&gt; &lt;br&gt; &lt;em&gt; &lt;strong&gt; &lt;span class="" id="" style=""&gt; &lt;img src="" height="" width="" alt=""&gt;', 'fsvbasic'),
		'section'  => 'fsvbasic_header_settings',
		'settings' => 'fsvbasic_theme_options[head_large_text]',
		'type'     => 'text',
		'priority' => 4,
	) );

	// Slide Settings - Add Section
	$wp_customize->add_section( 'fsvbasic_slide_settings' , array(
		'title'    => __( 'Slide Settings', 'fsvbasic' ),
		'priority' => 83,
	) );

	// Slide Settings - Slide 1 Picture
	$wp_customize->add_setting( 'fsvbasic_theme_options[slide1_pic]' , array(
		'default'   => $defaults['slide1_pic'],
		'type'      => 'option',
		'capability'=> 'edit_theme_options',
		'sanitize_callback' => 'esc_url',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'fsvbasic_slide1_pic', array(
		'label'		=> __( 'Slide1 Picture','fsvbasic' ),
		'description'    => __('Pictures must be 1200 pixels width and 300 pixels height.', 'fsvbasic'),
		'section'	=> 'fsvbasic_slide_settings',
		'settings'	=> 'fsvbasic_theme_options[slide1_pic]',
		'priority' => 1,
	) ) );

	// Slide Settings - Slide 1 URL
	$wp_customize->add_setting( 'fsvbasic_theme_options[slide1_url]' , array(
		'default'   => $defaults['slide1_url'],
		'type'      => 'option',
		'capability'=> 'edit_theme_options',
		'sanitize_callback' => 'esc_url',
	) );

	$wp_customize->add_control( 'fsvbasic_slide1_url' , array(
		'label'    => __( 'Slide1 Link URL', 'fsvbasic' ),
		'description'    => __('Paste or Type URL.', 'fsvbasic'),
		'section'  => 'fsvbasic_slide_settings',
		'settings' => 'fsvbasic_theme_options[slide1_url]',
		'type'     => 'text',
		'priority' => 2,
	) );

	// Slide Settings - Slide 1 Caption
	$wp_customize->add_setting( 'fsvbasic_theme_options[slide1_cap]' , array(
		'default'   => $defaults['slide1_cap'],
		'type'      => 'option',
		'capability'=> 'edit_theme_options',
		'sanitize_callback' => 'esc_html',
	) );

	$wp_customize->add_control( 'fsvbasic_slide1_cap' , array(
		'label'    => __( 'Slide1 Caption', 'fsvbasic' ),
		'description'    => __('You may not use <abbr title="HyperText Markup Language">HTML</abbr> tags.', 'fsvbasic'),
		'section'  => 'fsvbasic_slide_settings',
		'settings' => 'fsvbasic_theme_options[slide1_cap]',
		'type'     => 'text',
		'priority' => 3,
	) );

	// Slide Settings - Slide 2 Picture
	$wp_customize->add_setting( 'fsvbasic_theme_options[slide2_pic]' , array(
		'default'   => $defaults['slide2_pic'],
		'type'      => 'option',
		'capability'=> 'edit_theme_options',
		'sanitize_callback' => 'esc_url',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'fsvbasic_slide2_pic', array(
		'label'		=> __( 'Slide2 Picture','fsvbasic' ),
		'description'    => __('Pictures must be 1200 pixels width and 300 pixels height.', 'fsvbasic'),
		'section'	=> 'fsvbasic_slide_settings',
		'settings'	=> 'fsvbasic_theme_options[slide2_pic]',
		'priority' => 4,
	) ) );

	// Slide Settings - Slide 2 URL
	$wp_customize->add_setting( 'fsvbasic_theme_options[slide2_url]' , array(
		'default'   => $defaults['slide2_url'],
		'type'      => 'option',
		'capability'=> 'edit_theme_options',
		'sanitize_callback' => 'esc_url',
	) );

	$wp_customize->add_control( 'fsvbasic_slide2_url' , array(
		'label'    => __( 'Slide2 Link URL', 'fsvbasic' ),
		'description'    => __('Paste or Type URL.', 'fsvbasic'),
		'section'  => 'fsvbasic_slide_settings',
		'settings' => 'fsvbasic_theme_options[slide2_url]',
		'type'     => 'text',
		'priority' => 5,
	) );

	// Slide Settings - Slide 2 Caption
	$wp_customize->add_setting( 'fsvbasic_theme_options[slide2_cap]' , array(
		'default'   => $defaults['slide2_cap'],
		'type'      => 'option',
		'capability'=> 'edit_theme_options',
		'sanitize_callback' => 'esc_html',
	) );

	$wp_customize->add_control( 'fsvbasic_slide2_cap' , array(
		'label'    => __( 'Slide2 Caption', 'fsvbasic' ),
		'description'    => __('You may not use <abbr title="HyperText Markup Language">HTML</abbr> tags.', 'fsvbasic'),
		'section'  => 'fsvbasic_slide_settings',
		'settings' => 'fsvbasic_theme_options[slide2_cap]',
		'type'     => 'text',
		'priority' => 6,
	) );

	// Slide Settings - Slide 3 Picture
	$wp_customize->add_setting( 'fsvbasic_theme_options[slide3_pic]' , array(
		'default'   => $defaults['slide3_pic'],
		'type'      => 'option',
		'capability'=> 'edit_theme_options',
		'sanitize_callback' => 'esc_url',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'fsvbasic_slide3_pic', array(
		'label'		=> __( 'Slide3 Picture','fsvbasic' ),
		'description'    => __('Pictures must be 1200 pixels width and 300 pixels height.', 'fsvbasic'),
		'section'	=> 'fsvbasic_slide_settings',
		'settings'	=> 'fsvbasic_theme_options[slide3_pic]',
		'priority' => 7,
	) ) );

	// Slide Settings - Slide 3 URL
	$wp_customize->add_setting( 'fsvbasic_theme_options[slide3_url]' , array(
		'default'   => $defaults['slide3_url'],
		'type'      => 'option',
		'capability'=> 'edit_theme_options',
		'sanitize_callback' => 'esc_url',
	) );

	$wp_customize->add_control( 'fsvbasic_slide3_url' , array(
		'label'    => __( 'Slide3 Link URL', 'fsvbasic' ),
		'description'    => __('Paste or Type URL.', 'fsvbasic'),
		'section'  => 'fsvbasic_slide_settings',
		'settings' => 'fsvbasic_theme_options[slide3_url]',
		'type'     => 'text',
		'priority' => 8,
	) );

	// Slide Settings - Slide 3 Caption
	$wp_customize->add_setting( 'fsvbasic_theme_options[slide3_cap]' , array(
		'default'   => $defaults['slide3_cap'],
		'type'      => 'option',
		'capability'=> 'edit_theme_options',
		'sanitize_callback' => 'esc_html',
	) );

	$wp_customize->add_control( 'fsvbasic_slide3_cap' , array(
		'label'    => __( 'Slide3 Caption', 'fsvbasic' ),
		'description'    => __('You may not use <abbr title="HyperText Markup Language">HTML</abbr> tags.', 'fsvbasic'),
		'section'  => 'fsvbasic_slide_settings',
		'settings' => 'fsvbasic_theme_options[slide3_cap]',
		'type'     => 'text',
		'priority' => 9,
	) );

	// Slide Settings - Slide 4 Picture
	$wp_customize->add_setting( 'fsvbasic_theme_options[slide4_pic]' , array(
		'default'   => $defaults['slide4_pic'],
		'type'      => 'option',
		'capability'=> 'edit_theme_options',
		'sanitize_callback' => 'esc_url',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'fsvbasic_slide4_pic', array(
		'label'		=> __( 'Slide4 Picture','fsvbasic' ),
		'description'    => __('Pictures must be 1200 pixels width and 300 pixels height.', 'fsvbasic'),
		'section'	=> 'fsvbasic_slide_settings',
		'settings'	=> 'fsvbasic_theme_options[slide4_pic]',
		'priority' => 10,
	) ) );

	// Slide Settings - Slide 4 URL
	$wp_customize->add_setting( 'fsvbasic_theme_options[slide4_url]' , array(
		'default'   => $defaults['slide4_url'],
		'type'      => 'option',
		'capability'=> 'edit_theme_options',
		'sanitize_callback' => 'esc_url',
	) );

	$wp_customize->add_control( 'fsvbasic_slide4_url' , array(
		'label'    => __( 'Slide4 Link URL', 'fsvbasic' ),
		'description'    => __('Paste or Type URL.', 'fsvbasic'),
		'section'  => 'fsvbasic_slide_settings',
		'settings' => 'fsvbasic_theme_options[slide4_url]',
		'type'     => 'text',
		'priority' => 11,
	) );

	// Slide Settings - Slide 4 Caption
	$wp_customize->add_setting( 'fsvbasic_theme_options[slide4_cap]' , array(
		'default'   => $defaults['slide4_cap'],
		'type'      => 'option',
		'capability'=> 'edit_theme_options',
		'sanitize_callback' => 'esc_html',
	) );

	$wp_customize->add_control( 'fsvbasic_slide4_cap' , array(
		'label'    => __( 'Slide4 Caption', 'fsvbasic' ),
		'description'    => __('You may not use <abbr title="HyperText Markup Language">HTML</abbr> tags.', 'fsvbasic'),
		'section'  => 'fsvbasic_slide_settings',
		'settings' => 'fsvbasic_theme_options[slide4_cap]',
		'type'     => 'text',
		'priority' => 12,
	) );

	// Slide Settings - Slide 5 Picture
	$wp_customize->add_setting( 'fsvbasic_theme_options[slide5_pic]' , array(
		'default'   => $defaults['slide5_pic'],
		'type'      => 'option',
		'capability'=> 'edit_theme_options',
		'sanitize_callback' => 'esc_url',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'fsvbasic_slide5_pic', array(
		'label'		=> __( 'Slide5 Picture','fsvbasic' ),
		'description'    => __('Pictures must be 1200 pixels width and 300 pixels height.', 'fsvbasic'),
		'section'	=> 'fsvbasic_slide_settings',
		'settings'	=> 'fsvbasic_theme_options[slide5_pic]',
		'priority' => 13,
	) ) );

	// Slide Settings - Slide 5 URL
	$wp_customize->add_setting( 'fsvbasic_theme_options[slide5_url]' , array(
		'default'   => $defaults['slide5_url'],
		'type'      => 'option',
		'capability'=> 'edit_theme_options',
		'sanitize_callback' => 'esc_url',
	) );

	$wp_customize->add_control( 'fsvbasic_slide5_url' , array(
		'label'    => __( 'Slide5 Link URL', 'fsvbasic' ),
		'description'    => __('Paste or Type URL.', 'fsvbasic'),
		'section'  => 'fsvbasic_slide_settings',
		'settings' => 'fsvbasic_theme_options[slide5_url]',
		'type'     => 'text',
		'priority' => 14,
	) );

	// Slide Settings - Slide 5 Caption
	$wp_customize->add_setting( 'fsvbasic_theme_options[slide5_cap]' , array(
		'default'   => $defaults['slide5_cap'],
		'type'      => 'option',
		'capability'=> 'edit_theme_options',
		'sanitize_callback' => 'esc_html',
	) );

	$wp_customize->add_control( 'fsvbasic_slide5_cap' , array(
		'label'    => __( 'Slide5 Caption', 'fsvbasic' ),
		'description'    => __('You may not use <abbr title="HyperText Markup Language">HTML</abbr> tags.', 'fsvbasic'),
		'section'  => 'fsvbasic_slide_settings',
		'settings' => 'fsvbasic_theme_options[slide5_cap]',
		'type'     => 'text',
		'priority' => 15,
	) );

	// Welcome Message Area Component - Add Section
	$wp_customize->add_section( 'fsvbasic_welcome_settings' , array(
		'title'    => __( 'Welcome Message', 'fsvbasic' ),
		'priority' => 84,
	) );

	// Welcome Message Component - Title
	$wp_customize->add_setting( 'fsvbasic_theme_options[welcome_title]' , array(
		'default'   => $defaults['welcome_title'],
		'type'      => 'option',
		'capability'=> 'edit_theme_options',
		'sanitize_callback' => 'esc_html',
	) );

	$wp_customize->add_control( 'fsvbasic_welcome_title' , array(
		'label'    => __('Welcome Message Title', 'fsvbasic'),
		'description'    => __('You may not use <abbr title="HyperText Markup Language">HTML</abbr> tags.', 'fsvbasic'),
		'section'  => 'fsvbasic_welcome_settings',
		'settings' => 'fsvbasic_theme_options[welcome_title]',
		'type'     => 'text',
		'priority' => 1,
	) );

	// Welcome Message Component - Message Text
	$wp_customize->add_setting( 'fsvbasic_theme_options[welcome_text]' , array(
		'default'   => $defaults['welcome_text'],
		'type'      => 'option',
		'capability'=> 'edit_theme_options',
		'sanitize_callback' => 'fsvbasic_text_sanitize',
	) );

	$wp_customize->add_control( 'fsvbasic_welcome_text' , array(
		'label'    => __('Welcome Message Text', 'fsvbasic'),
		'description'    => __('You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: &lt;a href="" target="" class="" id="" title=""&gt; &lt;br&gt; &lt;em&gt; &lt;strong&gt; &lt;span class="" id="" style=""&gt; &lt;img src="" height="" width="" alt=""&gt;', 'fsvbasic'),
		'section'  => 'fsvbasic_welcome_settings',
		'settings' => 'fsvbasic_theme_options[welcome_text]',
		'type'     => 'textarea',
		'priority' => 2,
	) );

	// Welcome Message Background Color
	$wp_customize->add_setting( 'fsvbasic_theme_options[welcome_bg_color]', array(
		'default'           => $defaults['welcome_bg_color'],
		'type'              => 'option',
		'sanitize_callback' => 'sanitize_hex_color',
		'capability'        => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'welcome_bg_color', array(
		'label'    => __( 'Welcome Message Background Color', 'fsvbasic' ),
		'description'    => __('Select color of the background dot pattern. It will be a little dark shades in Firefox.', 'fsvbasic'),
		'section'  => 'fsvbasic_welcome_settings',
		'settings' => 'fsvbasic_theme_options[welcome_bg_color]',
		'priority' => 3,
	) ) );

	// Footer Area Component - Add Section
	$wp_customize->add_section( 'fsvbasic_footer_settings' , array(
		'title'    => __( 'Footer', 'fsvbasic' ),
		'priority' => 121,
	) );

	// Footer Area Component - Footer Text
	$wp_customize->add_setting( 'fsvbasic_theme_options[foot_text]' , array(
		'default'   => $defaults['foot_text'],
		'type'      => 'option',
		'capability'=> 'edit_theme_options',
		'sanitize_callback' => 'fsvbasic_text_sanitize',
	) );

	$wp_customize->add_control( 'fsvbasic_foot_text' , array(
		'label'    => __('Footer Text', 'fsvbasic'),
		'description'    => __('You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: &lt;a href="" target="" class="" id="" title=""&gt; &lt;br&gt; &lt;em&gt; &lt;strong&gt; &lt;span class="" id="" style=""&gt; &lt;img src="" height="" width="" alt=""&gt;', 'fsvbasic'),
		'section'  => 'fsvbasic_footer_settings',
		'settings' => 'fsvbasic_theme_options[foot_text]',
		'type'     => 'text',
		'priority' => 1,
	) );

}
add_action( 'customize_register', 'fsvbasic_customize_register' );

endif; // if ( ! function_exists( 'fsvbasic_customize_register' ) )

/**
 * Sanitizing Input Text.
 *
 * @since FSVBASIC 1.0
 */
function fsvbasic_text_sanitize( $value ) {

	$args = array(
		'a' => array(
			'href' => array(),
			'target' => array(),
			'class' => array(),
			'id' => array(),
			'title' => array()
		),
		'br' => array(),
		'em' => array(),
		'strong' => array(),
		'span' => array(
			'style' => array(),
			'class' => array(),
			'id' => array()
		),
		'img' => array(
			'src' => array(),
			'height' => array(),
			'width' => array(),
			'alt' => array()
		),
	);

	return wp_kses( $value , $args );

}

/**
 * Enqueue Javascript postMessage handlers for the Customizer.
 *
 * @since FSVBASIC 1.0
 */
function fsvbasic_customize_preview_js() {
	wp_enqueue_script( 'fsvbasic-customizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), '20141201', true );
}
add_action( 'customize_preview_init', 'fsvbasic_customize_preview_js' );

