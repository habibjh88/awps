<?php

namespace Awps\Setup;

/**
 * Enqueue.
 */
class Enqueue {
	/**
	 * register default hooks and actions for WordPress
	 * @return
	 */
	public function register() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
	}

	/**
	 * Notice the mix() function in wp_enqueue_...
	 * It provides the path to a versioned asset by Laravel Mix using querystring-based
	 * cache-busting (This means, the file name won't change, but the md5. Look here for
	 * more information: https://github.com/JeffreyWay/laravel-mix/issues/920 )
	 */
	public function enqueue_scripts() {
		// Deregister the built-in version of jQuery from WordPress

		// CSS
		wp_enqueue_style( 'main', mix( 'css/style.css' ), array(), '1.0.0', 'all' );

		// JS
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'main', mix( 'js/app.js' ), array( 'jquery' ), '1.0.0', true );

		// Extra
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
}
