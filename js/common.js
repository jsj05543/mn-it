/**
 * common.js
 *
 *  version --- 3.6
 *  updated --- 2011/11/16
 */


/* !stack ------------------------------------------------------------------- */
jQuery(document).ready(function($) {
	pageScroll();
	rollover();
	popWindow();
	localNav();
	opacityOver();

	$('#hd_search input:text, #searchSec01 input:text').focus(function(){
		if(this.value==this.title){
			this.value='';
			$(this).addClass('search-change');
		};
	}).blur(function(){
		if(this.value==''){
			this.value=this.title;
			$(this).removeClass('search-change');
		};
	});
});

/* !isUA -------------------------------------------------------------------- */
var isUA = (function(){
	var ua = navigator.userAgent.toLowerCase();
	indexOfKey = function(key){ return (ua.indexOf(key) != -1)? true: false;}
	var o = {};
	o.ie      = function(){ return indexOfKey("msie"); }
	o.fx      = function(){ return indexOfKey("firefox"); }
	o.chrome  = function(){ return indexOfKey("chrome"); }
	o.opera   = function(){ return indexOfKey("opera"); }
	o.android = function(){ return indexOfKey("android"); }
	o.ipad    = function(){ return indexOfKey("ipad"); }
	o.ipod    = function(){ return indexOfKey("ipod"); }
	o.iphone  = function(){ return indexOfKey("iphone"); }
	return o;
})();
/* !fxPrint ----------------------------------------------------------------- */
(function(){
	setCSS = function(){
		elem = document.createElement('link');
		elem.setAttribute('rel','stylesheet');
		elem.setAttribute('type','text/css');
		elem.setAttribute('media','print');
		elem.setAttribute('href','/css/fx_print.css');
		document.getElementsByTagName('head')[0].appendChild(elem);
	}
	if( isUA.fx() ) window.addEventListener("load",setCSS,false); 
})();
/* !init Smart Devices ------------------------------------------------------ */
(function (){
	var parentNode = document.getElementsByTagName('head')[0];
	var viewport = {
		withzoom:'width=devise-width, initial-scale=1.0',
		android : 'width=480, user-scalable=yes, initial-scale=0.3125 maximum-scale=3',
		ipad    : 'width=1024',
		//iphonescale1  : 'width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=0'
		iphone  : 'width=device-width'
	}
	meta = document.createElement('meta');
	meta.setAttribute('name','viewport');

	if( isUA.android() ){
		meta.setAttribute('content',viewport.android);
		parentNode.appendChild(meta);
	}else if( isUA.ipad() ){
		meta.setAttribute('content',viewport.ipad);
		parentNode.appendChild(meta);
	}else if( isUA.ipod() || isUA.iphone() ){
		meta.setAttribute('content',viewport.iphone);
		parentNode.appendChild(meta);
		window.addEventListener('load', function(){ setTimeout(scrollTo, 100, 0, 1);}, false);
	}else{
	}
})();
/* !rollover ---------------------------------------------------------------- */
var rollover = function(){
	var suffix = { normal : '_no.', over   : '_on.'}
	$('a.over, a.active, img.over, input.over').each(function(){
		var a = null;
		var img = null;

		var elem = $(this).get(0);
		if( elem.nodeName.toLowerCase() == 'a' ){
			a = $(this);
			img = $('img',this);
		}else if( elem.nodeName.toLowerCase() == 'img' || elem.nodeName.toLowerCase() == 'input' ){
			img = $(this);
		}

		var src_no = img.attr('src');
		var src_on = src_no.replace(suffix.normal, suffix.over);

		if( elem.nodeName.toLowerCase() == 'a' ){
			a.bind("mouseover focus",function(){ img.attr('src',src_on); })
			 .bind("mouseout blur",  function(){ img.attr('src',src_no); });
		}else if( elem.nodeName.toLowerCase() == 'img' ){
			img.bind("mouseover",function(){ img.attr('src',src_on); })
			   .bind("mouseout", function(){ img.attr('src',src_no); });
		}else if( elem.nodeName.toLowerCase() == 'input' ){
			img.bind("mouseover focus",function(){ img.attr('src',src_on); })
			   .bind("mouseout blur",  function(){ img.attr('src',src_no); });
		}

		var cacheimg = document.createElement('img');
		cacheimg.src = src_on;
	});
};
/* !pageScroll -------------------------------------------------------------- */
var pageScroll = function(){
	jQuery.easing.easeInOutCubic = function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t + b;
		return c/2*((t-=2)*t*t + 2) + b;
	}; 
	$('a.scroll, .scroll a, .pageTop a').each(function(){
		$(this).bind("click keypress",function(e){
			e.preventDefault();
			var target  = $(this).attr('href');
			var targetY = $(target).offset().top;
			var parent  = ( isUA.opera() )? (document.compatMode == 'BackCompat') ? 'body': 'html' : 'html,body';
			$(parent).animate(
				{scrollTop: targetY },
				400,
				'easeInOutCubic',
				function(){
					location.hash = target;
				}
			);
			return false;
		});
	});
}
/* !localNav ---------------------------------------------------------------- */
var localNav = function(){
	var navClass = document.body.className.toLowerCase(),
		parent = $(".sideNavi"),
		prefix = 'lNav',
		current = 'current',
		regex = {
			a  : /l/,
			dp : [
				/l[\d]+_[\d]+_[\d]+_[\d]+/,
				/l[\d]+_[\d]+_[\d]+/,
				/l[\d]+_[\d]+/,
				/l[\d]+/
			]
		},
		route = [],
		i,
		l,
		temp,
		node;

	$("ul ul", parent).hide();

	if( navClass.indexOf("ldef") >= -1 ){
		for(i = 0, l = regex.dp.length; i < l; i++){
			temp = regex.dp[i].exec( navClass );
			if( temp ){
				route[i] = temp[0].replace(regex.a, prefix);
			}
		}
		///console.log(route);
		if( route[0] ){
			// depth 4
			node = $("a."+route[0], parent);
			node.addClass(current);
			node.next().show();
			node.parent().parent().show()
				.parent().parent().show()
				.parent().parent().show();
			node.parent().parent().prev().addClass('parent');
			node.parent().parent()
				.parent().parent().prev().addClass('parent');
			node.parent().parent()
				.parent().parent()
				.parent().parent().prev().addClass('parent');

		}else if( route[1] ){
			// depth 3
			node = $("a."+route[1], parent);
			node.addClass(current);
			node.next().show();
			node.parent().parent().show()
				.parent().parent().show();
			node.parent().parent().prev().addClass('parent');
			node.parent().parent()
				.parent().parent().prev().addClass('parent');


		}else if( route[2] ){
			// depth 2
			node = $("a."+route[2], parent);
			node.addClass(current);
			node.next().show();
			node.parent().parent().show();
			node.parent().parent().prev().addClass('parent');

		}else if( route[3] ){
			// depth 1
			node = $("a."+route[3], parent);
			node.addClass(current);
			node.next().show();

		}else{
		}
	}
}

/* !opacityOver --------------------------------------------------------------- */
var opacityOver = function(){
	$(".opacityOver").hover(
	  function () {
		$(this).stop().fadeTo(200, 0.6);
	  },
	  function () {
		$(this).stop().fadeTo(400, 1);
	  }
	);
}

/* !sideNaviSelector --------------------------------------------------------------- */
var sideNaviSelector = function(){

	$('.sideNaviList').hide();
	$('#wrapper').before('<div id="overlay"></div>');
	selectHide();
	$('.sideNaviSelected p.open').click(function () {
		selectShow();
	});
	$('.sideNaviSelected p.close').click(function () {
		selectHide();
	});

	$('.sideNaviSelector a').each(function(i){
		$(this).click(function(){
			var count = $('.sideNaviSelector a').index(this);
			var cYear = $('.sideNaviSelector a').eq(count).text();
			$('.sideNaviSelected span').html(cYear);
			$('.sideNaviSelector a').removeClass('current');
			$('.sideNaviSelector a').eq(count).addClass('current');
			$('.sideNaviList').hide();
			$('.sideNaviList').eq(count).show();
			selectHide();
			return false;
		});
	});

	$('#overlay').click(function () {
		selectHide();
	});
	function selectShow(){
		$('#overlay').show();
		$('.sideNaviSelected p.open').hide();
		$('.sideNaviSelected p.close').show();
		$('.sideNaviSelector').show();
	}
	function selectHide(){
		$('#overlay').hide();
		$('.sideNaviSelected p.open').show();
		$('.sideNaviSelected p.close').hide();
		$('.sideNaviSelector').hide();
	}
}

/* !newsSort --------------------------------------------------------------- */
var newsSort = function(){
	$(".inputNews01").click(function(){
		var val00 = $('.ulNews01 input').eq(0).attr('checked');
		if( val00 > 0 ){
			$(".dl_list01").show();
			return false;
		} else {
			$(".dl_list01").hide();
			var val01 = $('.ulNews01 input').eq(1).attr('checked');
			var val02 = $('.ulNews01 input').eq(2).attr('checked');
			var val03 = $('.ulNews01 input').eq(3).attr('checked');
			var val04 = $('.ulNews01 input').eq(4).attr('checked');
			var val05 = $('.ulNews01 input').eq(5).attr('checked');
			var val06 = $('.ulNews01 input').eq(6).attr('checked');
			var val07 = $('.ulNews01 input').eq(7).attr('checked');
			if( val01 > 0 ){
				$(".news").show();
			}
			if( val02 > 0 ){
				$(".exam").show();
			}
			if( val03 > 0 ){
				$(".event").show();
			}
			if( val04 > 0 ){
				$(".apen").show();
			}
			if( val05 > 0 ){
				$(".urgent").show();
			}
			if( val06 > 0 ){
				$(".other").show();
			}
			return false;
		}
	})
}

/* !eventSort --------------------------------------------------------------- */
var eventSort = function(){
	$(".inputNews01").click(function(){
		var val00 = $('.ulNews01 input').eq(0).attr('checked');
		if( val00 > 0 ){
			$(".dl_list01").show();
			return false;
		} else {
			$(".dl_list01").hide();
			var val01 = $('.ulNews01 input').eq(1).attr('checked');
			var val02 = $('.ulNews01 input').eq(2).attr('checked');
			if( val01 > 0 ){
				$(".seminor").show();
			}
			if( val02 > 0 ){
				$(".other").show();
			}
			return false;
		}
	})
}

/* !popWindow --------------------------------------------------------------- */
var popWindow = function (){
	var param = null;
	// param[0] = width
	// param[1] = height
	// param[2] = window.name
	$('a[class^="js_popup"], area[class^="js_popup"]').each(function(i){
		$(this).click(function(){
			var w = null;
			param = $(this).attr('class').match(/[0-9]+/g);
			// get window.name
			param[2] = window.name ? window.name+'_' : '';
			w = window.open(this.href, param[2]+'popup'+i,'width='+param[0]+',height='+param[1]+',scrollbars=yes');
			w.focus();
			return false;
		});
	});
}
/* !defFunc ----------------------------------------------------------------- */
var defFunc = (function(){
	Print = function(){ window.print(); return false;}
	Close = function(){ window.close(); return false;}
})();
