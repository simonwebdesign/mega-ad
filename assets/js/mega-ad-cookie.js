(function () {
	'use strict';

	var settings    = window.megaAdSettings || {};
	var cookieName  = 'mega-ad';
	var cookieDays  = parseInt( settings.cookieDays, 10 ) || 1;
	var delay       = parseInt( settings.delay, 10 )      || 0;

	function getCookie( name ) {
		var match = document.cookie.match( new RegExp( '(?:^|; )' + name + '=([^;]*)' ) );
		return match ? decodeURIComponent( match[1] ) : null;
	}

	function setCookie( name, value, days ) {
		var expires = new Date();
		expires.setTime( expires.getTime() + days * 24 * 60 * 60 * 1000 );
		document.cookie = name + '=' + encodeURIComponent( value ) +
			'; expires=' + expires.toUTCString() +
			'; path=/; SameSite=Lax';
	}

	function closeAd() {
		var wrap = document.getElementById( 'mega-ad-wrap' );
		if ( wrap ) wrap.style.display = 'none';
		document.documentElement.classList.remove( 'has-mega-ad' );
		document.body.classList.remove( 'has-mega-ad' );
		setCookie( cookieName, '1', cookieDays );
	}

	function showAd() {
		var wrap = document.getElementById( 'mega-ad-wrap' );
		if ( ! wrap ) return;

		// Don't show on the WP login page.
		if ( document.body.classList.contains( 'login' ) ) return;

		// Cookie already set — ad was dismissed recently.
		if ( getCookie( cookieName ) ) return;

		wrap.style.display = 'flex';
		document.documentElement.classList.add( 'has-mega-ad' );
		document.body.classList.add( 'has-mega-ad' );

		var dismiss = document.getElementById( 'mega-ad-dismiss' );
		if ( dismiss ) {
			dismiss.addEventListener( 'click', function ( e ) {
				e.stopPropagation();
				closeAd();
			} );
		}

		// Clicking the ad link drops the cookie so it doesn't reappear immediately.
		var adLink = wrap.querySelector( '#mega-ad a' );
		if ( adLink ) {
			adLink.addEventListener( 'click', function () {
				setCookie( cookieName, '1', cookieDays );
			} );
		}

		// Close on backdrop click (anywhere outside the inner ad box).
		wrap.addEventListener( 'click', function ( e ) {
			if ( e.target === wrap ) closeAd();
		} );

		// Close on Escape key.
		document.addEventListener( 'keydown', function ( e ) {
			if ( e.key === 'Escape' ) closeAd();
		} );
	}

	document.addEventListener( 'DOMContentLoaded', function () {
		if ( delay > 0 ) {
			setTimeout( showAd, delay * 1000 );
		} else {
			showAd();
		}
	} );
})();
