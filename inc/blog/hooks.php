<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

/**
 * Blog hooks
 *
 */

{
    /**
     * General
     *
     */
    add_action( 'apack/options', function( $options ) {

        $options->add_tab( __( 'Blog Settings', 'ametex-pack' ), apply_filters( 'apack/options/tab_blog_settings', [
            Field::make( 'checkbox', 'apack_blog_custom_enable', __( 'Custom Blog Template', 'ametex-pack' ) )
                ->set_help_text( __( 'Checked to custom blog template enable (default: disable)', 'ametex-pack' ) )
                ->set_default_value( false ),
            Field::make( 'radio_image', 'apack_blog_single_template', __( 'Template (Detail page)' ) )
                ->add_options( 'apack_blog_detail_template' )
                ->set_default_value( 'classic' ),
            Field::make( 'sidebar', 'apack_blog_custom_sidebar', __( 'Select Custom Sidebar', 'ametex-pack' ) )
                ->set_conditional_logic( [
                    [
                        'field' => 'apack_blog_single_template',
                        'value' => ['sidebar_sticky'],
                        'compare' => 'IN'
                    ] ] ),
            Field::make( 'text', 'apack_blog_content_width', __( 'Content With (Detail page)', 'ametex-pack' ) )
                ->set_attribute( 'type', 'number' )
                ->set_default_value( 980 ),
            Field::make( 'checkbox', 'apack_blog_bio_info', __( 'Enable Biographical Info (Detail page)', 'ametex-pack' ) )
                ->set_default_value( true ),
            Field::make( 'checkbox', 'apack_blog_related_posts', __( 'Enable Related Posts (Detail page)', 'ametex-pack' ) )
                ->set_default_value( true ),
            Field::make( 'text', 'apack_blog_related_post_number', __( 'Related Posts Number', 'ametex-pack' ) )
                ->set_attribute( 'type', 'number' )
                ->set_default_value( 5 ),
            ] ) );
    }, 24 );

    add_action( 'carbon_fields_register_fields', function() {
        if( true != carbon_get_theme_option( 'apack_blog_custom_enable' ) ) return;

        Container::make( 'post_meta', __( 'Blog Settings (Ametex Pack)', 'ametex-pack' ) )
            ->where( 'post_type', '=', 'post' )
            ->add_fields( [
                Field::make( 'radio_image', 'apack_blog_single_template', __( 'Template' ) )
                    ->add_options( 'apack_blog_detail_template' )
                    ->set_default_value( carbon_get_theme_option( 'apack_blog_single_template' ) ),
                Field::make( 'sidebar', 'apack_blog_custom_sidebar', __( 'Select Custom Sidebar', 'ametex-pack' ) )
                    ->set_default_value( carbon_get_theme_option( 'apack_blog_custom_sidebar' ) )
                    ->set_conditional_logic( [
                        [
                            'field' => 'apack_blog_single_template',
                            'value' => ['sidebar_sticky'],
                            'compare' => 'IN'
                        ] ] ),
                Field::make( 'text', 'apack_blog_content_width', __( 'Content With', 'ametex-pack' ) )
                    ->set_attribute( 'type', 'number' )
                    ->set_default_value( carbon_get_theme_option( 'apack_blog_content_width' ) ),
                Field::make( 'checkbox', 'apack_blog_related_posts', __( 'Enable Related Posts (Detail page)', 'ametex-pack' ) )
                    ->set_default_value( carbon_get_theme_option( 'apack_blog_related_posts' ) ),
                Field::make( 'text', 'apack_blog_related_post_number', __( 'Related Posts Number', 'ametex-pack' ) )
                    ->set_attribute( 'type', 'number' )
                    ->set_default_value( carbon_get_theme_option( 'apack_blog_related_post_number' ) ),
                ] );
    } );

    add_action( 'wp_head', function() {
        if( ! is_singular( 'post' ) ) return;
        global $post;

        ?>
        <style>
            :root {
                --apack-blog-content-width: <?php echo carbon_get_post_meta( $post->ID, 'apack_blog_content_width' ); ?>px;
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

    add_filter( 'body_class', function( $classes ) {

        if( is_singular( 'post' ) ) {
            global $post;
            $classes[] = 'apack-blog-template-' . carbon_get_post_meta( $post->ID, 'apack_blog_single_template' );
        }

        return $classes;
    } );

    add_action( 'init', function() {
        global $apack_elementor_widgets;

        $custom_blog = carbon_get_theme_option( 'apack_blog_custom_enable' );
        if( true != $custom_blog ) return;

        /**
         * Single
         *
         */
        add_filter( 'single_template', 'apack_blog_custom_single_template' );

        # Blog - Classic template
        add_action( 'apack/blog/single_before', 'apack_blog_heading_bar', 20 );
        add_action( 'apack/blog/single_content', 'apack_blog_content', 20 );
        add_action( 'apack/blog/single_content', 'apack_blog_related', 24 );
        add_action( 'apack/blog/single_content', 'apack_comment_template', 28 );
        add_action( 'apack/blog_article/after', 'apack_blog_bio_info', 20 );

        # Blog - Sitebar sticky template
        add_action( 'apack/blog/single_before', 'apack_blog_mini_heading', 20 );
        add_action( 'apack/blog/single_content', 'apack_blog_content_two_columns', 20 );

        # Blog - Heading 2 columns
        add_action( 'apack/blog/single_before', 'apack_blog_heading_2_columns', 20 );
        add_action( 'apack/blog/single_content', 'apack_blog_content_separate', 18 );
        add_action( 'apack/blog/single_content', 'apack_blog_content', 20 );
        add_action( 'apack/blog/single_content', 'apack_blog_related_2_columns', 24 );

        /**
         * Elementor widgets
         *
         */

        $apack_elementor_widgets['apack_elementor_post_slide'] = [
            'label' => __( 'Post Slide', 'ametex-pack' ),
            'description' => __( '...', 'ametex-pack' ),
            'active' => true,
            'path_file' => APACK_DIR . '/inc/elementor-widget/apack-post-slide.php',
            'scss_file' => APACK_DIR . '/src/elements/_post-slide.scss',
        ];

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
