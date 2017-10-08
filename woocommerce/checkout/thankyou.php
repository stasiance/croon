<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
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
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="woocommerce-order">

	<?php if ( $order ) : ?>

		<?php if ( $order->has_status( 'failed' ) ) : ?>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php _e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce' ); ?></p>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
				<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php _e( 'Pay', 'woocommerce' ) ?></a>
				<?php if ( is_user_logged_in() ) : ?>
					<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php _e( 'My account', 'woocommerce' ); ?></a>
				<?php endif; ?>
			</p>

		<?php else : ?>
			<div class="bubble-wrap">

				<div class="bubble"></div>

<!--			<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( '주문이 완료되었습니다.', 'woocommerce' ), $order ); ?></p>-->
			<div class="order-summery">
				<ul class="woocommerce-order-overview woocommerce-thankyou-order-details order_details">

					<li class="woocommerce-order-overview__order order">
						<?php _e( '주문번호:', 'woocommerce' ); ?>
						<strong><?php echo $order->get_order_number(); ?></strong>
					</li>
	<!-- hide
					<li class="woocommerce-order-overview__date date">
						<?php _e( '주문일자:', 'woocommerce' ); ?>
						<strong><?php echo wc_format_datetime( $order->get_date_created() ); ?></strong>
					</li>

					<li class="woocommerce-order-overview__total total">
						<?php _e( '주문합계:', 'woocommerce' ); ?>
						<strong><?php echo $order->get_formatted_order_total(); ?></strong>
					</li>

					<?php if ( $order->get_payment_method_title() ) : ?>

					<li class="woocommerce-order-overview__payment-method method">
						<?php _e( '결제방법:', 'woocommerce' ); ?>
						<strong><?php echo wp_kses_post( $order->get_payment_method_title() ); ?></strong>
					</li>
	-->
					<?php endif; ?>

				</ul>
				<!-- html -->
				<div class="empty-icon">
					<img src="<?php echo get_template_directory_uri(); ?>/dist/assets/images/ui/icon-box.png" alt="택배 상자">
				</div>

				<p class="woocommerce-order-overview__text">
					로그인 화면에서 이메일 주소와 주문번호 입력하시면
					주문 및 배송 조회가 가능합니다.
				</p>

			</div>
		</div>
		<?php endif; ?>


		<!--<?php do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() ); ?>-->

		<!-- html -->
		<div id="thankyou-order-info" class="product-box-wrap">
			<h2>주문 정보</h2>
			<div class="product-header flex">
				<div class="row">
					<div class="small-8 cell">상품정보</div>
					<div class="small-2 cell">수량</div>
					<div class="small-2 cell">소계금액</div>
				</div>
			</div>

			<?php foreach ( $order->get_items() as $item_key => $item ) {
				$product = apply_filters( 'woocommerce_order_item_product', $order->get_product_from_item( $item ), $item );
			?>

			<div class="product-box flex">
				<div class="row">
					<div class="small-4 cell">
						<div class="product-thumbnail">
							<?php echo $product->get_image('shop_thumbnail');  ?>
						</div>
					</div>
					<div class="small-8 cell grid-x product-text">
						<div class="product-name small-12 cell" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
							<?php echo $item->get_name();?>
						</div>
						<div class="product-quantity small-12 cell" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
								<?php echo $item->get_quantity();?>개
						</div>
						<div class="product-price small-12 cell" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
							<?php echo $order->get_formatted_line_subtotal($item); ?>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
		</div>
		<!--?php do_action( 'woocommerce_thankyou', $order->get_id() ); ?-->
		<!-- html : price info -->
		<div id="product-price-box">
			<div class="row small-12 thead">
				<div class="small-8 cell">
						총 상품 금액
				</div>
				<div class="small-4 cell">
						<strong>132,000</strong>원
				</div>
			</div>
			<div class="row small-12 tbody">
				<div class="small-8 cell">
						배송비
				</div>
				<div class="small-4 cell">
						<strong>120,000</strong>원
				</div>
			</div>
			<div class="row small-12 tbody">
				<div class="small-8 cell">
						쿠폰
				</div>
				<div class="small-4 cell">
						<strong>-12,000</strong>원
				</div>
			</div>
			<div class="row small-12 tfoot">
				<div class="small-8 cell">
						총 결제 금액
				</div>
				<div class="small-4 cell">
						<strong>120,000</strong>원
				</div>
			</div>
		</div>
		<!-- payment method -->
		<div id="payment-method-box" class="section">
			<h2>결제수단</h2>
			<div class="row small-12 method">
				<div class="small-4 cell mobile">
					결제수단
				</div>
				<div class="small-8 cell">
					가상계좌
					<!-- show this div only in desktop mode -->
					<div class="desktop">
						입금계좌: KB국민 123456789123456<br />
						입금기한일: 2017.12.22
					</div>
					<!-- end of desktop mode -->
				</div>
			</div>
			<!-- show this divs only in mobile mode -->
			<div class="row small-12 method-info bankaccount mobile">
				<div class="small-4 cell">
					입금계좌
				</div>
				<div class="small-8 cell">
					KB국민 27019078910166
				</div>
			</div>
			<div class="row small-12 method-info expired mobile">
				<div class="small-4 cell">
					입금기한일
				</div>
				<div class="small-8 cell">
					2017.12.22
				</div>
			</div>
			<!-- end of mobile mode -->
		</div>
		<!-- customer info -->
		<div id="customer-details-box" class="section">
			<h2>주문고객 정보</h2>
			<div class="row small-12 customer-info name">
				<div class="small-4 cell">
					주문자
				</div>
				<div class="small-8 cell">
					유정임
				</div>
			</div>
			<div class="row small-12 customer-info email">
				<div class="small-4 cell">
					이메일
				</div>
				<div class="small-8 cell">
					jeongim@asiance.com
				</div>
			</div>
			<div class="row small-12 customer-info cellno">
				<div class="small-4 cell">
					휴대폰 번호
				</div>
				<div class="small-8 cell">
					01012345678
				</div>
			</div>
			<div class="row small-12 customer-info address">
				<div class="small-4 cell">
					주소
				</div>
				<div class="small-8 cell">
					04518 서울시 중구 정동길 33<br />
					신아일보기념관 4층
				</div>
			</div>
		</div>
		<!-- shipping info -->
		<div id="shipping-details-box" class="section">
			<h2>배송정보</h2>
			<div class="row small-12 shipping-info name">
				<div class="small-4 cell">
					주문자
				</div>
				<div class="small-8 cell">
					유정임
				</div>
			</div>
			<div class="row small-12 shipping-info cellno">
				<div class="small-4 cell">
					휴대폰 번호
				</div>
				<div class="small-8 cell">
					01012345678
				</div>
			</div>
			<div class="row small-12 shipping-info address">
				<div class="small-4 cell">
					주소
				</div>
				<div class="small-8 cell">
					04518 서울시 중구 정동길 33<br />
					신아일보기념관 4층
				</div>
			</div>
			<div class="row small-12 shipping-info request">
				<div class="small-4 cell">
					배송요청사항
				</div>
				<div class="small-8 cell">
					부재실 경비실에 맡겨주세요.
				</div>
			</div>
		</div>
		<!-- end of HTML -->


	<?php else : ?>

		<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( '주문이 완료되었습니다.', 'woocommerce' ), null ); ?></p>

	<?php endif; ?>

	<!-- HTML -->
	<div class="btn-wrap">
		<a href="<?php echo esc_url( home_url( '/shop' ) ); ?>" class="checkout-button button alt wc-forward">쇼핑 계속 하기</a>
		<a href="<?php echo esc_url( home_url( '/shipping' ) ); ?>" class="checkout-button button alt wc-forward white">주문/배송 조회</a>
	</div>
	<!-- end of HTML -->

</div>
