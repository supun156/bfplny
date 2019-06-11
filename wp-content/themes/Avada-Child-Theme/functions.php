<?php

function theme_enqueue_styles() {
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'avada-stylesheet' ) );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

function avada_lang_setup() {
	$lang = get_stylesheet_directory() . '/languages';
	load_child_theme_textdomain( 'Avada', $lang );
}
add_action( 'after_setup_theme', 'avada_lang_setup' );

// Add Shops/Restaurant Post Type
include_once( get_stylesheet_directory() . '/php/shop_post_type.php');

// Add Query Helper
include_once( get_stylesheet_directory() . '/php/queries.php');

// Add Card Generation Code and Styles
include_once( get_stylesheet_directory() . '/php/gen_cards.php');
include_once( get_stylesheet_directory() . '/php/directory_cards.php');
wp_register_style('home-cards', get_stylesheet_directory_uri().'/css/cards.css',false);
wp_enqueue_style('home-cards');
wp_register_style('directory-cards', get_stylesheet_directory_uri().'/css/directory_cards.css',false);
wp_enqueue_style('directory-cards');

