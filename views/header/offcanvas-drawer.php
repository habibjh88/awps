<?php
/**
 * Template part for displaying header offcanvas
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package awps
 */
?>


<div class="awps-offcanvas-drawer">

	<nav id="site-navigation" class="offcanvas-navigation" role="navigation">
		<?php
		if ( has_nav_menu( 'primary' ) ) :
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'menu_id'        => 'primary-menu',
					'walker'         => new Awps\Core\WalkerNav(),
				)
			);
		endif;
		?>
	</nav><!-- .main-navigation -->

</div><!-- .container -->

<div class="awps-body-overlay"></div>
