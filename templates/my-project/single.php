<?php
/**
 * My Project archive template
 *
 */
?>
<?php get_header(); ?>
	<div class="my-project-main">
        <div class="my-project-container-width">
            <div class="my-project-main__inner">
                <?php
                /**
                 * apack/my_project/single_content hooks.
                 *
                 */
                do_action( 'apack/my_project/single_content' );
                ?>
            </div>
        </div>
    </div>
<?php get_footer(); ?>
