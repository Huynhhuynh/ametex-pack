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
