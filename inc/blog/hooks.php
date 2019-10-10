<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

/**
 * Blog hooks
 *
 */

{
    /**
     * Gneral
     *
     */
    add_action( 'apack/options', function( $options ) {

        $options->add_tab( __( 'Blog Settings', 'ametex-pack' ), apply_filters( 'apack/options/tab_blog_settings', [
            Field::make( 'checkbox', 'apack_blog_custom_enable', __( 'Custom Blog Template', 'ametex-pack' ) )
                ->set_help_text( __( 'Checked to custom blog template enable (default: disable)', 'ametex-pack' ) )
                ->set_default_value( false ),
            Field::make( 'text', 'apack_blog_content_width', __( 'Content With', 'ametex-pack' ) )
                ->set_attribute( 'type', 'number' )
                ->set_default_value( 980 ),
            Field::make( 'checkbox', 'apack_blog_related_posts', __( 'Enable Related Posts (Single page)', 'ametex-pack' ) )
                ->set_default_value( true ),
            Field::make( 'text', 'apack_blog_related_post_number', __( 'Related Posts Number', 'ametex-pack' ) )
                ->set_attribute( 'type', 'number' )
                ->set_default_value( 5 ),
            ] ) );
    }, 24 );

    add_action( 'wp_head', function() {

        ?>
        <style>
            :root {
                --apack-blog-content-width: <?php echo carbon_get_theme_option( 'apack_blog_content_width' ); ?>px;
            }
        </style>
        <?php
    }, 6 );

    add_action( 'wp_head', function() {
        global $post;

        if( ! is_singular( 'post' ) ) return;
        $old = get_post_meta( $post->ID, '_post-views', true );
        $count = empty( $old ) ? 1 : $old;

        update_post_meta( $post->ID, '_post-views', $count + 1 );
    } );

    add_action( 'wp_enqueue_scripts', function() {
        if( true != carbon_get_theme_option( 'apack_blog_custom_enable' ) ) return;
        wp_enqueue_style( 'ametex-pack-blog-css', APACK_URI . '/dist/ametex-pack-blog.css', false, APACK_VER );
    } );

    add_action( 'init', function() {

        $custom_blog = carbon_get_theme_option( 'apack_blog_custom_enable' );
        if( true != $custom_blog ) return;

        /**
         * Single
         *
         */
        add_filter( 'single_template', 'apack_blog_custom_single_template' );
        add_action( 'apack/blog/single_before', 'apack_blog_heading_bar', 20 );
        add_action( 'apack/blog/single_content', 'apack_blog_content', 20 );
        add_action( 'apack/blog/single_content', 'apack_blog_related', 24 );
        add_action( 'apack/blog/single_content', 'apack_comment_template', 28 );

        /**
         * Render Css
         */
         if( true == apack_get_mode() ) {
             apack_scss_compiler(
                 file_get_contents( APACK_DIR . '/src/blog/blog.scss' ),
                 APACK_DIR . '/dist/ametex-pack-blog.css',
                 APACK_DIR . '/src/blog/',
                 'ScssPhp\ScssPhp\Formatter\Compressed',
                 true
             );
         }
    } );
}
