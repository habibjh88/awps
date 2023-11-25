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

			<nav id="site-navigation" class="main-navigation mr-auto pl-1 pr-1" role="navigation">
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

			<div class="menu-icon-wrapper d-flex pl-1 pr-1">
				<ul class="d-flex gap-15 align-middle">
					<li>
						<a class="menu-bar trigger-off-canvas" href="#">
							<span></span>
							<span></span>
							<span></span>
						</a>
					</li>
					<li>
						<a class="search-bar" href="#">
							<svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M11.3938 2.01175C8.90994 2.01591 6.52904 3.00445 4.77271 4.76078C3.01638 6.51711 2.02785 8.89801 2.02368 11.3818C2.02576 13.8677 3.01313 16.2515 4.76945 18.0108C6.52578 19.77 8.90786 20.7614 11.3938 20.7677C13.5985 20.7677 15.63 19.9921 17.2363 18.7086L21.1379 22.6102C21.3355 22.794 21.5967 22.894 21.8665 22.8893C22.1364 22.8845 22.3939 22.7754 22.585 22.5848C22.7761 22.3942 22.8859 22.137 22.8914 21.8672C22.8968 21.5973 22.7975 21.3359 22.6142 21.1377L18.7127 17.2322C20.0452 15.575 20.7716 13.5123 20.7717 11.3858C20.7717 6.22041 16.5591 2.01175 11.3938 2.01175ZM11.3938 4.09836C15.4331 4.09836 18.6851 7.3464 18.6851 11.3818C18.6851 15.4173 15.4331 18.685 11.3938 18.685C7.35439 18.685 4.10636 15.4291 4.10636 11.3897C4.10636 7.35033 7.35439 4.09836 11.3938 4.09836Z" fill="#575757"/>
							</svg>
						</a>
					</li>
				</ul>
			</div>

		</div><!-- .row -->

	</div><!-- .container -->
