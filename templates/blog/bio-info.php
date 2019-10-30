<?php
/**
 * Bio info template
 *
 */

$user_data = get_userdata( $author_id );
?>
<div class="apack-bio-info">
    <div class="line">
        <span><?php echo apack_svg_icon( 'clip' ); ?></span>
    </div>
    <div class="bio-info-entry">
        <div class="author-avatar">
            <img src="<?php echo get_avatar_url( $author_id, [
                'size' => 80
                ] ) ?>" alt="<?php _e( 'author image', 'ametex-pack' ); ?>">
        </div>
        <div class="author-entry">
            <h4 class="a-name"><?php echo $user_data->display_name; ?></h4>
            <div class="a-bio">
                <?php echo wpautop( get_the_author_meta( 'description', $author_id ) ); ?>
            </div>
            <div class="a-social">
                <a href="<?php echo carbon_get_user_meta( $author_id, 'apack_user_facebook' ); ?>" class="s-item s-facebook" target="_blank"><?php echo apack_svg_icon( 'facebook' ); ?></a>
                <a href="<?php echo carbon_get_user_meta( $author_id, 'apack_user_twitter' ); ?>" class="s-item s-twitter" target="_blank"><?php echo apack_svg_icon( 'twitter' ); ?></a>
            </div>
        </div>
    </div>
</div>
