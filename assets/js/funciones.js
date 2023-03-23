$(document).ready(function(){
	if($( window ).width() < 768){
		$("#menu-menu-bazinga li.menu-item-has-children > a").click(function(e){
			e.preventDefault();
			$(this).parent().find(".sub-menu").slideToggle();
		})
	}
	$(".botonHamburguesa").click(function(){
		$(this).find(".linea").toggleClass("equis");
		$(".menu-menu-bazinga-container").toggleClass("in");
		$("body").toggleClass("no-scroll");	
	})

	/*$(".woocommerce-checkout #billing_comuna").on('change', function() {
	  var valor = $(this).val();
	  console.log(valor);
	  $(".woocommerce-checkout #billing_city").val(valor);
	  jQuery( 'body' ).trigger( 'update_checkout' );
	});*/
	var slide = $('#main-slide .slide-content');
	slide.owlCarousel({
		
		items:1,
	    loop:true,
	    animateOut: 'fadeOut',
	    animateIn: 'fadeIn',
	    autoplay:true,
	    autoplayTimeout:6000,
    	autoplayHoverPause:true,
	})
	var carrouselNews = $(".carousel-news .owl-carousel");
	carrouselNews.owlCarousel({
	    loop:true,
	    margin:23,
	    dots:false,
	    nav:true,
	    center:false,
	    navText: ["<img src='wp-content/themes/bazinga/assets/images/arrow-carusel.jpg'>","<img src='wp-content/themes/bazinga/assets/images/arrow-carusel.jpg'>"],
	    responsiveClass:true,
	    responsive:{
	        0:{
	            items:1
	        },
	        600:{
	            items:4
	        },
	        1024:{
	            items:5
	        },
	        1200:{
	            items:6
	        }
	    }
	})
	var carrouselCategory = $(".carousel-categorias");
	carrouselCategory.owlCarousel({
	    loop:true,
	    margin:17,
	    dots:false,
	    nav:true,
	    center:false,
	    autoplay:true,
	    autoplayTimeout:6000,
    	autoplayHoverPause:true,
	    navText: ["<img src='wp-content/themes/bazinga/assets/images/arrow-carusel.jpg'>","<img src='wp-content/themes/bazinga/assets/images/arrow-carusel.jpg'>"],
	    responsiveClass:true,
	    responsive:{
	        0:{
	            items:1
	        },
	        600:{
	            items:2
	        },
	        1000:{
	            items:3
	        }
	    }
	})
	var carrouselBlog = $(".carousel-blog");
	carrouselBlog.owlCarousel({
	    loop:true,
	    animateOut: 'fadeOut',
	    animateIn: 'fadeIn',
	    margin:17,
	    dots:true,
	    nav:false,
	    center:false,
	    autoplay:true,
	    autoplayTimeout:6000,
    	autoplayHoverPause:true,
	    navText: ["<img src='wp-content/themes/bazinga/assets/images/arrow-carusel.jpg'>","<img src='wp-content/themes/bazinga/assets/images/arrow-carusel.jpg'>"],
	    responsiveClass:true,
	    responsive:{
	        0:{
	            items:1
	        },
	        600:{
	            items:1
	        },
	        1000:{
	            items:1
	        }
	    }
	})
	var carrouselComments = $(".carousel-comments");
	carrouselComments.owlCarousel({
	    loop:true,
	    margin:17,
	    dots:false,
	    nav:true,
	    center:false,
	    autoplay:true,
	    autoplayTimeout:6000,
    	autoplayHoverPause:true,
	    navText: ["<img src='wp-content/themes/bazinga/assets/images/arrow-carusel.jpg'>","<img src='wp-content/themes/bazinga/assets/images/arrow-carusel.jpg'>"],
	    responsiveClass:true,
	    responsive:{
	        0:{
	            items:1
	        },
	        600:{
	            items:2
	        },
	        1000:{
	            items:2
	        }
	    }
	})
	$(document).ready(function() {
	  $('.woocommerce-product-gallery__image a').magnificPopup({
	  	type:'image',
	  	mainClass: 'mfp-with-zoom', // this class is for CSS animation below

		  zoom: {
		    enabled: true, // By default it's false, so don't forget to enable it

		    duration: 300, // duration of the effect, in milliseconds
		    easing: 'ease-in-out', // CSS transition easing function

		    // The "opener" function should return the element from which popup will be zoomed in
		    // and to which popup will be scaled down
		    // By defailt it looks for an image tag:
		    opener: function(openerElement) {
		      // openerElement is the element on which popup was initialized, in this case its <a> tag
		      // you don't need to add "opener" option if this code matches your needs, it's defailt one.
		      return openerElement.is('img') ? openerElement : openerElement.find('img');
		    }
		  }
	  });
	});
})