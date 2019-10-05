<?php
/**
 * Share
 *
 */

?>
<ul class="apack-share-container">
    <?php foreach( $socials as $name => $item ) : ?>
    <?php $url = str_replace( array_keys( $replace_url ), array_values( $replace_url ), $item['url'] ); ?>
    <li class="s-item s-<?php echo $name ?>">
        <a href="<?php echo $url; ?>" title="<?php echo $item['title'] ?>">
            <span class="__icon">
                <?php echo $item['svg_icon']; ?>
            </span>
        </a>
    </li>
    <?php endforeach; ?>
</ul>
