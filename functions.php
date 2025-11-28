<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;


function wens_track_scripts(){
   // enqueue parent style
	wp_enqueue_style('wens-track-parent-style', get_template_directory_uri() . '/style.css');
}
add_action('wp_enqueue_scripts', 'wens_track_scripts');


function wens_track_register_block_pattern_categories(){
    register_block_pattern_category(
        'wens-track',
        array( 'label' => __( 'WENS Track', 'wens-track' ) )
    );

}
add_action('init', 'wens_track_register_block_pattern_categories');
