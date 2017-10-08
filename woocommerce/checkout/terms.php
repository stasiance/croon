<?php
/**
 * Checkout terms and conditions checkbox
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.1.1
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// CUSTOM TERMS

if (is_user_logged_in()) {
	$termsCat = 'member';
} else {
	$termsCat = 'non-member';
}

$terms = new WP_Query( array( 'category_name' => $termsCat ) );
?>

<?php if ( $terms->have_posts() ) : ?>
	<div class="checkout-agree">
		<div class="member accordion">
			<?php $i = 1; ?>
			<?php while ( $terms->have_posts() ) : $terms->the_post(); ?>
				<h4>
					<div class="check-box">
						<input type="checkbox" name="terms-consent" id="checkout-agree-chk<?php echo $i; ?>" value="term-<?php echo $i; ?>" />
						<label for="checkout-agree-chk<?php echo $i; ?>"><?php the_title(); ?></label>
					</div>
				</h4>
				<?php the_content(); ?>
				<?php $i++; ?>
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
		</div>
	</div>
<?php endif; ?>
