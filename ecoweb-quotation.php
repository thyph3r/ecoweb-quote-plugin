<?php
/**
 * Plugin Name: Ecoweb Quote Plugin
 * Description: This plugin is designed in order to allow customers to directly send quotations for a specific product
 * Version: 1.1.1
 * Author: Othon Man
 * Author URI: http://ecoweb.gr
 */
 

/**
 * @snippet       Show Product Inquiry Contact Forms 7 @ Single Product Page - WooCommerce Shop
 * @author        Othon Man
 * @compatible    WC 7.9.0, WP 6.2.2, PHP 7.1.0
 */
 
// --------------------------
// 1. Display Button and Echo CF7
 
add_filter( 'woocommerce_single_product_summary', 'ecoweb_woocommerce_cf7_single_product', 30 );
  
function ecoweb_woocommerce_cf7_single_product() {
    global $product, $price;
    if ( $product->get_price() == 0 ||  $product->get_price() == '' ) {
        echo '<button type="submit" id="trigger_cf" class="single_add_to_cart_button button alt">Product Inquiry</button>';
        echo '<div id="product_inq" style="display:none">';
        echo do_shortcode('[contact-form-7 id="3470" title="Quote_Contact"]');
        echo '</div>'; 
// --------------------------
// 2. Echo Javascript: 
// a) on click, display CF7
// b) and populate CF7 subject with Product Name
// c) and change CF7 button to "Close"
 
add_action( 'woocommerce_single_product_summary', 'ecoweb_on_click_show_cf7_and_populate', 40);
 
function ecoweb_on_click_show_cf7_and_populate() {
   
  ?>
    <script type="text/javascript">
        jQuery('#trigger_cf').on('click', function(){
        if ( jQuery(this).text() == 'Product Inquiry' ) {
                    jQuery('#product_inq').css("display","block");
                    jQuery('input[name="your-subject"]').val('<?php the_title(); ?>');
            jQuery("#trigger_cf").html('Close'); 
        } else {
            jQuery('#product_inq').hide();
            jQuery("#trigger_cf").html('Product Inquiry'); 
        }
        });
    </script>
    <?php
}}}