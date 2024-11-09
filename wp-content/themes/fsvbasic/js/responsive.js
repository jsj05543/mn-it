/**
 * This script is used for making the entire site responsive.
 *
 * @package WordPress
 * @subpackage FSVBASIC
 * @since FSVBASIC 2.0
 */

( function( $ ) {

	var v_position = 786;
	var m_position = 1218;

	$(function(){

		// Load bxSlider
		$('.main_slider').bxSlider({
			captions : true,
			startSlide : 0
		});

		// Rendering Widget Recent Entries 
		$('.widget_recent_entries a').wrap('<span class="post-title"></span>');

		$('.widget_recent_entries li').each(function(){

			$(this).find('.post-date').insertBefore($(this).find('.post-title'));

		});

		// Rendering RSS Widget
		$('.rss-widget-icon').parent('a').addClass('rss-widget-icon-link');
		$('.rss-widget-icon-link').removeClass('rsswidget');

		$('.widget_rss .widget-title').each(function(){

			$(this).find('.rss-widget-icon-link').insertAfter($(this).find('.rsswidget'));

		});

		// Rendering Calendar Widget
		$('.calendar_wrap table#wp-calendar').each(function(){

			$(this).find('tfoot').insertAfter($(this).find('tbody'));

		});

		// Rendering Tagged posts Widget
		$('.widget_tagposts img').addClass('main-tile');

		// Rendering Dropdown List (Categories, Archives)
		//$('.widget_archive select[name=archive-dropdown]').wrap('<span class="widget-dropdown"></span>');
		//$('.widget_categories select.postform').wrap('<span class="widget-dropdown"></span>');

		// Page Top Button
		var showTop = 100;

		$('body').append('<a href="javascript:void(0);" id="pagetop"><span class="dashicons dashicons-arrow-up-alt2"></span></a>');

		var pagetop = $('#pagetop');

		pagetop.on('click',function() {

			$('html,body').animate({scrollTop:'0'},500);

		});

		$(window).on('load scroll resize',function(){

			if($(window).scrollTop() >= showTop){

				pagetop.fadeIn('normal');

			} else if($(window).scrollTop() < showTop){

				pagetop.fadeOut('normal');
			}

		});

		// Toggle Menu
		var button = document.getElementById('button-toggle-menu');
		var layout = document.getElementById('layout');
		var sidebar = document.getElementById('header-nav-area');

		button.addEventListener('click', function() {
			layout.classList.toggle('active');
			sidebar.classList.toggle('active');
		});

		var w_normal = window.innerWidth;

		if ( w_normal < v_position ) {

			// Rendering for Toggle Menu
			window.name = 'window_mnu';
			$('div#page div#header-nav-area').insertBefore('div#page');

		}

	});

	var r_timer = false;

	$(window).resize(function() {

		if ( r_timer !== false ) {

			clearTimeout( r_timer );

    	}

		r_timer = setTimeout(function() {

			var w_resize = window.innerWidth;

			$(function(){

				if ( w_resize < v_position ) {

					// Rendering for Toggle Menu
					window.name = 'window_mnu';
					$('div#page div#header-nav-area').insertBefore('div#page');


				} else {

					if ( window.name != 'window_res' ) {

						// Rendering for Normal Menu
						window.name = 'window_res';
						$('div#header-nav-area').insertAfter('div#masthead');

					}

				}

			});

		}, 50);

	});

} )( jQuery );

