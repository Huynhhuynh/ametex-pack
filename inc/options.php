<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

/**
 * Options
 *
 */

if( ! function_exists( 'apack_general_options' ) ) {
    /**
     * General options
     *
     */
    function apack_general_options() {

        $options = Container::make( 'theme_options', __( 'Ametex Pack Options', 'ametex-pack' ) )
            ->set_page_parent( 'themes.php' )
            ->add_tab( __( 'General Settings', 'ametex-pack' ), apply_filters( 'apack/options/tab_general_settings', [
                Field::make( 'checkbox', 'apack_dev_mode', __( 'Develop Mode', 'ametex-pack' ) )
                    ->set_default_value( false )
                    ->set_help_text( __( 'Enable develop mode auto rendering scss general and elementor widget style!' ) ),
                Field::make( 'checkbox', 'apack_load_js_fancybox_3', __( 'Load library Fancybox version 3.', 'ametex-pack' ) )
                    ->set_default_value( true )
                    ->set_help_text( __( 'jQuery lightbox script for displaying images, videos and more. Touch enabled, responsive and fully customizable.!' ) ),
                Field::make( 'checkbox', 'apack_load_js_owlcarousel_2', __( 'Load library OwlCarousel version 2.', 'ametex-pack' ) )
                    ->set_default_value( true )
                    ->set_help_text( __( 'Touch enabled jQuery plugin that lets you create a beautiful responsive carousel slider.!' ) ),
                ] ) )
            ->add_tab( __( 'Header Settings', 'ametex-pack' ), apply_filters( 'apack/options/tab_header_settings', [
                Field::make( 'html', 'apack_header_info_text' )
                    ->set_html( 'Ametex header make by Elementor builder (customize the header areas of your site visually, without any code)' ),
                Field::make( 'checkbox', 'apack_header_custom_mobi_enable', __( 'Enable Custom Header Mobi', 'ametex-pack' ) )
                    ->set_default_value( false )
                    ->set_help_text( 'Disable elementor header mobi and use new template.' ),
                Field::make( 'select', 'apack_header_mobi_breakpoint', __( 'Header Mobi Breakpoint', 'ametex-pack' ) )
                    ->set_options( [
                        'tablet' => sprintf( __( 'Tablet < %spx', 'ametex-pack' ), get_option( 'elementor_viewport_lg', 1025 ) ),
                        'mobile' => sprintf( __( 'Mobile < %spx', 'ametex-pack' ), get_option( 'elementor_viewport_md', 768 ) ),
                        ] )
                    ->set_default_value( 'tablet' )
                    ->set_help_text( 'Header mobi breakpoint (default: Tablet)' ),
                Field::make( 'select', 'apack_header_mobi_nav', __( 'Select Menu Mobi', 'ametex-pack' ) )
                    ->add_options( 'apack_memu_list_options' )
                    ->set_default_value( '' )
                    ->set_help_text( 'Create new a <a href="'. admin_url( 'nav-menus.php' ) .'" target="_blank">menu</a> for mobile' ),
                Field::make( 'checkbox', 'apack_header_mobi_search_enable', __( 'Enable Search (Mobile)', 'ametex-pack' ) )
                    ->set_default_value( false ),
                Field::make( 'image', 'apack_header_mobi_logo', __( 'Mobi Logo', 'ametex-pack' ) )
                    ->set_value_type( 'url' )
                    ->set_help_text( __( 'Select custom logo for mobile.' ) ),
                ] ) )
            ->add_tab( __( 'Social Settings', 'ametex-pack' ), apply_filters( 'apack/options/tab_social_settings', [
                Field::make( 'text', 'apack_social_facebook', __( 'Facebook URL', 'amatex-pack' ) ),
                Field::make( 'text', 'apack_social_instagram', __( 'Instagram URL', 'amatex-pack' ) ),
                Field::make( 'text', 'apack_social_twitter', __( 'Twitter URL', 'amatex-pack' ) ),
                Field::make( 'text', 'apack_social_youtube', __( 'Youtube URL', 'amatex-pack' ) ),
                ] ) );

        do_action( 'apack/options', $options );
    }

    add_action( 'carbon_fields_register_fields', 'apack_general_options' );
}

if( ! function_exists( 'apack_user_social_options' ) ) {
    /**
     * User social options
     *
     */
    function apack_user_social_options() {

        Container::make(  'user_meta', __( 'Socials', 'ametex-pack' ) )
            ->add_fields( array(
                Field::make( 'text', 'apack_user_facebook', __( 'Facebook Url', 'ametex-pack' ) )
                    ->set_default_value( 'https://http://facebook.com/' ),
                Field::make( 'text', 'apack_user_twitter', __( 'Twitter Url', 'ametex-pack' ) )
                    ->set_default_value( 'https://twitter.com/' ),
            ) );
    }

    add_action( 'carbon_fields_register_fields', 'apack_user_social_options' );
}
