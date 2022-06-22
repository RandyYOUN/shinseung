<?php include_once(get_template_directory().'/includes/coming-soon-variables.php'); ?>
<!-- Coming Soon -->
<div class="coming-soon style-3 padding-top-100 padding-bottom-100">
    <div class="container">
        <div class="col-md-8">
            <?php if(!empty($coming_heading)){
                $allowed_html = array(
                    'br' => array()
                ); ?>
                <h3 class="text-white letter-space-3 margin-top-80"><?php echo wp_kses($coming_heading, $allowed_html); ?></h3>
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
                <?php if(!empty($coming_button_text)){ ?>
                    <a href="<?php echo esc_url($button_link); ?>" class="btn btn-x-large btn-color font-normal letter-space-3 margin-top-100"><?php echo esc_attr($coming_button_text); ?></a>
                <?php } ?>
            </div>
        </div>
    </div>
</div>