<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Project
 */

if ( ! defined( 'ABSPATH' ) ) exit; // phpcs:ignore
?>
<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
<?php
	do_action( 'project_head_open' );
	echo '<meta charset="' . esc_attr( get_bloginfo( 'charset' ) ) . '">';
	echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
	echo '<link rel="profile" href="https://gmpg.org/xfn/11">';
	wp_head();
	do_action( 'project_head_close' );
?>
</head>
<body <?php body_class(); ?>>
<?php // phpcs:disable Generic.WhiteSpace.ScopeIndent
	project_body_open();

	echo '<div id="page" class="site">';

		echo '<a class="skip-link screen-reader-text" href="#primary">' . esc_html__( 'Skip to content', 'project' ) . '</a>';

		echo '<header id="masthead" class="site-header">';

			echo '<div class="site-branding">';

				$project_bloginfo = get_bloginfo( 'name', 'display' );

				echo '<div class="site-logo"><a class="flex" href="' . esc_url( home_url( '/' ) ) . '" rel="home" title="' . esc_html( $project_bloginfo ) . '">' . wp_kses_post( project_custom_logo( false ) ) . '</a></div>';

			echo '</div><!-- .site-branding -->';

			project_property_search();

		echo '</header><!-- #masthead -->';
