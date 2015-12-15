<?php

/**
 * Get the Cookie JS and Style if there are published posts if there is a published Mega Ad.
 */
function swd_ma_scripts() {

	$args=array(
		'posts_per_page'	=> 1,
		'post_type'			=> 'mega-ad',
		'post_status'		=> 'publish',
	);

	$swd_ma_status = get_posts( $args );
	if( $swd_ma_status ) {

	    //echo 'expiration ID on the first post found' . $swd_ma_status[0]->ID; //For debugging

	    $mega_ad_id       = $swd_ma_status[0]->ID;
		$expiration_date  = get_post_meta( $mega_ad_id, '_swd_ma_textdate', true );
		$current_time     = date_i18n( 'm/d/Y' );

		if( $expiration_date >= $current_time ) {

			wp_enqueue_style( 'mega-ad-ionicons', SWD_MA_URL . '/css/ionicons.min.css', array(), '2.0.1' ); // Get Ionicons
			wp_enqueue_style( 'mega-ad', SWD_MA_URL . '/css/style.css', array(), '1.0.0'  ); // Mega Ad Styles
			wp_enqueue_script( 'mega-ad-cookie-helper', SWD_MA_URL . '/js/mega-ad-cookie.js', array(), '1.0.0'  ); // This sets the cookie
			wp_enqueue_script( 'mega-ad-cookie', SWD_MA_URL . '/js/jquery.cookie.js', array(), '1.4.1'  ); // This is the cookie jQuery plugin
		
		}

	}

}
add_action( 'wp_head', 'swd_ma_scripts' );

/**
 * Add Mega Ad
 */
function swd_ma_query() {

	$args=array(
		'posts_per_page'	=> 1,
		'post_type'			=> 'mega-ad',
		'post_status'		=> 'publish',
	);

	$swd_ma_status = get_posts( $args );
	if( $swd_ma_status ) {

	    $mega_ad_id       = $swd_ma_status[0]->ID;
		$expiration_date  = get_post_meta( $mega_ad_id, '_swd_ma_textdate', true );
		$current_time     = date_i18n( 'm/d/Y' );

		if( $expiration_date >= $current_time ) {
			?>
				<?php $image  = get_post_meta( $mega_ad_id, '_swd_ma_image', true ); ?>
				<?php $url    = get_post_meta( $mega_ad_id, '_swd_ma_url', true ); ?>
				
				<div id="mega_ad_wrap" style="display: none;">
					<div id="dismiss">
						<i class="icon ion-android-close"></i>
					</div>
					<div id="mega_ad">
						<a href="<?php echo esc_url( $url ); ?>"/><img src="<?php echo esc_url( $image ); ?>" border="0" /></a>
					</div>
				</div>
			<?php
		} // Mega Ad Ends here

	}

}
add_action( 'wp_footer', 'swd_ma_query' );

