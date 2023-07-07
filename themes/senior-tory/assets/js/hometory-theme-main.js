var tempScrollTop		= 0;
var tempScrollCount	= 0;
function scrollMainHandler(top){
	var scrollTop		= top;
	if(typeof(use_fixed_nav)!=='undefined' && use_fixed_nav){
		var fixedHeader	= jQuery('.ht-top-navbar-panel');
		var headerHeight = jQuery('.ht-header-wrapper').height() + 20;

		if(scrollTop > headerHeight && scrollTop<=tempScrollTop){
			if(!fixedHeader.hasClass('ht-top-navbar-show') && tempScrollCount>2) {
				fixedHeader.stop().addClass('ht-top-navbar-show');
			}
			tempScrollCount++;
		}else{
			if(fixedHeader.hasClass('ht-top-navbar-show')) {
				fixedHeader.stop().removeClass('ht-top-navbar-show');
			}
			tempScrollCount = 0;
		}
		tempScrollTop		= top;
	}
	if(typeof(use_back_to_top)!=='undefined' && use_back_to_top){
		var scroll_timer;
		var displayed				= false;
		var $message			= jQuery('.ht-back-to-top');

		window.clearTimeout(scroll_timer);
		scroll_timer = window.setTimeout(function () {
			if(scrollTop <= 0)
			{
				displayed = false;
				$message.removeClass('ht-back-to-top-shown');
			}
			else if(displayed == false)
			{
				displayed = true;
				$message.stop(true, true).addClass('ht-back-to-top-shown').click(function () { $message.removeClass('ht-back-to-top-shown'); });
			}
		}, 400);
	}	
}

jQuery(document).ready(function($){

	var masthead				= $( '#ht-main-nav-panel' );
	var siteHeaderMenu		= masthead.find( '#site-header-menu' );
	var socialNavigation		= masthead.find( '#social-navigation' );

	$(window).scroll(function(){
		scrollMainHandler($(this).scrollTop());
	});

	$('.ht-back-to-top').click(function(e) {
			$('html, body').animate({scrollTop:0}, 500);
			return false;
	});

	var topPanel			= $('.ht-top-widget-panel');
	var pageWrapper	= $('#ht-main-wrapper');
	var showPanel		= $('.ht-top-widget-open');
	var panelHeight		= 0;

	showPanel.on('click', function(e) {
		if(!topPanel.hasClass('ht-show-panel')){
			panelHeight = topPanel.outerHeight();
			$(this).addClass('ht-show-panel');
			pageWrapper.attr('style','transform: translateY('+panelHeight+'px);-ms-transform: translateY('+panelHeight+'px);-webkit-transform: translateY('+panelHeight+'px);');
			topPanel.addClass('ht-show-panel');
			topPanel.show();
		}else{
			pageWrapper.attr('style','')
			topPanel.removeClass('ht-show-panel');
			$(this).removeClass('ht-show-panel');
		}
	});


	function initMainNavigation( container ) {
		var dropdownToggle = $( '<button />', {
			'class': 'dropdown-toggle',
			'aria-expanded': false
		} ).append( $( '<span />', {
			'class': 'screen-reader-text',
			text: ""
		} ) );

		container.find( '.menu-item-has-children > a' ).after( dropdownToggle );
		container.find( '.current-menu-ancestor > button' ).addClass( 'toggled-on' );
		container.find( '.current-menu-ancestor > .sub-menu' ).addClass( 'toggled-on' );		
		container.find( '.menu-item-has-children' ).attr( 'aria-haspopup', 'true' );

		container.find( '.dropdown-toggle, a[href^="#"]' ).click( function( e ) {
			var _this					= $( this );
			if(!_this.hasClass('dropdown-toggle')){
				_this	= _this.closest('li').find('.dropdown-toggle');
			}
			var screenReaderSpan = _this.find( '.screen-reader-text' );

			e.preventDefault();
			_this.toggleClass( 'toggled-on' );

			if(_this.next( '.children, .sub-menu' ).hasClass( 'toggled-on' )) {
				_this.next( '.children, .sub-menu' ).slideUp(300);
				_this.next( '.children, .sub-menu' ).removeClass( 'toggled-on' );				
			}else{
				_this.next( '.children, .sub-menu' ).slideDown(300);
				_this.next( '.children, .sub-menu' ).addClass( 'toggled-on' );				
			}			

			_this.attr( 'aria-expanded', _this.attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
		} );
	}
	initMainNavigation( $( '.ht-menu-nav' ) );

	$('.ht-menu-icon, .ht-close-ht-mobile-panel, .ht-mobile-panel-dim').click(function(event) {
		if(!$('body').hasClass('ht-mobile-panel-shown')) {
			$('body').addClass('ht-mobile-panel-shown');
			setTimeout(function(){
				$("body").one("click",function(e) {
					var target = e.target;
					if (!$(target).is('.ht-mobile-panel') && !$(target).parents().is('.ht-mobile-panel')) {
						$('body').removeClass('ht-mobile-panel-shown');
					}
				});
			}, 200);

		} else{
			$('body').removeClass('ht-mobile-panel-shown');
		}
	});	
	$('.ht-page-back-wrap').click(function(event) {
		window.history.back();
	});
	$('.ht-right-icon, .ht-close-side-area, .ht-right-open-btn').click(function(event) {
		if(!$('body').hasClass('ht-right-widget-show')) {
			$('body').addClass('ht-right-widget-show');
			setTimeout(function(){
				$("body").one("click",function(e) {
					var target = e.target;
					if (!$(target).is('.ht-right-widget-panel') && !$(target).parents().is('.ht-right-widget-panel')) {
						$('body').removeClass('ht-right-widget-show');
					}
					
				});

			}, 200);

		} else{
			$('body').removeClass('ht-right-widget-show');
		}
	});

	var isSearch = false;
	$('.ht-mobile-search-btn').click(function(event){
		$( ".ht-mobile-panel form" ).submit();
	})
	$('.ht-top-search-btn').click(function(event){
		if( isSearch == false ){
			isSearch =true;
			$('.ht-top-close-btn').css("display","block");
			$('.ht-top-bar-search input').css("display","inline-block");
			$(".ht-top-search-btn").css("right","24px");
			$(".ht-top-bar-search input").animate({"width": "130px"	}, 300, function() {$('.ht-top-bar-search input').focus();});			
			$(".ht-top-bar-search").animate({"width": "160px"	}, 300, function() {});
		}
		else{
			$( ".ht-top-bar-search form" ).submit();
		}
	})
	$('.ht-top-close-btn').click(function(event){
		isSearch = false;
		$('.ht-top-close-btn').css("display","none");
		$(".ht-top-bar-search input").animate({"width": "0px"	}, 300, function() {$('.ht-top-bar-search input').css("display","none");});
		$(".ht-top-search-btn").css("right","3px");
		$(".ht-top-bar-search").animate({"width": "20px"	}, 300, function() {});
	})
	$('.ht-show-search-popup-btn').click(function(event){
		
		$(".ht-show-search-popup-close-btn").css("display","inline-block");
		$(".ht-show-search-popup-btn").css("display","none");
		
		$('.ht-top-navbar-popup-search').addClass('ht-popup-search-show');
		$('.ht-top-navbar-panel').addClass('ht-navbar-search-show');
	})

	$('.ht-show-search-popup-close-btn').click(function(event){		
		$(".ht-show-search-popup-close-btn").css("display","none");
		$(".ht-show-search-popup-btn").css("display","inline-block");
		
		$('.ht-top-navbar-popup-search').removeClass('ht-popup-search-show');
		$('.ht-top-navbar-panel').removeClass('ht-navbar-search-show');
	})	
	$('.ht-popup-search-send').click(function(event){
		$( ".ht-top-navbar-popup-search form" ).submit();
	})	
});