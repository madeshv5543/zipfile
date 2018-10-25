jQuery(document).ready(function( $ ) {
 "use strict";
 
	 $('.roadmap').owlCarousel({
	     loop: false,
	     margin: 30,
	     nav: true,
	     navText: ['<i class="ion-ios-arrow-back"></i>', '<i class="ion-ios-arrow-forward"></i>'],
	     responsive: {
	         0: {
	             items: 1,

	         },
	         380: {
	             items: 2,
	             margin: 15,
	         },
	         600: {
	             items: 3
	         },
	         1000: {
	             items: 5
	         },
	         1199: {
	             items: 5
	         }
	     }
	 });
		
}); 