<?php
/**
 * Single content
 */

global $post;
?>

<article <?php post_class( 'myproject-summary' ); ?>>
    <div class="myproject-summary__inner">
        <div class="__entry">

            <?php do_action( 'apack/my_project/entry_before' ); ?>

            <div class="heading">
                <div class="avatar">
                    <?php echo get_avatar( $post->post_author, 100 ); ?>
                </div>
                <div class="heading__meta">
                    <h2 class="title"><?php the_title(); ?></h2>
                    <div class="meta">
                        <div class="by">
                            <?php echo sprintf( __( 'by %s, ', 'ametex-pack' ), get_the_author() ); ?>
                        </div>
                        <div class="term">
                            <?php echo get_the_term_list( get_the_ID(), 'my-project-cat', '', ', ', '.' ); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-text">
                <?php echo wpautop( get_the_content( null, false, $post ) ); ?>
            </div>
            <div class="tags">
                <?php echo get_the_term_list( get_the_ID(), 'my-project-tag', '<span class="tag-icon">'. apack_svg_icon( 'tag' ) .'</span>', ', ', '.' ); ?>
            </div>
            <div class="views">
                <span class="__icon">
                    <?php  echo apack_svg_icon( 'eye' ); ?>
                </span>
                <span><?php echo get_post_meta( $post->ID, '_post-views', true ); ?> <?php _e( 'views', 'ametex-pack' ); ?></span>
            </div>
            <div class="share">
                <span class="text">
                    <?php _e( 'Share: ', 'ametex-pack' ); ?>
                </span>
                <?php apack_share_post(); ?>
            </div>

            <?php do_action( 'apack/my_project/entry_after' ); ?>
        </div>
        <div class="__media">
            <?php
            /**
             * apack/my_project/entry_media hook.
             *
             * @see apack_myproject_single_media - 20
             */
            do_action( 'apack/my_project/entry_media' );
            ?>
        </div>
    </div>
</article>
