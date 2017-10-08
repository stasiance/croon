<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "container" div.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

// Top bar links
global $woocommerce;
$myaccount_page_id = get_option( 'woocommerce_myaccount_page_id' );
if ( $myaccount_page_id ) {
  $myaccount_page_url = get_permalink( $myaccount_page_id );
}
$cart_url = $woocommerce->cart->get_cart_url();

?>

<!doctype html>
<html class="no-js" <?php language_attributes(); ?> >
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
	<?php do_action( 'foundationpress_after_body' ); ?>

	<?php if ( get_theme_mod( 'wpt_mobile_menu_layout' ) === 'offcanvas' ) : ?>
		<?php get_template_part( 'template-parts/mobile-off-canvas' ); ?>
	<?php endif; ?>

	<?php do_action( 'foundationpress_layout_start' ); ?>

	<header class="site-header" role="banner">
		<div class="site-title-bar title-bar" <?php foundationpress_title_bar_responsive_toggle() ?>>
			<div class="title-bar-left">
				<a href="#" data-toggle="<?php foundationpress_mobile_menu_id(); ?>">
					<img src="<?php echo get_template_directory_uri(); ?>/dist/assets/images/ui/menu-mobile-burger.svg" alt="Menu">
				</a>
				<!-- <button class="menu-icon" type="button" data-toggle="<?php //foundationpress_mobile_menu_id(); ?>"></button> -->
			</div>
			<span class="site-mobile-title title-bar-title">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<img src="<?php echo get_template_directory_uri(); ?>/dist/assets/images/logo/menu-mobile-logo.svg" alt="CROON">
				</a>
			</span>
			<div class="title-bar-right">
				<a class="my-account-icon" href="<?php echo $myaccount_page_url; ?>">
					<img src="<?php echo get_template_directory_uri(); ?>/dist/assets/images/ui/menu-mobile-my-page.svg" alt="My page">
				</a>
				<a href="<?php echo $cart_url; ?>" class="mini-cart-icon">
					<img src="<?php echo get_template_directory_uri(); ?>/dist/assets/images/ui/menu-mobile-shopping-bag.svg" alt="Shopping bag">
          <span><?php echo WC()->cart->get_cart_contents_count(); ?></span>
				</a>
			</div>
		</div>

		<!-- 2017-09-21 new -->
				<nav class="site-navigation top-bar" role="navigation">
					<div class="top-bar-left">
						<div class="site-desktop-title top-bar-title">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
								<img src="<?php echo get_template_directory_uri(); ?>/dist/assets/images/logo/menu-desktop-logo.png" alt="CROON">
							</a>
						</div>
					</div>
					<div class="top-bar-right">
                        <?php if(is_user_logged_in()){ ?>
                            <a class="my-account-icon" href="<?php echo esc_url( wc_logout_url() ); ?>">로그아웃</a>
                        <?php }else{ ?>
                            <a class="my-account-icon" href="<?php echo esc_url( home_url( '/login' ) ); ?>">로그인</a>
                        <?php } ?>
                        <a class="my-account-icon" href="<?php echo $myaccount_page_url; ?>">마이페이지</a>
						<a href="<?php echo $cart_url; ?>" class="mini-cart-icon">
							<img src="<?php echo get_template_directory_uri(); ?>/dist/assets/images/ui/menu-mobile-shopping-bag.svg" alt="장바구니">
		          <span><?php echo WC()->cart->get_cart_contents_count(); ?></span>
						</a>
					</div>
				</nav>
		<!-- end of 2017-09-21 -->
		<!-- 2017-09-21 hide
		<nav class="site-navigation top-bar" role="navigation">
			<div class="top-bar-left">
				<div class="site-desktop-title top-bar-title">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
				</div>
			</div>
			<div class="top-bar-right">
				<?php foundationpress_top_bar_r(); ?>

				<?php if ( ! get_theme_mod( 'wpt_mobile_menu_layout' ) || get_theme_mod( 'wpt_mobile_menu_layout' ) === 'topbar' ) : ?>
					<?php get_template_part( 'template-parts/mobile-top-bar' ); ?>
				<?php endif; ?>
			</div>
		</nav>
		-->
	</header>

<?php if(is_cart()){
        if(WC()->cart->get_cart_contents_count() == 0 ){?>
            <section class="container empty-cart">
            <?php }else{ ?>
                <section class="container">
            <?php }
     }else{ ?>
        <section class="container">
<?php }?>

		<?php do_action( 'foundationpress_after_header' );
