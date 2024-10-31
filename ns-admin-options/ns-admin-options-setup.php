<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* *** add menu page and add sub menu page *** */
add_action( 'admin_menu', function()  {
    add_menu_page( 'NS Popup Cart for WooCommerce', 'NS Popup Cart', 'manage_options', untrailingslashit( dirname( __FILE__ ) ).'/ns_admin_option_dashboard.php', '', plugin_dir_url( __FILE__ ).'img/backend-sidebar-icon.png', 60);
	add_submenu_page(untrailingslashit( dirname( __FILE__ ) ).'/ns_admin_option_dashboard.php', 'How to install premium version', 'How to install premium version', 'manage_options', 'how-to-install-premium-version', function(){  wp_redirect('http://www.nsthemes.com/how-to-install-the-premium-version/'); exit; });
});

/* *** add style *** */
add_action( 'admin_enqueue_scripts', function() {
	wp_enqueue_style('ns-option-css-page', plugin_dir_url( __FILE__ ) . 'css/ns-option-css-page.css');
	wp_enqueue_style('ns-option-css-custom-page', plugin_dir_url( __FILE__ ) . 'css/ns-option-css-custom-page.css');
	wp_enqueue_script( 'ns-option-js-page-viewcart', plugins_url( '/js/ns-option-js-page.js' , __FILE__ ), array( 'jquery' ) );
});

add_action( 'wp_enqueue_scripts', 'ns_css_front_theme_name_scripts' );
function ns_css_front_theme_name_scripts() {
	wp_enqueue_style('ns-option-css-custom-page-front', plugin_dir_url( __FILE__ ) . 'css/ns-option-css-custom-page-front.css');
    wp_enqueue_script( 'ns-option-js-page-viewcart-front', plugins_url( '/js/ns-option-js-page-front.js' , __FILE__ ), array( 'jquery' ) );
}
?>