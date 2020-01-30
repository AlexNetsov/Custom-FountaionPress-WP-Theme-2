import $ from 'jquery';
$( document ).ready(function() {
	// Top bar desktop search
    $('.site-navigation .top-bar-right .top-search').click(function() {
	    if($('.desktop-search-form').is(':visible')){
		    var imgToPut = $(this).attr('not-clicked-icon');
		    $('#menu-header-menu').show();
			$('.desktop-search-form').hide();
			$(this).find('img').attr('src', imgToPut);
	    }
	    else {
		    var imgToPut = $(this).attr('clicked-icon');
		    $('#menu-header-menu').hide();
			$('.desktop-search-form').show();
			$(this).find('img').attr('src', imgToPut);
	    }
    });
    
    // Top bar mobile search
    $('.site-title-bar .title-bar-left .mobile-search').click(function() {
	    if($('.mobile-search-form').is(':visible')){
		    var imgToPut = $(this).attr('not-clicked-icon');
			$('.mobile-search-form').hide();
			$('.mobile-menu-overlay').hide();
			$(this).find('img').attr('src', imgToPut);
			$(this).css({
				'background':'transparent',
			});
	    }
	    else {
		    var imgToPut = $(this).attr('clicked-icon');
			$('.mobile-search-form').show();
			$('.mobile-menu-overlay').show();
			$(this).find('img').attr('src', imgToPut);
			$(this).css({
				'background':'white',
			});
	    }
    });


    // Sliders
    var owl = $('.owl-carousel');
	owl.owlCarousel({
	  items: 3,
	  center: false,
	  dots: true,
	  margin: 20,
	  responsive:{
        0:{
            items:1,
            margin: 0,
        },
        480:{
            items:2,
        },
        1024:{
            items:3,
        }
    }
	});
	$('.owl-carousel').append('<span class="slider-back-arrow"></span><span class="slider-forward-arrow"></span>');
	$('.slider-forward-arrow').click(function() {
	    owl.trigger('next.owl.carousel');
	});
	$('.slider-back-arrow').click(function() {
	    owl.trigger('prev.owl.carousel');
	});
	$('.return-to-top').click(function() {      // When button is clicked
	    $('body,html').animate({
	        scrollTop : 0                       // Scroll to top of body
	    }, 500);
	});
	
	// Place down chevron on appropriate menu items
	if($('.submenus').length > 0){
		var indexesArray = $('.indexes-container').html().trim().split(',');
	}
	
	$('#menu-header-menu>li').each(function() {
		var id = $(this).attr('id').replace('menu-item-', '');
		for (var i = 0; i < indexesArray.length; i++) {
			if (id == indexesArray[i]) {
				$(this).addClass('custom-dropdown-parent');
			}
		}
	});
	
	// Show/hide the custom submenus
	$('#menu-header-menu>li').hover(function(){
		$('.submenus>div').hide();
	});	
	$('#menu-header-menu>li.custom-dropdown-parent').hover(function() {
		var id = $(this).attr('id').replace('menu-item-', '');
		$('.submenus>div').hide();
		$('.submenus>div[custom-menu-index='+id+']').show();
	});
	
	function makeMouseOutFn(elem){
	    var list = traverseChildren(elem);
	    return function onMouseOut(event) {
	        var e = event.toElement || event.relatedTarget;
	        if (!!~list.indexOf(e)) {
	            return;
	        }
	        $('.submenus>div:visible').hide();
	    };
	}
	if($('.submenus').length > 0){
		//using closure to cache all child elements
		var parent = document.getElementsByClassName('submenus')[0];
		parent.addEventListener('mouseout',makeMouseOutFn(parent),true);
	}
	//quick and dirty DFS children traversal, 
	function traverseChildren(elem){
	    var children = [];
	    var q = [];
	    q.push(elem);
	    while (q.length > 0) {
	      var elem = q.pop();
	      children.push(elem);
	      pushAll(elem.children);
	    }
	    function pushAll(elemArray){
	      for(var i=0; i < elemArray.length; i++) {
	        q.push(elemArray[i]);
	      }
	    }
	    return children;
	}
	
	// Fix fancybox vc buttons
	$('a[href="#popup-form"]').each(function(){
		$($(this).attr('data-fancybox',''));
	});
	
	// Mobile share buttons
	$('.social-open').click(function(e){
		e.preventDefault();
		if($('.share-container-mobile a.mobile-share-social').is(':visible')){
			$(this).removeClass('grey-social-button');
			$('.share-container-mobile a.mobile-share-social').each(function(){
				$(this).hide('slow');
			});
		}
		else {
			$(this).addClass('grey-social-button');
			$('.share-container-mobile a.mobile-share-social').each(function(){
				$(this).show('slow').css('display', 'block');
			});
		}
	});
}); 