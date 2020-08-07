<?php
/**
 * Theme API: Theme Scripts
 *
 * @package Project
 * @subpackage Theme_Scripts
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // phpcs:ignore

/**
 * This file manages the scripts and styles enqueued throughout the theme.
 */
class Project_Theme_Scripts {
	/**
	 * Dynamic file extension for minified and unminifed files.
	 *
	 * @var string
	 */
	private $suffix;

	/**
	 * Primary constructor.
	 */
	public function __construct() {
		$this->suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

		/**
		 * Enqueue admin script & style dependenciesl.
		 */
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );

		/**
		 * Enqueue script and style dependencies.
		 */
		add_action( 'wp_enqueue_scripts', array( $this, 'theme_scripts' ) );
	}

	/**
	 * Enqueue admin scripts and admin styles.
	 */
	public function admin_scripts() {
		// Main admin stylesheet.
		wp_enqueue_style( 'project-admin', get_theme_file_uri( "admin/assets/css/project-admin{$this->suffix}.css" ), false, project_file_version( 'admin/assets/css/project-admin.css' ) );

		// Main admin JavaScript file.
		wp_enqueue_script( 'project-admin', get_theme_file_uri( "admin/assets/js/project-admin{$this->suffix}.js" ), array( 'lodash', 'jquery' ), project_file_version( 'admin/assets/js/project-admin.js' ), true );
	}

	/**
	 * Enqueue scripts and styles.
	 *
	 * @global string $this->suffix Minfied file extension when WP_SCRIPT_DEBUG is true.
	 */
	public function theme_scripts() {
		// Registered scripts.
		$this->register_scripts();

		// phpcs:disable
		if ( is_front_page() )
		{
			wp_enqueue_style( 'front-page' );
		}
		else
		{
			wp_enqueue_style( 'style' );
		}

		// Move jQuery to footer.
		wp_enqueue_script( 'jquery', includes_url( 'js/jquery/jquery.js' ), false, '1.12.4-wp', true );

		// Primary theme JavaScript.
		wp_enqueue_script( 'project-script', get_theme_file_uri( "dist/js/project{$this->suffix}.js" ), array( 'lodash', 'jquery' ), project_file_version( 'dist/js/project.js' ), true );
	}

	/**
	 * Enqueue the main stylesheets and scripts.
	 *
	 * @access private
	 */
	private function register_scripts() {
		wp_register_style( 'style', get_stylesheet_uri(), false, project_file_version( 'dist/css/project.css' ) );
		wp_register_style( 'front-page', get_theme_file_uri( "dist/css/front-page{$this->suffix}.css" ), false, project_file_version( 'dist/css/front-page.css' ) );
	}
}
