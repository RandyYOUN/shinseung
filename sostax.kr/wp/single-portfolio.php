<?php
/*
 * Portfolio Single Page
 */
$portfolio_single_page_layout = albist_wp_get_field('portfolio_single_page_layout');
if($portfolio_single_page_layout == 'popup'){
    while(have_posts()): the_post();
    $portfolio_slide_images = albist_wp_get_field('portfolio_slide_images');
    if(is_array($portfolio_slide_images)){ ?>
        <div class="detail-img">
            <!-- Portfolio Slider -->
            <div class="cbp-slider">
                <ul class="cbp-slider-wrap">
                    <?php foreach($portfolio_slide_images as $img){ ?>
                        <li class="cbp-slider-item">
                            <img class="img-responsive" src="<?php echo esc_url($img['url']); ?>" alt="">
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    <?php } ?>
    <div class="container">
        <!-- Portfolio Details -->
        <section class="portfolio-details">
            <!-- Project Detail -->
            <div class="padding-top-100 padding-bottom-100">
                <?php get_template_part('includes/portfolio/portfolio','inner'); ?>
            </div>
        </section>
    </div>
<?php endwhile;
} else{ ?>
    <!DOCTYPE html>
    <html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
    <!-- Wrap -->
    <div id="wrap" class="animated fadeIn">
        <?php while(have_posts()): the_post();
        $close_button_link = albist_wp_get_field('close_button_link'); ?>
        <!-- header -->
        <header class="header-normal header-light">
            <div class="sticky">
                <!-- header -->
                <div class="container">
                    <!-- Logo -->
                    <div class="logo"> 
                        <a href="<?php echo esc_url(home_url('/')); ?>">
                            <img class="img-responsive" src="<?php echo get_template_directory_uri();  ?>/images/logo-dark.png" alt="" >
                        </a> 
                    </div>
                    <!-- NAV Page -->
                    <div class="nav-detail">
                        <ul>
                            <li>
                                <?php $nepo = get_next_post();
                                if(!empty($nepo)){
                                    $nepoid = $nepo->ID;
                                    $next_post_url = get_permalink($nepoid);
                                } else {
                                    $next_post_url = "no-posts";
                                }
                                if($next_post_url != "no-posts"){ ?>
                                    <a href="<?php echo esc_url($next_post_url); ?>">
                                        <i class="fa fa-long-arrow-left margin-right-10"></i>
                                        <span><?php esc_attr_e('previous','albist-wp'); ?></span>
                                    </a>
                                <?php } else{ ?>
                                    <a href="javascript:void(0);">
                                        <i class="fa fa-long-arrow-left margin-right-10"></i>
                                        <span><?php esc_attr_e('previous','albist-wp'); ?></span>
                                    </a>
                                <?php } ?>
                            </li>
                            <li class="margin-left-20 margin-right-20"> 
                                <a href="<?php echo esc_url($close_button_link); ?>">
                                    <img src="<?php echo get_template_directory_uri();  ?>/images/nav-icon.jpg" alt="">
                                </a>
                            </li>
                            <li>
                                <?php $prpo=get_previous_post();
                                if(!empty($prpo)){
                                    $prpoid = $prpo->ID;
                                    $prev_post_url = get_permalink($prpoid);
                                } else {
                                    $prev_post_url = "no-post"; }
                                if($prev_post_url != "no-post"){ ?>
                                    <a href="<?php echo esc_url($prev_post_url); ?>">
                                        <span><?php esc_attr_e('next','albist-wp'); ?></span>
                                        <i class="fa fa-long-arrow-right margin-left-10"></i>
                                    </a>
                                <?php } else{ ?>
                                    <a href="javascript:void(0);">
                                        <span><?php esc_attr_e('next','albist-wp'); ?></span>
                                        <i class="fa fa-long-arrow-right margin-left-10"></i>
                                    </a>
                                <?php } ?>
                            </li>
                        </ul>
                    </div>
                    <a href="<?php echo esc_url($close_button_link); ?>" class="close-page">
                        <i class="lnr lnr-cross"></i> 
                    </a> 
                </div>
            </div>
        </header>
        <!-- Content -->
        <div id="content">
            <!-- Portfolio Details -->
            <section class="portfolio-details">
                <?php $portfolio_slide_images = albist_wp_get_field('portfolio_slide_images');
                if(is_array($portfolio_slide_images)){ ?>
                    <div class="detail-img">
                        <!-- Portfolio Slider -->
                        <div class="single-slide">
                            <?php foreach($portfolio_slide_images as $img){ ?>
                                <div> <img class="img-responsive" src="<?php echo esc_url($img['url']); ?>" alt=""> </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
                <!-- Project Detail -->
                <div class="padding-top-100 padding-bottom-100">
                    <?php get_template_part('includes/portfolio/portfolio','inner'); ?>
                </div>
            </section>
            <?php endwhile; ?>
        </div>
<?php get_footer();
} ?>