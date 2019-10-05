<?php
/**
 * Single content
 */

global $post;
$tags_icon = '<svg x="0px" y="0px" viewBox="0 0 486.982 486.982" style="enable-background:new 0 0 486.982 486.982;" xml:space="preserve"> <g> <path d="M131.35,422.969c14.6,14.6,38.3,14.6,52.9,0l181.1-181.1c5.2-5.2,9.2-11.4,11.8-18c18.2,5.1,35.9,7.8,51.5,7.7 c38.6-0.2,51.4-17.1,55.6-27.2c4.2-10,7.2-31-19.9-58.6c-0.3-0.3-0.6-0.6-0.9-0.9c-16.8-16.8-41.2-32.3-68.9-43.8 c-5.1-2.1-10.2-4-15.2-5.8v-0.3c-0.3-22.2-18.2-40.1-40.4-40.4l-108.5-1.5c-14.4-0.2-28.2,5.4-38.3,15.6l-181.2,181.1 c-14.6,14.6-14.6,38.3,0,52.9L131.35,422.969z M270.95,117.869c12.1-12.1,31.7-12.1,43.8,0c7.2,7.2,10.1,17.1,8.7,26.4 c11.9,8.4,26.1,16.2,41.3,22.5c5.4,2.2,10.6,4.2,15.6,5.9l-0.6-43.6c0.9,0.4,1.7,0.7,2.6,1.1c23.7,9.9,45,23.3,58.7,37 c0.2,0.2,0.4,0.4,0.6,0.6c13,13.3,14.4,21.8,13.3,24.4c-3.4,8.1-39.9,15.3-95.3-7.8c-16.2-6.8-31.4-15.2-43.7-24.3 c-0.4,0.5-0.9,1-1.3,1.5c-12.1,12.1-31.7,12.1-43.8,0C258.85,149.569,258.85,129.969,270.95,117.869z"/> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>';
$views_icon = '<svg x="0px" y="0px" viewBox="0 0 488.85 488.85" style="enable-background:new 0 0 488.85 488.85;" xml:space="preserve"> <g> <path d="M244.425,98.725c-93.4,0-178.1,51.1-240.6,134.1c-5.1,6.8-5.1,16.3,0,23.1c62.5,83.1,147.2,134.2,240.6,134.2 s178.1-51.1,240.6-134.1c5.1-6.8,5.1-16.3,0-23.1C422.525,149.825,337.825,98.725,244.425,98.725z M251.125,347.025 c-62,3.9-113.2-47.2-109.3-109.3c3.2-51.2,44.7-92.7,95.9-95.9c62-3.9,113.2,47.2,109.3,109.3 C343.725,302.225,302.225,343.725,251.125,347.025z M248.025,299.625c-33.4,2.1-61-25.4-58.8-58.8c1.7-27.6,24.1-49.9,51.7-51.7 c33.4-2.1,61,25.4,58.8,58.8C297.925,275.625,275.525,297.925,248.025,299.625z"/> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>';
?>

<article <?php post_class( 'myproject-summary' ); ?>>
    <div class="myproject-summary__inner">
        <div class="__entry">
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
                <?php echo get_the_term_list( get_the_ID(), 'my-project-tag', '<span class="tag-icon">'. $tags_icon .'</span>', ', ', '.' ); ?>
            </div>
            <div class="views">
                <span class="__icon">
                    <?php  echo $views_icon; ?>
                </span>
                <span><?php echo get_post_meta( $post->ID, '_post-views', true ); ?> <?php _e( 'views', 'ametex-pack' ); ?></span>
            </div>
            <div class="share">
                <span class="text">
                    <?php _e( 'Share: ', 'ametex-pack' ); ?>
                </span>
                <?php apack_share_post(); ?>
            </div>
        </div>
        <div class="__media">
            <?php the_post_thumbnail( 'full' ); ?>
        </div>
    </div>
</article>
