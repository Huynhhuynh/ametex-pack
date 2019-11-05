<?php
/**
 * Related 2 columns template
 *
 */

if ( count( $loop ) <= 0 ) return;
?>
<div class="apack-related-posts-container style-2-columns">
    <h3 class="post-related-title"><?php _e( 'Related Posts ', 'ametex-pack' ); ?></h3>
    <ul class="related-post-list-2-columns">
        <?php foreach( $loop as $p ) : ?>
        <?php
        $comments_number = (int) get_comments_number( $p->ID );
        $views_number = (int) get_post_meta( $p->ID, '_post-views', true );
        ?>
        <li class="post-item">
            <div class="post-thumb">
                <a href="<?php echo get_the_permalink( $p->ID ); ?>">
                    <?php echo get_the_post_thumbnail( $p->ID, 'thumbnail' ); ?>
                </a>
            </div>
            <div class="post-entry">
                <div class="in-cat">
                    <?php echo get_the_term_list( $p->ID, 'category', 'in ', ', ', '.' ); ?>
                </div>
                <h3 class="post-title">
                    <a href="<?php echo get_the_permalink( $p->ID ); ?>">
                        <?php the_title(); ?>
                    </a>
                </h3>
                <div class="post-meta">
                    <div class="auth-name">
                        <?php echo sprintf( __( 'by %s', 'ametex-pack' ), get_the_author() ); ?>
                    </div>
                    <div class="post-date">
                        <?php echo get_the_date( '', $p->ID ); ?>
                    </div>
                    <!-- <div class="views">
                        <?php // echo sprintf( _n( '%s view', '%s views', $views_number, 'ametex-pack' ), $views_number ); ?>
                    </div>
                    <div class="comment-count">
                        <?php // echo sprintf( _n( '%s comment', '%s comments', $comments_number, 'ametex-pack' ), $comments_number ); ?>
                    </div> -->
                </div>
            </div>
        </li>
        <?php endforeach; ?>
    </ul>
</div>
<?php wp_reset_postdata(); ?>
