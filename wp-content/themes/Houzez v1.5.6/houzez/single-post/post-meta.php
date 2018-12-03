<?php
$author_image = get_the_author_meta('fave_author_custom_picture');
if( empty($author_image) ) {
    $author_image = houzez_get_avatar_url(get_avatar( get_the_author_meta( 'ID' ), 40 ));
}
$blog_date = houzez_option('blog_date');
$blog_author = houzez_option('blog_author');
?>
<ul class="author-meta">
    <?php if( $blog_author != 0 ) { ?>
    <li class="name">
        <a><img src="<?php echo esc_url($author_image); ?>" alt="Auther Image" class="meta-image" height="40" width="40"></a>
        <?php esc_html_e( 'by', 'houzez' ); ?> <a><?php the_author(); ?></a>
    </li>
    <?php } ?>
    <?php if( $blog_date != 0 ) { ?>
        <li><i class="fa fa-calendar"></i> <?php the_date(); ?> </li>
    <?php } ?>
    <li><i class="fa fa-bookmark-o"></i> <?php the_category(', '); ?></li>
    <li><i class="fa fa-comments-o"></i> <?php echo comments_number( '0', '1' ); ?></li>
</ul>