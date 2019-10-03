<?php
/**
 * Loop item template
 *
 */

?>
<div <?php post_class( 'item' ); ?>>
    <div class="item__inner">
        <div class="thumbnail">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail( 'medium', [
                    'data-apack-image-lazy' => true,
                    'data-image-final' => get_the_post_thumbnail_url( get_the_ID(), 'full' ),
                    ] ); ?>
            </a>
        </div>
        <div class="entry">
            <h4 class="title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h4>
            <div class="meta">
                <div class="by">
                    <?php echo sprintf( __( 'by %s, ', 'ametex-pack' ), get_the_author() ); ?>
                </div>
                <div class="term">
                    <?php echo get_the_term_list( get_the_ID(), 'my-project-cat' ); ?>
                </div>
            </div>
        </div>
    </div>
</div>
