"use strict";

/*
 **	Cryptronick preloader
 */
(function cryptronick_preloader () {
	setTimeout(function(){
		jQuery('#preloader-wrapper').fadeOut();
	},8000);
}());

/*
 **	Plugin for counter shortcode
 */
(function($) {
    "use strict";

    $.fn.countTo = function(options) {
        // merge the default plugin settings with the custom options
        options = $.extend({}, $.fn.countTo.defaults, options || {});

        // how many times to update the value, and how much to increment the value on each update
        var loops = Math.ceil(options.speed / options.refreshInterval),
            increment = (options.to - options.from) / loops;

        return $(this).each(function() {
            var _this = this,
                loopCount = 0,
                value = options.from,
                interval = setInterval(updateTimer, options.refreshInterval);

            function updateTimer() {
                value += increment;
                loopCount++;
                $(_this).html(value.toFixed(options.decimals));

                if (typeof(options.onUpdate) === 'function') {
                    options.onUpdate.call(_this, value);
                }

                if (loopCount >= loops) {
                    clearInterval(interval);
                    value = options.to;

                    if (typeof(options.onComplete) === 'function') {
                        options.onComplete.call(_this, value);
                    }
                }
            }
        });
    };

    $.fn.countTo.defaults = {
        from: 0,  // the number the element should start at
        to: 100,  // the number the element should end at
        speed: 1000,  // how long it should take to count between the target numbers
        refreshInterval: 100,  // how often the element should be updated
        decimals: 0,  // the number of decimal places to show
        onUpdate: null,  // callback method for every time the element is updated,
        onComplete: null  // callback method for when the element finishes updating
    };
})(jQuery);

is_visible_init ();
cryptronick_shop_animation_init();
cryptronick_slick_slider_arrows_init();

jQuery(document).ready(function($) {
	cryptronick_image_particles ();
	var ie = (function(){

	    var undef,
	        v = 3,
	        div = document.createElement('div'),
	        all = div.getElementsByTagName('i');
	    
	    while (
	        div.innerHTML = '<!--[if gt IE ' + (++v) + ']><i></i><![endif]-->',
	        all[0]
	    );
	   
	    return v > 4 ? v : undef;
	    
	}());

	if (ie == 9) {
		jQuery('body').addClass('ie_9');
	}

	cryptronick_search();
	cryptronick_mobile_menu();
	cryptronick_menu_line();
	cryptronick_sticky_header ();
	cryptronick_message_close();
	cryptronick_back_to_top();
	cryptronick_link_scroll();

	//Flickr Widget
	if (jQuery('.flickr_widget_wrapper').size() > 0) {
		jQuery('.flickr_badge_image a').each(function() {
			jQuery(this).append('<div class="flickr_fadder"></div>');
		});
	}

	//Blank Anchors
	jQuery('a[href="#"]').on('click', function(e) {
		e.preventDefault();
	});

	// Nivoslider
	if (jQuery('.nivoSlider').size() > 0) {
		jQuery('.nivoSlider').each(function() {
			jQuery(this).nivoSlider({
				directionNav: true,
				controlNav: false,
				effect:'fade',
				pauseTime:4000,
				slices: 1
			});
		});
	}

	// bpt Carousel List
	cryptronick_carousel_slick ();

	// bpt Countdown
	cryptronick_countdown_module ();

	// bpt Flicker Widget
	cryptronick_flickr_widget ();

	// bpt Popup Video
	cryptronick_popup_video ();

	// bpt Time Line Appear
	cryptronick_init_timeline_appear ();

	// bpt Time Line Appear
	cryptronick_init_timeline_horizontal_appear ();

	// bpt Time Line Appear
	cryptronick_init_ico_progress_appear ();

	// bpt Image Layers
	cryptronick_img_layers ();

	cryptronick_includes_js ();

	// bpt Shop Animation
	jQuery( 'ul.bpt-products.animated_products li' ).cryptronick_shop_animation();

	// bpt Shop counter
	cryptronick_woocommerce_qty();

	jQuery( '.bpt_module_title .carousel_arrows' ).cryptronick_slick_slider_arrows();

});


function cryptronick_includes_js () {
	if (jQuery('.cryptronick_module_counter').length) {
		// bpt Counter
		cryptronick_initCounter();
	}
}

function cryptronick_popup_video () {
	if (jQuery(".swipebox_video, .swipebox").length) {
		jQuery( '.swipebox_video, .swipebox' ).swipebox( {
			useCSS : true, // false will force the use of jQuery for animations
			useSVG : true, // false to force the use of png for buttons
			initialIndexOnArray : 0, // which image index to init when a array is passed
			hideCloseButtonOnMobile : false, // true will hide the close button on mobile devices
			removeBarsOnMobile : true, // false will show top bar on mobile devices
			hideBarsDelay : 3000, // delay before hiding bars on desktop
			videoMaxWidth : 1140,
			autoplayVideos: false,
			beforeOpen: function() {}, // called before opening
			afterOpen: null, // called after opening
			afterClose: function() {}, // called after closing
			loopAtEnd: false // true will return to the first image after the last image is reached
		} );
	}
}

function cryptronick_back_to_top(){
	var W_height = jQuery(window).height();
	var element = jQuery('#back_to_top');
	if (element.length) {
		element.on('click',function(){
			jQuery('body,html').animate({
				scrollTop: 0
			}, 500);
			return false;
		});		
		var show_back_to_top = function (){
			if (jQuery(document).scrollTop() < W_height) {
	        	element.removeClass('show');
	        }else{
	        	element.addClass('show');
	        }
		}
		show_back_to_top();
		jQuery(window).scroll(function() {
	        show_back_to_top();
	    });
	}	
}

// menu line
function cryptronick_menu_line(){
	var menu = jQuery('.main-menu.main_menu_container.menu_line_enable > ul');
	if (menu.length) {
		menu.each(function(){
			var menu = jQuery(this);
			var current = '';
			menu.append('<span class="menu_item_line"></span>');
			var menu_item = menu.find('> .menu-item');
			var currentItem = menu.find('> .current-menu-item');
			var currentItemParent = menu.find('> .current-menu-ancestor');
			var line = menu.find('.menu_item_line');
			if (currentItem.length || currentItemParent.length) {
				current = currentItem.length ? currentItem : (currentItemParent.length ? currentItemParent : '');
				line.css({width: current.find('>a').outerWidth()});
				line.css({left: current.find('>a').offset().left - menu.offset().left});
			}

			menu_item.mouseenter(function(){
                line.css({width: jQuery(this).find('> a').outerWidth()});
                line.css({left: jQuery(this).find('> a').offset().left - jQuery(this).parent().offset().left});
            });

            menu.mouseleave(function(){
                if (current.length) {
                    line.css({width: current.find('> a').outerWidth()});
                    line.css({left: current.find('> a').offset().left - menu.offset().left});
                } else {
                	line.css({width:'0'});
                    line.css({left:'100%'});
                }
            });


		})
	}
}

function cryptronick_sticky_header (){
	if (jQuery(window).width() > 1200) {
		var stickyNumber = jQuery('header.bpt-theme-header').height();
		var stickyHeader = jQuery('header.bpt-theme-header > .bpt-sticky-header');
		var docScroll = jQuery(document).scrollTop();
		var docScrollNext = jQuery(document).scrollTop();
		if (stickyHeader.length) {
			var stickyType = stickyHeader.attr('data-sticky-type');
			if (stickyHeader[0].hasAttribute('data-sticky-number')) {
				stickyNumber = stickyHeader.attr('data-sticky-number');
			}
			var stickyOn = function(){
				docScroll = jQuery(document).scrollTop();
				if (stickyType == 'classic') {
					if (docScroll < stickyNumber) {
						stickyHeader.removeClass('sticky_on')
					}else{
						stickyHeader.addClass('sticky_on')
					}
				}else{
					if (( docScrollNext < docScroll) || (docScroll < stickyNumber) ) {
						stickyHeader.removeClass('sticky_on')
					}else{
						stickyHeader.addClass('sticky_on')
					}				
				}	
				docScrollNext = jQuery(document).scrollTop();		

			}
			stickyOn();
			jQuery(window).scroll(function() {
	            stickyOn();
	        });
		}
	}

}

// mobile menu
function cryptronick_mobile_menu(){
	var windowW = jQuery(window)
	var loaded = false;
	var main_menu = jQuery('.mobile_menu_container .main-menu > ul');
	var mobile_width = jQuery('.mobile_menu_container').data( "mobileWidth" );
	var sub_menu = jQuery('.mobile_menu_container .main-menu > ul ul');
	var mobile_toggle = jQuery('.mobile-navigation-toggle');
	if (windowW.width() <= mobile_width) {
		sub_menu.hide().removeClass('showsub')
		main_menu.hide().addClass('mobile_view_on');
		loaded = true;
		cryptronick_mobile_menu_switcher(main_menu)		
	}else{
		sub_menu.show();
		main_menu.show();
	}

	jQuery(window).resize(function() {
		if (windowW.width() <= mobile_width) {
			if (!mobile_toggle.hasClass('is-active')) {
				sub_menu.hide().removeClass('showsub')
				main_menu.hide().removeClass('showsub').addClass('mobile_view_on');
				mobile_toggle.removeClass('is-active')
			}
			if (loaded == false) {
				loaded = true;
				cryptronick_mobile_menu_switcher(main_menu)
			}		
		}else{
			sub_menu.show().removeClass('showsub');
			main_menu.show().removeClass('showsub').removeClass('mobile_view_on');
			mobile_toggle.removeClass('is-active')
		}
	});
}
// end mobile menu 

function cryptronick_mobile_menu_switcher(main_menu){
	if (jQuery(main_menu).find('.menu-item-has-children > .mobile_sitcher').length == 0) {
		jQuery(main_menu).find('.menu-item-has-children').append('<div class="mobile_sitcher"></div>')
	}
	jQuery('.mobile-navigation-toggle').on("tap click", function() {
		var element = jQuery(this);
		if (element.hasClass('is-active')) {
			main_menu.removeClass('showsub').slideUp(200)
			element.removeClass('is-active')
		}else{
			main_menu.addClass('showsub').slideDown(200)
			element.addClass('is-active')
		}
	});

	jQuery(main_menu).find('.menu-item-has-children > .mobile_sitcher , .menu-item-has-children > a[href*=#]').on("tap click", function(e) {
		e.preventDefault();
		var element = jQuery(this);
		if (element.hasClass('is-active')) {
			element.prev('ul.sub-menu').removeClass('showsub').slideUp(200)
			element.next('ul.sub-menu').removeClass('showsub').slideUp(200)
			element.removeClass('is-active')
		}else{
			element.prev('ul.sub-menu').addClass('showsub').slideDown(200)
			element.next('ul.sub-menu').addClass('showsub').slideDown(200)
			element.addClass('is-active')
		}
	});
}

function cryptronick_search(){
	var top_search = jQuery('.header_search');

	if (top_search.size() > 0) {

		var openSearch = function () {
				top_search.addClass('search-open');
				setTimeout(function(){
					top_search.find('input.search_text').focus();
				}, 100);
				return false;
			},
			closeSearch = function () {
				top_search.removeClass('search-open');
			};

		top_search.find('.header_search__icon').on('click', function (e) {
			e.stopPropagation();
			if (!top_search.hasClass('search-open')) {
				openSearch();
			}
		});
		top_search.find('.header_search__icon-close').on('click', function (e) {
			if (top_search.hasClass('search-open')) {
				closeSearch();
			}
		});
		jQuery('body > *:not(header)').on('click', function (e) {
			if (top_search.hasClass('search-open')) {
				closeSearch();
			}
		});

	}
}

function cryptronick_message_close(){
	jQuery(".cryptronick_module_message_box.closable").each(function(){
		var element = jQuery(this);
		element.find('.message_close_button').on('click',function(){
			element.slideUp(300);
		})
	})
}

jQuery(window).load(function() {
	cryptronick_isotope ();
	cryptronick_blog_isotope_js ();
	resize_visual ();
	setTimeout(function(){
		jQuery('#preloader-wrapper').fadeOut();
	},1100);
	particles_custom ();
	jQuery(".bpt-currency-stripe_scrolling").each(function(){
    	jQuery(this).simplemarquee({
	        speed: 40,
	        space: 0,
	        handleHover: true,
	        handleResize: true
	    });
    })
});

function resize_visual () {
	if (jQuery('.vc_row-o-full-height').length) {
		var w = window.innerWidth;
		var leftPosition = jQuery('.vc_row-o-full-height')[0].style.left;
		var re = /\d+/i;
		var found = leftPosition.match(re);
		if(found){
			var found = parseInt(found[0], 10) + 9;
			jQuery('.vc_row-o-full-height')[0].style.width = w + "px";
			jQuery('.vc_row-o-full-height')[0].style.left = -found + "px";			
		}

	}
}

// -------------------- //
// --- bpt COMPOSER --- //
// -------------------- //

// bpt Counter
function cryptronick_initCounter() {

    var counters = jQuery('.counter_value');

    if (counters.length) {
        counters.each(function() {
            var counter = jQuery(this);
            counter.appear(function() {
                var max = parseFloat(counter.text());
                counter.countTo({
                    from: 0,
                    to: max,
                    speed: 1500,
                    refreshInterval: 100
                });
            });
        });
    }

}

// bpt Time Line Appear
function cryptronick_init_timeline_appear() {

    var item = jQuery('.cryptronick_module_time_line_vertical.appear_anim .time_line-item');

    if (item.length) {
        item.each(function() {
            var item = jQuery(this);
            item.appear(function() {
                item.addClass('item_show');
            });
        });
    }

}

// bpt Time Line Horizontal Appear
function cryptronick_init_timeline_horizontal_appear() {

    var item = jQuery('.cryptronick_module_time_line_horizontal.appear_anim');
    var duration = 250;
    if (item.length) {
        item.each(function() {
            var item = jQuery(this);
            item.appear(function() {
				item.find('.time_line-item').each(function(index){
					jQuery(this).delay(duration * index).animate({
						opacity:1
					},duration);
				})
            });
        });
    }

}

// bpt Time Line Appear
function cryptronick_init_ico_progress_appear() {

    var item = jQuery('.cryptronick_module_ico_progress');

    if (item.length) {
        item.each(function() {
            var item = jQuery(this),
            	item_bar = item.find('.progress_completed'),
            	data_width = item_bar.data('width')
            item.appear(function() {
                item_bar.css('width',data_width+'%');
            });
        });
    }

}

// bpt Image Layers
function cryptronick_img_layers() {
	jQuery('.cryptronick_module_img_layer').each(function() {
		var container = jQuery(this);
		var initImageLayers = function(){
			container.appear(function() {
				container.addClass('img_layer_animate');
            },{done:true})
		}
		jQuery(window).on('resize', initImageLayers);
		jQuery(window).on('load', initImageLayers);
	});
}

function cryptronick_isotope () {
	if (jQuery(".isotope").length) {

		var portfolio_dom = jQuery(".isotope").get(0);
		var $grid =	imagesLoaded( portfolio_dom, function() {
			// initialize masonry
			jQuery(".isotope").isotope({
		        layoutMode: 'masonry',
		        masonry: {
		            columnWidth: '.bpt_portfolio_list-item, .item',
		        },
				itemSelector: '.bpt_portfolio_list-item, .item',
				percentPosition: true
			});
			jQuery(window).trigger('resize');
		
		});
	
		jQuery(".isotope-filter a").each(function(){
			var data_filter = this.getAttribute("data-filter");
			var num = jQuery(this).closest('.bpt_portfolio_list').find('.bpt_portfolio_list-item').filter( data_filter ).length;
			jQuery(this).find('.number_filter').text( num );
		});
	}

	var $filterCount = jQuery('.number_filter');
	jQuery(".isotope-filter a").on("click", function (e){
		e.preventDefault();
		var data_filter = this.getAttribute("data-filter");
		jQuery(this).siblings().removeClass("active");
		jQuery(this).addClass("active");
		var grid = this.parentNode.nextElementSibling;
		jQuery(grid).isotope({ filter: data_filter });
	});
}

// Blog Isotope
function cryptronick_blog_isotope_js () {
	if (jQuery(".blog_masonry").length) {
		var blog_dom = jQuery(".blog_masonry").get(0);
		var $grid =	imagesLoaded( blog_dom, function() {
			// initialize masonry
			jQuery(".blog_masonry").isotope({
		        layoutMode: 'masonry',
		        masonry: {
		            columnWidth: '.item',
		        },
				itemSelector: '.item',
				percentPosition: true
			});
			jQuery(window).trigger('resize');
		
		});
	}
}

// bpt Carousel List
function cryptronick_carousel_slick () {
	var carousel_tag = jQuery('.cryptronick_carousel_slick');
	if (carousel_tag.length) {
		carousel_tag.each(function(){
			jQuery(this).slick({
			});
		});
	}
}

// bpt Countdown
function cryptronick_countdown_module () {
	if (jQuery('.bpt-countdown').length) {
		jQuery('.bpt-countdown').each(function () {
			var year = jQuery(this).attr('data-year');
			var month = jQuery(this).attr('data-month');
			var day = jQuery(this).attr('data-day');
			var hours = jQuery(this).attr('data-hours');
			var min = jQuery(this).attr('data-min');
			var format = jQuery(this).attr('data-format');

			var austDay = new Date();
			austDay = new Date(+year, +month-1, +day, +hours, +min);
			jQuery(this).countdown({
				until: austDay,
				padZeroes: true,
				format: format,
				labels: [jQuery(this).attr('data-label_years'),jQuery(this).attr('data-label_months'),jQuery(this).attr('data-label_weeks'),jQuery(this).attr('data-label_days'),jQuery(this).attr('data-label_hours'),jQuery(this).attr('data-label_minutes'),jQuery(this).attr('data-label_seconds')],
				labels1:[jQuery(this).attr('data-label_year'),jQuery(this).attr('data-label_month'),jQuery(this).attr('data-label_week'),jQuery(this).attr('data-label_day'),jQuery(this).attr('data-label_hour'),jQuery(this).attr('data-label_minute'),jQuery(this).attr('data-label_second')]
			});
		});
	}
}

// bpt Flicker Widget
function cryptronick_flickr_widget () {
	if (jQuery('.flickr_widget_wrapper').length) {
		jQuery('.flickr_widget_wrapper').each(function () {
			var flickrid = jQuery(this).attr('data-flickrid');
			var widget_id = jQuery(this).attr('data-widget_id');
			var widget_number = jQuery(this).attr('data-widget_number');
			jQuery(this).addClass('flickr_widget_wrapper_'+flickrid);

			jQuery.getJSON("http://api.flickr.com/services/feeds/photos_public.gne?id="+widget_id+"&lang=en-us&format=json&jsoncallback=?", function(data){
				jQuery.each(data.items, function(i,item){
					if(i<widget_number){
						jQuery("<img/>").attr("src", item.media.m).appendTo(".flickr_widget_wrapper_"+flickrid).wrap("<div class=\'flickr_badge_image\'><a href=\'" + item.link + "\' target=\'_blank\' title=\'Flickr\'></a></div>");
					}
				});
			});
		});
	}
}


function is_visible_init (){
	jQuery.fn.is_visible = function (){
		var elementTop = jQuery(this).offset().top;
		var elementBottom = elementTop + jQuery(this).outerHeight();
		var viewportTop = jQuery(window).scrollTop();
		var viewportBottom = viewportTop + jQuery(window).height();
		return elementBottom > viewportTop && elementTop < viewportBottom;
	}
}

/* Shop Animation */

function cryptronick_shop_animation_init (){
	jQuery.fn.cryptronick_shop_animation = function (){
		jQuery(this).each( function ( i, l ){
			var el = jQuery(this);
			var done_shop = false;			
			if (!done_shop) done_shop = cryptronick_shop_controller(el, i);
			jQuery(window).scroll(function (){
				if (!done_shop) done_shop = cryptronick_shop_controller(el, i);
			});
		});
	}
}


function cryptronick_shop_controller (el, delay){
	if (el.is_visible()){
		setTimeout(function () {
			jQuery(el).addClass('visible_item');
		}, 250);					
		return true;
	}
	return false;
}

function cryptronick_slick_slider_arrows_init (){
	jQuery.fn.cryptronick_slick_slider_arrows = function (){
		jQuery(this).each( function (){
			var el = jQuery(this);
			jQuery(this).find('a.left_slick_arrow').on("click", function() {
				jQuery(this).closest('.bpt_cpt_section').find('.slick-prev').trigger('click');
			});
			jQuery(this).find('a.right_slick_arrow').on("click", function() {
				jQuery(this).closest('.bpt_cpt_section').find('.slick-next').trigger('click');
			});
		});
	}
}

function particles_custom () {
	jQuery('.particles-js').each(function () {
		var id = jQuery(this).attr('id');
		var color = jQuery(this).data('particles-color');
		var particle_type = jQuery(this).data('type');
		console.log(particle_type);
		if (true == particle_type) {
			var numbers = 60;
			var lines = false;
		} else {
			var numbers = 110;
			var lines = true;
		}
		
		particlesJS(
			id, {
				"particles":{
					"number":{
						"value":numbers,
						"density":{
							"enable":true,
							"value_area":800
						}
					},
					"color":{
						"value":color
					},
					"shape":{
						"type":"circle",
						"stroke":{
							"width":0,
							"color":"#000000"
						},"polygon":{
							"nb_sides":5
						},
						"image":{
							"src":"img/github.svg",
							"width":100,
							"height":100
						}
					},
					"opacity":{
						"value":0.5,
						"random":false,
						"anim":{
							"enable":false,
							"speed":1,
							"opacity_min":0.1,
							"sync":false
						}
					},
					"size":{
						"value":3,
						"random":true,
						"anim":{
							"enable":false,
							"speed":33.56643356643357,
							"size_min":0.1,
							"sync":true
						}
					},
					"line_linked":{
						"enable":lines,
						"distance":150,
						"color":color,
						"opacity":0.4,
						"width":1
					},
					"move":{
						"enable":true,
						"speed":2,
						"direction":"none",
						"random":false,
						"straight":false,
						"out_mode":"out",
						"bounce":false,
						"attract":{
							"enable":false,
							"rotateX":600,
							"rotateY":1200
						}
					}
				},
				"interactivity":{
					"detect_on":"canvas",
					"events":{
						"onhover":{
							"enable":true,
							"mode":"grab"
						},
						"onclick":{
							"enable":true,
							"mode":"push"
						},
						"resize":true
					},
					"modes":{
						"grab":{
							"distance":158.35505639876231,
							"line_linked":{
								"opacity":1
							}
						},
						"bubble":{
							"distance":400,
							"size":40,
							"duration":2,
							"opacity":8,
							"speed":3
						},
						"repulse":{
							"distance":200,
							"duration":0.4
						},
						"push":{"particles_nb":4},
						"remove":{"particles_nb":2}
					}
				},
				"retina_detect":true
			});
		var count_particles, stats, update;
		update = function() {
			requestAnimationFrame(update); 
		}; 
		requestAnimationFrame(update);
	})
}

function cryptronick_link_scroll () {
	jQuery('a.smooth-scroll').on('click', function(event){
	    jQuery('html, body').animate({
	        scrollTop: jQuery( jQuery.attr(this, 'href') ).offset().top
	    }, 500);
	    event.preventDefault();
	});
}

function cryptronick_woocommerce_qty(){
	jQuery('.quantity.number-input span.minus').on( "click", function() {
  		this.parentNode.querySelector('input[type=number]').stepDown();
  		if(document.querySelector('.woocommerce-cart-form [name=update_cart]')){
  			document.querySelector('.woocommerce-cart-form [name=update_cart]').disabled = false;
  		}
	});	

	jQuery('.quantity.number-input span.plus').on( "click", function() {
		this.parentNode.querySelector('input[type=number]').stepUp();
  		if(document.querySelector('.woocommerce-cart-form [name=update_cart]')){
  			document.querySelector('.woocommerce-cart-form [name=update_cart]').disabled = false;
  		}
	});
}

//BPT Ajax Loading Content
( function ($){

	jQuery(document).ready(function (){	
		cryptronick_ajax_load();
	});
	
	function cryptronick_ajax_load (){
		var i, section;
		var sections = document.getElementsByClassName( 'bpt_cpt_section' );
		for ( i = 0; i < sections.length; i++ ){
			section = sections[i];
			cryptronick_ajax_init ( section );
		}
	}
	var wait_load = false;
	function cryptronick_ajax_init ( section ){

		var grid, form, data_field, data, request_data, load_more;

		var offset_items = 0;
		if ( section == undefined ) return;
		grid = section.getElementsByClassName( 'container-grid' );
		
		if ( !grid.length ) return;
		grid = grid[0];
		
		form = section.getElementsByClassName( 'posts_grid_ajax' );
		if ( !form.length ) return;
		form = form[0];
		data_field = form.getElementsByClassName( 'ajax_data' );
		if ( !data_field.length ) return;
		data_field = data_field[0];
		data = data_field.value;
		data = JSON.parse( data );
		request_data =  data;

		offset_items += request_data.post_count;
		
		load_more = section.getElementsByClassName( 'load_more_item' );
		if ( load_more.length ){
			load_more = load_more[0];
			load_more.addEventListener( 'click', function ( e ){
				if ( wait_load ) return;
				wait_load = true;
				jQuery(this).addClass('loading');
				e.preventDefault();
				request_data['offset_items'] = offset_items;
				request_data['items_load'] = request_data.items_load;
				
				$.post( bpt_core.ajaxurl, {
					'action'		: 'bpt_ajax',
					'data'			: request_data

				}, function ( response, status ){
					var response_container, new_items, load_more_hidden;
					response_container = document.createElement( "div" );
					response_container.innerHTML = response;
					new_items = $( ".item", response_container );
					load_more_hidden = $( ".hidden_load_more", response_container );

					if(load_more_hidden.length){
						jQuery(section).find('.load_more_wrapper').fadeOut(300, function() { $(this).remove(); });
					}else{
						jQuery(section).find('.load_more_wrapper .load_more_item').removeClass('loading');
					}
					
					if($( grid ).hasClass('carousel')){
						$( grid ).find('.slick-track').append( new_items );
						$( grid ).find('.slick-dots').remove();
						$( grid ).find('.cryptronick_carousel_slick').slick('reinit');						
					}
					else if($( grid ).hasClass('grid')){
						new_items = new_items.hide();
						$( grid ).append( new_items );
						new_items.fadeIn('slow');							
					}else{
                        var items = jQuery(new_items);
                        jQuery(grid).isotope( 'insert', items );
                        jQuery(grid).imagesLoaded().always(function(){
                        	jQuery(grid).isotope( 'layout' );
                        	updateFilter();
                        });                     	
					}

					//Call vc waypoint settings
					if(typeof jQuery.fn.waypoint === "function"){
						jQuery(grid).find(".wpb_animate_when_almost_visible:not(.wpb_start_animation)").waypoint(function() {
					        jQuery(this).addClass("wpb_start_animation animated")
					    }, { offset: "100%"});						
					}

					//Update Items
					offset_items += parseInt(request_data.items_load);
					
					wait_load = false;
				});
			}, false );
		}			
	}
	
	function updateFilter(){
		jQuery(".isotope-filter a").each(function(){
			var data_filter = this.getAttribute("data-filter");
			var num = jQuery(this).closest('.bpt_portfolio_list').find('.bpt_portfolio_list-item').filter( data_filter ).length;
			jQuery(this).find('.number_filter').text( num );
		});
			
	}

}(jQuery));

//BPT LIKES
(function( $ ) {

	$(document).on('click', '.sl-button', function() {
		var button = $(this);
		var post_id = button.attr('data-post-id');
		var security = button.attr('data-nonce');
		var iscomment = button.attr('data-iscomment');
		var allbuttons;
		if ( iscomment === '1' ) { /* Comments can have same id */
			allbuttons = $('.sl-comment-button-'+post_id);
		} else {
			allbuttons = $('.sl-button-'+post_id);
		}
		var loader = allbuttons.next('#sl-loader');
		if (post_id !== '') {
			$.ajax({
				type: 'POST',
				url: bpt_core.ajaxurl,
				data : {
					action : 'cryptronick_like',
					post_id : post_id,
					nonce : security,
					is_comment : iscomment,
				},
				beforeSend:function(){
					loader.html('&nbsp;<div class="loader">Loading...</div>');
				},	
				success: function(response){
					var icon = response.icon;
					var count = response.count;
					allbuttons.html(icon+count);
					if(response.status === 'unliked') {
						var like_text = bpt_core.like;
						allbuttons.prop('title', like_text);
						allbuttons.removeClass('liked');
					} else {
						var unlike_text = bpt_core.unlike;
						allbuttons.prop('title', unlike_text);
						allbuttons.addClass('liked');
					}
					loader.empty();					
				}
			});

		}
		return false;
	});

})( jQuery );


function cryptronick_image_particles () {
	var $item = jQuery('.cryptronick_module_image_particles');
	if ($item.length) {
		$item.each(function(){
			var item = jQuery(this).find('.image_particles_data');
			var item_image = item.data('img');
			var item_id = item.data('id');
		    var options = {
		        "img": item_image,
		        "sizeMin": 1,
		        "sizeMax": 6,
		        "gridSize": 6,
		        "gridStartZoomEnabled": false,
		        "gridStartZoom": 1,
		        "gridStartZoomSpeed": 10,
		        "zoomOnHover": true,
		        "zoomOnHoverDelta": 5,
		        "mouseoverRadius": 50,
		        "shape": "circle",
		        "mousemoveBehavior": false,
		        "circleMotionSpeedMin": 0,
		        "circleMotionSpeedMax": 3,
		        "circleMotionRadiusMin": 10,
		        "circleMotionRadiusMax": 15,
		        "fullScreenStretch": false,
		        "fullScreen": false,
		        "randomizeGrid": true
		    };
		    var canvas = document.getElementById(item_id);
		    var particler = new Particler(canvas, options);
		    particler.run();
		})
		
	}
	
}


