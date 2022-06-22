<?php // Creating Social Icons Widget
class social_icons_widget extends WP_Widget {
    function __construct() {
        parent::__construct(
// Base ID of your widget
            'social_icons_widget',
// Widget name will appear in UI
            esc_html__('Albist WP Social Icons', 'albist-wp'),
// Widget description
            array( 'description' => esc_html__( 'Use this widget for social icons.', 'albist-wp' ), )
        );
    }
// Creating widget front-end
// This is where the action happens
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );

        $facebook = apply_filters( 'facebook', $instance['facebook'] );
        $twitter = apply_filters( 'twitter', $instance['twitter'] );
        $google_plus = apply_filters( 'google_plus', $instance['google_plus'] );
        $linkedin = apply_filters( 'linkedin', $instance['linkedin'] );
        $pinterest = apply_filters( 'pinterest', $instance['pinterest'] );
        $instagram = apply_filters( 'instagram', $instance['instagram'] );
// before and after widget arguments are defined by themes
        echo ''.$args['before_widget'];
        if ( ! empty( $title ) )
            echo ''.$args['before_title'] . $title . $args['after_title'];
        ?>
        <div class="social_icons">
            <?php if(!empty($facebook)){ ?>
                <a href="<?php echo esc_url($facebook); ?>"><i class="fa fa-facebook"></i></a>
            <?php } if(!empty($twitter)){ ?>
                <a href="<?php echo esc_url($twitter); ?>"><i class="fa fa-twitter"></i></a>
            <?php } if(!empty($google_plus)){ ?>
                <a href="<?php echo esc_url($google_plus); ?>"><i class="fa fa-google-plus"></i></a>
            <?php } if(!empty($linkedin)){ ?>
                <a href="<?php echo esc_url($linkedin); ?>"><i class="fa fa-linkedin"></i></a>
            <?php } if(!empty($pinterest)){ ?>
                <a href="<?php echo esc_url($pinterest); ?>"><i class="fa fa-pinterest"></i></a>
            <?php } if(!empty($instagram)){ ?>
                <a href="<?php echo esc_url($instagram); ?>"><i class="fa fa-instagram"></i></a>
            <?php } ?>
        </div>
        <?php echo ''.$args['after_widget'];
    }
// Widget Backend
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        } else {
            $title = "";
        }
        if ( isset( $instance[ 'facebook' ] ) ) {
            $facebook = $instance[ 'facebook' ];
        } else {
            $facebook = "";
        }
        if ( isset( $instance[ 'twitter' ] ) ) {
            $twitter = $instance[ 'twitter' ];
        } else {
            $twitter = "";
        }
        if ( isset( $instance[ 'google_plus' ] ) ) {
            $google_plus = $instance[ 'google_plus' ];
        } else {
            $google_plus = "";
        }
        if ( isset( $instance[ 'linkedin' ] ) ) {
            $linkedin = $instance[ 'linkedin' ];
        } else {
            $linkedin = "";
        }
        if ( isset( $instance[ 'pinterest' ] ) ) {
            $pinterest = $instance[ 'pinterest' ];
        } else {
            $pinterest = "";
        }
        if ( isset( $instance[ 'instagram' ] ) ) {
            $instagram = $instance[ 'instagram' ];
        } else {
            $instagram = "";
        }
        // Widget admin form
        ?>
        <p>
            <label for="<?php echo ''.$this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:','albist-wp' ); ?></label>
            <input class="widefat" id="<?php echo ''.$this->get_field_id( 'title' ); ?>" name="<?php echo ''.$this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo ''.$this->get_field_id( 'facebook' ); ?>"><?php esc_html_e( 'Facebook:','albist-wp' ); ?></label>
            <input class="widefat" id="<?php echo ''.$this->get_field_id( 'facebook' ); ?>" name="<?php echo ''.$this->get_field_name( 'facebook' ); ?>" type="text" value="<?php echo esc_attr( $facebook ); ?>" />
        </p>
        <p>
            <label for="<?php echo ''.$this->get_field_id( 'twitter' ); ?>"><?php esc_html_e( 'Twitter:','albist-wp' ); ?></label>
            <input class="widefat" id="<?php echo ''.$this->get_field_id( 'twitter' ); ?>" name="<?php echo ''.$this->get_field_name( 'twitter' ); ?>" type="text" value="<?php echo esc_attr( $twitter ); ?>" />
        </p>
        <p>
            <label for="<?php echo ''.$this->get_field_id( 'google_plus' ); ?>"><?php esc_html_e( 'Google Plus:','albist-wp' ); ?></label>
            <input class="widefat" id="<?php echo ''.$this->get_field_id( 'google_plus' ); ?>" name="<?php echo ''.$this->get_field_name( 'google_plus' ); ?>" type="text" value="<?php echo esc_attr( $google_plus ); ?>" />
        </p>
        <p>
            <label for="<?php echo ''.$this->get_field_id( 'linkedin' ); ?>"><?php esc_html_e( 'Linkedin:','albist-wp' ); ?></label>
            <input class="widefat" id="<?php echo ''.$this->get_field_id( 'linkedin' ); ?>" name="<?php echo ''.$this->get_field_name( 'linkedin' ); ?>" type="text" value="<?php echo esc_attr( $linkedin ); ?>" />
        </p>
        <p>
            <label for="<?php echo ''.$this->get_field_id( 'pinterest' ); ?>"><?php esc_html_e( 'Pinterest:','albist-wp' ); ?></label>
            <input class="widefat" id="<?php echo ''.$this->get_field_id( 'pinterest' ); ?>" name="<?php echo ''.$this->get_field_name( 'pinterest' ); ?>" type="text" value="<?php echo esc_attr( $pinterest ); ?>" />
        </p>
        <p>
            <label for="<?php echo ''.$this->get_field_id( 'instagram' ); ?>"><?php esc_html_e( 'Instagram:','albist-wp' ); ?></label>
            <input class="widefat" id="<?php echo ''.$this->get_field_id( 'instagram' ); ?>" name="<?php echo ''.$this->get_field_name( 'instagram' ); ?>" type="text" value="<?php echo esc_attr( $instagram ); ?>" />
        </p>
    <?php
    }
// Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['facebook'] = ( ! empty( $new_instance['facebook'] ) ) ? strip_tags( $new_instance['facebook'] ) : '';
        $instance['twitter'] = ( ! empty( $new_instance['twitter'] ) ) ? strip_tags( $new_instance['twitter'] ) : '';
        $instance['google_plus'] = ( ! empty( $new_instance['google_plus'] ) ) ? strip_tags( $new_instance['google_plus'] ) : '';
        $instance['linkedin'] = ( ! empty( $new_instance['linkedin'] ) ) ? strip_tags( $new_instance['linkedin'] ) : '';
        $instance['pinterest'] = ( ! empty( $new_instance['pinterest'] ) ) ? strip_tags( $new_instance['pinterest'] ) : '';
        $instance['instagram'] = ( ! empty( $new_instance['instagram'] ) ) ? strip_tags( $new_instance['instagram'] ) : '';
        return $instance;
    }
} // Class tweets_widget ends here
// Register and load the widget
function social_icons_load_widget() {
    register_widget( 'social_icons_widget' );
}
add_action( 'widgets_init', 'social_icons_load_widget' );
// Creating Recent Post With Thumbnail Widget
class recent_posts_widget2 extends WP_Widget {
    function __construct() {
        parent::__construct(
// Base ID of your widget
            'recent_posts_widget',
// Widget name will appear in UI
            esc_html__('Albist WP Recent Posts With Thumbnails', 'albist-wp'),
// Widget description
            array( 'description' => esc_html__( 'Use this widget for recent posts with thumbnails.', 'albist-wp' ), )
        );
    }
// Creating widget front-end
// This is where the action happens
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );
        $number_posts = apply_filters( 'number_posts', $instance['number_posts'] );
// before and after widget arguments are defined by themes
        echo ''.$args['before_widget'];
        if ( ! empty( $title ) )
            echo ''.$args['before_title'] . $title . $args['after_title'];
// This is where you run the code and display the output
        if(!empty ($number_posts))
            $argo = array(
                'post_type' => 'post',
                'posts_per_page'    => $number_posts,
                'order' => 'DESC',
                'post_status' => 'publish'
            );
        $query = new WP_Query( $argo );
        $rp_count = 50; ?>
        <ul class="papu-post margin-top-20">
            <?php while($query->have_posts()): $query->the_post(); ?>
                <li class="media">
                    <?php if(has_post_thumbnail()){ ?>
                        <div class="media-left">
                            <a href="<?php the_permalink(); ?>">
                                <img class="media-object" src="<?php echo albist_feature_image_url(get_the_ID()); ?>" alt="">
                            </a>
                        </div>
                    <?php } ?>
                    <div class="media-body">
                        <a class="media-heading" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        <span><?php echo get_the_time('M j, Y'); ?></span>
                    </div>
                </li>
                <?php endwhile; ?>
        </ul>
            <?php wp_reset_postdata();
        echo ''.$args['after_widget'];
    }
// Widget Backend
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        } else {
            $title = "Recent Posts";
        }
        if ( isset( $instance[ 'number_posts' ] ) ) {
            $number_posts = $instance[ 'number_posts' ];
        } else {
            $number_posts = 5;
        }
// Widget admin form
        ?>
        <p>
            <label for="<?php echo ''.$this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:','albist-wp' ); ?></label>
            <input class="widefat" id="<?php echo ''.$this->get_field_id( 'title' ); ?>" name="<?php echo ''.$this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo ''.$this->get_field_id( 'number_posts' ); ?>"><?php esc_html_e( 'Number Of Posts:','albist-wp' ); ?></label>
            <input class="widefat" id="<?php echo ''.$this->get_field_id( 'number_posts' ); ?>" name="<?php echo ''.$this->get_field_name( 'number_posts' ); ?>" type="number" value="<?php echo esc_attr( $number_posts ); ?>" />
        </p>
    <?php
    }
// Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['number_posts'] = ( ! empty( $new_instance['number_posts'] ) ) ? strip_tags( $new_instance['number_posts'] ) : '';
        return $instance;
    }
} // Class recent_posts_widget ends here
// Register and load the widget
function rp_load_widget2() {
    register_widget( 'recent_posts_widget2' );
}
add_action( 'widgets_init', 'rp_load_widget2' );

// Creating Photo Stream Widget
class photo_stream_widget extends WP_Widget {
    function __construct() {
        parent::__construct(
// Base ID of your widget
            'photo_stream_widget',
// Widget name will appear in UI
            esc_html__('Albist WP Photo Stream', 'albist-wp'),
// Widget description
            array( 'description' => esc_html__( 'Use this widget for photo stream.', 'albist-wp' ), )
        );
    }
// Creating widget front-end
// This is where the action happens
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );
        $mediaID = apply_filters( 'mediaID', $instance['mediaID'] );
        $ex_mediaID = explode(',',$mediaID);
// before and after widget arguments are defined by themes
        echo ''.$args['before_widget'];
        if ( ! empty( $title ) )
            echo ''.$args['before_title'] . $title . $args['after_title'];
// This is where you run the code and display the output
        if(is_array($ex_mediaID)){ ?>
        <div class="flicker">
            <div class="single-slide">
                <?php foreach($ex_mediaID as $img){
                    $image_info = wp_get_attachment_image_src( $img, 'full' ); ?>
                <div>
                    <a href="<?php echo esc_url($image_info[0]); ?>" data-lighter>
                        <img class="img-responsive" src="<?php echo esc_url($image_info[0]); ?>" alt="" >
                    </a>
                </div>
                <?php } ?>
            </div>
        </div>
        <?php }
        echo ''.$args['after_widget'];
    }
// Widget Backend
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        } else {
            $title = "Photo Stream";
        }
        if ( isset( $instance[ 'mediaID' ] ) ) {
            $mediaID = $instance[ 'mediaID' ];
        } else {
            $mediaID = '';
        }
// Widget admin form
        ?>
        <p>
            <label for="<?php echo ''.$this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:','albist-wp' ); ?></label>
            <input class="widefat" id="<?php echo ''.$this->get_field_id( 'title' ); ?>" name="<?php echo ''.$this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo ''.$this->get_field_id( 'mediaID' ); ?>"><?php esc_html_e( 'Media IDs:','albist-wp' ); ?></label>
            <input class="widefat" id="<?php echo ''.$this->get_field_id( 'mediaID' ); ?>" name="<?php echo ''.$this->get_field_name( 'mediaID' ); ?>" type="text" value="<?php echo esc_attr( $mediaID ); ?>" />
            <small><?php echo esc_html__('Separate attachment/media IDs by single comma.','albist-wp'); ?></small>
        </p>
    <?php
    }
// Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['mediaID'] = ( ! empty( $new_instance['mediaID'] ) ) ? strip_tags( $new_instance['mediaID'] ) : '';
        return $instance;
    }
} // Class recent_posts_widget ends here
// Register and load the widget
function photo_stream_widget() {
    register_widget( 'photo_stream_widget' );
}
add_action( 'widgets_init', 'photo_stream_widget' );
?>