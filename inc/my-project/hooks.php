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
    add_filter( 'apack/my_project/single_content', 'apack_myproject_single_content' );
    add_action( 'wp_head', 'apack_myproject_increase_view_post' );
}
