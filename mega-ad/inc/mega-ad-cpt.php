<?php

/**
 * Add Mega Ad CPT
 */
add_action( 'init', 'mega_ad_cpt' );
function mega_ad_cpt() {

	$labels = array(
		'name' => 'Mega Ads',
		'singular_name' => 'Mega Ad',
	);

	$args = array(
		'labels' => $labels,
		'description' => '',
		'public' => false,
		'show_ui' => true,
		'has_archive' => false,
		'show_in_menu' => true,
		'exclude_from_search' => true,
		'capability_type' => 'post',
		'map_meta_cap' => true,
		'hierarchical' => false,
		'rewrite' => array( 'slug' => 'mega-ad', 'with_front' => true ),
		'query_var' => true,
		'menu_icon' => 'dashicons-tablet' 
	);

	register_post_type( 'mega-ad', $args );
	// End of cptui_register_my_cpts()
}