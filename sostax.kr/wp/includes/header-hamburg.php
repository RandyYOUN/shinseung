<header class="header-normal space-nav">
    <div class="sticky">
        <div class="container-fluid">
            <!-- Logo -->
            <div class="logo">
                <a href="<?php echo esc_url(home_url('/')); ?>">
                    <?php $image_logo = albist_wp_option('image_logo');
                    if(!empty($image_logo)){ ?>
                        <img class="img-responsive" src="<?php echo esc_url($image_logo); ?>" alt="" >
                    <?php } else{ ?>
                        <img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="" >
                    <?php } ?>
                </a>
            </div>
            <!-- NAV BUTTON -->
            <a href="#cd-nav" class="cd-nav-trigger">
                <?php echo esc_html__('Menu','albist-wp'); ?>
                <span class="cd-nav-icon"></span>
                <svg x="0px" y="0px" width="54px" height="54px" viewBox="0 0 54 54">
                    <circle fill="transparent" stroke="#656e79" stroke-width="1" cx="27" cy="27" r="25" stroke-dasharray="157 157" stroke-dashoffset="157"></circle>
                </svg>
            </a>
            <!-- NAV OPEN OVERLAP -->
            <?php $hamburg_image_bg = albist_wp_option('hamburg_image_bg'); ?>
            <div id="cd-nav" class="cd-nav" <?php if(!empty($hamburg_image_bg)) { ?> style="background: url(<?php echo esc_url($hamburg_image_bg); ?>) center center no-repeat;" <?php } ?>>
                <div class="position-center-center">
                    <div class="cd-navigation-wrapper">
                        <div class="cd-half-block">
                            <nav>
                                <ul class="cd-primary-nav">
                                    <?php if ( has_nav_menu( 'hamburg-menu' ) ) :
                                        wp_nav_menu( array( 'theme_location' => 'hamburg-menu','container' => '','items_wrap' => '%3$s' ) );
                                    else:
                                        echo '<li><a>' . esc_html__( 'Define your hamburg menu.', 'albist-wp' ) . '</a></li>';
                                    endif; ?>
                                </ul>
                            </nav>
                        </div>

                        <!-- Right Section -->
                        <div class="cd-half-block">
                            <address>
                                <?php $hamburg_menu_email = albist_wp_option('hamburg_menu_email');
                                $hamburg_menu_phone = albist_wp_option('hamburg_menu_phone');
                                $hamburg_menu_address = albist_wp_option('hamburg_menu_address');
                                ?>
                                <ul class="cd-contact-info">
                                    <?php if(!empty($hamburg_menu_email)){ ?>
                                        <li><?php echo esc_attr($hamburg_menu_email); ?></li>
                                    <?php } if(!empty($hamburg_menu_phone)){ ?>
                                        <li><?php echo esc_attr($hamburg_menu_phone); ?></li>
                                    <?php } if(!empty($hamburg_menu_address)){ ?>
                                        <li><?php echo do_shortcode($hamburg_menu_address); ?></li>
                                    <?php } ?>
                                </ul>
                            </address>
                        </div>
                    </div>
                </div>
                <!-- Navigation -->
            </div>
            <!-- Social Icons -->
            <div class="social_icons">
                <?php $facebook = albist_wp_option('facebook');
                $twitter = albist_wp_option('twitter');
                $dribbble = albist_wp_option('dribbble');
                $google = albist_wp_option('google');
                $linkedin = albist_wp_option('linkedin');
                $pinterest = albist_wp_option('pinterest');
                $behance = albist_wp_option('behance');
                $instagram = albist_wp_option('instagram');
                if(!empty($facebook)){ ?>
                    <a href="<?php echo esc_url($facebook); ?>"><i class="fa fa-facebook"></i></a>
                <?php } if(!empty($twitter)){ ?>
                    <a href="<?php echo esc_url($twitter); ?>"><i class="fa fa-twitter"></i></a>
                <?php } if(!empty($dribbble)){ ?>
                    <a href="<?php echo esc_url($dribbble); ?>"><i class="fa fa-dribbble"></i></a>
                <?php } if(!empty($behance)){ ?>
                    <a href="<?php echo esc_url($behance); ?>"><i class="fa fa-behance"></i></a>
                <?php } if(!empty($google)){ ?>
                    <a href="<?php echo esc_url($google); ?>"><i class="fa fa-google-plus"></i></a>
                <?php } if(!empty($linkedin)){ ?>
                    <a href="<?php echo esc_url($linkedin); ?>"><i class="fa fa-linkedin"></i></a>
                <?php } if(!empty($pinterest)){ ?>
                    <a href="<?php echo esc_url($pinterest); ?>"><i class="fa fa-pinterest-p"></i></a>
                <?php } if(!empty($instagram)){ ?>
                    <a href="<?php echo esc_url($instagram); ?>"><i class="fa fa-instagram"></i></a>
                <?php } ?>
            </div>
        </div>
    </div>
</header>