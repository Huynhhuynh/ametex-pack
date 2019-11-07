<?php
/**
 * Offcanvas menu template
 *
 */

?>
<div class="apack-offcanvas-menu" style="--apack-offcanvas-tab-cols: <?php echo count( $tab_entries ); ?>;">

    <a href="#" class="__close"><span><?php _e( 'Close', 'ametex-pack' ); ?></span></a>

    <div class="__inner">

        <div class="apack-tab-container">
            <?php foreach( $tab_entries as $key => $item ) : ?>
                <div class="tab-content-item __<?php echo $key; ?>" data-tab-key="<?php echo $key; ?>">
                    <div class="content__inner">
                        <?php if( function_exists( $item['content_callback'] ) ) {
                            call_user_func( $item['content_callback'] );
                        } ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div> <!-- .apack-tab-container -->

        <div class="apack-tab-nav">
            <?php foreach( $tab_entries as $key => $item ) : ?>
                <div class="tab-nav-item __<?php echo $key; ?>" data-tab-key="<?php echo $key; ?>">
                    <div class="__icon">
                        <?php echo $item['svg_icon']; ?>
                    </div>
                    <div class="__label">
                        <?php echo $item['title']; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div> <!-- .apack-tab-nav -->

    </div>

</div> <!-- .apack-offcanvas-menu -->
