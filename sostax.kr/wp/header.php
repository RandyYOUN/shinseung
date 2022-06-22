<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $favicon = albist_wp_option("favicon");
    if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) { ?>
        <link rel="icon" href="<?php echo esc_url($favicon); ?>">
    <?php }
	wp_head(); ?>
</head>
<?php $b_class = '';
$enable_boxed_layout = albist_wp_option('enable_boxed_layout');
if(!empty($enable_boxed_layout)){
    $b_class .= ' '.$enable_boxed_layout;
}
$page_classes = albist_wp_get_field('page_classes');
if(!empty($page_classes)){
    $b_class .= ' '.$page_classes;
}?>
<body <?php body_class($b_class); ?>>
<!-- Wrap -->
<div id="wrap">
    <!-- header -->
    <?php if(!is_404()){
        if(is_category()){
            $select_page_menu = albist_wp_get_field('select_page_menu');
        } elseif(is_home() || is_tag() || is_author() || is_date() || is_day() || is_year() || is_month() || is_time() || is_search() || is_attachment()){
            $select_page_menu = albist_wp_option('general_pages_menu');
        } else {
            $select_page_menu = albist_wp_get_field('select_page_menu');
        }
        if($select_page_menu == 'logo-center'):
            get_template_part('includes/header','logo-center');
        elseif($select_page_menu == 'hamburg'):
            get_template_part('includes/header','hamburg');
        else:
            get_template_part('includes/header','logo-left');
        endif;
        // Page Banners
        get_template_part('includes/header','banners');
    } ?>
    <div class="clear"></div>
    <?php if ( get_header_image() ) : ?>
        <div id="site-header">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                <img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="">
            </a>
        </div>
    <?php endif; ?>
    <div class="clear"></div>