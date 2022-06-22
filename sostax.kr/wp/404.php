<?php get_header(); ?>
    <!-- Content -->
    <div id="content">
        <div class="container">
            <!-- 404 Pages -->
            <div class="row">
                <div class="col-md-8 center-auto">
                    <div class="page-404 text-center margin-bottom-100"> 
                        <img class="img-responsive margin-top-100 margin-bottom-0" src="<?php echo get_template_directory_uri(); ?>/images/404-page.jpg" alt="" >
                        <div class="col-md-9 center-auto">
                            <?php $error_404 = albist_wp_option('error_404');
                            if(!empty($error_404)){
                                echo do_shortcode($error_404);
                            } else{ ?>
                                <h3><?php esc_html_e('OH MY GOSH! YOU FOUND IT !!!','albist-wp'); ?></h3>
                                <p><?php esc_html_e('Looks like the page you’re trying to visit doesn’t exist. Please check the URL and try your luck again.','albist-wp'); ?></p>
                                <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-dark margin-top-40 margin-bottom-100"><?php esc_html_e('TAKE ME  HOME','albist-wp'); ?></a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Content -->
<?php get_footer(); ?>