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
            ->add_tab( __( 'General', 'ametex-pack' ), apply_filters( 'apack/options/tab_general_settings', [
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
