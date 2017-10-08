<?php
function my_custom_checkout_field_display_admin_order_meta($order){

  $userId = get_post_meta( $order->id, '_customer_user', true);

  $gender = 'n/a';
  $birth  = 'n/a';

  $concerns  = 'n/a';
  $consents  = 'n/a';

  if( get_user_meta( $userId, 'account_gender', true ) )    { $gender = get_user_meta( $userId, 'account_gender', true ); }
  if( get_user_meta( $userId, 'account_birthdate', true ) ) { $birth  = get_user_meta( $userId, 'account_birthdate', true ); }

  if( get_user_meta( $userId, 'account_concerns', true ) ) { $concerns = implode (', ', json_decode( get_user_meta( $userId, 'account_concerns', true ) ) ); }
  if( get_user_meta( $userId, 'account_consent', true ) )  { $consents = implode (', ', json_decode( get_user_meta( $userId, 'account_consent', true ) ) ); }

  echo '<div style="clear:both"></div>';

  echo '<p><strong>'.__('Gender').':</strong> ' . $gender . '</p>';
  echo '<p><strong>'.__('Birthdate').':</strong> ' . $birth . '</p>';
  echo '<p><strong>'.__('Skin concerns').':</strong> ' . $concerns . '</p>';
  echo '<p><strong>'.__('Marketing consents').':</strong> ' . $consents . '</p>';
}
add_action( 'woocommerce_admin_order_data_after_billing_address', 'my_custom_checkout_field_display_admin_order_meta', 10, 1 );
