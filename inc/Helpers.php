<?php
/**
 * Helpers methods
 * List all your static functions you wish to use globally on your theme
 *
 * @package awps
 */

if ( ! function_exists( 'dd' ) ) {
	/**
	 * Var_dump and die method
	 *
	 * @return void
	 */
	function dd() {
		echo '<pre>';
		array_map( function ( $x ) {
			var_dump( $x );
		}, func_get_args() );
		echo '</pre>';
		die;
	}
}

if ( ! function_exists( 'starts_with' ) ) {
	/**
	 * Determine if a given string starts with a given substring.
	 *
	 * @param string $haystack
	 * @param string|array $needles
	 *
	 * @return bool
	 */
	function starts_with( $haystack, $needles ) {
		foreach ( (array) $needles as $needle ) {
			if ( $needle != '' && substr( $haystack, 0, strlen( $needle ) ) === (string) $needle ) {
				return true;
			}
		}

		return false;
	}
}

if ( ! function_exists( 'mix' ) ) {
	/**
	 * Get the path to a versioned Mix file.
	 *
	 * @param string $path
	 * @param string $manifestDirectory
	 *
	 * @return \Illuminate\Support\HtmlString
	 *
	 * @throws \Exception
	 */
	function mix( $path, $manifestDirectory = '' ) {
		if ( ! $manifestDirectory ) {
			//Setup path for standard AWPS-Folder-Structure
			$manifestDirectory = "assets/dist/";
		}
		static $manifest;
		if ( ! starts_with( $path, '/' ) ) {
			$path = "/{$path}";
		}
		if ( $manifestDirectory && ! starts_with( $manifestDirectory, '/' ) ) {
			$manifestDirectory = "/{$manifestDirectory}";
		}
		$rootDir = dirname( __FILE__, 2 );
		if ( file_exists( $rootDir . '/' . $manifestDirectory . '/hot' ) ) {
			return getenv( 'WP_SITEURL' ) . ":8080" . $path;
		}
		if ( ! $manifest ) {
			$manifestPath = $rootDir . $manifestDirectory . 'mix-manifest.json';
			if ( ! file_exists( $manifestPath ) ) {
				throw new Exception( 'The Mix manifest does not exist.' );
			}
			$manifest = json_decode( file_get_contents( $manifestPath ), true );
		}

		if ( starts_with( $manifest[ $path ], '/' ) ) {
			$manifest[ $path ] = ltrim( $manifest[ $path ], '/' );
		}

		$path = $manifestDirectory . $manifest[ $path ];

		return get_template_directory_uri() . $path;
	}
}

if ( ! function_exists( 'assets' ) ) {
	/**
	 * Easily point to the assets dist folder.
	 *
	 * @param string $path
	 */
	function assets( $path ) {
		if ( ! $path ) {
			return;
		}

		echo get_template_directory_uri() . '/assets/dist/' . $path;
	}
}

if ( ! function_exists( 'svg' ) ) {
	/**
	 * Easily point to the assets dist folder.
	 *
	 * @param string $path
	 */
	function svg( $path ) {
		if ( ! $path ) {
			return;
		}

		echo get_template_part( 'assets/dist/svg/inline', $path . '.svg' );
	}
}

if ( ! function_exists( 'dowp_get_svg' ) ) {
	/**
	 * Get svg icon
	 * @param $name
	 *
	 * @return string|void
	 */
	function dowp_get_svg( $name ) {

		switch ($name) {
		  case "search":
		    return '<svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M11.3938 2.01175C8.90994 2.01591 6.52904 3.00445 4.77271 4.76078C3.01638 6.51711 2.02785 8.89801 2.02368 11.3818C2.02576 13.8677 3.01313 16.2515 4.76945 18.0108C6.52578 19.77 8.90786 20.7614 11.3938 20.7677C13.5985 20.7677 15.63 19.9921 17.2363 18.7086L21.1379 22.6102C21.3355 22.794 21.5967 22.894 21.8665 22.8893C22.1364 22.8845 22.3939 22.7754 22.585 22.5848C22.7761 22.3942 22.8859 22.137 22.8914 21.8672C22.8968 21.5973 22.7975 21.3359 22.6142 21.1377L18.7127 17.2322C20.0452 15.575 20.7716 13.5123 20.7717 11.3858C20.7717 6.22041 16.5591 2.01175 11.3938 2.01175ZM11.3938 4.09836C15.4331 4.09836 18.6851 7.3464 18.6851 11.3818C18.6851 15.4173 15.4331 18.685 11.3938 18.685C7.35439 18.685 4.10636 15.4291 4.10636 11.3897C4.10636 7.35033 7.35439 4.09836 11.3938 4.09836Z" fill="#575757"/>
					</svg>';
		    break;
		  case "blue":
		    echo "Your favorite color is blue!";
		    break;
		  case "green":
		    echo "Your favorite color is green!";
		    break;
		  default:
		    echo "Your favorite color is neither red, blue, nor green!";
		}
	}
}


