<?php
/**
 * My Account navigation
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/navigation.php.
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
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_account_navigation' );
?>

<nav class="woocommerce-MyAccount-navigation">
	<h2>마이페이지</h2>
	<ul>
		<li class="<?php echo wc_get_account_menu_item_classes( 'edit-account' ); ?>">
			<a href="<?php echo esc_url( wc_get_account_endpoint_url( 'edit-account' ) ); ?>"><?php echo esc_html( '회원 정보 수정' ); ?></a>
		</li>
		<li class="<?php echo wc_get_account_menu_item_classes( 'edit-address' ); ?>">
			<a href="<?php echo esc_url( wc_get_account_endpoint_url( 'edit-address' ) ); ?>"><?php echo esc_html( '주소록' ); ?></a>
		</li>
		<li class="<?php echo wc_get_account_menu_item_classes( 'orders' ); ?>">
			<a href="<?php echo esc_url( wc_get_account_endpoint_url( 'orders' ) ); ?>"><?php echo esc_html( '주문 내역' ); ?></a>
		</li>
		<li class="<?php echo wc_get_account_menu_item_classes( 'my-ticket' ); ?>">
			<a href="<?php echo esc_url( wc_get_account_endpoint_url( 'my-ticket' ) ); ?>"><?php echo esc_html( '1:1문의' ); ?></a>
		</li>
		<li class="<?php echo wc_get_account_menu_item_classes( 'my-wish-list' ); ?>">
			<a href="<?php echo esc_url( wc_get_account_endpoint_url( 'my-wish-list' ) ); ?>"><?php echo esc_html( '위시리스트' ); ?></a>
		</li>
		<li class="<?php echo wc_get_account_menu_item_classes( 'unsubscribe' ); ?>">
			<a href="<?php echo esc_url( wc_get_account_endpoint_url( 'unsubscribe' ) ); ?>"><?php echo esc_html( '회원 탈퇴' ); ?></a>
		</li>
	</ul>
</nav>

<?php do_action( 'woocommerce_after_account_navigation' ); ?>
