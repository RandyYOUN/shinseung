<?php get_header(); ?>
<!-- Content -->
<div id="content">
    <!-- Blog -->
    <section class="blog blog-page blog-single padding-top-150 padding-bottom-150">
        <div class="container">
            <div class="row">
                <?php $disable_sidebar = albist_wp_option('disable_sidebar');
                if($disable_sidebar == 1){
                    $col = 'col-md-12';
                } else{
                    $col = 'col-md-9 padding-right-30';
                }
                $hide_feature_image = albist_wp_option('hide_feature_image');
                $hide_date = albist_wp_option('hide_date');
                $hide_author = albist_wp_option('hide_author');
                $hide_comments_count = albist_wp_option('hide_comments_count');
                while(have_posts()): the_post(); ?>
                    <div class="<?php echo esc_attr($col); ?>">
                        <!-- Row -->
                        <div class="row">
                            <!-- BLOG POST -->
                            <div class="col-md-12">
                                <article>
                                    <?php if($hide_feature_image != 1){
                                        if(has_post_thumbnail()){ ?>
                                            <img class="img-responsive" src="<?php echo albist_feature_image_url(get_the_ID()); ?>" alt="" >
                                        <?php }
                                    } ?>
                                    <div class="post-info">
                                        <div class="post-in">
                                            <div class="extra">
                                                <?php if($hide_date != 1){ ?>
                                                    <span><i class="icon-calendar"></i><?php echo get_the_time('M j, Y'); ?></span>
                                                <?php } if($hide_author != 1){ ?>
                                                    <span class="margin-left-15"><i class="icon-user"></i><?php the_author(); ?></span>
                                                <?php } if($hide_comments_count != 1){ ?>
                                                    <span class="margin-left-15"><i class="icon-bubbles"></i> <?php comments_number( '0', '1', '%' ); esc_attr_e(' Comments','albist-wp'); ?></span>
                                                <?php } ?>
                                            </div>
                                            <a href="<?php the_permalink(); ?>" class="tittle-post"><?php the_title(); ?></a>
                                            <?php the_content(); ?>
                                            <div class="clear"></div>
                                            <?php posts_nav_link(); ?>
                                            <?php wp_link_pages( array( 'before' => '<div class="page-link">' . esc_html__( 'Pages:', 'albist-wp' ), 'after' => '</div>' ) ); ?>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        </div>
                        <?php comments_template(); ?>
                    </div>
                <?php endwhile; ?>
                <div id="none" <?php post_class(); ?>>
                    <p><?php the_tags(); ?></p>
                    <p><?php the_post_thumbnail(); ?></p>
                </div>
                <?php if($disable_sidebar != 1){ ?>
                    <!-- Side Bar -->
                    <div class="col-md-3">
                        <?php get_sidebar(); ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
</div>
<?php get_footer(); ?>