<?php
/**
 * Plugin Name: Mega Ad
 * Plugin URI: http://simonwebdesign.com
 * Description: This plugin creates a full screen ad with an expiration date.
 * Author: Simon Web Design, LLC
 * Author URI: http://simonwebdesign.com
 * Version: 1.0.1
 * License: GPLv2
 */

/**
 * Define the URL path
 */
define( 'SWD_MA_URL', plugin_dir_url( __FILE__ ) . 'assets' );

/**
 * Get the plugin files
 */
require_once dirname( __FILE__ ) . '/inc/mega-ad.php';
require_once dirname( __FILE__ ) . '/inc/mega-ad-cpt.php';

/**
 * Get the bootstrap! Go CMB Go!
 */
if ( file_exists(  __DIR__ . '/inc/cmb2/init.php' ) ) {
	require_once  __DIR__ . '/inc/cmb2/init.php';
} elseif ( file_exists(  __DIR__ . '/inc/CMB2/init.php' ) ) {
	require_once  __DIR__ . '/inc/CMB2/init.php';
}

/**
 * It's CMB2 time.
 */
add_action( 'cmb2_init', 'mega_ad_cmb2_metaboxes' );
function mega_ad_cmb2_metaboxes() {

	remove_post_type_support( 'mega-ad', 'editor' );
	remove_post_type_support( 'mega-ad', 'custom-fields' );
	remove_post_type_support( 'mega-ad', 'thumbnail' );
	remove_post_type_support( 'mega-ad', 'comments' );
	remove_post_type_support( 'mega-ad', 'trackbacks' );
	remove_post_type_support( 'mega-ad', 'excerpt' );

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_swd_ma_';

	/**
	 * Metabox for Mega Ad
	 */
	$swd_ma_cmb = new_cmb2_box( array(
		'id'           => $prefix . 'metabox',
		'title'        => __( 'Mega Ad', 'cmb2' ),
		'object_types' => array( 'mega-ad', ), // Post type
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true, // Show field names on the left
	) );

	$swd_ma_cmb->add_field( array(
		'name' => __( 'Mega Ad URL', 'cmb2' ),
		'desc' => __( 'Add the Mega Ad URL', 'cmb2' ),
		'id'   => $prefix . 'url',
		'type' => 'text_url',
	) );

	$swd_ma_cmb->add_field( array(
		'name' => __( 'Mega Ad Image', 'cmb2' ),
		'desc' => __( 'Upload an image or enter a URL.', 'cmb2' ),
		'id'   => $prefix . 'image',
		'type' => 'file',
	) );

	$swd_ma_cmb->add_field( array(
		'name' => __( 'Mega Ad Expiration', 'cmb2' ),
		'desc' => __( 'Enter an expiration date.', 'cmb2' ),
		'id'   => $prefix . 'textdate',
		'type' => 'text_date',
	) );	

}





