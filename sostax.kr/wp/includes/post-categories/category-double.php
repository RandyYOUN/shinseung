<?php $category_post_sidebar = albist_wp_get_field('category_post_sidebar'); ?>
<!-- Blog -->
<section class="blog blog-page blog-col-2 padding-top-150 padding-bottom-150">
    <div class="container">
        <div class="row">
            <?php if($category_post_sidebar == 'left'){ ?>
                <div class="col-md-3">
                    <?php get_sidebar(); ?>
                </div>
            <?php } if($category_post_sidebar == 'left'){
                $class = 'col-md-9 padding-left-30';
            } elseif($category_post_sidebar == 'right') {
                $class = 'col-md-9 padding-right-30';
            } else {
                $class = 'col-md-12';
            } ?>
            <div class="<?php echo esc_attr($class); ?>">
                <!-- Row -->
                <div class="row">
                    <?php $count = 1;
                    while(have_posts()): the_post(); ?>
                        <!-- BLOG POST -->
                        <div class="col-md-6">
                            <article>
                                <?php if(has_post_thumbnail()){ ?>
                                    <img class="img-responsive" src="<?php echo albist_feature_image_url(get_the_ID()); ?>" alt="" >
                                <?php } ?>
                                <div class="post-info">
                                    <div class="post-in">
                                        <div class="extra">
                                            <span><i class="icon-calendar"></i><?php echo get_the_time('M j, Y'); ?></span>
                                            <span class="margin-left-15"><i class="icon-user"></i><?php the_author(); ?></span>
                                            <span class="margin-left-15"><i class="icon-bubbles"></i> <?php comments_number( '0', '1', '%' ); esc_attr_e(' Comments','albist-wp'); ?></span>
                                        </div>
                                        <a href="<?php the_permalink(); ?>" class="tittle-post"> <?php the_title(); ?></a>
                                        <p><?php the_excerpt(); ?></p>
                                        <a href="<?php the_permalink(); ?>" class="btn-1"><?php esc_attr_e('Read More','albist-wp'); ?> <i class="fa fa-angle-right"></i></a>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <?php if($count % 2 == 0){ ?>
                            <div class="clearfix"></div>
                    <?php } $count++;
                    endwhile; ?>
                </div>
                <!-- Pagination -->
                <?php albist_pagination($pages = '', $range = 2); ?>
            </div>
            <?php if($category_post_sidebar == 'right'){ ?>
                <div class="col-md-3">
                    <?php get_sidebar(); ?>
                </div>
            <?php } ?>
        </div>
    </div>
</section>