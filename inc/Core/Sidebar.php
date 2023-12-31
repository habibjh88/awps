<?php

namespace Awps\Core;

/**
 * Sidebar.
 */
class Sidebar {
	/**
	 * register default hooks and actions for WordPress
	 * @return
	 */
	public function register() {
		add_action( 'widgets_init', array( $this, 'widgets_init' ) );

		//Add input fields(priority 5, 3 parameters)
		add_action( 'in_widget_form', [ $this, 'kk_in_widget_form' ], 5, 3 );
		//Callback function for options update (priorität 5, 3 parameters)
		add_filter( 'widget_update_callback', [ $this, 'kk_in_widget_form_update' ], 5, 3 );
		//add class names (default priority, one parameter)
		add_filter( 'dynamic_sidebar_params', [ $this, 'kk_dynamic_sidebar_params' ] );
	}

	/*
		Define the sidebar
	*/
	public function widgets_init() {
		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar', 'awps' ),
			'id'            => 'dowp-sidebar',
			'description'   => esc_html__( 'Default sidebar to add all your widgets.', 'awps' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s p-2">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Footer Sidebar', 'awps' ),
			'id'            => 'dowp-footer-sidebar',
			'description'   => esc_html__( 'Footer sidebar to add all your widgets.', 'awps' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s p-2">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
	}

	function kk_in_widget_form( $t, $return, $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '', 'float' => 'none' ) );
		if ( ! isset( $instance['float'] ) ) {
			$instance['float'] = null;
		}
		if ( ! isset( $instance['texttest'] ) ) {
			$instance['texttest'] = null;
		}
		?>
		<p>
			<input id="<?php echo $t->get_field_id( 'width' ); ?>" name="<?php echo $t->get_field_name( 'width' ); ?>" type="checkbox" <?php checked( isset( $instance['width'] ) ? $instance['width'] : 0 ); ?> />
			<label for="<?php echo $t->get_field_id( 'width' ); ?>"><?php _e( 'halbe Breite' ); ?></label>
		</p>
		<p>
			<label for="<?php echo $t->get_field_id( 'float' ); ?>">Float:</label>
			<select id="<?php echo $t->get_field_id( 'float' ); ?>" name="<?php echo $t->get_field_name( 'float' ); ?>">
				<option <?php selected( $instance['float'], 'auto' ); ?> value="auto">none</option>
				<option <?php selected( $instance['float'], 'left' ); ?>value="left">left</option>
				<option <?php selected( $instance['float'], 'right' ); ?> value="right">right</option>
			</select>
		</p>
		<input type="text" name="<?php echo $t->get_field_name( 'texttest' ); ?>" id="<?php echo $t->get_field_id( 'texttest' ); ?>" value="<?php echo $instance['texttest']; ?>"/>
		<?php
		$retrun = null;
		return array( $t, $return, $instance );
	}

	function kk_in_widget_form_update( $instance, $new_instance, $old_instance ) {
		$instance['width']    = isset( $new_instance['width'] );
		$instance['float']    = $new_instance['float'];
		$instance['texttest'] = strip_tags( $new_instance['texttest'] );

		return $instance;
	}

	function kk_dynamic_sidebar_params( $params ) {
		global $wp_registered_widgets;
		$widget_id  = $params[0]['widget_id'];
		$widget_obj = $wp_registered_widgets[ $widget_id ];
		$widget_opt = get_option( $widget_obj['callback'][0]->option_name );
		$widget_num = $widget_obj['params'][0]['number'];
		if ( isset( $widget_opt[ $widget_num ]['width'] ) ) {
			if ( isset( $widget_opt[ $widget_num ]['float'] ) ) {
				$float = $widget_opt[ $widget_num ]['float'];
			} else {
				$float = '';
			}
			$params[0]['before_widget'] = preg_replace( '/class="/', 'class="' . $float . ' half ', $params[0]['before_widget'], 1 );
		}

		return $params;
	}
}
