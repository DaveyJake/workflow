<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Project
 */

if ( ! defined( 'ABSPATH' ) ) exit; // phpcs:ignore

get_header();

echo '<main id="primary" class="site-main">';

    echo '<section class="error-404 not-found">';

        echo '<header class="page-header">';

            echo '<h1 class="page-title">' . esc_html__( 'Oops! That page can&rsquo;t be found.', 'project' ) . '</h1>';

        echo '</header><!-- .page-header -->';

        echo '<div class="page-content">';

            echo '<p>' . esc_html__( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'project' ) . '</p>';

            echo get_search_form();

            the_widget( 'WP_Widget_Recent_Posts' );

            echo '<div class="widget widget_categories">';

                echo '<h2 class="widget-title">' . esc_html__( 'Most Used Categories', 'project' ) . '</h2>';

                echo '<ul>';

                $project_404_category_args = array(
                    'orderby'    => 'count',
                    'order'      => 'DESC',
                    'show_count' => 1,
                    'title_li'   => '',
                    'number'     => 10,
                );

                wp_list_categories( $project_404_category_args );

                echo '</ul>';

            // phpcs:disable
            echo '</div><!-- .widget -->';

            /* translators: %1$s: smiley */
            $project_archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'project' ), convert_smilies( ':)' ) ) . '</p>';

            the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>{$project_archive_content}" );

            the_widget( 'WP_Widget_Tag_Cloud' );

        echo '</div><!-- .page-content -->';

    echo '</section><!-- .error-404 -->';

echo '</main><!-- #main -->';

get_footer();
