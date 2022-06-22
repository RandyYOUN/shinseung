<?php get_header();
while(have_posts()): the_post(); ?>
    <!-- Content -->
    <div id="content">
        <?php $page_layout = albist_wp_get_field('page_layout');
        $hide_page_title = albist_wp_get_field('hide_page_title');
        if($page_layout == 'fullwidth'){
            the_content();
        } else{ ?>
            <section class="padding-top-150 padding-bottom-100">
                <div class="container">
                    <?php if($hide_page_title != 'yes'){ ?>
                        <div class="heading text-left">
                            <h4><?php the_title(); ?></h4>
                            <hr>
                        </div>
                    <?php } ?>
                    <div class="inner-content">
                        <?php the_content(); ?>
                    </div>
                </div>
            </section>
        <?php } ?>
        <!-- Comment Template -->
        <?php if (comments_open()) { ?>
            <section>
                <div class="container">
                    <?php comments_template(); ?>
                </div>
            </section>
        <?php } ?>
    </div>
<?php endwhile;
get_footer(); ?>