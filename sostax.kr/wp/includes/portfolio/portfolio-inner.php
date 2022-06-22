<?php
/*
 * Portfolio Inner Details
 */
$small_caption_above_title = albist_wp_get_field('small_caption_above_title');
$portfolio_client_name = albist_wp_get_field('portfolio_client_name');
$portfolio_skills = albist_wp_get_field('portfolio_skills');
$project_date = albist_wp_get_field('project_date');
$project_url = albist_wp_get_field('project_url');
$project_extra_images = albist_wp_get_field('project_extra_images');

$client_string = albist_wp_get_field('client_string');
$skills_string = albist_wp_get_field('skills_string');
$date_string = albist_wp_get_field('date_string');
$launch_project_string = albist_wp_get_field('launch_project_string');
?>
<div class="container">
    <!-- Heading -->
    <div class="heading text-center margin-bottom-30">
        <?php if(!empty($small_caption_above_title)){ ?>
            <span><?php echo esc_attr($small_caption_above_title); ?></span>
        <?php } ?>
        <h4><?php the_title(); ?></h4>
        <hr class="margin-bottom-40">
        <?php the_content(); ?>
    </div>
    <!-- Project Info -->
    <div class="text-center">
        <ul class="projext-info">
            <?php if(!empty($portfolio_client_name)){ ?>
                <li><span><?php echo esc_attr($client_string); ?> - </span> <?php echo esc_attr($portfolio_client_name); ?></li>
            <?php }if(!empty($portfolio_skills)){ ?>
                <li><span><?php echo esc_attr($skills_string); ?> - </span> <?php echo esc_attr($portfolio_skills); ?></li>
            <?php } if(!empty($project_date)){ ?>
                <li><span><?php echo esc_attr($date_string); ?>   - </span> <?php echo esc_attr($project_date); ?></li>
            <?php } ?>
        </ul>
        <?php if(!empty($project_url)){ ?>
            <a href="<?php echo esc_url($project_url); ?>" class="btn-1 btn-2 margin-top-50"><?php echo esc_attr($launch_project_string); ?> <i class="fa fa-plus"></i></a>
        <?php } ?>
    </div>
    <?php if(is_array($project_extra_images)){ ?>
        <div class="project-img">
            <ul class="row">
                <?php foreach($project_extra_images as $img){ ?>
                    <li class="col-md-6">
                        <img class="img-responsive" src="<?php echo esc_url($img['url']); ?>" alt="">
                    </li>
                <?php } ?>
            </ul>
        </div>
    <?php } ?>
</div>