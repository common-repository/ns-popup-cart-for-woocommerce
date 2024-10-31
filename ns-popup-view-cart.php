<?php
/*
Plugin Name: NS Custom view cart popup
Plugin URI: https://wordpress.org/plugins/ns-popup-cart-for-woocommerce/
Description: This plugin allow to create a new menu item linked to a modal popup
Version: 1.2.3
Author: NsThemes
Author URI: http://www.nsthemes.com
License: GNU General Public License v2.0
License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** 
 * @author        PluginEye
 * @copyright     Copyright (c) 2019, PluginEye.
 * @version         1.0.0
 * @license       https://www.gnu.org/licenses/gpl-3.0.html GNU General Public License Version 3
 * PLUGINEYE SDK
*/

require_once('plugineye/plugineye-class.php');
$plugineye = array(
    'main_directory_name'       => 'ns-popup-cart-for-woocommerce',
    'main_file_name'            => 'ns-popup-view-cart.php',
    'redirect_after_confirm'    => 'admin.php?page=ns-popup-cart-for-woocommerce%2Fns-admin-options%2Fns_admin_option_dashboard.php',
    'plugin_id'                 => '246',
    'plugin_token'              => 'NWNmZmJiZDAzYWI2NTFiMTMwMTFjMzBiZDAwZWIwYzU2ZGQwYWVmY2RlYzNmYjFmMmE0OTIwZTAwZWZjOGM4OGU1NGNiY2FmOTM2NWE=',
    'plugin_dir_url'            => plugin_dir_url(__FILE__),
    'plugin_dir_path'           => plugin_dir_path(__FILE__)
);

$plugineyeobj246 = new pluginEye($plugineye);
$plugineyeobj246->pluginEyeStart();      


if ( ! defined( 'VIEWCART_NS_PLUGIN_DIR' ) )
    define( 'VIEWCART_NS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

if ( ! defined( 'VIEWCART_NS_PLUGIN_DIR_URL' ) )
    define( 'VIEWCART_NS_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );



/* *** plugin options *** */
require_once( VIEWCART_NS_PLUGIN_DIR.'/ns-popup-view-option.php');

require_once( plugin_dir_path( __FILE__ ).'/ns-admin-options/ns-admin-options-setup.php');


function ns_view_add_modal() {?>
<!-- Trigger/Open The Modal -->
<div id="viewcart_modal" class="modal">
<!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?php echo strtoupper ( get_option("ns_view_cart_popup_title", ""));?></h4>
    </div>
    <div class="modal-body">
	    <?php echo do_shortcode('[woocommerce_cart]'); ?>
    </div>
  </div>
</div>
<?php }

add_action ('wp_head', 'ns_view_add_modal');

function ns_view_add_menu_item($items, $args) {
      if (get_option('ns_view_cart_popup_title') == ''){
        $ns_print = 'Popup';
      }else{
        $ns_print = get_option('ns_view_cart_popup_title', 'Popup');
      }
     $items .= '<li id="cartlink-modal"><a href="#" role="button" data-toggle="modal" data-target="#viewcart_modal">'. ucfirst($ns_print).'</a></li>';
    return $items;
}
add_filter('wp_nav_menu_items','ns_view_add_menu_item', 10, 2 );


/* *** add link premium *** */
add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'nspopupcarforwoocommerce_add_action_links' );

function nspopupcarforwoocommerce_add_action_links ( $links ) {	
 $mylinks = array('<a id="nspcfwlinkpremium" href="https://www.nsthemes.com/product/popup-cart-for-woocommerce/?ref-ns=2&campaign=PCFWlinkpremium" target="_blank">'.__( 'Premium Version', 'ns-popup-cart-for-woocommerce' ).'</a>');
return array_merge( $links, $mylinks );
}