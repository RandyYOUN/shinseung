<?php
/*
 * Page Banners
 */
$hide_scroll_down_btn = albist_wp_option('hide_scroll_down_btn');
$banner_img = get_template_directory_uri().'/images/placeholder.png';
if(is_category()){
    $select_page_banner = albist_wp_get_field('select_page_banner');
    $slider_revolution_alias = albist_wp_get_field('slider_revolution_alias');
    $banner_heading = albist_wp_get_field('banner_heading');
    $banner_small_caption = albist_wp_get_field('banner_small_caption');
    $header_banner_image = albist_wp_get_field('header_banner_image');
    if(!empty($header_banner_image)){
        $banner_img = $header_banner_image;
    }
} else {
    $select_page_banner = albist_wp_get_field('select_page_banner');
    $slider_revolution_alias = albist_wp_get_field('slider_revolution_alias');
    $banner_heading = albist_wp_get_field('banner_heading');
    $banner_small_caption = albist_wp_get_field('banner_small_caption');
    $header_banner_image = albist_wp_get_field('header_banner_image');
    if(!empty($header_banner_image)){
        $banner_img = $header_banner_image;
    }
}
if($select_page_banner == 'style-1'){ ?>
<!-- Parallax With Breadcrumb -->
<section class="sub-bnr parallax-bg trigger-sticky" data-stellar-background-ratio="0.5" style="background:url(<?php echo esc_url($banner_img); ?>) no-repeat;">
    <div class="container">
        <div class="position-center-center">
            <h3>
                <?php
                    if(is_category()){
                        echo single_cat_title("", false);
                    } else {
                        echo get_the_title();
                    }
                ?>
            </h3>
            <!--======= Breadcrumb =========-->
            <ol class="breadcrumb">
                <li>
                    <a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Home','albist-wp'); ?></a>
                </li>
                <li class="active">
                    <?php
                    if(is_category()){
                        echo single_cat_title("", false);
                    } else {
                        echo get_the_title();
                    }
                    ?>
                </li>
            </ol>
        </div>
    </div>
    <?php if($hide_scroll_down_btn != 1){ ?>
        <!-- GO DOWN -->
        <div class="scroll">
            <a href="#content" class="go-down">
                <img src="<?php echo get_template_directory_uri().'/'; ?>images/go-down.png" alt="">
            </a>
        </div>
    <?php } ?>
</section>
<?php } elseif($select_page_banner == 'style-2'){ ?>
<!-- Parallax With Custom Data -->
<section class="sub-bnr parallax-bg trigger-sticky" data-stellar-background-ratio="0.5" style="background:url(<?php echo esc_url($banner_img); ?>) no-repeat;">
    <div class="container">
        <div class="position-center-center">
            <?php if(!empty($banner_heading)){ ?>
                <h3><?php echo esc_attr($banner_heading); ?></h3>
            <?php } if($banner_small_caption){ ?>
                <p class="font-lora"><?php echo esc_attr($banner_small_caption); ?></p>
            <?php } ?>
        </div>
    </div>
    <?php if($hide_scroll_down_btn != 1){ ?>
        <!-- GO DOWN -->
        <div class="scroll">
            <a href="#content" class="go-down">
                <img src="<?php echo get_template_directory_uri().'/'; ?>images/go-down.png" alt="">
            </a>
        </div>
    <?php } ?>
</section>
<?php } elseif($select_page_banner == 'style-3'){ ?>
<!-- Slider Revolution -->
<section class="home-slider trigger-sticky">
    <?php if(function_exists('putRevSlider')){
        putRevSlider($slider_revolution_alias, $slider_revolution_alias);
    } ?>
    <?php if($hide_scroll_down_btn != 1){ ?>
        <!-- GO DOWN -->
        <div class="scroll">
            <a href="#content" class="go-down">
                <img src="<?php echo get_template_directory_uri().'/'; ?>images/go-down.png" alt="">
            </a>
        </div>
    <?php } ?>
</section>
<?php } ?>