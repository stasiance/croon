<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wc_print_notices();

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) );
	return;
}

?>

<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">
<div class="flex">

	<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>

		<?php if ( $checkout->get_checkout_fields() ) : ?>

			<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

			<div class="col2-set" id="customer_details">
				<div class="col-1">
					<?php do_action( 'woocommerce_checkout_billing' ); ?>
				</div>

				<div class="col-2">
					<?php do_action( 'woocommerce_checkout_shipping' ); ?>
				</div>
			</div>

			<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

		<?php endif; ?>

	<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

	<div id="order_review" class="woocommerce-checkout-review-order">
		<h3 id="order_review_heading"><?php _e( '주문 상품', 'woocommerce' ); ?></h3>

			<!-- start product -->
			<?php
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			    $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			    $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
			?>
			<div class="product-box">
			<div class="row">
				<div class="small-4 cell">
					<div class="product-thumbnail">
						<?php
							$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

							if ( ! $product_permalink ) {
								echo $thumbnail;
							} else {
								printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail );
							}
						?>
					</div>
				</div>
				<div class="small-8 cell grid-x product-text">
					<div class="product-name small-12 cell" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
						<?php echo apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ); ?>
					</div>
					<div class="product-quantity small-12 cell" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
						<?php echo $cart_item['quantity'];?>개
					</div>
					<div class="product-price small-12 cell" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
						<?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key )?>
					</div>
				</div>
			</div>
		</div>
		<?php } } ?>
		<!-- end product -->
		<!-- start coupon -->
		<?php
		if (wc_coupons_enabled() && empty( WC()->cart->applied_coupons )) {
	 	?>
		<div id="use-coupon">
			<input type="checkbox" id="chk2" name="chk2"><label for="chk2">쿠폰사용</label>
		</div>
			<form class="checkout_coupon" method="post">

				<p class="form-row form-row-first">
					<input type="text" name="coupon_code" class="input-text" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" id="coupon_code" value="" />
				</p>

				<p class="form-row form-row-last">
					<input type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>" />
				</p>

				<div class="clear"></div>
			</form>

		<?php } ?>
		<!-- end coupon -->

		<?php do_action( 'woocommerce_checkout_order_review' ); ?>
	</div>

</div>
</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
