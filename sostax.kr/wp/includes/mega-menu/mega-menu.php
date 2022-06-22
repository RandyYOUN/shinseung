<?php
/*
  * Custom Mega Menu For Primary Menu Location.
  */
$top_id = get_the_ID();
if ( has_nav_menu( 'primary-menu' ) ) {
    // Get Nav Slug
    $menu_name = 'primary-menu';
    $locations = get_nav_menu_locations();
    $menu_id = $locations[ $menu_name ] ;
    $nav_object = wp_get_nav_menu_object($menu_id);
    // End Get Nav Slug
    $all_nav_items = wp_get_nav_menu_items ($nav_object->slug);

	if(is_array($all_nav_items)){
    	foreach($all_nav_items as $ani){
        if($ani->menu_item_parent == 0){
            $children = albist_check_if_menu_item_has_children_items($ani->ID);
            if (!empty($children)) {
                $top_extra_classes = $ani->classes;
                $cs = '';
                foreach($top_extra_classes as $ec){
                    $cs = $cs.' '.$ec;
                }
                $li_children = 'class="'.$cs.'"';
                $a_children = '';
                $a_caret = '';
            } else {
                $top_extra_classes = $ani->classes;
                $cs = '';
                foreach($top_extra_classes as $ec){
                    $cs = $cs.' '.$ec;
                }
                if(!empty($cs)){
                    $li_children = 'class="'.$cs.'"';
                } else {
                    $li_children = '';
                }
                $a_children = '';
                $a_caret = '';
            } ?>
            <li <?php echo ''.$li_children; ?> <?php albist_check_if_mega_menu_item_is_active($ani->object_id,$top_id,$ani->url); ?>>
                <a <?php if(!empty($ani->target)) { ?>target="<?php echo esc_attr($ani->target); ?>" <?php } ?> href="<?php echo esc_url($ani->url); ?>" <?php echo ''.$a_children; ?>>
                    <?php echo ''.$ani->title.' '.$a_caret; ?>
                </a>
                <!-- Second Level Menu -->
                <?php $second_chil = albist_return_children_menu_items($ani->ID);
                if(is_array($second_chil) && !empty($second_chil) && !in_array('meganav',$top_extra_classes)){ ?>
                    <ul class="dropdown animated-3s fadeIn" role="menu">
                        <?php foreach($second_chil as $second_ani){
                            $children = albist_check_if_menu_item_has_children_items($second_ani->ID);
                            // Icon For Menu
                            $icon = get_post_meta($second_ani->ID,'menu_item_fajar_menu_icons',true);
                            if(!empty($icon)){
                                $icon = '<i class="'.$icon.' nav-left-icon"></i>';
                            } else {
                                $icon = '';
                            }
                            if (!empty($children)) {
                                $extra_classes = $second_ani->classes;
                                $cs = '';
                                foreach($extra_classes as $ec){
                                    $cs = $cs.' '.$ec;
                                }
                                $li_children = 'class="'.$cs.'"';

                                $a_caret = $icon.'<i class="icon-angle-right pull-right"></i>';
                            } else {
                                $li_children = '';
                                if(!empty($icon)){
                                    $a_caret = $icon;
                                } else {
                                    $a_caret = '<i class="icon-angle-right pull-left"></i>';
                                }
                            } ?>
                            <li <?php echo ''.$li_children; ?>>
                                <a <?php if(!empty($second_ani->target)){ ?>target="<?php echo esc_attr($second_ani->target); ?>" <?php } ?> href="<?php echo esc_url($second_ani->url); ?>">
                                    <?php echo ''.$a_caret.' '.$second_ani->title; ?>
                                </a>
                                <!-- Third Level Menu -->
                                <?php $third_chil = albist_return_children_menu_items($second_ani->ID);
                                if(is_array($third_chil) && !empty($third_chil)){ ?>
                                    <ul class="dropdown animated-3s fadeIn" role="menu">
                                        <?php foreach($third_chil as $row){
                                            $extra_classes = $row->classes;
                                            $cs = '';
                                            foreach($extra_classes as $ec){
                                                $cs = $cs.' '.$ec;
                                            } ?>
                                            <li <?php if(!empty($cs)){ echo 'class="'.$cs.'"'; }?>>
                                                <a <?php if(!empty($row->target)){ ?> target="<?php echo esc_attr($row->target); ?>" <?php } ?> href="<?php echo esc_url($row->url); ?>">
                                                    <?php echo ''.$row->title; ?>
                                                </a>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                <?php } ?>
                            </li>
                        <?php } ?>
                    </ul>
                <?php } elseif(is_array($second_chil) && !empty($second_chil) && in_array('meganav',$top_extra_classes)){ ?>
                    <!-- Mega Menu -->
                    <ul class="megamenu full-width">
                        <li>
                            <div class="row">
                                <?php
                                // Check if the menu item has children items
                                $mega_columns_data = array();
                                foreach($second_chil as $second_ani){
                                    $mega_children = albist_check_if_menu_item_has_children_items($second_ani->ID);
                                    if(!empty($mega_children) && count($mega_children) >= 1){
                                        $mega_columns_data[] = array(
                                            'parent_ID' =>  $second_ani->ID,
                                            'column_class' =>  $second_ani->classes[0]
                                        );
                                    }
                                }
                                // Loop through parent ID's to get each column children items
                                $columns = array(
                                    'col-lg-1','col-lg-2','col-lg-3','col-lg-4','col-lg-5','col-lg-6','col-lg-7','col-lg-8','col-lg-9','col-lg-10','col-lg-11','col-lg-12',
                                    'col-md-1','col-md-2','col-md-3','col-md-4','col-md-5','col-md-6','col-md-7','col-md-8','col-md-9','col-md-10','col-md-11','col-md-12',
                                    'col-sm-1','col-sm-2','col-sm-3','col-sm-4','col-sm-5','col-sm-6','col-sm-7','col-sm-8','col-sm-9','col-sm-10','col-sm-11','col-sm-12',
                                    'col-xs-1','col-xs-2','col-xs-3','col-xs-4','col-xs-5','col-xs-6','col-xs-7','col-xs-8','col-xs-9','col-xs-10','col-xs-11','col-xs-12'
                                );
                                foreach($mega_columns_data as $row){
                                    if(in_array($row['column_class'],$columns)){
                                        $class = $row['column_class'];
                                    } else {
                                        $class = 'col-sm-3';
                                    }
                                    // Get Number of children items as per parent ID
                                    $mega_chill = albist_return_children_menu_items($row['parent_ID']);
                                    if(is_array($mega_chill)){ ?>
                                        <div class="<?php echo ''.$class; ?>">
                                            <ul>
                                                <?php foreach($mega_chill as $row){
                                                    if($row->classes[0] == 'heading'){ ?>
                                                        <li class="nav-heading"><h6><?php echo ''.$row->title; ?></h6></li>
                                                    <?php } else{
                                                        $extra_classes = $row->classes;
                                                        $cs = '';
                                                        foreach($extra_classes as $ec){
                                                            $cs = $cs.' '.$ec;
                                                        } ?>
                                                        <li class="<?php echo ''.$cs; ?>">
                                                            <a <?php if(!empty($row->target)){ ?>target="<?php echo esc_attr($row->target); ?>" <?php } ?> href="<?php echo esc_url($row->url); ?>">
                                                                <i class="icon-angle-right"></i>
                                                                <?php echo ''.$row->title; ?>
                                                            </a>
                                                        </li>
                                                    <?php }
                                                } ?>
                                            </ul>
                                        </div>
                                    <?php }
                                } ?>
                            </div>
                        </li>
                    </ul>
                <?php } ?>
            </li>
        <?php }
    }
	}
} ?>