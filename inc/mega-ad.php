<?php

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Returns the active (non-expired) ad data, or false if none exists.
 * Uses a static variable so the query only runs once per page load.
 */
function swd_ma_get_active_ad() {
	static $ad = null;

	if ( $ad !== null ) {
		return $ad;
	}

	$posts = get_posts( array(
		'posts_per_page' => 1,
		'post_type'      => 'mega-ad',
		'post_status'    => 'publish',
	) );

	if ( ! $posts ) {
		$ad = false;
		return $ad;
	}

	$id         = $posts[0]->ID;
	$expiration = get_post_meta( $id, '_swd_ma_textdate', true );

	if ( ! $expiration || strtotime( $expiration ) <= current_time( 'timestamp' ) ) {
		$ad = false;
		return $ad;
	}

	$ad = array(
		'id'          => $id,
		'image'       => get_post_meta( $id, '_swd_ma_image', true ),
		'url'         => get_post_meta( $id, '_swd_ma_url', true ),
		'cookie_days' => max( 1, (int) get_post_meta( $id, '_swd_ma_cookie_days', true ) ?: 1 ),
		'delay'       => max( 0, (int) get_post_meta( $id, '_swd_ma_delay', true ) ),
		'device'      => get_post_meta( $id, '_swd_ma_device', true ) ?: 'all',
	);

	return $ad;
}

/**
 * Returns true if the ad should be shown on the current device.
 */
function swd_ma_device_matches( $device ) {
	if ( $device === 'all' ) return true;
	$is_mobile = wp_is_mobile();
	return ( $device === 'mobile' && $is_mobile ) || ( $device === 'desktop' && ! $is_mobile );
}

/**
 * Enqueue styles and scripts only when an active, device-matched ad exists.
 */
function swd_ma_scripts() {
	$ad = swd_ma_get_active_ad();
	if ( ! $ad || ! swd_ma_device_matches( $ad['device'] ) ) return;

	wp_enqueue_style( 'mega-ad', SWD_MA_URL . '/css/style.css', array(), '2.0.0' );
	wp_enqueue_script( 'mega-ad', SWD_MA_URL . '/js/mega-ad-cookie.js', array(), '2.0.0', true );
	wp_localize_script( 'mega-ad', 'megaAdSettings', array(
		'cookieDays' => $ad['cookie_days'],
		'delay'      => $ad['delay'],
	) );
}
add_action( 'wp_enqueue_scripts', 'swd_ma_scripts' );

/**
 * Output the ad markup in the footer.
 */
function swd_ma_output() {
	$ad = swd_ma_get_active_ad();
	if ( ! $ad || ! swd_ma_device_matches( $ad['device'] ) ) return;
	?>
	<div id="mega-ad-wrap" style="display:none;" aria-modal="true" role="dialog">
		<button id="mega-ad-dismiss" aria-label="<?php esc_attr_e( 'Close advertisement', 'mega-ad' ); ?>"></button>
		<div id="mega-ad">
			<div class="mega-ad-inner">
				<a href="<?php echo esc_url( $ad['url'] ); ?>" target="_blank" rel="noopener noreferrer">
					<img src="<?php echo esc_url( $ad['image'] ); ?>" alt="" />
				</a>
			</div>
		</div>
	</div>
	<?php
}
add_action( 'wp_footer', 'swd_ma_output' );
