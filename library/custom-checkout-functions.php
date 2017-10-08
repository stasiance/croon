<?php
//원으로 변경
add_filter('woocommerce_currency_symbol', 'change_won_currency_symbol', 10, 2);

function change_won_currency_symbol( $currency_symbol, $currency ) {
switch( $currency ) {
case 'KRW': $currency_symbol = '원'; break;
}
return $currency_symbol;
}


/*
Checkout 페이지 보이게
*/
add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields_set' );
function custom_override_checkout_fields_set( $fields ) {
    $fields['billing']['billing_last_name']['placeholder'] = '성';
    $fields['billing']['billing_first_name']['placeholder'] = '이름';
    $fields['billing']['billing_phone']['placeholder'] = '휴대폰 번호';

    $fields['shipping']['shipping_last_name']['placeholder'] = '성';
    $fields['shipping']['shipping_first_name']['placeholder'] = '이름';

    $fields['billing']['billing_last_name']['required'] = true;
    $fields['shipping']['shipping_last_name']['required'] = true;

    return $fields;
}


/*Remove shipping label - JH*/
add_filter( 'woocommerce_cart_shipping_method_full_label', 'bbloomer_remove_shipping_label', 10, 2 );

function bbloomer_remove_shipping_label($label, $method) {
$new_label = preg_replace( '/^.+:/', '', $label );
return $new_label;
}
