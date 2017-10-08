<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "off-canvas-wrap" div and all content after.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

?>

		</section>
		<div class="footer-container" data-sticky-footer>
			<footer class="footer">
				<?php do_action( 'foundationpress_before_footer' ); ?>
				<?php dynamic_sidebar( 'footer-widgets' ); ?>
				<?php do_action( 'foundationpress_after_footer' ); ?>

<!-- 2017-09-20 hide
				<?php require_once( 'dist/assets/images/ui/wave_dark.svg' ); ?>
-->
<!-- 2017-09-20 new -->
<div class="footer-wave"><img src="<?php echo get_template_directory_uri(); ?>/dist/assets/images/ui/wave.png" alt=""></div>
<!-- end of 2017-09-20 -->

				<nav class="footer-nav">
					<div class="social-nav">
						<a href="#"><img src="<?php echo get_template_directory_uri(); ?>/dist/assets/images/ui/sns-facebook.png" alt="facebook"></a>
						<a href="#"><img src="<?php echo get_template_directory_uri(); ?>/dist/assets/images/ui/sns-instagram.png" alt="instagram"></a>
					</div>
					<div class="website-nav">
						<?php
							wp_nav_menu( array(
								'menu'					 => 'pre-footer',
								'theme_location' => 'menu-1',
								'menu_id'        => 'pref-footer-menu',
							) );
						?>

					</div>
					<div class="newsletter-cta"><a href="#"><?php _e( '뉴스레터 구독', 'enjo' ) ?></a></div>
				</nav>
				<div class="footer-info">

<!-- 2017-09-20 new -->
<div id="footer-address">

	<div class="logo"><img src="<?php echo get_template_directory_uri(); ?>/dist/assets/images/ui/logo-w.png" alt="croon"></div>
	<ul>
		<li>대표이사: 마르코</li>
		<li>서울특별시 중구 정동길 33 4층</li>
		<li>T. 070-1234-1234 E-mail. enjocs@enjo.com</li>
	</ul>
	<ul>
		<li>사업자 등록번호 201-86-00000</li>
		<li>통신판매업신고 제2017-서울중구-0000</li>
	</ul>
					<?php
					$q = new WP_Query( array(
						'category_name' => 'footer',
						'posts_per_page' => 1,
						));
					?>
					<?php if ( $q->have_posts() ) : ?>
						<?php while ( $q->have_posts() ) : $q->the_post(); ?>
							<?php the_post_thumbnail(); ?>
							<?php the_content(); ?>
						<?php endwhile; ?>
						<?php wp_reset_postdata(); ?>
					<?php endif; ?>

					<?php
						wp_nav_menu( array(
							'menu'					 => 'footer',
							'theme_location' => 'menu-1',
							'menu_id'        => 'footer-menu',
						) );
					?>

	<div class="copyright">Copyright &copy;ENJO, All rights reserved.</div>

</div>
				</div>
			</footer>
		</div>

		<?php do_action( 'foundationpress_layout_end' ); ?>

<?php if ( get_theme_mod( 'wpt_mobile_menu_layout' ) === 'offcanvas' ) : ?>
	</div><!-- Close off-canvas content -->
<?php endif; ?>


<?php wp_footer(); ?>
<?php do_action( 'foundationpress_before_closing_body' ); ?>
</body>
</html>
