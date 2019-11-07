<?php
/**
 * Header mobile custom template
 *
 */

$custom_logo = carbon_get_theme_option( 'apack_header_mobi_logo' );
?>
<div class="apack-header-custom-mobi">

    <div class="header-summary">

        <div class="site-brand">

            <?php do_action( 'apack/header_mobi/before_logo' ); ?>

            <?php if( ! empty( $custom_logo ) ) {
                echo '<a class="custom-logo-link" rel="home">
                    <img src="'. $custom_logo .'">
                </a>';
            } else { the_custom_logo(); } ?>

            <?php do_action( 'apack/header_mobi/after_logo' ); ?>

        </div> <!-- .site-brand -->

        <div class="site-tools">

            <?php do_action( 'apack/header_mobi/before_menu_icon' ); ?>

            <div class="mobi-menu">
                <div class="__icon">
                    <?php echo apack_svg_icon( 'menu_dots' ); ?>
                </div>
            </div>

            <?php do_action( 'apack/header_mobi/after_menu_icon' ); ?>

        </div> <!-- .site-tools -->

    </div> <!-- .header-summary -->

</div> <!-- .apack-header-custom-mobi -->
