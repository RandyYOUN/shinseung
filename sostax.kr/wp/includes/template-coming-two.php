<?php include_once(get_template_directory().'/includes/coming-soon-variables.php'); ?>
<!-- Coming Soon -->
<div class="coming-soon style-2 padding-top-100 padding-bottom-100">
    <div class="container">
        <div class="avatar">
            <?php if(!empty($coming_image_logo)){ ?>
                <img src="<?php echo esc_url($coming_image_logo); ?>" alt="" >
            <?php } ?>
        </div>
        <?php if(!empty($coming_heading)){
            $allowed_html = array(
                'br' => array()
            ); ?>
            <h3 class="text-white letter-space-3 margin-top-80"><?php echo wp_kses($coming_heading, $allowed_html); ?></h3>
        <?php } if(!empty($coming_small_caption)){ ?>
            <p class="font-crimson font-16px text-white center-auto width-70"><?php echo esc_attr($coming_small_caption); ?></p>
        <?php } ?>
        <!-- Timer -->
        <div class="time margin-bottom-80">
            <!-- Countdown-->
            <ul class="countdown">
                <!--======= Days =========-->
                <li>
                    <article> <span class="days"><?php echo esc_attr__('00','albist-wp'); ?></span>
                        <p class="days_ref"><?php echo esc_attr__('Days','albist-wp'); ?></p>
                    </article>
                </li>
                <!--======= Hours =========-->
                <li>
                    <article> <span class="hours"><?php echo esc_attr__('00','albist-wp'); ?></span>
                        <p class="hours_ref"><?php echo esc_attr__('Hours','albist-wp'); ?></p>
                    </article>
                </li>
                <!--======= Mintes =========-->
                <li>
                    <article><span class="minutes"><?php echo esc_attr__('00','albist-wp'); ?></span>
                        <p class="minutes_ref"><?php echo esc_attr__('Minutes','albist-wp'); ?></p>
                    </article>
                </li>
                <!--======= Seconds =========-->
                <li>
                    <article><span class="seconds"><?php echo esc_attr__('00','albist-wp'); ?></span>
                        <p class="seconds_ref"><?php echo esc_attr__('Seconds','albist-wp'); ?></p>
                    </article>
                </li>
            </ul>
            <!-- Countdown end-->
        </div>
        <!-- Subcribe -->
        <div class="subcribe">
            <div class="sub-mail">
                <?php if(!empty($newsletter_shortcode)){
                    echo do_shortcode($newsletter_shortcode);
                } ?>
            </div>
        </div>
        <!--======= FOOTER ICONS =========-->
        <ul class="social-icons margin-bottom-100">
            <?php if(!empty($coming_facebook)){ ?>
                <li class="facebook"><a href="<?php echo esc_url($coming_facebook); ?>"> <i class="fa fa-facebook"></i></a></li>
            <?php } if(!empty($coming_twitter)){ ?>
                <li class="twitter"><a href="<?php echo esc_url($coming_twitter); ?>"> <i class="fa fa-twitter"></i></a></li>
            <?php } if(!empty($coming_google)){ ?>
                <li class="googleplus"><a href="<?php echo esc_url($coming_google); ?>"> <i class="fa fa-google"></i></a></li>
            <?php } if(!empty($coming_skype)){ ?>
                <li class="skype"><a href="<?php echo esc_url($coming_skype); ?>"> <i class="fa fa-skype"></i></a></li>
            <?php } if(!empty($coming_pinterest)){ ?>
                <li class="pinterest"><a href="<?php echo esc_url($coming_pinterest); ?>"> <i class="fa fa-pinterest"></i></a></li>
            <?php } if(!empty($coming_instagram)){ ?>
                <li class="instagram"><a href="<?php echo esc_url($coming_instagram); ?>"> <i class="fa fa-instagram"></i></a></li>
            <?php } if(!empty($coming_dribbble)){ ?>
                <li class="dribbble"><a href="<?php echo esc_url($coming_dribbble); ?>"> <i class="fa fa-dribbble"></i></a></li>
            <?php } if(!empty($coming_flicker)){ ?>
                <li class="flickr"><a href="<?php echo esc_url($coming_flicker); ?>"> <i class="fa fa-flickr"></i></a></li>
            <?php } ?>
        </ul>
    </div>
</div>