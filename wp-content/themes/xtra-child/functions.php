<?php
/* ------------------------------------------------------------------------- *
 *  Custom functions
/* ------------------------------------------------------------------------- */

define('THEME_URL',get_template_directory_uri().'-child/');

wp_enqueue_style( 'general-css', THEME_URL.'css/general.css' );    


add_action( 'wp_enqueue_scripts', 'cdvz_enqueue_parent_style' );
function cdvz_enqueue_parent_style() {
	wp_enqueue_style( 'codevz-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'codevz-child-style', get_stylesheet_directory_uri() . '/style.css', array( 'codevz-style' ), '' );
}
	
	// Add your custom functions here, or overwrite existing ones. Read more how to use:
	// http://codex.wordpress.org/Child_Themes
add_action( 'acf/init', 'enable_acf_shortcode' );
function enable_acf_shortcode() {
    acf_update_setting( 'enable_shortcode', true );
}

function __e($str) {
    _e($str,'THEME_NAME');
}
function ___($str) {
    return __($str,'THEME_NAME');
}