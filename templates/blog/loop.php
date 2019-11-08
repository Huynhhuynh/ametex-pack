<?php
/**
 * Loop template
 */

?>
<div class="apack-post-loop-container">
    <?php
    if( have_posts() ) {

        while ( have_posts() ) : the_post();

            do_action( 'apack/post_loop_item', $increase );
            $increase += 1;

        endwhile;

    }
    ?>
</div>

<?php apack_pagination(); ?>
