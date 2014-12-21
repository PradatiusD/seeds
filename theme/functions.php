<?php

//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );
//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'awsum Studio Child Theme' );
define( 'CHILD_THEME_URL', 'http://github.com/PradatiusD/awsum' );
define( 'CHILD_THEME_VERSION', '1.0.0' );


//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );
//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );
//* Add support for custom background
add_theme_support( 'custom-background' );
//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

if (in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1'))) {
  // For Debugging on Localhost
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  
  // For live reloading
  function local_livereload(){
    wp_register_script('livereload', 'http://localhost:35729/livereload.js', null, false, true);
    wp_enqueue_script('livereload');    
  }
  add_action( 'wp_enqueue_scripts', 'local_livereload');
}
// move Secondary Sidebar to .content-sidebar-wrap
remove_action('genesis_after_content_sidebar_wrap','genesis_get_sidebar_alt');
add_action('genesis_after_content','genesis_get_sidebar_alt' );
// $hook_name = 'genesis_after_content_sidebar_wrap';
// global $wp_filter;
// var_dump( $wp_filter[$hook_name] );



// Header Scripts
function header_scripts () {
  wp_enqueue_style('custom_fonts', '//fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic|Montserrat:400,700', array(), '1.0');
  wp_enqueue_style('fontawesome', '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css', array(), '4.0.3');
}
add_action('wp_enqueue_scripts','header_scripts');


// Twitter Scripts for Team Members
function twitter_scripts() {
  if (is_singular('team-member')) {
    wp_enqueue_script('angular','//ajax.googleapis.com/ajax/libs/angularjs/1.3.3/angular.min.js',array('jquery'), '3.2.0', true);
    wp_enqueue_script('angular-sanitize','//cdnjs.cloudflare.com/ajax/libs/angular.js/1.3.3/angular-sanitize.min.js', array('angular'), '1.3.3', true);
    wp_enqueue_script('twitter-angular', get_stylesheet_directory_uri().'/js/twitter.js',array('angular', 'jquery'), '1.0.0', true);
  }
}
add_action( 'wp_enqueue_scripts', 'twitter_scripts');
