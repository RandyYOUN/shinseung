<?php
/*
 * Template Name: Contact Page
 */
get_header();
while(have_posts()): the_post();
    $contact_number = albist_wp_get_field('contact_number');
    $contact_email = albist_wp_get_field('contact_email');
    $contact_address = albist_wp_get_field('contact_address');
    $office_hours = albist_wp_get_field('office_hours');
    $heading_small_text = albist_wp_get_field('heading_small_text');
    $heading_large_text = albist_wp_get_field('heading_large_text');
    $contact_form_7_shortcode = albist_wp_get_field('contact_form_7_shortcode');
?>
<!-- Content -->
<div id="content">
    <!-- Contact Info -->
    <section class="light-gray-bg contact-info  padding-top-0 padding-bottom-0">
        <div class="row">
            <!-- MAP -->
            <div class="col-lg-6">
                <div id="map"></div>
            </div>
            <!-- Number -->
            <div class="col-lg-6">
                <div class="number">
                    <?php if(!empty($contact_number)){ ?>
                        <i class="lnr  lnr-phone-handset"></i>
                        <h1> <?php echo esc_attr($contact_number); ?> </h1>
                    <?php } if(!empty($contact_email)){ ?>
                        <p><?php echo esc_attr($contact_email); ?></p>
                    <?php } ?>
                </div>
                <!-- Address -->
                <div class="row">
                    <div class="col-sm-6">
                        <div class="info-office">
                            <?php if(!empty($contact_address)){ ?>
                                <h5><?php esc_attr_e('address','albist-wp'); ?></h5>
                                <?php echo do_shortcode($contact_address); ?>
                            <?php } if(!empty($office_hours)){ ?>
                                <h5><?php esc_attr_e('office hours','albist-wp'); ?></h5>
                                <?php echo do_shortcode($office_hours); ?>
                            <?php } ?>
                        </div>
                    </div>
                    <?php if(has_post_thumbnail()){ ?>
                    <!-- img -->
                    <div class="col-sm-6">
                        <img class="img-responsive" src="<?php echo albist_feature_image_url(get_the_ID()); ?>" alt="">
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Info -->
    <section class="contact-info  padding-top-150 padding-bottom-150">
        <div class="container">
            <!-- Heading -->
            <div class="heading text-center">
                <?php if(!empty($heading_small_text)){ ?>
                    <span><?php echo esc_attr($heading_small_text); ?></span>
                <?php } if(!empty($heading_large_text)){ ?>
                    <h4><?php echo esc_attr($heading_large_text); ?></h4>
                    <hr>
                <?php }
                the_content(); ?>
            </div>
            <?php if(!empty($contact_form_7_shortcode)){ ?>
            <!-- Contact  -->
            <section class="contact-us">
                <div class="contact-form">
                    <!-- FORM -->
                    <div id="contact_form">
                        <?php echo do_shortcode($contact_form_7_shortcode); ?>
                    </div>
                </div>
            </section>
            <?php } ?>
        </div>
    </section>
</div>
<?php endwhile;
get_footer(); ?>