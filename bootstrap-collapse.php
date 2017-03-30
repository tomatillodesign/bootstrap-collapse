<?php               namespace clb_bootstrap;
/*
Plugin Name: Bootstrap Collapse
Plugin URI: http://www.tomatillodesign.com
Description: Using Bootstrap Collapse in WordPress
Author: Chris Liu-Beers
Version: 1.0
Author URI: http://www.tomatillodesign.com
License: GPL-2.0+
License URI: http://www.gnu.org/licenses/gpl-2.0.txt
Text Domain: bootstrap-collapse
Domain Path: /languages/
*/

if ( ! defined( 'ABSPATH' ) ) {
				die;
}


/**
* Register our text domain.
*
* @since 1.3.0
*/
function load_textdomain() {
	load_plugin_textdomain( 'bootstrap-collapse', false, basename( dirname( __FILE__ ) ) . '/languages' );
}
add_action( 'plugins_loaded', __NAMESPACE__ . '\\load_textdomain' );


/**
* Register and Enqueue Scripts and Styles.
*
* @since 1.0.0
*/
//Script-tac-ulous -> All the Scripts and Styles Registered and Enqueued, scripts first - then styles
function scripts_styles() {

	wp_register_script( 'collapsejs' , plugins_url( '/js/bootstrap.min.js',  __FILE__), array( 'jquery' ), '3.3.5', true );
	wp_register_style( 'collapsecss' , plugins_url( '/css/bootstrap.css',  __FILE__), '' , '3.3.5', 'all' );


	wp_enqueue_script( 'collapsejs' );
	wp_enqueue_style( 'collapsecss' );
}
add_action( 'wp_enqueue_scripts',  __NAMESPACE__ . '\\scripts_styles' );


/**
 * Add scripts in back-end.
 *
 * @since 1.3.0
 */
function admin_collapse($hook) {
    if ( 'settings_page_bootstrap-collapse' != $hook ) {
        return;
    }
    wp_enqueue_script( 'collapsejs' , plugins_url( '/js/bootstrap.min.js',  __FILE__), array( 'jquery' ), '3.3.5', true );
    wp_enqueue_style( 'collapsecss' , plugins_url( '/css/bootstrap.css',  __FILE__), '' , '3.3.5', 'all' );
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'wp-color-picker-alpha', plugins_url( '/js/wp-color-picker-alpha.min.js',  __FILE__ ), array( 'wp-color-picker' ), '1.3.0', true );
}
add_action( 'admin_enqueue_scripts',  __NAMESPACE__ . '\\admin_collapse' );



/**
 * Create the plugin option page.
 *
 * @since 1.3.0
 */

function plugin_page() {

    /*
     * Use the add options_page function
     * add_options_page( $page_title, $menu_title, $capability, $menu-slug, $function )
     */

     add_options_page(
        __( 'Bootstrap Collapse Plugin','bootstrap-collapse' ), //$page_title
        __( 'Bootstrap Collapse ', 'bootstrap-collapse' ), //$menu_title
        'manage_options', //$capability
        'bootstrap-collapse', //$menu-slug
        __NAMESPACE__ . '\\plugin_options_page' //$callbackfunction
      );
}
add_action( 'admin_menu', __NAMESPACE__ . '\\plugin_page' );


/**
 * Include the plugin option page.
 *
 * @since 1.3.0
 */

function plugin_options_page() {

    if( !current_user_can( 'manage_options' ) ) {

      wp_die( "Hall and Oates 'Say No Go'" );
    }

   require( 'inc/options-page-wrapper.php' );
}


/**
 * Register our option fields
 *
 * @since 1.3.0
 */
// Check validation
function plugin_settings() {
  register_setting(
        'ng_bm_settings_group', //option group name
        'bootstrap_collapse_settings'// options setting name
     //  __NAMESPACE__ . '\\bootstrap_collapse_validate_input' //sanitize the inputs
  );

  add_settings_section(
        'clb_bootstrap_collapse_section', //declare the section id
        'Bootstrap Collapse Settings', //page title
         __NAMESPACE__ . '\\clb_bootstrap_section_callback', //callback function below
        'bootstrap-collapse' //page that it appears on
    );

    add_settings_field(
        'ng_collapse_use_css', //unique id of field
        'Custom Collapse CSS', //title
         __NAMESPACE__ . '\\ng_collapse_use_css_callback', //callback function below
        'bootstrap-collapse', //page that it appears on
        'clb_bootstrap_collapse_section' //settings section declared in add_settings_section
    );

    add_settings_field(
        'ng_overlay', //unique id of field
        'Overlay Background Color', //title
         __NAMESPACE__ . '\\ng_overlay_callback', //callback function below
        'bootstrap-collapse', //page that it appears on
        'clb_bootstrap_collapse_section' //settings section declared in add_settings_section
    );

    add_settings_field(
        'ng_overlay_opacity', //unique id of field
        'Overlay Opacity', //title
         __NAMESPACE__ . '\\ng_overlay_opacity_callback', //callback function below
        'bootstrap-collapse', //page that it appears on
        'clb_bootstrap_collapse_section' //settings section declared in add_settings_section
    );

    add_settings_field(
        'ng_collapse_color', //unique id of field
        'Collapse Text Color', //title
         __NAMESPACE__ . '\\ng_collapse_color_callback', //callback function below
        'bootstrap-collapse', //page that it appears on
        'clb_bootstrap_collapse_section' //settings section declared in add_settings_section
    );

    add_settings_field(
        'ng_collapse_color_background', //unique id of field
        'Collapse Background Color ', //title
         __NAMESPACE__ . '\\ng_collapse_color_background_callback', //callback function below
        'bootstrap-collapse', //page that it appears on
        'clb_bootstrap_collapse_section' //settings section declared in add_settings_section
    );

    add_settings_field(
        'ng_button_background', //unique id of field
        'Close Button Background Color', //title
         __NAMESPACE__ . '\\ng_button_background_callback', //callback function below
        'bootstrap-collapse', //page that it appears on
        'clb_bootstrap_collapse_section' //settings section declared in add_settings_section
    );

    add_settings_field(
        'ng_button_color', //unique id of field
        'Close Button Text Color', //title
         __NAMESPACE__ . '\\ng_button_color_callback', //callback function below
        'bootstrap-collapse', //page that it appears on
        'clb_bootstrap_collapse_section' //settings section declared in add_settings_section
    );
    add_settings_field(
        'ng_button_background_hover', //unique id of field
        'Close Button Background Hover Color ', //title
         __NAMESPACE__ . '\\ng_button_background_hover_callback', //callback function below
        'bootstrap-collapse', //page that it appears on
        'clb_bootstrap_collapse_section' //settings section declared in add_settings_section
    );

    add_settings_field(
        'ng_button_color_hover', //unique id of field
        'Close Button Text Hover Color', //title
         __NAMESPACE__ . '\\ng_button_color_hover_callback', //callback function below
        'bootstrap-collapse', //page that it appears on
        'clb_bootstrap_collapse_section' //settings section declared in add_settings_section
    );

    add_settings_field(
        'ng_collapse_alignment', //unique id of field
        'Collapse Header & Body Alignment', //title
         __NAMESPACE__ . '\\ng_collapse_alignment_callback', //callback function below
        'bootstrap-collapse', //page that it appears on
        'clb_bootstrap_collapse_section' //settings section declared in add_settings_section
    );

    add_settings_field(
        'ng_collapse_footer_alignment', //unique id of field
        'Collapse Footer Alignment', //title
         __NAMESPACE__ . '\\ng_collapse_footer_alignment_callback', //callback function below
        'bootstrap-collapse', //page that it appears on
        'clb_bootstrap_collapse_section' //settings section declared in add_settings_section
    );

    add_settings_field(
        'ng_collapse_use_borders', //unique id of field
        'Use Collapse Borders', //title
         __NAMESPACE__ . '\\ng_collapse_use_borders_callback', //callback function below
        'bootstrap-collapse', //page that it appears on
        'clb_bootstrap_collapse_section' //settings section declared in add_settings_section
    );

    add_settings_field(
        'ng_collapse_border_color', //unique id of field
        'Collapse Border Color', //title
         __NAMESPACE__ . '\\ng_collapse_border_color_callback', //callback function below
        'bootstrap-collapse', //page that it appears on
        'clb_bootstrap_collapse_section' //settings section declared in add_settings_section
    );

}
//add_action('admin_init', __NAMESPACE__ . '\\plugin_settings');

/**
 * Register our section call back
 * (not much happening here)
 * @since 1.3.0
 */

function clb_bootstrap_section_callback() {

}
