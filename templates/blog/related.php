<?php
/**
 * Related posts template
 *
 */

if ( count( $loop ) <= 0 ) return;
?>
<div class="apack-related-posts-container">
    <h3 class="post-related-title"><?php _e( 'Related Posts ', 'ametex-pack' ); ?></h3>
    <ul class="related-post-list">
        <?php foreach ( $loop as $index => $p ) : ?>
        <li class="related-post-item">
            <div class="thumbnail">
                <a href="<?php echo get_the_permalink( $p->ID ); ?>">
                    <?php echo get_the_post_thumbnail( $p->ID, 'thumbnail' ); ?>
                </a>
            </div>
            <div class="entry">
                <h4 class="p-title">
                    <a href="<?php echo get_the_permalink( $p->ID ); ?>">#<?php echo ($index + 1); ?>. <?php echo $p->post_title; ?></a>
                </h4>
                <div class="meta">
                    <div class="post-date">
                        <?php echo get_the_date( '', $post->ID ); ?>
                    </div>
                    <div class="author">
                        <?php echo sprintf( __( 'by %s', 'ametex-pack' ), get_the_author() ); ?>
                    </div>
                    <div class="in-cat">
                        <?php echo get_the_term_list( $p->ID, 'category', 'in ', ', ', '.' ); ?>
                    </div>
                </div>
            </div>
        </li>
        <?php endforeach; ?>
    </ul>
</div>
<?php wp_reset_postdata(); ?>
