<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Vyro Blog
 */

get_header();
?>
<main id="primary" class="site-main">

	<?php
	while ( have_posts() ) :
		the_post();

		setPostViews( get_the_ID() );

		get_template_part( 'template-parts/content', 'single' );

		do_action( 'vyro_blog_post_navigation' );

		if ( is_singular( 'post' ) ) {
			$vyro_blog_related_posts_label = get_theme_mod( 'vyro_blog_post_related_post_label', __( 'Related Posts', 'vyro-blog' ) );
			$vyro_blog_args                = array(
				'posts_per_page' => 3,
				'post__not_in'   => array( $post->ID ),
				'orderby'        => 'rand',
			);

			$vyro_blog_cat_content_id = get_the_category( $post->ID );
			if ( ! empty( $vyro_blog_cat_content_id ) ) {
				$vyro_blog_args['cat'] = $vyro_blog_cat_content_id[0]->term_id;
			}

			$vyro_blog_query = new WP_Query( $vyro_blog_args );

			if ( $vyro_blog_query->have_posts() ) :
				?>
				<div class="related-posts">
					<h2><?php echo esc_html( $vyro_blog_related_posts_label ); ?></h2>
					<div class="row">
						<?php
						while ( $vyro_blog_query->have_posts() ) :
							$vyro_blog_query->the_post();
							?>
							<div>
								<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
									<?php vyro_blog_post_thumbnail(); ?>
									<div class="post-text">
										<header class="entry-header">
											<?php the_title( '<h5 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h5>' ); ?>
										</header><!-- .entry-header -->
										<div class="entry-content">
											<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 20 ) ); ?></p>
										</div><!-- .entry-content -->
									</div>
								</article>
							</div>
							<?php
						endwhile;
						wp_reset_postdata();
						?>
					</div>
				</div>
				<?php
			endif;
		}

		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
	endif;

	endwhile; // End of the loop.
	?>

</main><!-- #main -->

<?php
if ( vyro_blog_is_sidebar_enabled() ) {
	get_sidebar();
}

get_footer();
