<?php

namespace Awps\Custom;

/**
 * Extras.
 */
class Extras {
	/**
	 * register default hooks and actions for WordPress
	 * @return
	 */
	public function register() {
		add_filter( 'body_class', array( $this, 'body_class' ) );
		add_action( 'wp_nav_menu_item_custom_fields', [ $this, 'menu_customize' ], 10, 2 );
		add_action( 'wp_update_nav_menu_item', [ $this, 'menu_update' ], 10, 2 );
		add_filter( 'wp_get_nav_menu_items', [ $this, 'menu_modify' ], 11, 3 );
		add_filter( 'get_search_form', [ $this, 'search_form' ] );
	}

	/*
	 * Body Class added
	 */
	public function body_class( $classes ) {

		// Adds a class of group-blog to blogs with more than 1 published author.

		if ( is_multi_author() ) {
			$classes[] = 'group-blog';
		}
		// Adds a class of hfeed to non-singular pages.
		if ( ! is_singular() ) {
			$classes[] = 'hfeed';
		}

		return $classes;
	}

	/*
	 * Menu Customize
	 */
	function menu_customize( $item_id, $item ) {
		//Mega menu
		$_mega_menu = get_post_meta( $item_id, 'dowp_mega_menu', true );
		//Query string
		$menu_query_string_key = get_post_meta( $item_id, 'dowp_menu_qs_key', true );
		$menu_query_string     = get_post_meta( $item_id, 'dowp_menu_qs', true );
		?>

		<?php if ( $item->menu_item_parent < 1 ) : ?>
			<p class="description mega-menu-wrapper widefat">
				<label for="dowp_mega_menu-<?php echo $item_id; ?>" class="widefat">
					<?php _e( 'Make as Mega Menu', 'awps' ); ?><br>
					<select class="widefat" id="dowp_mega_menu-<?php echo $item_id; ?>" name="dowp_mega_menu[<?php echo $item_id; ?>]">
						<option value=""><?php _e( "Choose Mega Menu", "awps" ) ?></option>
						<?php
						for ( $item = 2; $item < 12; $item ++ ) {
							$menu_item  = $item;
							$class_hide = null;
							$label_hide = '';
							if ( $item > 6 ) {
								$menu_item  -= 5;
								$class_hide = ' hide-header';
								$label_hide = ' — Hide Col Title';
							}
							$class    = "mega-menu mega-menu-col-{$menu_item}" . $class_hide ?? "";
							$selected = ( $_mega_menu == $class ) ? ' selected="selected" ' : null;
							?>
							<option <?php echo esc_attr( $selected ) ?> value="<?php echo esc_attr( $class ) ?>">
								<?php _e( "Mega menu - {$menu_item} Col {$label_hide}", 'awps' ) ?>
							</option>
							<?php
						}
						?>
					</select>
				</label>
			</p>
		<?php endif; ?>

		<div class="menu-query-string" style="width:100%">
			<p class="description description-thin">
				<label for="dowp-menu-qs-key-<?php echo $item_id; ?>">
					<?php _e( 'Query String Key', 'homlisti-core' ); ?><br>
					<input type="text"
						   id="dowp-menu-qs-key-<?php echo $item_id; ?>"
						   name="dowp-menu-qs-key[<?php echo $item_id; ?>]"
						   value="<?php echo esc_html( $menu_query_string_key ); ?>"
					/>
				</label>
			</p>
			<p class="description description-thin">
				<label for="dowp-menu-qs-<?php echo $item_id; ?>">
					<?php _e( 'Query String Value', 'homlisti-core' ); ?><br>
					<input type="text"
						   id="dowp-menu-qs-<?php echo $item_id; ?>"
						   name="dowp-menu-qs[<?php echo $item_id; ?>]"
						   value="<?php echo esc_html( $menu_query_string ); ?>"
					/>
				</label>
			</p>
		</div>

		<?php

	}

	/**
	 * Menu Update
	 *
	 * @param $menu_id
	 * @param $menu_item_db_id
	 *
	 * @return void
	 */
	function menu_update( $menu_id, $menu_item_db_id ) {
		$_mega_menu         = $_POST['dowp_mega_menu'][ $menu_item_db_id ] ?? '';
		$query_string_key   = $_POST['dowp-menu-qs-key'][ $menu_item_db_id ] ?? '';
		$query_string_value = $_POST['dowp-menu-qs'][ $menu_item_db_id ] ?? '';

		update_post_meta( $menu_item_db_id, 'dowp_mega_menu', $_mega_menu );
		update_post_meta( $menu_item_db_id, 'dowp_menu_qs_key', $query_string_key );
		update_post_meta( $menu_item_db_id, 'dowp_menu_qs', $query_string_value );
	}

	/**
	 * Modify Menu item
	 *
	 * @param $items
	 * @param $menu
	 * @param $args
	 *
	 * @return mixed
	 */
	function menu_modify( $items, $menu, $args ) {
		foreach ( $items as $item ) {
			$menu_query_string_key = get_post_meta( $item->ID, 'dowp_menu_qs_key', true );
			$menu_query_string     = get_post_meta( $item->ID, 'dowp_menu_qs', true );
			if ( $menu_query_string ) {
				$item->url = add_query_arg( $menu_query_string_key, $menu_query_string, $item->url );
			}
		}

		return $items;
	}

	/**
	 * Search form modify
	 * @return string
	 */
	public function search_form() {
		$output = '
		<form method="get" class="dowp-search-form" action="' . esc_url( home_url( '/' ) ) . '">
            <div class="search-box">
				<input type="text" class="form-control" placeholder="' . esc_attr__( 'Search here...', 'homlisti' ) . '" value="' . get_search_query() . '" name="s" />
				<button class="item-btn" type="submit">
					' . dowp_get_svg( 'search' ) . '
				</button>
            </div>
		</form>
		';

		return $output;
	}
}
