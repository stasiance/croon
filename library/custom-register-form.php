<?php

function wooc_extra_register_fields() {
?>
      <p class="form-row form-row-wide">
        <label for="account_password-2"><span class="required">*</span> <?php _e( 'Password verification', 'woocommerce' ); ?></label>
        <input type="password" class="input-text" name="account_password-2" id="reg_account_password-2" value="<?php if ( ! empty( $_POST['account_password-2'] ) ) esc_attr_e( $_POST['account_password-2'] ); ?>" />
      </p>

      <p class="form-row form-row-wide">
        <label for="reg_billing_last_name"><span class="required">*</span> <?php _e( 'Last name', 'woocommerce' ); ?></label>
        <input type="text" class="input-text" name="billing_last_name" id="reg_billing_last_name" value="<?php if ( ! empty( $_POST['billing_last_name'] ) ) esc_attr_e( $_POST['billing_last_name'] ); ?>" />
      </p>

      <p class="form-row form-row-wide">
        <label for="reg_billing_first_name"><span class="required">*</span> <?php _e( 'First name', 'woocommerce' ); ?></label>
        <input type="text" class="input-text" name="billing_first_name" id="reg_billing_first_name" value="<?php if ( ! empty( $_POST['billing_first_name'] ) ) esc_attr_e( $_POST['billing_first_name'] ); ?>" />
      </p>

      <p class="form-row form-row-wide">
        <label for="reg_billing_phone"><span class="required">*</span> <?php _e( 'Phone', 'woocommerce' ); ?></label>
        <input type="text" class="input-text" name="billing_phone" id="reg_billing_phone" value="<?php if ( ! empty( $_POST['billing_phone'] ) ) esc_attr_e( $_POST['billing_phone'] ); ?>" />
      </p>

      <p class="form-row form-row-wide">
        <label for="reg_account_birthdate"><?php _e( 'Birthdate', 'enjo' ); ?></label>
        <input type="date" class="input-text" name="account_birthdate" id="reg_account_birthdate" value="<?php if ( ! empty( $_POST['account_birthdate'] ) ) esc_attr_e( $_POST['account_birthdate'] ); ?>" />
      </p>

      <p class="form-row form-row-wide">
        <span><?php _e( 'Gender', 'enjo' ); ?></span>
        <input type="radio" class="input-text" name="account_gender" id="reg_account_gender_1" value="woman" />
        <label for="reg_account_gender_1"><?php _e( 'Woman', 'woocommerce' ); ?></label>

        <input type="radio" class="input-text" name="account_gender" id="reg_account_gender_2" value="man" />
        <label for="reg_account_gender_2"><?php _e( 'Man', 'woocommerce' ); ?></label>
      </p>

      <p class="form-row form-row-wide">
        <label for="reg_billing_postcode"><?php _e( 'Zip code', 'woocommerce' ); ?></label>
        <input type="text" class="input-text" name="billing_postcode" id="reg_billing_postcode" value="<?php if ( ! empty( $_POST['billing_postcode'] ) ) esc_attr_e( $_POST['billing_postcode'] ); ?>" />
      </p>

      <p class="form-row form-row-wide">
        <label for="reg_billing_address_1"><?php _e( 'Address 1', 'woocommerce' ); ?></label>
        <input type="text" class="input-text" name="billing_address_1" id="reg_billing_address_1" value="<?php if ( ! empty( $_POST['billing_address_1'] ) ) esc_attr_e( $_POST['billing_address_1'] ); ?>" />
      </p>

      <p class="form-row form-row-wide">
        <label for="reg_billing_address_2"><?php _e( 'Address 2', 'woocommerce' ); ?></label>
        <input type="text" class="input-text" name="billing_address_2" id="reg_billing_address_2" value="<?php if ( ! empty( $_POST['billing_address_2'] ) ) esc_attr_e( $_POST['billing_address_2'] ); ?>" />
      </p>
    </div>

    <div class="small-12 medium-6 cell">
      <p class="form-row form-row-wide">
        <span class="fake-label"><?php _e( 'Skin concern', 'enjo' ); ?></span>

        <input type="checkbox" class="input-text" name="account_concerns[]" id="concern_one" value="concern_one" />
        <label for="concern_one"><?php _e( 'Whitening', 'enjo' ); ?></label>

        <input type="checkbox" class="input-text" name="account_concerns[]" id="concern_two" value="concern_two" />
        <label for="concern_two"><?php _e( 'Acne', 'enjo' ); ?></label>

        <input type="checkbox" class="input-text" name="account_concerns[]" id="concern_three" value="concern_three" />
        <label for="concern_three"><?php _e( 'Wrinkles', 'enjo' ); ?></label>

        <input type="checkbox" class="input-text" name="account_concerns[]" id="concern_four" value="concern_four" />
        <label for="concern_four"><?php _e( 'Moisturizing', 'enjo' ); ?></label>

        <input type="checkbox" class="input-text" name="account_concerns[]" id="concern_five" value="concern_five" />
        <label for="concern_five"><?php _e( 'Pore', 'enjo' ); ?></label>

        <input type="checkbox" class="input-text" name="account_concerns[]" id="concern_six" value="concern_six" />
        <label for="concern_six"><?php _e( 'Keratin', 'enjo' ); ?></label>
      </p>

      <p class="form-row form-row-wide">
        <span class="fake-label"><?php _e( 'Marketing', 'enjo' ); ?></span>

        <p><?php _e( 'Marketing consent remarks', 'enjo' ); ?></p>

        <input type="checkbox" class="input-text" name="account_consent[]" id="marketing_consent_one" value="marketing_consent_one" />
        <label for="marketing_consent_one"><?php _e( 'SMS', 'enjo' ); ?></label>

        <input type="checkbox" class="input-text" name="account_consent[]" id="marketing_consent_two" value="marketing_consent_two" />
        <label for="marketing_consent_two"><?php _e( 'Email', 'enjo' ); ?></label>
      </p>

      <?php wc_get_template( 'checkout/terms.php' ); ?>

    </div>
  </div>
<?php
}
add_action( 'woocommerce_register_form', 'wooc_extra_register_fields' );


function wooc_validate_extra_register_fields( $username, $email, $validation_errors ) {
  // Test mandatory fields
  if( empty($_POST['billing_first_name']) ) { $validation_errors->add( 'billing_first_name', __( 'First name is mandatory', 'enjo' ) ); }
  if( empty($_POST['billing_last_name']) )  { $validation_errors->add( 'billing_last_name',  __( 'Last name is mandatory', 'enjo' ) ); }

  // Test specific formats
  if( $_POST['password'] !== $_POST['account_password-2'] ) { $validation_errors->add( 'account_password-2', __( 'Passwords should be the same', 'enjo' ) ); }
  if( !empty($_POST['account_birthdate']) && !strtotime($_POST['account_birthdate']) ) { $validation_errors->add( 'account_birthdate',      __( 'Please enter a valid date', 'enjo' ) ); }
  if ( 0 < strlen( trim( preg_replace( '/[\s\#0-9_\-\+\/\(\)]/', '', $_POST['billing_phone'] ) ) ) || strlen($_POST['billing_phone']) !== 11 || substr($_POST['billing_phone'], 0, 3) !== '010' ) {
    $validation_errors->add( 'billing_phone', __( 'Please enter a valid phone number', 'enjo' ) );
  }
}
add_action( 'woocommerce_register_post', 'wooc_validate_extra_register_fields', 10, 3 );


function wooc_save_extra_register_fields( $customer_id ) {
  if ( isset( $_POST['billing_first_name'] ) ) {
    update_user_meta( $customer_id, 'first_name', sanitize_text_field( $_POST['billing_first_name'] ) ); // WP
    update_user_meta( $customer_id, 'billing_first_name', sanitize_text_field( $_POST['billing_first_name'] ) ); // WC
  }

  if ( isset( $_POST['billing_last_name'] ) ) {
    update_user_meta( $customer_id, 'last_name', sanitize_text_field( $_POST['billing_last_name'] ) );
    update_user_meta( $customer_id, 'billing_last_name', sanitize_text_field( $_POST['billing_last_name'] ) );
  }

  if ( isset( $_POST['account_birthdate'] ) ) { update_user_meta( $customer_id, 'account_birthdate', sanitize_text_field( $_POST['account_birthdate'] ) ); }
  if ( isset( $_POST['account_gender'] ) )    { update_user_meta( $customer_id, 'account_gender', sanitize_text_field( $_POST['account_gender'] ) ); }
  if ( isset( $_POST['account_consent'] ) )   { update_user_meta( $customer_id, 'account_consent', sanitize_text_field( json_encode( $_POST['account_consent'] ) ) ); }
  if ( isset( $_POST['account_concerns'] ) )  { update_user_meta( $customer_id, 'account_concerns', sanitize_text_field( json_encode( $_POST['account_concerns'] ) ) ); }
  if ( isset( $_POST['billing_phone'] ) )     { update_user_meta( $customer_id, 'billing_phone', sanitize_text_field( $_POST['billing_phone'] ) ); }
  if ( isset( $_POST['billing_postcode'] ) )  { update_user_meta( $customer_id, 'billing_postcode', sanitize_text_field( $_POST['billing_postcode'] ) ); }
  if ( isset( $_POST['billing_address_1'] ) ) { update_user_meta( $customer_id, 'billing_address_1', sanitize_text_field( $_POST['billing_address_1'] ) ); }
  if ( isset( $_POST['billing_address_2'] ) ) { update_user_meta( $customer_id, 'billing_address_2', sanitize_text_field( $_POST['billing_address_2'] ) ); }
}
add_action( 'woocommerce_created_customer', 'wooc_save_extra_register_fields' );
