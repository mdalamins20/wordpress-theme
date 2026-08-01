<?php

// Small List Widget.
require get_template_directory() . '/inc/widgets/small-list-widget.php';

// Tile List Widget.
require get_template_directory() . '/inc/widgets/tile-list-widget.php';

// Social Icons Widget.
require get_template_directory() . '/inc/widgets/social-icons-widget.php';

/**
 * Register Widgets
 */
function vyro_blog_register_widgets() {

	register_widget( 'Vyro_Blog_Small_List_Widget' );

	register_widget( 'Vyro_Blog_Tile_List_Widget' );

	register_widget( 'Vyro_Blog_Social_Icons_Widget' );
}
add_action( 'widgets_init', 'vyro_blog_register_widgets' );
