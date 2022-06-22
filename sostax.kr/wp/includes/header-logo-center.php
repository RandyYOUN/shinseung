<header class="header-1">
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
    <!-- Navigation -->
    <div class="navbar sticky">
        <div class="container">
            <!-- NAV -->
            <nav class="webimenu">
                <!-- MENU BUTTON RESPONSIVE -->
                <div class="menu-toggle"> <i class="fa fa-bars"> </i> </div>
                <ul class="nav ownmenu">
                    <?php if ( has_nav_menu( 'primary-menu' ) ) {
                        require_once(get_template_directory() . "/includes/mega-menu/mega-menu.php");
                    } else{
                        echo '<li><a href="">' . esc_html__( 'Define your primary menu', 'albist-wp' ) . '</a></li>';
                    } ?>
                </ul>
            </nav>
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