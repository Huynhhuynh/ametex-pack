<?php
/**
 * Loop item template
 */

global $post;
?>
<article <?php post_class( 'post-item post-nth-' . $increase ); ?>>

    <div class="post-inner">

        <div class="post-thumb">

            <a href="<?php the_permalink(); ?>">
                <div class="thumb-layer" style="background-image: url(<?php the_post_thumbnail_url( 'large' ); ?>)"></div>
                <img class="placeholder-thumb" src="<?php echo APACK_URI . '/images/placeholder-image-600x400.jpg' ?>" alt="#">
            </a>

            <div class="post-date">
                <span class="__icon"><?php echo apack_svg_icon( 'calendar' ); ?></span>
                <span class="__text"><?php echo get_the_date( '', get_the_ID() ); ?></span>
            </div>

        </div>

        <div class="post-entry">

            <h4 class="post-title">

                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>

            </h4>

            <div class="post-excerpt">
                <?php echo wp_trim_words( get_the_excerpt(), apply_filters( 'apack/post_loop_item/excerpt_words', 12, $increase ), '[...]' ); ?>
            </div>

            <div class="post-meta">

                <div class="in-cat">
                    <?php echo get_the_term_list( get_the_ID(), 'category', 'in ', ', ', '.' ); ?>
                </div>

                <div class="author">
                    <?php echo sprintf( __( 'by %s', 'ametex-pack' ), get_the_author_meta( 'display_name', $post->post_author ) ); ?>
                </div>

            </div>

        </div>

    </div>

</article>
