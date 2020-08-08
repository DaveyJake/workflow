<?php
/**
 * Functions that help throughout the theme; not to be used on the frontend.
 *
 * @author Davey Jacobson <daveyjake21@gmail.com>
 *
 * @package Project
 */

if ( ! defined( 'ABSPATH' ) ) exit; // phpcs:ignore

/**
 * Generate an `select` dropdown box.
 *
 * @see _project_args_fill()
 * @see _project_attr_value()
 *
 * @param array|string $args {
 *     Optional arguments for the dropdown.
 *
 *     @type string $id          The ID attribute value.
 *     @type string $class       The class attribute value.
 *     @type string $name        The name attribute value.
 *     @type string $placeholder The placeholder text.
 *     @type string $icon        The FontAwesome icon. Default: 'chevron'.
 *     @type bool   $echo        True will output HTML. False returns HTML.
 * }
 */
function project_dropdown_menu( $args = '' ) {
	$defaults = array(
		'id'          => '',
		'class'       => '',
		'name'        => '',
		'placeholder' => '',
		'icon'        => 'chevron',
		'echo'        => true,
	);

	$args = wp_parse_args( $args, $defaults );

	// Check the ID and name attributes.
	_project_args_fill( $args );

	// Icon to include.
	if ( ! empty( $args['icon'] ) ) {
		$icon = '<i class="' . esc_attr( 'fa ssf-' . $args['icon'] ) . '"></i>';
	}

	if ( $args['echo'] ) {
		printf(
			'<select id="%s" class="%s" name="%s" placeholder="%s"></select>%s',
			esc_attr( $args['id'] ),
			esc_attr( $args['class'] ),
			esc_attr( $args['name'] ),
			esc_attr( $args['placeholder'] ),
			wp_kses_post( $icon )
		);
	} else {
		return '<select ' . _project_attr_value( $args ) . '></select>' . $icon;
	}
}

/**
 * Used the last modified unix date of a file as its version.
 *
 * @param string $file File path with no leading slash.
 *
 * @return int File's last modified unix date.
 */
function project_file_version( $file ) {
	$path = get_template_directory() . '/' . ltrim( $file, '/' );

	if ( ! file_exists( $path ) ) {
		error_log( "Incorrect File Path: {$path}" ); // phpcs:ignore

		return time();
	} else {
		return filemtime( $path );
	}
}

/**
 * Generate an `input` text box.
 *
 * @see _project_args_fill()
 * @see _project_attr_value()
 *
 * @param array|string $args {
 *     Optional arguments for the input box.
 *
 *     @type string $id          ID attribute.
 *     @type string $name        Name attribute.
 *     @type string $type        Accepts 'text', 'number', 'checkbox', 'radio', 'button'.
 *     @type string $placeholder Placeholder text.
 *     @type string $icon        FontAwesome icon to use without ('fa-' prefix).
 *     @type bool   $echo=true   True will output HTML. False will return HTML.
 * }
 */
function project_input_box( $args = '' ) {
	$defaults = array(
		'id'          => '',
		'name'        => '',
		'placeholder' => '',
		'type'        => '',
		'icon'        => '',
		'echo'        => false,
	);

	$args = wp_parse_args( $args, $defaults );

	// Check the ID and name attributes.
	_project_args_fill( $args );

	if ( ! empty( $args['icon'] ) ) {
		$icon = '<i class="' . esc_attr( 'fa ssf-' . $args['icon'] ) . '"></i>';
	}

	// Output if echo is true.
	if ( $args['echo'] ) {
		printf(
			'<input id="%s" name="%s" placeholder="%s" type="%s" value="" />%s',
			esc_attr( $args['id'] ),
			esc_attr( $args['name'] ),
			esc_attr( $args['placeholder'] ),
			esc_attr( $args['type'] ),
			wp_kses_post( $icon )
		);
	} else {
		return '<input ' . _project_attr_value( $args ) . ' />' . $icon;
	}
}

/**
 * Adjust the stylesheet URI using {@see 'stylesheet_uri'}.
 *
 * @global string $suffix Depends on SCRIPT_DEBUG: '' if true; '.min' if false.
 *
 * @param string $stylesheet_uri Stylesheet URI for the current theme/child theme.
 */
function project_stylesheet_uri( $stylesheet_uri ) {
	global $suffix;

	return str_replace( 'style.css', "dist/css/project{$suffix}.css", $stylesheet_uri );
}

add_filter( 'stylesheet_uri', 'project_stylesheet_uri', 10 );

/**
 * Switch hyphens (-) with underscores (_) or vice-versa.
 *
 * @access private
 *
 * @see project_input_box()
 * @see project_dropdown_menu()
 *
 * @param array $args The args to target.
 */
function _project_args_fill( array &$args ) { // phpcs:ignore
	if ( isset( $args['name'] ) && empty( $args['id'] ) ) {
		$args['id'] = preg_replace( '/_/', '-', $args['name'] );
	} elseif ( isset( $args['id'] ) && empty( $args['name'] ) ) {
		$args['name'] = preg_replace( '/-/', '_', $args['id'] );
	}
}

/**
 * Convert associative array to HTML attributes.
 *
 * @author lordspace
 * @link https://gist.github.com/lordspace
 *
 * @see http://stackoverflow.com/questions/18081625/how-do-i-map-an-associative-array-to-html-element-attributes
 *
 * @param array $attributes     Associative array of key-value pairs.
 * @param bool  $make_them_data Prefix each key with 'data-'.
 *
 * @return string
 */
function _project_array_attrs( array $attributes, $make_them_data = false ) { // phpcs:ignore
    $pairs = array();

    foreach ( $attributes as $name => $value ) {
		if ( $make_them_data ) {
			$name = 'data-' . $name;
		}

        $name  = htmlentities( $name, ENT_QUOTES, 'UTF-8' );
        $value = htmlentities( $value, ENT_QUOTES, 'UTF-8' );

        if ( is_bool( $value ) && $value ) {
            $pairs[] = $name;
        } else {
            $pairs[] = sprintf( '%s="%s"', $name, $value );
        }
    }

    return implode( ' ', $pairs );
}

/**
 * Covert associative array to HTML attribute=value pairs.
 *
 * @access private
 *
 * @param array  $args  Attribute-value pairs.
 * @param string $attrs HTML to build on.
 *
 * @return string HTML-ready attributes and values.
 */
function _project_attr_value( array &$args, $attrs = '' ) { // phpcs:ignore
	foreach ( $args as $attr => $value ) {
		if ( 'icon' !== $attr && 'echo' !== $attr ) {
			$attrs .= $attr . '="' . esc_attr( $value ) . '" ';
		}
	}

	return trim( $attrs );
}
