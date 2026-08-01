<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Vyro Blog
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="blog-post-container">
		<div class="blog-post-inner">
			<div class="blog-post-image">
				<?php vyro_blog_post_thumbnail(); ?>
			</div>
			<div class="blog-post-detail">
				<div class="post-categories">
					<?php vyro_blog_categories_list(); ?>
				</div>
				<?php
				if ( is_singular() ) :
					the_title( '<h1 class="post-main-title">', '</h1>' );
				else :
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				endif;
				?>
				<div class="post-excerpt">
					<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), get_theme_mod( 'vyro_blog_excerpt_length', 20 ) ) ); ?></p>
				</div>
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
</article><!-- #post-<?php the_ID(); ?> -->