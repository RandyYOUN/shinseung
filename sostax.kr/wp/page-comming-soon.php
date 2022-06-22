<?php
/*
 * Template Name: Coming Soon Pages
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<?php $coming_background_image = albist_wp_get_field('coming_background_image'); ?>
<body class="bg-parallax" style="background:url(<?php echo esc_url($coming_background_image); ?>) no-repeat" data-stellar-background-ratio="0.5">
<!-- Page Wrapper -->
<div id="wrap">
    <?php $coming_soon_page_layout = albist_wp_get_field('coming_soon_page_layout');
    if($coming_soon_page_layout == 'layout-1'):
        get_template_part('includes/template-coming','one');
    elseif($coming_soon_page_layout == 'layout-2'):
        get_template_part('includes/template-coming','two');
    else:
        get_template_part('includes/template-coming','three');
    endif; ?>
</div>
<!-- End Page Wrapper -->
<?php wp_footer(); ?>
</body>
</html>