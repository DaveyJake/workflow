<?php
/**
 * The file contains all widgets used throughout this theme
 *
 * @package Project
 */

if ( ! defined( 'ABSPATH' ) ) exit; // phpcs:ignore

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function project_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'project' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'project' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}

/**
 * Initialize the widgets.
 */
add_action( 'widgets_init', 'project_widgets_init' );
