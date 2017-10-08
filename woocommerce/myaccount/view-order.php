<?php
/**
 * View Order
 *
 * Shows the details of a particular order on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/view-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<p>
	<span>주문번호</span>
	<span><?php echo $order->get_order_number() ?></span>
	<span>주문일자</span>
	<span><?php echo wc_format_datetime( $order->get_date_created() ) ?></span>
	<span>주문상태</span>
	<span><?php echo wc_get_order_status_name( $order->get_status() ) ?></span>
</p>

<?php if ( $notes = $order->get_customer_order_notes() ) : ?>
	<h2><?php _e( 'Order updates', 'woocommerce' ); ?></h2>
	<ol class="woocommerce-OrderUpdates commentlist notes">
		<?php foreach ( $notes as $note ) : ?>
		<li class="woocommerce-OrderUpdate comment note">
			<div class="woocommerce-OrderUpdate-inner comment_container">
				<div class="woocommerce-OrderUpdate-text comment-text">
					<p class="woocommerce-OrderUpdate-meta meta"><?php echo date_i18n( __( 'l jS \o\f F Y, h:ia', 'woocommerce' ), strtotime( $note->comment_date ) ); ?></p>
					<div class="woocommerce-OrderUpdate-description description">
						<?php echo wpautop( wptexturize( $note->comment_content ) ); ?>
					</div>
	  				<div class="clear"></div>
	  			</div>
				<div class="clear"></div>
			</div>
		</li>
		<?php endforeach; ?>
	</ol>
<?php endif; ?>

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
