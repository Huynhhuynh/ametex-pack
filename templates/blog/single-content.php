<?php
/**
 * Blog single content template
 *
 */

global $post;
?>
<article <?php post_class( 'apack-custom-blog-content' ); ?>>

    <?php do_action( 'apack/blog_article/before' ); ?>

    <div class="content-text">

        <?php do_action( 'apack/blog_content/before' ); ?>

        <?php the_content(); ?>

        <div class="meta-tag">
            <span class="__icon">
                <?php echo apack_svg_icon( 'tag' ); ?>
            </span>
            <?php echo get_the_term_list( $post->ID, 'post_tag', '', ', ', '.' ); ?>
        </div>

        <?php do_action( 'apack/blog_content/after' ); ?>

    </div>

    <?php
    /**
     * apack/blog_article/after hook. 
     *
     * @see apack_blog_bio_info - 20
     */
    do_action( 'apack/blog_article/after' );
    ?>

</article>
