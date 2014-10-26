<?php
/*
Plugin Name: NaNoWriMo Category Reverse Order
Plugin URI: http://commons.hwdsb.on.ca
Description: If you use your blog to write a novel, the posts should surface chronologically. This plugin reverses the nanowrimo category archive so people can read your novel, and removes it from the main blog feed so people don't read your novel in reverse. You need to create a category called "nanowrimo" then add a link to the nanowrimo category archive in Appearance, Menus
Version: 1.0
Author: r-a-y
Author URI: http://commons.hwdsb.on.ca

/**
* Filter 'nanowrimo category posts so they display in ascending order.
*/
function hwdsb_nanowrimo_asc_order( $query = false ) {
// Bail if not on the 'nanowrimo' category page
if ( ! is_category('nanowrimo') )
return;
// Set the order to ascending
$query->set( 'order', 'ASC' );
}
add_action( 'pre_get_posts', 'hwdsb_nanowrimo_asc_order' );

/**
* Exclude 'nanowrimo category posts from homepage.
*/
function hwdsb_nanowrimo_exclude_from_home( $query = false ) {
// Bail if not home, not a query, or not main query
if ( ! is_home() || ! is_a( $query, 'WP_Query' ) || ! $query->is_main_query() )
return;
// Get 'nanowrimo' category
$cat = get_category_by_slug( 'nanowrimo' );
 
// Cat doesn't exist, so stop now!
if ( empty( $cat ) )
return;
 
// Exclude 'nanowrimo' category posts
$query->set( 'cat', '-' . $cat->term_id );
}
add_action( 'pre_get_posts', 'hwdsb_nanowrimo_exclude_from_home' );