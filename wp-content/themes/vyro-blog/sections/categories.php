<?php
if ( ! get_theme_mod( 'vyro_blog_enable_categories_section', false ) ) {
	return;
}
$vyro_blog_section_content = $vyro_blog_content_ids = array();
for ( $vyro_blog_i = 1; $vyro_blog_i <= 4; $vyro_blog_i++ ) {
	$vyro_blog_content_post_id = get_theme_mod( 'vyro_blog_categories_content_category_' . $vyro_blog_i );
	if ( ! empty( $vyro_blog_content_post_id ) ) {
		$vyro_blog_content_ids[] = $vyro_blog_content_post_id;
	}
}
$vyro_blog_args = array(
	'taxonomy'   => 'category',
	'number'     => 4,
	'include'    => array_filter( $vyro_blog_content_ids ),
	'orderby'    => 'include',
	'hide_empty' => false,
);

$vyro_blog_terms = get_terms( $vyro_blog_args );
$vyro_blog_i     = 1;
foreach ( $vyro_blog_terms as $vyro_blog_value ) {
	$data['title']         = $vyro_blog_value->name;
	$data['count']         = $vyro_blog_value->count;
	$data['permalink']     = get_term_link( $vyro_blog_value->term_id );
	$data['thumbnail_url'] = get_theme_mod( 'vyro_blog_category_category_image_' . $vyro_blog_i, '' );

	array_push( $vyro_blog_section_content, $data );
	$vyro_blog_i++;
}

$vyro_blog_section_content = apply_filters( 'vyro_blog_categories_section_content', $vyro_blog_section_content );

vyro_blog_render_categories_section( $vyro_blog_section_content );

/**
 * Render Categories Section
 */
function vyro_blog_render_categories_section( $vyro_blog_section_content ) {

	$vyro_blog_categories_title = get_theme_mod( 'vyro_blog_categories_title', __( 'Categories Section', 'vyro-blog' ) );
	?>

	<section id="vyro_blog_categories_section" class="categories-section section-splitter categories-style-1">
		<?php
		if ( is_customize_preview() ) :
			vyro_blog_section_link( 'vyro_blog_categories_section' );
		endif;
		?>
		<div class="section-wrapper">
			<?php if ( ! empty( $vyro_blog_categories_title ) ) : ?>
				<div class="section-title">
					<div class="title-heading">
						<?php if ( ! empty( $vyro_blog_categories_title ) ) { ?>
							<h3 class="main-title" ><?php echo esc_html( $vyro_blog_categories_title ); ?></h3>
							<?php
						}
						?>
					</div>
					<span class="heading-dash"></span>
				</div>
			<?php endif; ?>
			<div class="categories-container-wrapper column-4">
				<?php foreach ( $vyro_blog_section_content as $vyro_blog_content ) : ?>
					<div class="categories-container">
						<div class="categories-inner <?php echo esc_attr( empty( $vyro_blog_content['thumbnail_url'] ) ? 'no-image' : '' ); ?>">
							<?php if ( ! empty( $vyro_blog_content['thumbnail_url'] ) ) : ?>
								<div class="categories-image">
									<img src="<?php echo esc_url( $vyro_blog_content['thumbnail_url'] ); ?>" alt="<?php echo esc_attr( $vyro_blog_content['title'] ); ?>">
								</div>
							<?php endif; ?>
							<div class="categories-content">
								<div class="categories-details">
									<h3 class="categories-title"><a href="<?php echo esc_url( $vyro_blog_content['permalink'] ); ?>"><?php echo esc_html( $vyro_blog_content['title'] ); ?></a></h3>
									<?php
									if ( $vyro_blog_content['count'] <= 1 ) {
										$vyro_blog_post_count = $vyro_blog_content['count'] . __( ' Article', 'vyro-blog' );
									} else {
										$vyro_blog_post_count = $vyro_blog_content['count'] . __( ' Articles', 'vyro-blog' );
									}
									?>
									<span class="post-count"><?php echo esc_html( $vyro_blog_post_count ); ?></span>
								</div>
								<a href="<?php echo esc_url( $vyro_blog_content['permalink'] ); ?>" class="post-btn"><span class="post-icon"><i class="fa-solid fa-plus"></i></span></a>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<?php
}
