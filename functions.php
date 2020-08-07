<?php
/**
 * Project functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Project
 */

if ( ! defined( 'ABSPATH' ) ) exit; // phpcs:ignore

/**
 * Theme Functions
 */
require get_template_directory() . '/inc/theme-functions.php';

/**
 * Theme Setup
 */
require get_template_directory() . '/inc/theme-setup.php';

/**
 * Theme Widgets
 */
require get_template_directory() . '/inc/theme-widgets.php';

/**
 * Theme Scripts & Styles
 */
require get_template_directory() . '/inc/class-project-theme-scripts.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Device Detection
 */
require get_template_directory() . '/inc/class-project-device-detect.php';

/**
 * Customizer Additions
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
    require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Globally instantiated classes.
 */
$GLOBALS['project_theme_scripts'] = new Project_Theme_Scripts();
$GLOBALS['project_device_detect'] = new Project_Device_Detect();

/**
 * Admin-use only.
 */
if ( is_admin() ) {
    // Load most of the custom admin.
    require get_template_directory() . '/admin/class-slifer-network-settings.php';

    /**
     * Project Network Settings
     *
     * @global Project_Network_Settings $project_network_settings
     * @since 1.0.0
     */
    $GLOBALS['project_network_settings'] = new Project_Network_Settings();
}
