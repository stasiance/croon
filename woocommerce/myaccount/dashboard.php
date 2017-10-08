<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<div class="hello-wrap">
	<div class="hello-customer"><strong><?php echo esc_html( $current_user->display_name );?></strong>님, 안녕하세요 </div>
	<div class="modify-info">
		<?php
			printf(
				__('<a href="%2$s"><span>회원 정보 수정</span> <spanc class="icon-arrow gray"></spanc></a>'), 'woocommerce', esc_url( wc_get_endpoint_url( 'edit-account' ))
			);
		 ?>
	</div>
</div>
<?php
	/*
	printf(
		__( 'From your account dashboard you can view your <a href="%1$s">recent orders</a>, manage your <a href="%2$s">shipping and billing addresses</a> and <a href="%3$s">edit your password and account details</a>.', 'woocommerce' ),
		esc_url( wc_get_endpoint_url( 'orders' ) ),
		esc_url( wc_get_endpoint_url( 'edit-address' ) ),
		esc_url( wc_get_endpoint_url( 'edit-account' ) )
	);*/
?>
<?php
	$customer_orders = get_posts( apply_filters( 'woocommerce_my_account_my_orders_query', array(
		'numberposts' => $order_count,
		'meta_key'    => '_customer_user',
		'meta_value'  => get_current_user_id(),
		'post_type'   => wc_get_order_types( 'view-orders' ),
		'post_status' => array_keys( wc_get_order_statuses() ),
	) ) );

	$mypage_order_max_month = 6;
	$mypage_order_status_1_cnt = 0; //주문접수
	$mypage_order_status_2_cnt = 0; //결제완료
	$mypage_order_status_3_cnt = 0; //상품준비중
	$mypage_order_status_4_cnt = 0; //배송중
	$mypage_order_status_5_cnt = 0; //배송완료
	$unthil_show_date = strtotime(date('Y-m-d',strtotime('-'.$mypage_order_max_month.' month')));

	 foreach ( $customer_orders as $customer_order ) :
		$order      = wc_get_order( $customer_order );
		$customer_this_order_status = $order->get_status();
		$customer_this_order_date = strtotime($order->get_date_created()->date( 'Y-m-d' ));
		if($customer_this_order_date >= $unthil_show_date){ //6개월간의 주문건만 계산하여 보여줌
			if($customer_this_order_status == 'on-hold'){
				$mypage_order_status_1_cnt += 1;
			}else if($customer_this_order_status == 'processing'){
				$mypage_order_status_2_cnt += 1;
			}else if($customer_this_order_status == 'wc-packing'){
				$mypage_order_status_3_cnt += 1;
			}else if($customer_this_order_status == 'wc-shipping'){
				$mypage_order_status_4_cnt += 1;
			}else if($customer_this_order_status == 'wc-delivery-complete' || $customer_this_order_status == 'completed'){
				$mypage_order_status_5_cnt += 1;
			}
		}
	endforeach;
?>
<div class="order-status">
	<h2><span><a href="<?php echo esc_url(wc_get_endpoint_url('orders'))?>">주문/배송 조회</a></span> <spanc class="icon-arrow"></spanc> <span>(최근 6개월)</span></h2>
	<table>
		<tr>
			<td>
				<a href="<?php echo esc_url( wc_get_account_endpoint_url( 'orders' ) ); ?>">
				<div class="no">
					<?php echo $mypage_order_status_1_cnt == 0 ? $mypage_order_status_1_cnt : '<strong>'.$mypage_order_status_1_cnt.'</strong>' ;?>
				</div>
				<div class="text">
					주문접수
				</div>
			</a>
			</td>
			<td class="arrow"><span class="icon-arrow-big"></span></td>
			<td>
				<a href="<?php echo esc_url( wc_get_account_endpoint_url( 'orders' ) ); ?>">
				<div class="no">
					<?php echo $mypage_order_status_2_cnt == 0 ? $mypage_order_status_2_cnt : '<strong>'.$mypage_order_status_2_cnt.'</strong>' ;?>
				</div>
				<div class="text">
					결제완료
				</div>
				</a>
			</td>
			<td class="arrow"><span class="icon-arrow-big"></span></td>
			<td>
				<a href="<?php echo esc_url( wc_get_account_endpoint_url( 'orders' ) ); ?>">
				<div class="no">
					<?php echo $mypage_order_status_3_cnt == 0 ? $mypage_order_status_3_cnt : '<strong>'.$mypage_order_status_3_cnt.'</strong>' ;?>
				</div>
				<div class="text">
					상품준비중
				</div>
				</a>
			</td>
			<td class="arrow"><span class="icon-arrow-big"></span></td>
			<td>
				<a href="<?php echo esc_url( wc_get_account_endpoint_url( 'orders' ) ); ?>">
				<div class="no">
					<?php echo $mypage_order_status_4_cnt == 0 ? $mypage_order_status_4_cnt : '<strong>'.$mypage_order_status_4_cnt.'</strong>' ;?>
				</div>
				<div class="text">
					배송중
				</div>
				</a>
			</td>
			<td class="arrow"><span class="icon-arrow-big"></span></td>
			<td>
				<a href="<?php echo esc_url( wc_get_account_endpoint_url( 'orders' ) ); ?>">
				<div class="no">
					<?php echo $mypage_order_status_5_cnt == 0 ? $mypage_order_status_5_cnt : '<strong>'.$mypage_order_status_5_cnt.'</strong>' ;?>
				</div>
				<div class="text">
					배송완료
				</div>
				</a>
			</td>
		</tr>
	</table>
</div>
<div class="order-reaction">
	<table>
		<tr>
			<td>
				<a href="<?php echo esc_url( wc_get_account_endpoint_url( 'orders' ) ); ?>">주문 취소</a>
			</td>
			<td>
				<a href="<?php echo esc_url( wc_get_account_endpoint_url( 'orders' ) ); ?>">교환/반품</a>
			</td>
		</tr>
	</table>
</div>

<div class="dashboard-menu">
	<ul>
		<li>
			<?php
				printf(
					__('<a href="%2$s"><span class="icon-object note"></span> 주소록 관리 <span class="icon-arrow"></span></a>'), 'woocommerce', esc_url( wc_get_endpoint_url( 'edit-address' ))
				);
			 ?>
		</li>
		<li>
			<?php //1:1문의는 차후 Ticket 플러그인 추가하여 링크 수정
				printf(
					__('<a href="%2$s"><span class="icon-object qna"></span> 1:1 문의 <span class="icon-arrow"></span></a>'), 'woocommerce', esc_url( wc_get_endpoint_url( 'my-ticket' ))
				);
			 ?>
		</li>
		<li>
			<?php //1:1문의는 차후 위시리스트 플러그인 추가하여 링크 수정
				printf(
					__('<a href="%2$s"><span class="icon-object wishlist"></span> 위시리스트 <span class="icon-arrow"></span></a>'), 'woocommerce', esc_url( wc_get_endpoint_url( 'my-wish-list' ))
				);
			 ?>
		</li>
		<li>
			<?php //회원탈퇴는 코드앰샵에 있는걸 이용하여 사용 (스테이징 서버에만 존재 )
				printf(
					__('<a href="%2$s"><span class="icon-object quit"></span> 회원탈퇴 <span class="icon-arrow"></span></a>'), 'woocommerce', esc_url( wc_get_endpoint_url( 'unsubscribe' ))
				);
			 ?>
		</li>
	</ul>
</div>
<?php
	/**
	 * My Account dashboard.
	 *
	 * @since 2.6.0
	 */
	do_action( 'woocommerce_account_dashboard' );

	/**
	 * Deprecated woocommerce_before_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_before_my_account' );

	/**
	 * Deprecated woocommerce_after_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_after_my_account' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
