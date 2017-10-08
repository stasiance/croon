<?php
/**
 * Register new status
 * Tutorial: http://www.sellwithwp.com/woocommerce-custom-order-status-2/
**/
add_action( 'init', 'register_custom_order_status' );
function register_custom_order_status() {
    register_post_status( 'wc-packing', array(
        'label'                     => __('상품준비중'),
        'public'                    => true,
        'exclude_from_search'       => false,
        'show_in_admin_all_list'    => true,
        'show_in_admin_status_list' => true,
        'label_count'               => _n_noop( '상품 준비중 <span class="count">(%s)</span>', '상품 준비중 <span class="count">(%s)</span>' )
    ) );

    register_post_status( 'wc-shipping', array(
        'label'                     => __('배송중'),
        'public'                    => true,
        'exclude_from_search'       => false,
        'show_in_admin_all_list'    => true,
        'show_in_admin_status_list' => true,
        'label_count'               => _n_noop( '배송중 <span class="count">(%s)</span>', '배송중 <span class="count">(%s)</span>' )
    ) );

    register_post_status( 'wc-delivery-complete', array(
        'label'                     => __('배송완료'),
        'public'                    => true,
        'exclude_from_search'       => false,
        'show_in_admin_all_list'    => true,
        'show_in_admin_status_list' => true,
        'label_count'               => _n_noop( '배송완료 <span class="count">(%s)</span>', '배송완료 <span class="count">(%s)</span>' )
    ) );
};

// Add to list of WC Order statuses
add_filter( 'wc_order_statuses', 'add_packing_to_order_statuses' );
function add_packing_to_order_statuses( $order_statuses ) {

    $new_order_statuses = array();

    // add new order status after processing
    foreach ( $order_statuses as $key => $status ) {

        $new_order_statuses[ $key ] = $status;

        if ( 'wc-processing' === $key ) {
            $new_order_statuses['wc-packing'] = __('상품준비중');
        }
    }

    return $new_order_statuses;
}

// Add to list of WC Order statuses
add_filter( 'wc_order_statuses', 'add_shipping_to_order_statuses' );
function add_shipping_to_order_statuses( $order_statuses ) {

    $new_order_statuses = array();

    // add new order status after processing
    foreach ( $order_statuses as $key => $status ) {

        $new_order_statuses[ $key ] = $status;

        if ( 'wc-packing' === $key ) {
            $new_order_statuses['wc-shipping'] = __('배송중');
        }
    }

    return $new_order_statuses;
}

// Add to list of WC Order statuses
add_filter( 'wc_order_statuses', 'add_delivery_complete_to_order_statuses' );
function add_delivery_complete_to_order_statuses( $order_statuses ) {

    $new_order_statuses = array();

    // add new order status after processing
    foreach ( $order_statuses as $key => $status ) {

        $new_order_statuses[ $key ] = $status;

        if ( 'wc-shipping' === $key ) {
            $new_order_statuses['wc-delivery-complete'] = __('배송완료');
        }
    }

    return $new_order_statuses;
}


// Customizing _order_number
add_action( 'wp_insert_post', 'wc_custom_set_order_number', 10, 2 );
function wc_custom_set_order_number( $post_id, $post ) {
  global $wpdb;

  if ( 'shop_order' === $post->post_type && 'auto-draft' !== $post->post_status ) {

    $order_number = get_post_meta( $post_id, '_order_number', true );

    if ( '' === $order_number ) {

      $today = date("Ymd");
      $rand = strtoupper(substr(uniqid(sha1(time())),0,4));
      $unique = 'CR-' . $today . $rand;
      // attempt the query up to 3 times for a much higher success rate if it fails (due to Deadlock)
      $success = false;
      for ( $i = 0; $i < 3 && ! $success; $i++ ) {

        // this seems to me like the safest way to avoid order number clashes
        $query = $wpdb->prepare( "INSERT INTO {$wpdb->postmeta} (post_id, meta_key, meta_value) VALUES (%d, '_order_number', %s)", $post_id, $unique );

        $success = $wpdb->query( $query );
      }
    }
  }
}

add_filter( 'woocommerce_order_number', 'wc_custom_get_order_number', 10, 2 );
function wc_custom_get_order_number( $order_number, $order ) {

    $real_order_number = get_post_meta($order->ID, '_order_number', true);

    if ( $real_order_number ) {
        return $real_order_number;
    }

  return $order_number;

}


add_action('woocommerce_order_status_shipping_to_delivery-complete', 'wc_custom_insert_delivery_complete_date');
function wc_custom_insert_delivery_complete_date($order_id) {
    $today = date('Y-m-d H:i:s');
    $data = get_post_meta($order_id, 'delivery_complete_date');

    if (empty($data) === true) {
        add_post_meta($order_id, 'delivery_complete_date', $today);
    }
    else {
        update_post_meta($order_id, 'delivery_complete_date', $today);
    }
}


# 취소 가능한 status 추가.
add_filter('woocommerce_valid_order_statuses_for_cancel', 'wc_custom_add_filter_cancel_status');
function wc_custom_add_filter_cancel_status($status) {
    $status[] = 'awaiting-vbank';
    $status[] = 'processing';

    return $status;
}


add_filter('woocommerce_my_account_my_orders_query', 'wc_custom_my_orders_query_status');
function wc_custom_my_orders_query_status ($array) {
    $array['status'] = array('wc-awaiting-vbank', 'wc-processing', 'wc-packing', 'wc-shipping', 'wc-delivery-complete', 'wc-completed', 'wc-cancelled', 'wc-refunded');

    return $array;
}

//just for test
//자동으로 재고 개수를 증가시켜줌
//add_action('woocommerce_order_status_processing_to_cancelled', 'restore_order_stock', 10, 1);
/*function restore_order_stock ( $order_id ){
    $order = new WC_Order($order_id);

    if( !get_option('woocommerce_manage_stock') == 'yes' && !sizeof($order->get_items()) > 0 ){
        return;

    }

    error_log('before foreach'."\n", 3, "D:/stock.txt");

    foreach( $order->get_items() as $item){

        if($item['product_id'] > 0){
            $_product = $item->get_product();

            error_log('product :'.$_product."\n", 3, "D:/stock.txt");

            if($_product && $_product->exists() && $_product->managing_stock()){
                $old_stock = $_product->get_stock_quantity();
                error_log('old stock:'.$old_stock."\n", 3, "D:/stock.txt");

                $qty = apply_filters('woocommerce_order_item_quantity', $item['qty'], $this, $item);
                error_log('new stock:'.$qty."\n", 3, "D:/stock.txt");
                $new_quantity = $_product->increase_stock($qty);
                do_action('woocommerce_auto_stock_restored', $_product, $item);

                $order->add_order_note(sprintf(__('Item #%s stock incremented from %s to %s', 'woocommerce'), $item['product_id'], $old_stock, $new_quantity));
                $order->send_stock_notifications($_product, $new_quantity, $item['qty']);
                error_log('new stock:'.$new_quantity."\n", 3, "D:/stock.txt");
            }
        }
    }
}*/
