<?php get_header(); ?>
    <!-- Content -->
    <div id="content">
        <section class="blog blog-page padding-top-150 padding-bottom-150">
            <div class="container">
                <div class="row">
                    <div class="col-md-9 padding-right-30">
                        <!-- Row -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="heading text-center">
                                    <h4><?php printf( esc_html__( 'Search: %s', 'albist-wp' ), get_search_query() ); ?></h4>
                                    <hr>
                                </div>
                            </div>
                            <?php if(have_posts()):
                            while(have_posts()): the_post(); ?>
                                <!-- BLOG POST -->
                                <div class="col-md-12">
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
                            <?php endwhile;
                            else: ?>
                            <p class="text-center"><?php esc_attr_e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'albist-wp' ); ?></p>
                            <?php endif; ?>
                        </div>
                        <!-- Pagination -->
                        <?php albist_pagination($pages = '', $range = 2); ?>
                    </div>
                    <!-- Side Bar -->
                    <div class="col-md-3">
                        <?php get_sidebar(); ?>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php get_footer(); ?>