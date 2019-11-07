<?php
/**
 * Hooks
 *
 */

{
    /**
     * Carbonfields
     *
     */
    add_action( 'carbon_fields_theme_options_container_saved', 'apack_auto_render_scss_after_save' );
}

{
    /**
     * Header mobi custom
     *
     */

    add_action( 'body_class', function( $classes ) {
        if( true != carbon_get_theme_option( 'apack_header_custom_mobi_enable' ) ) return $classes;

        $header_mobi_breakpoint = carbon_get_theme_option( 'apack_header_mobi_breakpoint' );
        $classes[] = 'apack-header-mobi-custom';
        $classes[] = 'apack-header-mobi-breakpoint-' . $header_mobi_breakpoint;

        return $classes;
    } );

    add_action( 'get_header', 'apack_header_mobi_custom', 30 );
    add_action( 'apack/header_mobi/before_menu_icon', 'apack_header_mobi_search_icon' );
    add_action( 'wp_footer', 'apack_panel_custom_mobi_menu_offcanvas' );
    add_action( 'apack/offcanvs_tab_entry_search/after', 'apack_post_cats_block' );
}
