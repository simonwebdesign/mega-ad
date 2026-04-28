<?php
/**
 * Plugin Name: Mega Ad
 * Plugin URI: http://simonwebdesign.com
 * Description: This plugin creates a full screen ad with an expiration date.
 * Author: Simon Web Design, LLC
 * Author URI: http://simonwebdesign.com
 * Version: 2.0.1
 * License: GPLv2
 * Requires at least: 5.0
 * Requires PHP: 7.4
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'SWD_MA_URL', plugin_dir_url( __FILE__ ) . 'assets' );

require_once __DIR__ . '/inc/mega-ad.php';
require_once __DIR__ . '/inc/mega-ad-cpt.php';

if ( file_exists( __DIR__ . '/inc/cmb2/init.php' ) ) {
	require_once __DIR__ . '/inc/cmb2/init.php';
} elseif ( file_exists( __DIR__ . '/inc/CMB2/init.php' ) ) {
	require_once __DIR__ . '/inc/CMB2/init.php';
}

function mega_ad_cmb2_metaboxes() {

	remove_post_type_support( 'mega-ad', 'editor' );
	remove_post_type_support( 'mega-ad', 'custom-fields' );
	remove_post_type_support( 'mega-ad', 'thumbnail' );
	remove_post_type_support( 'mega-ad', 'comments' );
	remove_post_type_support( 'mega-ad', 'trackbacks' );
	remove_post_type_support( 'mega-ad', 'excerpt' );

	$prefix = '_swd_ma_';

	$swd_ma_cmb = new_cmb2_box( array(
		'id'           => $prefix . 'metabox',
		'title'        => __( 'Mega Ad Settings', 'mega-ad' ),
		'object_types' => array( 'mega-ad' ),
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true,
	) );

	$swd_ma_cmb->add_field( array(
		'name' => __( 'Ad URL', 'mega-ad' ),
		'desc' => __( 'URL the ad links to when clicked.', 'mega-ad' ),
		'id'   => $prefix . 'url',
		'type' => 'text_url',
	) );

	$swd_ma_cmb->add_field( array(
		'name' => __( 'Ad Image', 'mega-ad' ),
		'desc' => __( 'Upload an image or enter a URL.', 'mega-ad' ),
		'id'   => $prefix . 'image',
		'type' => 'file',
	) );

	$swd_ma_cmb->add_field( array(
		'name' => __( 'Expiration Date', 'mega-ad' ),
		'desc' => __( 'Ad will stop showing after this date.', 'mega-ad' ),
		'id'   => $prefix . 'textdate',
		'type' => 'text_date',
	) );

	$swd_ma_cmb->add_field( array(
		'name'    => __( 'Cookie Duration (days)', 'mega-ad' ),
		'desc'    => __( 'Days before the ad reappears after being dismissed.', 'mega-ad' ),
		'id'      => $prefix . 'cookie_days',
		'type'    => 'text_small',
		'default' => '1',
	) );

	$swd_ma_cmb->add_field( array(
		'name'    => __( 'Show Delay (seconds)', 'mega-ad' ),
		'desc'    => __( 'Seconds to wait before showing the ad. Use 0 for instant.', 'mega-ad' ),
		'id'      => $prefix . 'delay',
		'type'    => 'text_small',
		'default' => '0',
	) );

	$swd_ma_cmb->add_field( array(
		'name'    => __( 'Device Targeting', 'mega-ad' ),
		'desc'    => __( 'Choose which devices will see this ad.', 'mega-ad' ),
		'id'      => $prefix . 'device',
		'type'    => 'select',
		'default' => 'all',
		'options' => array(
			'all'     => __( 'All Devices', 'mega-ad' ),
			'mobile'  => __( 'Mobile Only', 'mega-ad' ),
			'desktop' => __( 'Desktop Only', 'mega-ad' ),
		),
	) );
}
add_action( 'cmb2_init', 'mega_ad_cmb2_metaboxes' );
