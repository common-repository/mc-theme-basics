<?php
/**
 * Plugin Name: MC Theme Basics
 * Plugin URI: https://github.com/miguelcalderon/wordpress-theme-basics
 * Description: Basic setup tasks for any Wordpress site: disable user enumeration, get rid of emojis, etc.
 * Version: 1.0
 * Author: Miguel Calderón
 * Author URI: https://github.com/miguelcalderon
 * License: GPL2
 * Copyright 2016 Miguel Calderón

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */
if (!function_exists('is_admin')) {
	header('Status: 403 Forbidden');
	header('HTTP/1.1 403 Forbidden');
	exit();
}
defined('ABSPATH') or die("No script kiddies please!");
define( 'MC_THEME_BASICS_VERSION', '1.0' );
define( 'MC_THEME_BASICS_RELEASE_DATE', date_i18n( 'F j, Y' ) );
define( 'MC_THEME_BASICS_DIR', plugin_dir_path( __FILE__ ) );
define( 'MC_THEME_BASICS_URL', plugin_dir_url( __FILE__ ) );

/* Desactivar enumeración de usuarios */
add_filter(
    'query_vars',
    function ( $public_query_vars ) {
        if ( ! is_admin() ) {
            foreach ( array( 'author', 'author_name' ) as $var ) {
                $key = array_search( $var, $public_query_vars );
                if ( false !== $key ) {
                    unset( $public_query_vars[ $key ] );
                }
            }
        }

        return $public_query_vars;
    }
);

/* Desactivar pistas de usuario / email correcto en login */
function no_wordpress_errors() {
	return 'Something is wrong!';
}
add_filter(
    'login_errors',
    function () {
    	return 'Something is wrong!';
    }
);

/* Emojis fuera */
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
?>