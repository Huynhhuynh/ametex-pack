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
