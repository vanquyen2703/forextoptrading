<?php
/**
 * VQ functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage VQ Child Theme
 * @since VQ Child Theme 1.0
 */


// define
define('VQ_DIR_ASSETS', get_stylesheet_directory_uri() . '/assets');

require_once get_stylesheet_directory() . '/inc/custom_post_type/ourteam/ourteam.php';
add_action( 'wp_enqueue_scripts', 'VQ_child_enqueue_styles' );
function VQ_child_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('parent-style')
    );

    // style guide
    wp_enqueue_style(
        'style-guide',
        VQ_DIR_ASSETS . '/css/style-guide.css',
        array(),
        wp_get_theme()->get( 'Version' )
    );
    wp_enqueue_style(
        'header',
        VQ_DIR_ASSETS . '/css/style-guide.css',
        array(),
        wp_get_theme()->get( 'Version' )
    );
    wp_enqueue_style(
        'footer',
        VQ_DIR_ASSETS . '/css/style-guide.css',
        array(),
        wp_get_theme()->get( 'Version' )
    );
    // wp_enqueue_style(
    //     'style-guide',
    //     VQ_DIR_ASSETS . '/css/style-guide.min.css',
    //     array(),
    //     wp_get_theme()->get( 'Version' )
    // );

    // Truevera icon fonts
    wp_enqueue_style(
        'truevera-icon-fonts',
        VQ_DIR_ASSETS . '/css/truevera-icon.css',
        array(),
        wp_get_theme()->get( 'Version' )
    );

    // Css Slick
    wp_enqueue_style(
        'VQ-slick',
        VQ_DIR_ASSETS . '/css/slick.min.css',
        array(),
        wp_get_theme()->get( 'Version' )
    );

    // other page
    if (!is_front_page()) {
        wp_enqueue_style(
            'other-page',
            VQ_DIR_ASSETS . '/css/other-page.min.css',
            array(),
            wp_get_theme()->get( 'Version' )
        );
    }
    // truevera single post
    if ( is_singular('post') || is_singular('members')) {
        wp_enqueue_style(
            'truevera-single-post',
            VQ_DIR_ASSETS . '/css/single-post.min.css',
            array(),
            wp_get_theme()->get( 'Version' )
        );
    }

    //script
      wp_enqueue_script('jquery', VQ_DIR_ASSETS .'/js/jquery.min.js');

    // Slick
      wp_enqueue_script('slick', VQ_DIR_ASSETS .'/js/slick.min.js');

    // truevera js
    wp_enqueue_script('truevera-js', VQ_DIR_ASSETS .'/js/theme-function.min.js');

      
}

// Update CSS within in Admin
function admin_style() {
    // wp_enqueue_style('admin-styles', VQ_DIR_ASSETS .'/css/admin.min.css');
}
add_action('admin_enqueue_scripts', 'admin_style');