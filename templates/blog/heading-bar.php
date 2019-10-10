<?php
/**
 * Heading bar template
 *
 */

global $post;
$comments_number = (int) get_comments_number( $post->ID );
$views_number = (int) get_post_meta( $post->ID, '_post-views', true );
?>
<div class="apack-blog-heading-bar-container">
    <div class="background-layer" style="--apack-blog-background-layer: url(<?php echo $background_layer; ?>)"></div>
    <div class="apack-blog-container-width">
        <div class="heading-entry">
            <div class="bookmark-icon">
                <?php echo apack_svg_icon( 'bookmark' ); ?>
            </div>
            <div class="in-cat">
                <?php echo get_the_term_list( $post->ID, 'category', 'in ', ', ', '.' ); ?>
            </div>
            <h2 class="title"><?php echo $title; ?></h2>
            <div class="meta">
                <div class="post-date">
                    <?php echo get_the_date( '', $post->ID ); ?>
                </div>
                <div class="author">
                    <?php echo sprintf( __( 'by %s', 'ametex-pack' ), get_the_author() ); ?>
                </div>
                <div class="views">
                    <?php echo sprintf( _n( '%s view', '%s views', $views_number, 'ametex-pack' ), $views_number ); ?>
                </div>
                <div class="comment-count">
                    <?php echo sprintf( _n( '%s comment', '%s comments', $comments_number, 'ametex-pack' ), $comments_number ); ?>
                </div>
            </div>
        </div>
    </div>
</div>
