<?php
/**
 * VanQuyen functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage VanQuyen Theme
 * @since VanQuyen 1.0
 */


// define
define('VQ_DIR_ASSETS', get_stylesheet_directory_uri() . '/assets');


add_action( 'wp_enqueue_scripts', 'vanquyen_child_enqueue_styles' );
function vanquyen_child_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('parent-style')
    );

    // style guide
    wp_enqueue_style(
        'archive',
        VQ_DIR_ASSETS . '/css/archive.min.css',
        array(),
        wp_get_theme()->get( 'Version' )
    );

    wp_enqueue_style(
        'style-guide',
        VQ_DIR_ASSETS . '/css/style-guide.min.css',
        array(),
        wp_get_theme()->get( 'Version' )
    );

	 // Home page
	 if (is_front_page()) {
        wp_enqueue_style(
            'home-page',
            VQ_DIR_ASSETS . '/css/homepage.min.css',
            array(),
            wp_get_theme()->get( 'Version' )
        );
    }

    //Orther page
    if (!is_front_page() || is_search()) {
        wp_enqueue_style(
            'orther-page',
            VQ_DIR_ASSETS . '/css/other-page.min.css',
            array(),
            wp_get_theme()->get( 'Version' )
        );
    }



    // Icon fonts
    wp_enqueue_style(
        'VQ-icon-fonts',
        VQ_DIR_ASSETS . '/css/vq-icon.min.css',
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

    // VQ single post
    if ( is_singular('post')) {
        wp_enqueue_style(
            'single-post',
            VQ_DIR_ASSETS . '/css/single.min.css',
            array(),
            wp_get_theme()->get( 'Version' )
        );
    }

    //script
    wp_enqueue_script('jquery', VQ_DIR_ASSETS .'/js/jquery.min.js');
    wp_enqueue_script('lazyload', VQ_DIR_ASSETS .'/js/lazyload.min.js');
    // Slick
    wp_enqueue_script('slick', VQ_DIR_ASSETS .'/js/slick.min.js');
    // vanquyen js
    wp_enqueue_script('VQ-js', VQ_DIR_ASSETS .'/js/theme-function.min.js');

}

// Update CSS within in Admin
function admin_style() {
    wp_enqueue_style('admin-styles', VQ_DIR_ASSETS .'/css/admin.min.css');
}
add_action('admin_enqueue_scripts', 'admin_style');


    // Add SVG to allowed file uploads
    function vq_uploads_svg($file_types){

        $new_filetypes = array();
        $new_filetypes['svg'] = 'image/svg';
        $file_types = array_merge($file_types, $new_filetypes );
        return $file_types;
    }
add_action('upload_mimes', 'vq_uploads_svg');