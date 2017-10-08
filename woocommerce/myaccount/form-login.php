<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
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
	exit; // Exit if accessed directly
}

?>

<?php wc_print_notices(); ?>

<?php do_action( 'woocommerce_before_customer_login_form' ); ?>

<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>

<nav class="login-register-tabs grid-x">
	<a href="#" class="switch-account-tabs small-6 cell active" data-tab="login"><?php _e( 'Login', 'enjo' ); ?></a>
	<a href="#" class="switch-account-tabs small-6 cell" data-tab="register"><?php _e( 'Register', 'enjo' ); ?></a>
</nav>

<div class="u-columns col2-set" id="customer_login">

	<div class="u-column1 col-1 login-tab account-tab grid-x" <?php if($_POST['register']) { echo 'style="display:none"'; } ?> >

<?php endif; ?>

	<div class="small-12 medium-6 cell">
		<h2><?php _e( 'Login', 'woocommerce' ); ?></h2>

		<form class="woocomerce-form woocommerce-form-login login" method="post">

			<?php do_action( 'woocommerce_login_form_start' ); ?>

			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<!-- <label for="username"><span class="required">*</span> <?php //_e( 'Username or email address', 'woocommerce' ); ?></label> -->
				<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( $_POST['username'] ) : ''; ?>" placeholder="<?php _e( 'Username or email address', 'woocommerce' ); ?>" />
			</p>
			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<!-- <label for="password"><span class="required">*</span> <?php //_e( 'Password', 'woocommerce' ); ?></span></label> -->
				<input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" placeholder="<?php _e( 'Password', 'woocommerce' ); ?>" />
			</p>

			<?php do_action( 'woocommerce_login_form' ); ?>

			<p class="form-row">
				<label class="woocommerce-form__label woocommerce-form__label-for-checkbox inline">
					<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php _e( 'Remember me', 'woocommerce' ); ?></span>
				</label>
			</p>

			<p class="woocommerce-LostPassword lost_password">
				<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php _e( 'Lost your password?', 'woocommerce' ); ?></a>
			</p>

			<p class="form-row">
				<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
				<input type="submit" class="woocommerce-Button button" name="login" value="<?php esc_attr_e( 'Login', 'woocommerce' ); ?>" />
			</p>

			<?php do_action( 'woocommerce_login_form_end' ); ?>

		</form>
	</div>

	<div class="small-12 medium-6 cell">
		<form class="guest-track-order" action="" method="post">
			<h2><?php _e( 'Guest order tracking', 'enjo' ); ?></h2>
			<p><?php _e( 'Guest order tracking', 'enjo' ); ?></p>
			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<input type="text" name="" value="" placeholder="<?php _e( '이메일 주소', 'enjo' ); ?>">
			</p>
			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<input type="text" name="" value="" placeholder="<?php _e( '주문번호', 'enjo' ); ?>">
			</p>
			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<input type="submit" name="" class="button" value="Check order">
			</p>
		</form>
	</div>

<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>

	</div>

	<div class="u-column2 col-2 register-tab account-tab" <?php if(!$_POST['register']) { echo 'style="display:none"'; } ?> >

		<h2><?php _e( 'Register', 'woocommerce' ); ?></h2>

		<form method="post" class="register">

			<?php /*
				<div> tags closed in /library/custom-register-form.php
				called by do_action( 'woocommerce_register_form_end' )
			*/ ?>
			<div class="grid-x">
				<div class="small-12 medium-6 cell">

					<?php do_action( 'woocommerce_register_form_start' ); ?>

					<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

						<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
							<label for="reg_username"><span class="required">*</span> <?php _e( 'Username', 'woocommerce' ); ?></label>
							<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( $_POST['username'] ) : ''; ?>" />
						</p>

					<?php endif; ?>

					<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
						<label for="reg_email"><span class="required">*</span> <?php _e( 'Email address', 'woocommerce' ); ?></label>
						<input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( $_POST['email'] ) : ''; ?>" />
					</p>

					<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

						<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
							<label for="reg_password"><span class="required">*</span> <?php _e( 'Password', 'woocommerce' ); ?></label>
							<input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" />
						</p>

					<?php endif; ?>

					<!-- Spam Trap -->
					<div style="<?php echo ( ( is_rtl() ) ? 'right' : 'left' ); ?>: -999em; position: absolute;"><label for="trap"><?php _e( 'Anti-spam', 'woocommerce' ); ?></label><input type="text" name="email_2" id="trap" tabindex="-1" autocomplete="off" /></div>

					<?php do_action( 'woocommerce_register_form' ); ?>

					<p class="woocomerce-FormRow form-row">
						<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
						<input type="submit" class="woocommerce-Button button" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>" />
					</p>

					<?php do_action( 'woocommerce_register_form_end' ); ?>

		</form>

	</div>

</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
