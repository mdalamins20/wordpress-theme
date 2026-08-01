<?php
if ( ! get_theme_mod( 'vyro_blog_enable_banner_section', false ) ) {
	return;
}

$vyro_blog_slider_content_ids  = $vyro_blog_editor_content_ids = array();
$vyro_blog_slider_content_type = get_theme_mod( 'vyro_blog_banner_slider_content_type', 'post' );
$vyro_blog_editor_content_type = get_theme_mod( 'vyro_blog_banner_editor_choice_content_type', 'post' );

if ( $vyro_blog_slider_content_type === 'post' ) {
	for ( $vyro_blog_i = 1; $vyro_blog_i <= 3; $vyro_blog_i++ ) {
		$vyro_blog_slider_content_ids[] = get_theme_mod( 'vyro_blog_banner_slider_content_post_' . $vyro_blog_i );
	}
	$vyro_blog_slider_args = array(
		'post_type'           => 'post',
		'posts_per_page'      => absint( 3 ),
		'ignore_sticky_posts' => true,
	);
	if ( ! empty( array_filter( $vyro_blog_slider_content_ids ) ) ) {
		$vyro_blog_slider_args['post__in'] = array_filter( $vyro_blog_slider_content_ids );
		$vyro_blog_slider_args['orderby']  = 'post__in';
	} else {
		$vyro_blog_slider_args['orderby'] = 'date';
	}
} else {
	$vyro_blog_cat_content_id = get_theme_mod( 'vyro_blog_banner_slider_content_category' );
	$vyro_blog_slider_args    = array(
		'cat'            => $vyro_blog_cat_content_id,
		'posts_per_page' => absint( 3 ),
	);
}

$vyro_blog_slider_args = apply_filters( 'vyro_blog_slider_section_args', $vyro_blog_slider_args );

if ( $vyro_blog_editor_content_type === 'post' ) {
	for ( $vyro_blog_i = 1; $vyro_blog_i <= 4; $vyro_blog_i++ ) {
		$vyro_blog_editor_content_ids[] = get_theme_mod( 'vyro_blog_banner_editor_choice_content_post_' . $vyro_blog_i );
	}
	$vyro_blog_editor_args = array(
		'post_type'           => 'post',
		'posts_per_page'      => absint( 4 ),
		'ignore_sticky_posts' => true,
	);
	if ( ! empty( array_filter( $vyro_blog_editor_content_ids ) ) ) {
		$vyro_blog_editor_args['post__in'] = array_filter( $vyro_blog_editor_content_ids );
		$vyro_blog_editor_args['orderby']  = 'post__in';
	} else {
		$vyro_blog_editor_args['orderby'] = 'date';
	}
} else {
	$vyro_blog_cat_content_id = get_theme_mod( 'vyro_blog_banner_editor_choice_content_category' );
	$vyro_blog_editor_args    = array(
		'cat'            => $vyro_blog_cat_content_id,
		'posts_per_page' => absint( 4 ),
	);
}

$vyro_blog_editor_args = apply_filters( 'vyro_blog_editor_choice_section_args', $vyro_blog_editor_args );

vyro_blog_render_slider_section( $vyro_blog_slider_args, $vyro_blog_editor_args );

/**
 * Render Banner Section.
 */
function vyro_blog_render_slider_section( $vyro_blog_slider_args, $vyro_blog_editor_args ) {
	?>

	<section id="vyro_blog_banner_section" class="banner-section section-splitter banner-style-1">
		<?php
		if ( is_customize_preview() ) :
			vyro_blog_section_link( 'vyro_blog_banner_section' );
		endif;
		?>
		<div class="section-wrapper">
			<div class="banner-container-wrapper">
				<?php
				$vyro_blog_editor_query = new WP_Query( $vyro_blog_editor_args );
				if ( $vyro_blog_editor_query->have_posts() ) {
					?>
					<div class="editors-choice">
						<div class="post-wrapper">
							<?php
							$vyro_blog_i = 1;
							while ( $vyro_blog_editor_query->have_posts() ) :
								$vyro_blog_editor_query->the_post();
								?>
								<div class="blog-post-container tile-layout">
									<div class="blog-post-inner <?php echo esc_attr( has_post_thumbnail() ? 'has-thumbnail' : 'no-thumbnail' ); ?>">
										<?php if ( has_post_thumbnail() ) : ?>
											<div class="blog-post-image">
												<a href="<?php the_permalink(); ?>">
													<?php the_post_thumbnail( 'post-thumbnail' ); ?>
												</a>
											</div>
										<?php endif; ?>
										<div class="blog-post-detail">
											<h3 class="post-main-title">
												<span class="post-counter"><?php echo absint( $vyro_blog_i ); ?></span>
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
				<?php } ?>

				<div class="banner-slider-part">
					<?php
					$vyro_blog_slider_query = new WP_Query( $vyro_blog_slider_args );
					if ( $vyro_blog_slider_query->have_posts() ) {
						?>
						<div class="banner-wrapper">
							<div class="banner-slider slick-button">
								<?php
								while ( $vyro_blog_slider_query->have_posts() ) :
									$vyro_blog_slider_query->the_post();
									?>
									<div class="blog-post-container tile-layout">
										<div class="blog-post-inner <?php echo esc_attr( has_post_thumbnail() ? 'has-thumbnail' : 'no-thumbnail' ); ?>">
											<?php if ( has_post_thumbnail() ) : ?>
												<div class="blog-post-image">
													<a href="<?php the_permalink(); ?>">
														<?php the_post_thumbnail( 'post-thumbnail' ); ?>
													</a>
												</div>
											<?php endif; ?>
											<div class="blog-post-detail">
												<ul class="post-categories">
													<?php vyro_blog_categories_list(); ?>
												</ul>
												<h3 class="post-main-title">
													<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
												</h3>
												<p class="post-excerpt">
													<?php echo esc_html( wp_trim_words( get_the_excerpt(), 20 ) ); ?>
												</p>
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
								endwhile;
								wp_reset_postdata();
								?>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</section>

	<?php
}
