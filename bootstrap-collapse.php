<?php               namespace clb_bootstrap_collapse;
/*
Plugin Name: Simple Bootstrap Collapse
Plugin URI: http://www.tomatillodesign.com
Description: Using Bootstrap 4.0+ Collapse in WordPress
Author: Chris Liu-Beers
Version: 1.0
Author URI: http://www.tomatillodesign.com
License: GPL-2.0+
License URI: http://www.gnu.org/licenses/gpl-2.0.txt
Text Domain: simple-bootstrap-collapse
Domain Path: /languages/
*/

if ( ! defined( 'ABSPATH' ) ) {
				die;
}


/**
* Register our text domain.
*
* @since 1.0
*/
function load_textdomain() {
	load_plugin_textdomain( 'bootstrap-collapse', false, basename( dirname( __FILE__ ) ) . '/languages' );
}
add_action( 'plugins_loaded', __NAMESPACE__ . '\\load_textdomain' );


/**
* Register and Enqueue Scripts and Styles.
*
* @since 1.0
*/
//Script-tac-ulous -> All the Scripts and Styles Registered and Enqueued, scripts first - then styles
function scripts_styles() {

	wp_register_script( 'collapsejs' , plugins_url( '/js/collapse.js',  __FILE__), array( 'jquery' ), '3.3.5', true );
	wp_register_style( 'collapsecss' , plugins_url( '/css/collapse.css',  __FILE__), '' , '3.3.5', 'all' );


	wp_enqueue_script( 'collapsejs' );
	wp_enqueue_style( 'collapsecss' );
}
add_action( 'wp_enqueue_scripts',  __NAMESPACE__ . '\\scripts_styles' );


/**
 * Add scripts in back-end.
 *
 * @since 1.0
 */
function admin_collapse($hook) {
    if ( 'settings_page_bootstrap-collapse' != $hook ) {
        return;
    }
    wp_enqueue_script( 'collapsejs' , plugins_url( '/js/bootstrap.js',  __FILE__), array( 'jquery' ), '3.3.5', true );
    wp_enqueue_style( 'collapsecss' , plugins_url( '/css/collapse.css',  __FILE__), '' , '3.3.5', 'all' );
}
add_action( 'admin_enqueue_scripts',  __NAMESPACE__ . '\\admin_collapse' );





/**
 * Register our section call back
 * (not much happening here)
 * @since 1.0
 */

function clb_bootstrap_collapse_section_callback() {

}





// Add Shortcode
function clb_collapse_section( $atts , $content = null ) {

	// Attributes
	$atts = shortcode_atts(
		array(
			'title' => 'Title_Here',
		),
		$atts
	);

	$title =  $atts['title'];
	$slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title)));

     $output = '<div class="clb-collapse-area"><a class="collapse-section" data-toggle="collapse" href="#' . $slug . '" aria-expanded="false" aria-controls="' . $slug . '"><div class="collapse-button-area">' . $title .'</div></a><div class="collapse" id="' . $slug . '">' . $content . '</div></div>';

	return $output;

}
add_shortcode( 'collapse', 'clb_bootstrap_collapse\clb_collapse_section' );
