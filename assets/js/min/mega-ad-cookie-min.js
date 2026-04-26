/*
 * jQuery Cookie for Mega Ad With jQuery Cookie
 * Author: Simon Web Design, LLC
 */

jQuery(document).ready( function() {

	if ( ! jQuery.cookie( 'mega-ad' ) ) {

		/* Cookie Not Detected Show Mega Ad */
		jQuery( '#mega_ad_wrap' ).fadeIn(0);
		jQuery( 'body' ).addClass( 'has-message' );

		/* Mega Ad CSS Scroll Fix */
		jQuery( 'html, body' ).css({
			'overflow': 'hidden',
			'overflow-x': 'hidden',
			'height': '100%'
		});

	} else {

		/* Cookie Detected Hide Mega Ad */
		jQuery( '#mega_ad_wrap' ).hide();

	}

	/* User Clicks Dismiss Mega Ad Drops Cookie */ 
	jQuery( '#dismiss','#mega_ad_wrap', '#mega_ad' ).click(function() {

		jQuery.cookie( "mega-ad", 1, {  path: '/', expires : 1 });
		jQuery( '#mega_ad_wrap' ).hide();

		/* Mega Ad CSS Scroll Reset */
		jQuery( 'html, body' ).css({
			'overflow': 'scroll',
			'overflow-x': 'scroll',
			'height': '100%'
		});

	});

	/* User Clicks Mega Ad and Drops Cookie */
	jQuery( "#mega_ad" ).click(function() {

		jQuery.cookie( "mega-ad", 1, {  path: '/', expires : 1 } );
		jQuery( '#mega_ad_wrap' ).hide();

		/* Mega Ad CSS Scroll Reset */
		jQuery( 'html, body' ).css({
			'overflow': 'scroll',
			'overflow-x': 'scroll',
			'height': '100%'
		});

	});

	/* If On Login Page Hide Mega Ad */
	if ( jQuery('body').hasClass('login') ) {
		jQuery('#mega_ad_wrap').hide();
	}

});
