<?php $footer_images = albist_wp_option('footer_images');
$ex_footer_images = explode(',',$footer_images);
if(is_array($ex_footer_images)){ ?>
<section class="photography">
    <div class="container-fluid">
        <ul class="row">
            <?php foreach($ex_footer_images as $img){
                $image_info = wp_get_attachment_image_src( $img, 'full' ); ?>
                <li>
                    <img src="<?php echo esc_url($image_info[0]); ?>" alt="">
                    <a href="<?php echo esc_url($image_info[0]); ?>" data-lighter>
                        <i class="lnr lnr-frame-expand"></i>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </div>
</section>
<?php } ?>
<footer>
    <div class="container">
        <!-- FOOTER -->
        <div class="footer-info">
            <div class="row">
                <!-- keep in touch -->
                <div class="col-md-4">
                    <div class="padding-right-50">
                        <?php if ( ! dynamic_sidebar( 'f1' ) ) : ?>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- Links -->
                <div class="col-md-2">
                    <?php if ( ! dynamic_sidebar( 'f2' ) ) : ?>
                    <?php endif; ?>
                </div>
                <!-- Photo Stream  -->
                <div class="col-md-3">
                    <?php if ( ! dynamic_sidebar( 'f3' ) ) : ?>
                    <?php endif; ?>
                </div>
                <!-- keep in touch -->
                <div class="col-md-3">
                    <div class="news-letter">
                        <?php if ( ! dynamic_sidebar( 'f4' ) ) : ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<?php $footer_copyright = albist_wp_option('footer_copyright');
if(!empty($footer_copyright)){ ?>
<div class="rights">
    <div class="container">
        <p><?php echo esc_attr($footer_copyright); ?></p>
        <div class="scroll"> <a href="#wrap" class="go-up"><i class="lnr lnr-arrow-up"></i></a> </div>
    </div>
</div>
<?php } ?>
</div>
<?php wp_footer(); ?>
</body>
</html>