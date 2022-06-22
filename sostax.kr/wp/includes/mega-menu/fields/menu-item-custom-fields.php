<?php
/**
 * Menu item custom fields example
 */
/**
 * Sample menu item metadata
 *
 * This class demonstrate the usage of Menu Item Custom Fields in plugins/themes.
 *
 * @since 0.1.0
 */
class Menu_Item_Custom_Fields_Example {

	/**
	 * Holds our custom fields
	 *
	 * @var    array
	 * @access protected
	 * @since  Menu_Item_Custom_Fields_Example 0.2.0
	 */
	protected static $fields = array();
	/**
	 * Initialize plugin
	 */
	public static function init() {
		add_action( 'wp_nav_menu_item_custom_fields', array( __CLASS__, '_fields' ), 10, 4 );
		add_action( 'wp_update_nav_menu_item', array( __CLASS__, '_save' ), 10, 3 );
		add_filter( 'manage_nav-menus_columns', array( __CLASS__, '_columns' ), 99 );

		self::$fields = array(
			'fajar_menu_icons' => esc_html__( 'Select Icon', 'albist-wp' ),
		);
	}
	/**
	 * Save custom field value
	 *
	 * @wp_hook action wp_update_nav_menu_item
	 *
	 * @param int   $menu_id         Nav menu ID
	 * @param int   $menu_item_db_id Menu item ID
	 * @param array $menu_item_args  Menu item data
	 */
	public static function _save( $menu_id, $menu_item_db_id, $menu_item_args ) {
		if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
			return;
		}

		check_admin_referer( 'update-nav_menu', 'update-nav-menu-nonce' );

		foreach ( self::$fields as $_key => $label ) {
			$key = sprintf( 'menu_item_%s', $_key );

			// Sanitize
			if ( ! empty( $_POST[ $key ][ $menu_item_db_id ] ) ) {
				// Do some checks here...
				$value = $_POST[ $key ][ $menu_item_db_id ];
			}
			else {
				$value = null;
			}

			// Update
			if ( ! is_null( $value ) ) {
				update_post_meta( $menu_item_db_id, $key, $value );
			}
			else {
				delete_post_meta( $menu_item_db_id, $key );
			}
		}
	}
	/**
	 * Print field
	 *
	 * @param object $item  Menu item data object.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args  Menu item args.
	 * @param int    $id    Nav menu ID.
	 *
	 * @return string Form fields
	 */
	public static function _fields( $id, $item, $depth, $args ) {
		foreach ( self::$fields as $_key => $label ) :
			$key   = sprintf( 'menu_item_%s', $_key );
			$id    = sprintf( 'edit-%s-%s', $key, $item->ID );
			$name  = sprintf( '%s[%s]', $key, $item->ID );
			$value = get_post_meta( $item->ID, $key, true );
			$class = sprintf( 'field-%s', $_key );
            // Custom Icons List
            $icons = array(
                'icon-hotairballoon',
                'icon-layers',
                'icon-browser',
                'icon-beaker',
                'icon-clock',
                'icon-quote',
                'icon-pencil',
                'icon-grid',
                'icon-facebook-1',
                'icon-email-1',
                'icon-mobile',
                'icon-laptop',
                'icon-desktop',
                'icon-tablet',
                'icon-phone',
                'icon-document',
                'icon-newspaper',
                'icon-calendar',
                'icon-pictures',
                'icon-picture',
                'icon-video',
                'icon-camera',
                'icon-printer',
                'icon-toolbox',
                'icon-briefcase',
                'icon-wallet',
                'icon-gift',
                'icon-edit',
                'icon-ribbon',
                'icon-trophy',
                'icon-shield',
                'icon-basket',
                'icon-envelope',
                'icon-attachment',
                'icon-pricetags',
                'icon-pencil',
                'icon-tools',
                'icon-paintbrush',
                'icon-magnifying-glass',
                'icon-mic',
                'icon-beaker',
                'icon-caution',
                'icon-profile-male',
                'icon-profile-female',
                'icon-bike',
                'icon-globe',
                'icon-chat',
                'icon-heart',
                'icon-upload',
                'icon-download',
                'icon-clock',
                'icon-happy',
                'icon-sad',
                'icon-twitter',
                'icon-googleplus',
                'icon-rss',
                'icon-tumblr',
                'icon-linkedin',
                'icon-dribbble',
                'icon-number',
                'icon-quote2',
                'icon-tag',
                'icon-cogs',
                'icon-android',
                'icon-sale',
                'icon-direction',
                'icon-lamp',
                'icon-battery',
                'icon-male',
                'icon-female',
                'icon-moon',
                'icon-sun',
                'icon-bus',
                'icon-shop',
                'icon-cart',
                'icon-star'
            );
            $iconsList = '<option>Select</option>';
            foreach($icons as $icon){
                $iconsList = $iconsList .'<option value="'.$icon.'">'.$icon.'</option>';
            } ?>
				<p class="description description-wide <?php echo esc_attr( $class ) ?>">
					<?php printf(
						'<label for="%1$s">%2$s<br />
						<select id="%1$s" class="widefat %1$s" name="%3$s">
						    <option value="%4$s" selected>%4$s</option>
						    %5$s
						</select>
						</label>',
						esc_attr( $id ),
						esc_html( $label ),
						esc_attr( $name ),
						esc_attr( $value ),
						$iconsList
					) ?>
				</p>
			<?php
		endforeach;
	}
	/**
	 * Add our fields to the screen options toggle
	 *
	 * @param array $columns Menu item columns
	 * @return array
	 */
	public static function _columns( $columns ) {
		$columns = array_merge( $columns, self::$fields );

		return $columns;
	}
}
Menu_Item_Custom_Fields_Example::init();
