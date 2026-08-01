<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Vyro Blog
 */

if ( ! is_front_page() || is_home() ) {
	?>
</div>
</div>
</div>
	<?php
}

if ( is_front_page() ) {
	require get_template_directory() . '/sections/above-footer-widgets.php';
}
?>

<footer class="site-footer">
	<div class="section-wrapper">
		<?php if ( is_active_sidebar( 'footer-widget' ) || is_active_sidebar( 'footer-widget-2' ) || is_active_sidebar( 'footer-widget-3' ) || is_active_sidebar( 'footer-widget-4' ) ) : ?>
			<div class="vyro-blog-middle-footer">
				<div class="middle-footer-wrapper four-column">
					<?php for ( $vyro_blog_i = 1; $vyro_blog_i <= 4; $vyro_blog_i++ ) { ?>
						<div class="footer-container-wrapper">
							<div class="footer-content-inside">
								<?php dynamic_sidebar( 'footer-widget-' . $vyro_blog_i ); ?>
							</div>
						</div>
					<?php } ?>
				</div>	
			</div>
		<?php endif; ?>
		<div class="vyro-blog-bottom-footer">
			<?php $vyro_blog_social_menu_class = get_theme_mod( 'vyro_blog_enable_footer_social_menu', true ) === true && has_nav_menu( 'social' ) ? '' : 'no-social-menu'; ?>
			<div class="bottom-footer-content <?php echo esc_attr( $vyro_blog_social_menu_class ); ?>">
				<?php

				/**
				 * Hook: vyro_blog_footer_copyright.
				 *
				 * @hooked - vyro_blog_output_footer_copyright_content - 10
				 */
				do_action( 'vyro_blog_footer_copyright' );

				?>
				<div class="header-social-icon">
					<div class="header-social-icon-container">
						<?php
						if ( has_nav_menu( 'social' ) ) {
							wp_nav_menu(
								array(
									'container'      => 'ul',
									'menu_class'     => 'social-links',
									'theme_location' => 'social',
									'link_before'    => '<span class="screen-reader-text">',
									'link_after'     => '</span>',
								)
							);
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>

<a href="#" class="scroll-to-top"></a>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
