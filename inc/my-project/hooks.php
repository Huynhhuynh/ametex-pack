<?php
/**
 * Hooks
 *
 */

{
    /**
     * My Project archive hooks.
     *
     */
     add_filter( 'archive_template', 'apack_myproject_custom_archive_template' ) ;
     add_action( 'apack/my_project/archive_content', 'apack_myproject_archive_heading', 16 );
     add_action( 'apack/my_project/archive_content', 'apack_myproject_loop', 20 );
     add_action( 'apack/my_project/archive_content', 'apack_pagination', 22 );
}

{
    /**
     * My Project single hooks.
     *
     */
    add_filter( 'single_template', 'apack_myproject_custom_single_template' );
    add_filter( 'apack/my_project/single_content', 'apack_myproject_single_nav', 18 );
    add_filter( 'apack/my_project/single_content', 'apack_myproject_single_content', 20 );
    add_action( 'apack/my_project/single_content', 'apack_comment_template', 26 );
    add_action( 'apack/my_project/entry_media', 'apack_myproject_single_media' );
    add_action( 'wp_head', 'apack_myproject_increase_view_post' );

    add_action( 'wp_head', function() {
        // Single control post nav
        if( true != carbon_get_theme_option( 'apack_project_single_post_nav' ) ) {
            remove_action( 'apack/my_project/single_content', 'apack_myproject_single_nav', 18 );
        }

        // Single control post comment
        if( true != carbon_get_theme_option( 'apack_project_single_comment' ) ) {
            remove_action( 'apack/my_project/single_content', 'apack_comment_template', 26 );
        }
    } );
}
