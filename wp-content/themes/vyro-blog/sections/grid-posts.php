<?php

if ( ! get_theme_mod( 'vyro_blog_enable_grid_posts_section', false ) ) {
	return;
}

$vyro_blog_grid_posts_content_ids  = array();
$vyro_blog_grid_posts_content_type = get_theme_mod( 'vyro_blog_grid_posts_content_type', 'post' );

if ( $vyro_blog_grid_posts_content_type === 'post' ) {
	for ( $vyro_blog_i = 1; $vyro_blog_i <= 3; $vyro_blog_i++ ) {
		$vyro_blog_grid_posts_content_ids[] = get_theme_mod( 'vyro_blog_grid_posts_content_post_' . $vyro_blog_i );
	}
	$vyro_blog_grid_posts_args = array(
		'post_type'           => 'post',
		'posts_per_page'      => absint( 3 ),
		'ignore_sticky_posts' => true,
	);
	if ( ! empty( array_filter( $vyro_blog_grid_posts_content_ids ) ) ) {
		$vyro_blog_grid_posts_args['post__in'] = array_filter( $vyro_blog_grid_posts_content_ids );
		$vyro_blog_grid_posts_args['orderby']  = 'post__in';
	} else {
		$vyro_blog_grid_posts_args['orderby'] = 'date';
	}
} else {
	$vyro_blog_cat_content_id  = get_theme_mod( 'vyro_blog_grid_posts_content_category' );
	$vyro_blog_grid_posts_args = array(
		'cat'            => $vyro_blog_cat_content_id,
		'posts_per_page' => absint( 3 ),
	);
}
$vyro_blog_grid_posts_args = apply_filters( 'vyro_blog_grid_posts_section_args', $vyro_blog_grid_posts_args );

vyro_blog_render_grid_posts_section( $vyro_blog_grid_posts_args );

/**
 * Render Grid Posts Section.
 */
function vyro_blog_render_grid_posts_section( $vyro_blog_grid_posts_args ) {
	$vyro_blog_query = new WP_Query( $vyro_blog_grid_posts_args );
	if ( $vyro_blog_query->have_posts() ) {
		$vyro_blog_grid_posts_title      = get_theme_mod( 'vyro_blog_grid_posts_section_title', __( 'Grid Posts Section', 'vyro-blog' ) );
		$vyro_blog_grid_posts_button     = get_theme_mod( 'vyro_blog_grid_posts_view_all_button_label', __( 'View All', 'vyro-blog' ) );
		$vyro_blog_grid_posts_button_url = get_theme_mod( 'vyro_blog_grid_posts_view_all_button_url', '' );
		?>
		<section id="vyro_blog_grid_posts_section" class="grid-section section-splitter grid-style-2">
			<?php
			if ( is_customize_preview() ) :
				vyro_blog_section_link( 'vyro_blog_grid_posts_section' );
			endif;
			?>
			<div class="section-wrapper">
				<?php if ( ! empty( $vyro_blog_grid_posts_title || $vyro_blog_grid_posts_button ) ) : ?>
					<div class="section-title">
						<div class="title-heading">
							<h3 class="main-title"><?php echo esc_html( $vyro_blog_grid_posts_title ); ?></h3>
						</div>
						<span class="heading-dash"></span>
						<?php if ( ! empty( $vyro_blog_grid_posts_button ) ) : ?>
							<a href="<?php echo esc_url( $vyro_blog_grid_posts_button_url ); ?>" class="view-all"><?php echo esc_html( $vyro_blog_grid_posts_button ); ?></a>
						<?php endif; ?>
					</div>
				<?php endif; ?>
				<div class="blog-post-container-wrapper">
					<?php
					$vyro_blog_i = 1;
					while ( $vyro_blog_query->have_posts() ) :
						$vyro_blog_query->the_post();
						?>
						<div class="blog-post-container grid-layout">
							<div class="blog-post-inner">
								<?php if ( has_post_thumbnail() ) { ?>
									<div class="blog-post-image">
										<a href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail( 'post-thumbnail' ); ?>
										</a>
									</div>
								<?php } ?>
								<div class="blog-post-detail">
									<ul class="post-categories">
										<?php vyro_blog_categories_list(); ?>
									</ul>
									<h3 class="post-main-title">
										<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									</h3>
									<div class="post-meta">
										<div class="post-meta-wrapper post-author-date">
											<?php
											vyro_blog_posted_by();
											vyro_blog_posted_on();
											?>
										</div>
										<div class="post-meta-wrapper read-time-post-views">
											<span class="read-time">
												<?php
												echo vyro_blog_reading_time( get_the_content() );
												echo esc_html__( ' min read', 'vyro-blog' );
												?>
											</span>
											<span class="post-views"><?php echo getPostViews( get_the_ID() ); ?></span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php
						$vyro_blog_i++;
					endwhile;
					wp_reset_postdata();
					?>
				</div>
			</div>
		</section>
		<?php
	}
}
