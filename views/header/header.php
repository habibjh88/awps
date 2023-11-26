<?php
/**
 * Template part for displaying header
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package awps
 */
?>


	<div class="container">

		<div class="row align-middle">

			<div class="site-branding pl-1 pr-1">
				<h1 class="site-title">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<?php bloginfo( 'name' ); ?>
					</a>
				</h1>
			</div><!-- .site-branding -->

			<nav id="site-navigation" class="main-navigation pl-1 pr-1" role="navigation">
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

			<div class="menu-icon-wrapper d-flex pl-1 pr-1 ml-auto">
				<ul class="d-flex gap-15 align-middle">
					<li>
						<a class="menu-bar trigger-off-canvas" href="#">
							<span></span>
							<span></span>
							<span></span>
						</a>
					</li>
					<li>
						<a class="menu-search-bar dowp-search-trigger" href="#">
							<?php echo dowp_get_svg('search') ?>
						</a>
						<?php get_search_form(); ?>
					</li>
				</ul>
			</div>

		</div><!-- .row -->

	</div><!-- .container -->
