<?php

if ( ! defined( 'ABSPATH' ) ) exit;

function mega_ad_cpt() {

	$labels = array(
		'name'          => __( 'Mega Ads', 'mega-ad' ),
		'singular_name' => __( 'Mega Ad', 'mega-ad' ),
		'add_new_item'  => __( 'Add New Mega Ad', 'mega-ad' ),
		'edit_item'     => __( 'Edit Mega Ad', 'mega-ad' ),
		'view_item'     => __( 'View Mega Ad', 'mega-ad' ),
		'search_items'  => __( 'Search Mega Ads', 'mega-ad' ),
		'not_found'     => __( 'No Mega Ads found.', 'mega-ad' ),
	);

	$args = array(
		'labels'              => $labels,
		'public'              => false,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_rest'        => true,
		'has_archive'         => false,
		'exclude_from_search' => true,
		'capability_type'     => 'post',
		'map_meta_cap'        => true,
		'hierarchical'        => false,
		'supports'            => array( 'title' ),
		'menu_icon'           => 'dashicons-tablet',
	);

	register_post_type( 'mega-ad', $args );
}
add_action( 'init', 'mega_ad_cpt' );
