<?php
if ( ! class_exists( 'Vyro_Blog_Small_List_Widget' ) ) {
	/**
	 * Adds Vyro_Blog_Small_List_Widget Widget.
	 */
	class Vyro_Blog_Small_List_Widget extends WP_Widget {

		/**
		 * Register widget with WordPress.
		 */
		public function __construct() {
			$vyro_blog_small_list_widget_ops = array(
				'classname'   => 'small-list-widget small-list-style-1',
				'description' => __( 'Retrive Small List Widgets', 'vyro-blog' ),
			);
			parent::__construct(
				'vyro_blog_small_list_widget',
				__( 'Ascendoor Small List Widget', 'vyro-blog' ),
				$vyro_blog_small_list_widget_ops
			);
		}

		/**
		 * Front-end display of widget.
		 *
		 * @see WP_Widget::widget()
		 *
		 * @param array $args     Widget arguments.
		 * @param array $instance Saved values from database.
		 */
		public function widget( $args, $instance ) {
			if ( ! isset( $args['widget_id'] ) ) {
				$args['widget_id'] = $this->id;
			}
			$vyro_blog_small_list_title       = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';
			$vyro_blog_small_list_title       = apply_filters( 'widget_title', $vyro_blog_small_list_title, $instance, $this->id_base );
			$vyro_blog_small_list_post_offset = isset( $instance['offset'] ) ? absint( $instance['offset'] ) : '';
			$vyro_blog_small_list_category    = isset( $instance['category'] ) ? absint( $instance['category'] ) : '';

			echo $args['before_widget'];

			if ( ! empty( $vyro_blog_small_list_title ) ) {
				?>
				<div class="section-title">
					<div class="title-heading">
						<?php echo $args['before_title'] . esc_html( $vyro_blog_small_list_title ) . $args['after_title']; ?>
					</div>
					<span class="heading-dash"></span>
				</div>
				<?php
			}
			?>
			<div class="small-list-wrapper">
				<?php
				$vyro_blog_small_list_widgets_args = array(
					'post_type'      => 'post',
					'posts_per_page' => absint( 3 ),
					'offset'         => absint( $vyro_blog_small_list_post_offset ),
					'cat'            => absint( $vyro_blog_small_list_category ),
				);

				$vyro_blog_query = new WP_Query( $vyro_blog_small_list_widgets_args );
				if ( $vyro_blog_query->have_posts() ) :
					while ( $vyro_blog_query->have_posts() ) :
						$vyro_blog_query->the_post();
						?>
						<div class="blog-post-container list-layout">
							<div class="blog-post-inner">
								<?php if ( has_post_thumbnail() ) { ?>
									<div class="blog-post-image">
										<a href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail(); ?>
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
										<div class="post-meta-wrapper">
											<?php
											vyro_blog_posted_by();
											vyro_blog_posted_on();
											?>
										</div>
									</div>
								</div>	
							</div>
						</div>
						<?php
					endwhile;
					wp_reset_postdata();
				endif;
				?>
			</div>
			<?php
			echo $args['after_widget'];
		}

		/**
		 * Back-end widget form.
		 *
		 * @see WP_Widget::form()
		 *
		 * @param array $instance Previously saved values from database.
		 */
		public function form( $instance ) {
			$vyro_blog_small_list_title       = isset( $instance['title'] ) ? $instance['title'] : '';
			$vyro_blog_small_list_post_offset = isset( $instance['offset'] ) ? absint( $instance['offset'] ) : '';
			$vyro_blog_small_list_category    = isset( $instance['category'] ) ? absint( $instance['category'] ) : '';
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Section Title:', 'vyro-blog' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $vyro_blog_small_list_title ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'offset' ) ); ?>"><?php esc_html_e( 'Number of posts to displace or pass over:', 'vyro-blog' ); ?></label>
				<input class="tiny-text" id="<?php echo esc_attr( $this->get_field_id( 'offset' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'offset' ) ); ?>" type="number" step="1" min="0" value="<?php echo absint( $vyro_blog_small_list_post_offset ); ?>" size="3" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>"><?php esc_html_e( 'Select the category to show posts:', 'vyro-blog' ); ?></label>
				<select id="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'category' ) ); ?>" class="widefat" style="width:100%;">
					<?php
					$vyro_blog_categories = vyro_blog_get_post_cat_choices();
					foreach ( $vyro_blog_categories as $vyro_blog_category => $vyro_blog_value ) {
						?>
						<option value="<?php echo absint( $vyro_blog_category ); ?>" <?php selected( $vyro_blog_small_list_category, $vyro_blog_category ); ?>><?php echo esc_html( $vyro_blog_value ); ?></option>
						<?php
					}
					?>
				</select>
			</p>
			<?php
		}

		/**
		 * Sanitize widget form values as they are saved.
		 *
		 * @see WP_Widget::update()
		 *
		 * @param array $new_instance Values just sent to be saved.
		 * @param array $old_instance Previously saved values from database.
		 *
		 * @return array Updated safe values to be saved.
		 */
		public function update( $new_instance, $old_instance ) {
			$instance             = $old_instance;
			$instance['title']    = sanitize_text_field( $new_instance['title'] );
			$instance['offset']   = (int) $new_instance['offset'];
			$instance['category'] = (int) $new_instance['category'];
			return $instance;
		}
	}
}
