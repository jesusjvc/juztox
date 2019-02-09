<?php 

require_once get_stylesheet_directory() . "/class.wp-auto-theme-update.php";

add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page', 20 );


function new_loop_shop_per_page( $cols ) {
  // $cols contains the current number of products per page based on the value stored on Options -> Reading
  // Return the number of products you wanna show per page.
  $cols = 12;
  return $cols;
}

 
function wc_ninja_custom_variable_price( $price, $product ) {
    // Main Price
    $prices = array( $product->get_variation_price( 'min', true ), $product->get_variation_price( 'max', true ) );
    $price = $prices[0] !== $prices[1] ? sprintf( __( 'Desde: %1$s', 'woocommerce' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );

    // Sale Price
    $prices = array( $product->get_variation_regular_price( 'min', true ), $product->get_variation_regular_price( 'max', true ) );
    sort( $prices );
    $saleprice = $prices[0] !== $prices[1] ? sprintf( __( 'Desde: %1$s', 'woocommerce' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );

    if ( $price !== $saleprice ) {
        $price = '' . $saleprice . ' ' . $price . '';
    }
    
    return $price;
}

add_filter( 'woocommerce_variable_sale_price_html', 'wc_ninja_custom_variable_price', 10, 2 );
add_filter( 'woocommerce_variable_price_html', 'wc_ninja_custom_variable_price', 10, 2 );


//Agregar prefix ordenes de compra

add_filter( 'woocommerce_order_number', 'change_woocommerce_order_number' );

function change_woocommerce_order_number( $order_id ) {
    $prefix = '00';
   // $suffix = '/TS';
    $new_order_id = $prefix . $order_id;
    return $new_order_id;
}

/**
 * ESTADOS
 * Function - Vender Somente para Estados Específicos - WooCommerce
 */
function wc_especifico_estado( $states ) {
	$states['MX'] = array(
		'MORELOS' => __( 'MORELOS', 'woocommerce' ),
		'DISTRITO FEDERAL' => __( 'DISTRITO FEDERAL', 'woocommerce' ),
		'PUEBLA' => __( 'PUEBLA', 'woocommerce' ),
	);

	return $states;
}
add_filter( 'woocommerce_states', 'wc_especifico_estado' );


//Registro de conversiones

add_action( 'woocommerce_thankyou', 'adwords_tracking' );

function adwords_tracking( $order_id ) {

// Lets grab the order

$order = wc_get_order( $order_id );

echo '<!-- Google Code for Realiz&oacute; un pedido Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1001511947;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "AyRhCJCpm28Qi7jH3QM";
var google_conversion_value = 700.00;
var google_conversion_currency = "MXN";
var google_remarketing_only = false;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/1001511947/?value=700.00&amp;currency_code=MXN&amp;label=AyRhCJCpm28Qi7jH3QM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>';

}



/**
 * @snippet       Add Content to the Customer Processing Order Email - WooCommerce
 * @compatible    Woo 3.2.6
 */
 
/*function add_content( $order, $sent_to_admin, $plain_text, $email ) {
    if ( $email->id == 'customer_processing_order' or $email->id == 'customer_on_hold_order') {
        echo '<p class="email-upsell-p">En Juztox nos preocupamos por el planeta, es por esto que iniciamos nuestra campaña de reciclaje de botellas. Envíanos a tus botellas vacías y enjuagadas y recibe 20% de descuento en tus siguiente compra,  solo las tienes que enviar o llevar a Avenida Toluca 585 local 8 Colonia Olivar de los Padres Álvaro Obregón en horario de 9.00 am - 4:00 pm de lunes a viernes, ahí las recibimos y las enviamos a ECOCE (asociación civil ambiental sin fines de lucro, creada y auspiciada por la industria de bebidas y alimentos) para su reciclaje.</p>';
    }
}*/

 
?>