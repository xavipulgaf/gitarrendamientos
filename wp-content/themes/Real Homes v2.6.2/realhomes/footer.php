<?php get_template_part("template-parts/carousel_partners"); ?>

<!-- Start Footer -->
<footer id="footer-wrapper">

       <div id="footer" class="container">

                <div class="row">

                        <div class="span3">
                            <?php if ( ! dynamic_sidebar( 'footer-first-column' ) ) : ?>
                            <?php endif; ?>
                        </div>

                        <div class="span3">
                            <?php if ( ! dynamic_sidebar( 'footer-second-column' ) ) : ?>
                            <?php endif; ?>
                        </div>

                        <div class="clearfix visible-tablet"></div>

                        <div class="span3">
                            <?php if ( ! dynamic_sidebar( 'footer-third-column' ) ) : ?>
                            <?php endif; ?>
                        </div>

                        <div class="span3">
                            <?php if ( ! dynamic_sidebar( 'footer-fourth-column' ) ) : ?>
                            <?php endif; ?>
                        </div>
                </div>

       </div>

        <!-- Footer Bottom -->
        <div id="footer-bottom" class="container">

                <div class="row">
                        <div class="span6">
                            <?php
                            $copyright_text = get_option( 'theme_copyright_text' );
                            echo ( $copyright_text ) ? '<p class="copyright">' . $copyright_text . '</p>' : '';
                            ?>
                        </div>
                        <div class="span6">
                            <?php
                            $designed_by_text = get_option( 'theme_designed_by_text' );
                            echo ( $designed_by_text ) ? '<p class="designed-by">' . $designed_by_text . '</p>' : '';
                            ?>
                        </div>
                </div>

        </div>
        <!-- End Footer Bottom -->

</footer><!-- End Footer -->

<?php
/**
 * include modal login if login & register page URL is not configured
 */
if ( ! is_user_logged_in() ) {
	$theme_login_url = inspiry_get_login_register_url();
	if ( empty( $theme_login_url ) && ( ! is_page_template( 'template-login.php' ) ) ) {
		get_template_part( 'template-parts/modal-login' );
	}
}

/**
 * Display link to previous and next entry
 */
 inspiry_post_nav();

?>

<a href="#top" id="scroll-top"><i class="fa fa-chevron-up"></i></a>

<?php wp_footer(); ?>
</body>
</html>