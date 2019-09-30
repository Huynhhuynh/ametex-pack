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

                ] ) )
            ->add_tab( __( 'Style Settings', 'ametex-pack' ), apply_filters( 'apack/options/tab_style_settings', [
                Field::make( 'color', 'apack_heading_color', __( 'Heading Color', 'ametex-pack' ) )
                    ->set_default_value( '#222222' ),
                Field::make( 'color', 'apack_text_color', __( 'Text Color', 'ametex-pack' ) )
                    ->set_default_value( '#716886' ),
                Field::make( 'color', 'apack_link_accent_color', __( 'Link / Accent Color', 'ametex-pack' ) )
                    ->set_default_value( '#fa7a60' ),
                Field::make( 'color', 'apack_button_background_color', __( 'Button Background Color', 'ametex-pack' ) )
                    ->set_default_value( '#fa7a60' ),
                Field::make( 'color', 'apack_button_text_color', __( 'Button Text Color', 'ametex-pack' ) )
                    ->set_default_value( '#ffffff' ),
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
