<?php
/**
 * Theme Functions Page
 * @ Albist WP Theme
 * @ Albist WP Theme 1.0
 **/
// Load all scripts and stylesheets
function albist_load_styles() {
    wp_enqueue_style( 'bootstrap.min' , get_template_directory_uri()."/css/bootstrap.min.css");
    wp_enqueue_style( 'font-awesome.min' , get_template_directory_uri()."/css/font-awesome.min.css");
    wp_enqueue_style( 'ionicons.min' , get_template_directory_uri()."/css/ionicons.min.css");
    wp_enqueue_style( 'main' , get_template_directory_uri()."/css/main.css");
    wp_enqueue_style( 'style' , get_template_directory_uri()."/css/style.css");
    wp_enqueue_style( 'responsive' , get_template_directory_uri()."/css/responsive.css");
    $theme_skin = albist_wp_option('theme_skins');
    if(!empty($theme_skin)){
        wp_enqueue_style( $theme_skin , get_template_directory_uri()."/css/colors/".$theme_skin.".css");
    } else {
        wp_enqueue_style( 'default' , get_template_directory_uri()."/css/default.css");
    }
    wp_enqueue_style( 'style-root' , get_template_directory_uri()."/style.css");
}
add_action('wp_enqueue_scripts', 'albist_load_styles');
function albist_load_scripts_footer() {
    wp_enqueue_script('modernizr', get_template_directory_uri() . '/js/modernizr.js', array('jquery'), '', false  );
    wp_enqueue_script('bootstrap.min', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '', true  );
    wp_enqueue_script('simpleNav', get_template_directory_uri() . '/js/simpleNav.js', array('jquery'), '', false  );
    wp_enqueue_script('jquery.lighter', get_template_directory_uri() . '/js/jquery.lighter.js', array('jquery'), '', true  );
    wp_enqueue_script('jquery.colio.min', get_template_directory_uri() . '/js/jquery.colio.min.js', array('jquery'), '', true  );
    wp_enqueue_script('owl.carousel.min', get_template_directory_uri() . '/js/owl.carousel.min.js', array('jquery'), '', true  );
    wp_enqueue_script('main', get_template_directory_uri() . '/js/main.js', array('jquery'), '', true  );
    if(is_page_template('page-contact.php')){
        $map_api_key = albist_wp_option('map_api_key');
        if(!empty($map_api_key)){
            wp_enqueue_script('contact-api', '//maps.google.com/maps/api/js?key='.$map_api_key, array('jquery'), '', false  );
        } else {
            wp_enqueue_script('contact-api', '//maps.google.com/maps/api/js?sensor=false', array('jquery'), '', false  );
        }
    }
    wp_enqueue_script('custom-scriptss', get_template_directory_uri() . '/js/custom-scripts.js', array('jquery'), '', false  );
    // IE Scripts
    wp_enqueue_script('html5shiv', get_template_directory_uri() . '/js/html5shiv.js', array('jquery'));
    wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );
    wp_enqueue_script('respond', get_template_directory_uri() . '/js/respond.min.js', array('jquery'));
    wp_script_add_data( 'respond', 'conditional', 'lt IE 9' );
}
// Load scripts in footer
add_action('wp_enqueue_scripts', 'albist_load_scripts_footer');
// Google Fonts
if ( ! function_exists( 'albist_fonts_url' ) ) :
    function albist_fonts_url() {
        $fonts_url = '';
        $fonts     = array();
        $subsets   = 'latin,latin-ext';
        if ( 'off' !== _x( 'on', 'Montserrat font: on or off', 'albist-wp' ) ) {
            $fonts[] = 'Montserrat:400,700';
        }
        if ( 'off' !== _x( 'on', 'Lora font: on or off', 'albist-wp' ) ) {
            $fonts[] = 'Lora:400,400italic,700';
        }
        if ( 'off' !== _x( 'on', 'Raleway font: on or off', 'albist-wp' ) ) {
            $fonts[] = 'Raleway:400,200,300,500,600,700,800,900,100';
        }
        if ( $fonts ) {
            $fonts_url = add_query_arg( array(
                'family' => urlencode( implode( '|', $fonts ) ),
                'subset' => urlencode( $subsets ),
            ), 'https://fonts.googleapis.com/css' );
        }
        return $fonts_url;
    }
endif;
function albist_fonts_scripts() {
    wp_enqueue_style( 'albist-fonts', albist_fonts_url(), array(), '1.0.0' );
}
add_action( 'wp_enqueue_scripts', 'albist_fonts_scripts' );
// Theme Title
function albist_wp_title( $title, $sep ) {
    global $paged, $page;
    if ( is_feed() ) {
        return $title;
    }
    // Add the site name.
    $title .= get_bloginfo( 'name', 'display' );
    // Add the site description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) ) {
        $title = "$title $sep $site_description";
    }
    // Add a page number if necessary.
    if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
        $title = "$title $sep " . sprintf( esc_html__( 'Page %s', 'albist-wp' ), max( $paged, $page ) );
    }
    return $title;
}
add_filter( 'wp_title', 'albist_wp_title', 10, 2 );
add_theme_support( 'title-tag' );
// After Theme Setup
function albist_theme_setup() {
    // Add custom backgroud support
    add_theme_support( 'custom-background' );
    // Adds RSS feed links to <head> for posts and comments.
    add_theme_support( 'automatic-feed-links' );
    // Add editor style support
    add_editor_style( array( 'css/editor-style.css'));
}
add_action( 'after_setup_theme', 'albist_theme_setup' );
// Text Domain
load_theme_textdomain( 'albist-wp', get_template_directory() . '/languages' );
// Add custom background support
require get_template_directory() . '/lib/custom-header.php';
// Add Thumbnail Support
if ( function_exists( 'add_theme_support' ) ) {
    add_theme_support( 'post-thumbnails' );
}
// Content Width
if ( !isset( $content_width ) ) $content_width = 1000;
// Registering sidebars
function albist_wp_widgets_init() {
    register_sidebar(array(
        'name' => esc_html__( 'Category / Post Sidebar','albist-wp' ),
        'id' => 'blog',
        'description' => esc_html__( 'Widgets in this area will be shown at blog post sidebar position.','albist-wp' ),
        'before_title' => '<h5 class="side-tittle margin-top-50">',
        'after_title' => '</h5><hr class="main">',
        'after_widget' => '</div><div class="clearfix "></div>',
        'before_widget' => '<div id="%1$s" class="widget %2$s">'
    ));
    register_sidebar(array(
        'name' => esc_html__( 'Footer Widget Area 1','albist-wp' ),
        'id' => 'f1',
        'description' => esc_html__( 'Widgets in this area will be shown at footer widget area 1 position.','albist-wp' ),
        'before_title' => '<h6>',
        'after_title' => '</h6>',
        'after_widget' => '</div><div class="clearfix margin-bottom-20"></div>',
        'before_widget' => '<div id="%1$s" class="%2$s">'
    ));
    register_sidebar(array(
        'name' => esc_html__( 'Footer Widget Area 2','albist-wp' ),
        'id' => 'f2',
        'description' => esc_html__( 'Widgets in this area will be shown at footer widget area 2 position.','albist-wp' ),
        'before_title' => '<h6>',
        'after_title' => '</h6>',
        'after_widget' => '</div><div class="clearfix margin-bottom-20"></div>',
        'before_widget' => '<div id="%1$s" class="%2$s">'
    ));
    register_sidebar(array(
        'name' => esc_html__( 'Footer Widget Area 3','albist-wp' ),
        'id' => 'f3',
        'description' => esc_html__( 'Widgets in this area will be shown at footer widget area 3 position.','albist-wp' ),
        'before_title' => '<h6>',
        'after_title' => '</h6>',
        'after_widget' => '</div><div class="clearfix margin-bottom-20"></div>',
        'before_widget' => '<div id="%1$s" class="%2$s">'
    ));
    register_sidebar(array(
        'name' => esc_html__( 'Footer Widget Area 4','albist-wp' ),
        'id' => 'f4',
        'description' => esc_html__( 'Widgets in this area will be shown at footer widget area 4 position.','albist-wp' ),
        'before_title' => '<h6>',
        'after_title' => '</h6>',
        'after_widget' => '</div><div class="clearfix margin-bottom-20"></div>',
        'before_widget' => '<div id="%1$s" class="%2$s">'
    ));
}
add_action( 'widgets_init', 'albist_wp_widgets_init' );
// Registering Menus
function albist_register_menu() {
    $locations = array(
        'primary-menu' => esc_html__( 'Primary Menu', 'albist-wp' ),
        'hamburg-menu' => esc_html__( 'Hamburg Menu', 'albist-wp' )
    );
    register_nav_menus( $locations );
}
add_action( 'init', 'albist_register_menu' );
// Changing excerpt 'more' text
function new_excerpt_more($more) {
    global $post;
}
add_filter('excerpt_more', 'new_excerpt_more');
//albist multiple excerpt
function albist_excerpt($charlength) {
    $excerpt = get_the_excerpt();
    $charlength++;
    if(strlen($excerpt)>$charlength) {
        $subex = substr($excerpt,0,$charlength-5);
        $exwords = explode(" ",$subex);
        $excut = -(strlen($exwords[count($exwords)-1]));
        if($excut<0) {
            echo do_shortcode(substr($subex,0,$excut));
        } else {
            echo do_shortcode($subex);
        }
        echo "..";
    } else {
        echo do_shortcode($excerpt);
    }
}
function albist_shortcode_excerpt($charlength) {
    $excerpt = get_the_excerpt();
    $charlength++;
    if(strlen($excerpt)>$charlength) {
        $subex = substr($excerpt,0,$charlength-5);
        $exwords = explode(" ",$subex);
        $excut = -(strlen($exwords[count($exwords)-1]));
        if($excut<0) {
            return do_shortcode(substr($subex,0,$excut));
        } else {
            return do_shortcode($subex);
        }
    } else {
        return do_shortcode($excerpt);
    }
}
// Controling excerpt length
function custom_excerpt_length( $length ) {
    return 45;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
// Get Feature Image URL By Post ID
function albist_feature_image_url($post_id){
    $image_url = wp_get_attachment_url( get_post_thumbnail_id($post_id) );
    return $image_url;
}
//Pagination
function albist_pagination($pages = '', $range = 2){
    $showitems = ($range * 2)+1;
    global $paged;
    if(empty($paged)) $paged = 1;
    if($pages == ''){
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if(!$pages)
        {
            $pages = 1;
        }
    }
    if(1 != $pages){
        echo "<div class='clearfix clear'></div>";
        echo "<ul class='pagination no-margin animate fadeInUp' data-wow-delay='0.4s'>";
        if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link(1)."'><i class='fa fa-long-arrow-left'></i></a></li>";
        if($paged > 1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged - 1)."'>&laquo;</a></li>";
        for ($i=1; $i <= $pages; $i++){
            if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
                echo ($paged == $i)? "<li><a class='current'>".sprintf('%02d', $i).".</a></li>":"<li><a href='".get_pagenum_link($i)."' class='inactive' >".sprintf('%02d', $i).".</a></li>";
            }
        }
        if ($paged < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged + 1)."'>&raquo;</a></li>";
        if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($pages)."'><i class='fa fa-long-arrow-right'></i></a></li>";
        echo "</ul>\n";
    }
}
// Set avatar Class
add_filter('get_avatar','albist_add_gravatar_class');
function albist_add_gravatar_class($class) {
    $class = str_replace("class='avatar", "class='media-object img-responsive", $class);
    return $class;
}
// Registering custom Comments
function albist_comment($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);
    if ( 'div' == $args['style'] ) {
        $tag = 'div';
        $add_below = 'comment';
    } else {
        $tag = '';
        $add_below = 'div-comment';
    } ?>
    <li class="media">
        <div class="media-left">
            <a href="" class="avatar"><?php echo get_avatar( $comment, 92 ); ?></a>
        </div>
        <div class="media-body">
            <h6 class="media-heading"><?php comment_author(); ?><span> <?php printf( esc_html__('%1$s at %2$s','albist-wp'), get_comment_date(),  get_comment_time()); ?></span></h6>
            <?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
            <p><?php comment_text(); ?></p>
        </div>
    </li>
<?php
}
// Setting Post Views Count
function albist_getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, 0);
        return "0";
    }
    return $count;
}
function albist_setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
// Theme Widgets
require_once(get_template_directory() . "/lib/widgets.php");
// Get Post/Pages Meta Fields
function albist_wp_get_field( $name ){
    if(function_exists('get_field')){
        if(is_category()){
            $queried_object = get_queried_object();
            return get_field($name,$queried_object);
        } else {
            return get_field($name);
        }
    } else{
        return '';
    }
}
// Albist Styles
include_once(get_template_directory() . '/albist-styles-scripts.php');
// Google Web Fonts For Theme Options
function albist_wp_theme_options_fonts_url() {
    $heading_font = albist_wp_option("headings_font_face");
    if(empty($heading_font)){
        $heading_font = 'Dancing Script';
    }
    $heading_weight = albist_wp_option("headings_font_weight");
    if(empty($heading_weight)){
        $heading_weight = 400;
    }
    $meta_font = albist_wp_option("meta_font_face");
    if(empty($meta_font)){
        $meta_font = 'Roboto';
    }
    $meta_weight = albist_wp_option("meta_font_weight");
    if(empty($meta_weight)){
        $meta_weight = 700;
    }
    $body_font = albist_wp_option("body_font_face");
    if(empty($body_font)){
        $body_font = 'Oswald';
    }
    $body_weight = albist_wp_option("body_font_weight");
    if(empty($body_weight)){
        $body_weight = 700;
    }

    $font_url = '';
    if ( 'off' !== _x( 'on', 'Google font: on or off', 'albist-wp' ) ) {
        $font_url = add_query_arg( 'family', urlencode( $heading_font.'|'.$meta_font.'|'.$body_font.':'.$heading_weight.','.$meta_weight.','.$body_weight ), "//fonts.googleapis.com/css" );
    }
    return $font_url;
}
// Enqueue Fonts For Theme Options
function albist_wp_theme_options_scripts() {
    wp_enqueue_style( 'albist-wp-theme-options-fonts', albist_wp_theme_options_fonts_url(), array(), '1.0.0' );
}
add_action( 'wp_enqueue_scripts', 'albist_wp_theme_options_scripts' );
//Plugin Activation Class
require_once(get_template_directory() .'/lib/plugin-activation.php');
add_action( 'tgmpa_register', 'albist_register_required_plugins' );
function albist_register_required_plugins() {
    $plugins = array(
        // albist Visual Composer
        array(
            'name'               => esc_html__('Visual Composer','albist-wp'),
            'slug'               => 'js_composer', 
            'source'             => get_template_directory_uri() . '/lib/plugins/js_composer.zip',
            'required'           => true, 
            'version'            => '', 
            'force_activation'   => false, 
            'force_deactivation' => false, 
            'external_url'       => '', 
            'is_callable'        => '', 
        ),
        // albist Shortcodes
        array(
            'name'               => esc_html__('Theme Shortcodes','albist-wp'),
            'slug'               => 'albist-shortcodes', 
            'source'             => get_template_directory_uri() . '/lib/plugins/albist-shortcodes.zip',
            'required'           => true, 
            'version'            => '', 
            'force_activation'   => false, 
            'force_deactivation' => false, 
            'external_url'       => '', 
            'is_callable'        => '', 
        ),
        // albist CPT's
        array(
            'name'               => esc_html__('Custom Post Types','albist-wp'),
            'slug'               => 'albist-cpt', 
            'source'             => get_template_directory_uri() . '/lib/plugins/albist-cpt.zip',
            'required'           => true, 
            'version'            => '', 
            'force_activation'   => false, 
            'force_deactivation' => false, 
            'external_url'       => '', 
            'is_callable'        => '', 
        ),
        // albist Framework
        array(
            'name'               => esc_html__('Albist Framework','albist-wp'),
            'slug'               => 'albist-framework', 
            'source'             => get_template_directory_uri() . '/lib/plugins/albist-framework.zip',
            'required'           => true, 
            'version'            => '', 
            'force_activation'   => false, 
            'force_deactivation' => false, 
            'external_url'       => '', 
            'is_callable'        => '', 
        ),
        // Albist Revolution Slider
        array(
            'name'               => esc_html__('Revolution Slider','albist-wp'),
            'slug'               => 'revslider', 
            'source'             => get_template_directory_uri() . '/lib/plugins/revslider.zip',
            'required'           => true, 
            'version'            => '', 
            'force_activation'   => false, 
            'force_deactivation' => false, 
            'external_url'       => '', 
            'is_callable'        => '', 
        ),
        // Advanced Custom Fields
        array(
            'name'      => esc_html__('Advanced Custom Fields','albist-wp'),
            'slug'      => 'advanced-custom-fields',
            'required'  => true,
        ),
        //  Contact Form 7
        array(
            'name'      => esc_html__('Contact Form 7','albist-wp'),
            'slug'      => 'contact-form-7',
            'required'  => false,
        ),
        //  Mailpoet Newsletter
        array(
            'name'      => esc_html__('MailPoet Newsletters','albist-wp'),
            'slug'      => 'wysija-newsletters',
            'required'  => false,
        ),

    );
    $config = array(
        'id'           => 'albist-wp',
        'default_path' => '',
        'menu'         => 'tgmpa-install-plugins',
        'has_notices'  => true,
        'dismissable'  => true,
        'dismiss_msg'  => '',
        'is_automatic' => false,
        'message'      => '',

    );
    tgmpa( $plugins, $config );
}
// Check For Plugin Using Plugin Name
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
// Advanced Custom Fields
if ( is_plugin_active( 'advanced-custom-fields/acf.php' ) ) {
    function albist_register_fields(){
        include_once(get_template_directory() . '/lib/advanced-custom-fields/add-ons/acf-gallery/gallery.php');
        include_once(get_template_directory() . '/lib/advanced-custom-fields/add-ons/acf-repeater/repeater.php');
    }
    add_action('acf/register_fields', 'albist_register_fields');
    define( 'ACF_LITE', true );
    include_once(get_template_directory() . '/lib/advanced-custom-fields/custom-fields.php');
}
// Visual Composer Functions
if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {
    require_once( get_template_directory() . '/lib/visual-composer.php' );
    function albist_vc_styles() {
        wp_register_style( 'albist_vc_icons', get_template_directory_uri() . '/lib/vc_icons/albist_vc_icons.css', false, '1.0.0' );
        wp_enqueue_style( 'albist_vc_icons' );
    }
    add_action( 'admin_enqueue_scripts', 'albist_vc_styles' );
}
// Options Framework
if ( is_plugin_active( 'albist-framework/vafpress.php' ) ) {
    $tmpl_opt  = get_template_directory() . '/admin/option.php';
    // Create instance of Options
    $theme_options = new VP_Option(array(
        'is_dev_mode'           => false,
        'option_key'            => 'vpt_option',
        'page_slug'             => 'vpt_option',
        'template'              => $tmpl_opt,
        'menu_page'             => 'themes.php',
        'use_auto_group_naming' => true,
        'use_util_menu'         => true,
        'minimum_role'          => 'edit_theme_options',
        'layout'                => 'fixed',
        'page_title'            => esc_html__( 'Theme Options', 'albist-wp' ),
        'menu_label'            => esc_html__( 'Theme Options', 'albist-wp' ),
    ));
}
//Option Hook
function albist_wp_option( $name ){
    if(function_exists('vp_option')){
        return vp_option( "vpt_option." . $name );
    } else{
        return '';
    }
}
// Add Span To Categories Count
add_filter('wp_list_categories', 'albist_add_span_cat_count');
function albist_add_span_cat_count($links) {
    $links = str_replace('</a> (', '</a> <span>(', $links);
    $links = str_replace(')', ')</span>', $links);
    return $links;
}
// Return Children Menu Items
function albist_return_children_menu_items($parent_id){
    // Get Nav Slug
    $menu_name = 'primary-menu';
    $locations = get_nav_menu_locations();
    $menu_id = $locations[ $menu_name ] ;
    $nav_object = wp_get_nav_menu_object($menu_id);
    // End Get Nav Slug
    $all_nav_items = wp_get_nav_menu_items ($nav_object->slug);
    $children = array();
    foreach($all_nav_items as $row){
        if($row->menu_item_parent == $parent_id){
            $children[] = $row;
        }
    }
    return $children;
}
// Check If Menu Item Has Children Items
function albist_check_if_menu_item_has_children_items($parent_id){
    $children = get_posts(
        array(
            'post_type' => 'nav_menu_item',
            'nopaging' => true,
            'numberposts' => 1,
            'meta_key' => '_menu_item_menu_item_parent',
            'meta_value' => $parent_id
        )
    );
    return $children;
}
// Mega menu walker
require_once(get_template_directory() . "/includes/mega-menu/menu-item-custom-fields.php");
function albist_check_if_mega_menu_item_is_active($object_id,$top_id,$url){
    $home_url = get_home_url().'/';
    if($object_id == $top_id && $top_id != 1){
        echo 'id="active-item"';
    } elseif($url == $home_url && $top_id == 1 && !is_single()) {
        echo 'id="active-item"';
    }
}
// Add Body Dark Class
function albist_dark_body_classes( $b_class ) {
    $enable_dark = albist_wp_option('enable_dark');
    if($enable_dark == 1){
        $b_class[] = 'dark-version ';
    }
    return $b_class;
}
add_filter('body_class', 'albist_dark_body_classes');