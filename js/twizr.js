/**
 * Twizr
 *
 * @package			WordPress
 * @subpackage		Twizr
 * @author			RogerTM
 * @license			license.txt
 * @link			https://themingisprose.com/twenty-em
 * @since 			Twizr 1.0
 */
jQuery(document).ready(function($) {
	// Top Menu
	function twizrTopMenu(){
		var menu = $('#top-menu .navbar')
			h 	 = $('#top-menu').outerHeight();
		$(window).scroll(function(){
			if ($('body,html').scrollTop() > Number(h)){
				$(menu).addClass('nav-primary');
				$(menu).removeClass('nav-transparent');
			}else{
				$(menu).removeClass('nav-primary');
				$(menu).addClass('nav-transparent');
			}
		});
	};
	twizrTopMenu();

	// Hide header on scroll down, show on scroll up
	// http://jsfiddle.net/mariusc23/s6mLJ/31/
	function twizrMenuScroll( target, height ){
		// Hide Header on on scroll down
		var didScroll;
		var lastScrollTop = 0;
		var delta = 5;
		var targetHeight = height;

		$(window).scroll(function(event){
		    didScroll = true;
		});

		setInterval(function() {
		    if (didScroll) {
		        hasScrolled();
		        didScroll = false;
		    }
		}, 250);

		function hasScrolled() {
		    var st = $(this).scrollTop();

		    // Make sure they scroll more than delta
		    if(Math.abs(lastScrollTop - st) <= delta)
		        return;

		    // If they scrolled down and are past the target. Do stuff.
		    // This is necessary so you never see what is "behind" the target.
		    if (st > lastScrollTop && st > targetHeight){
		        // Scroll Down
		        $(target).fadeOut();
		    } else {
		        // Scroll Up
		        if(st + $(window).height() < $(document).height()) {
		            $(target).fadeIn();
		        }
		    }

		    lastScrollTop = st;
		}
	}
	twizrMenuScroll( $('#top-menu'), $('#header').outerHeight() );

	// Display App version
	function twizrAppVersion(){
		var content	= $('#front-page-widget-one .jumbo-widget-heading')
			version = '<small> <code class="">v'+ twizrl10n.appVersion +'</code></small>';
		$(version).appendTo(content);
	}
	twizrAppVersion();

	// Add id attr in single entries and anchor'em
	$(function(){
		$('article .entry-content > h1, article .entry-content > h2, article .entry-content > h3, article .entry-content > h4, article .entry-content > h5, article .entry-content > h6').each(function(index){
			var $id = $(this).text().split(' ').join('-').split('"').join('').toLowerCase();
			$(this).attr({
				'id':$id,
				'class':'h-anchor'
			});
			$(this).prepend('<a href="#'+$id+'" class="anchor scroll-to" data-target="#'+$id+'" data-anchorjs-icon="#"></a>').wrapInner('<div></div>');
		});
	});

	// Get some <a> elements
	$('article.doc a').click(function(e){
		var	item	= $(this);
		if ( item.attr('href') == '#' ){
			e.preventDefault();
		}
	});

	// Run function on resize
	$(window).resize(function(){
		twizrTopMenu();
		twizrMenuScroll( $('#top-menu'), $('#header').outerHeight() );
	});
});
