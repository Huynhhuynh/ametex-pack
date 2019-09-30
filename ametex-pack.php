<?php
/**
 * @package Ametex Pack
 */
/*
Plugin Name: Ametex Pack - addon for Ametex theme
Plugin URI: #
Description: Updating...
Version: 1.0.0
Author: Beplus
Author URI: #
License: MIT
Text Domain: ametex-pack
*/

{
    /**
     * Define
     *
     */
    define( 'APACK_DIR', plugin_dir_path( __FILE__ ) );
    define( 'APACK_URI', plugin_dir_url( __FILE__ ) );
    define( 'APACK_VER', '1.0.0' );
}

{
    /**
     * Include
     *
     */
    require( APACK_DIR . '/vendor/autoload.php' );
    require( APACK_DIR . '/inc/static.php' );
    require( APACK_DIR . '/inc/helpers.php' );
    require( APACK_DIR . '/inc/hooks.php' );
    require( APACK_DIR . '/inc/ajax.php' );
    require( APACK_DIR . '/inc/options.php' );
    require( APACK_DIR . '/inc/elementor-loader.php' );
}

if( ! function_exists('apack_plugin_links') ) {
    /**
     * Plugin page links
     * @since 1.0.0
     *
     */
    function apack_plugin_links( $links ) {

        $plugin_links = array(
            '<a href="#">' . __( 'Settings', 'ametex-pack' ) . '</a>',
            '<a href="#">' . __( 'Docs', 'ametex-pack' ) . '</a>',
        );

        return array_merge( $plugin_links, $links );
    }

    add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'apack_plugin_links' );
}

if( ! function_exists( 'apack_crb_load' ) ) {
    /**
     * Carbon_Fields boot
     *
     */
    function apack_crb_load() {
        \Carbon_Fields\Carbon_Fields::boot();
    }

    add_action( 'after_setup_theme', 'apack_crb_load' );
}
