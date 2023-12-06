<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package awps
 */

?>

</div><!-- #content -->

<?php
if ( is_customize_preview() ) {
	echo '<div id="awps-footer-control" style="margin-top:-30px;position:absolute;"></div>';
}
?>

<footer class="site-footer" role="contentinfo">

	<div class="footer-area">
		<div class="container">
			<div class="footer-widgets row">
				<?php dynamic_sidebar('dowp-footer-sidebar'); ?>
			</div>
		</div>

	</div><!-- .site-info -->

	<div id="awps-footer-copy-control" class="footer-copyright text-center">
		<?php
		printf(
			'<a href="%s">%s</a>',
			esc_url( __( 'https://github.com/Alecaddd/awps', 'awps' ) ),
			'&copy copyright '
		);
		?>
	</div>
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
