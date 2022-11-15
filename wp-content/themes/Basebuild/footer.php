<?php

/**
 * The template for displaying the footer
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

// Get vars from options ACF
$email_form = get_field('email_form', 'option');
$footer_description = get_field('footer_description', 'option');
$phone = get_field('phone', 'option');
$phone_display = get_field('phone_display', 'option');
$email = get_field('email', 'option');
$address = get_field('address', 'option');


$youtube_url = get_field('youtube', 'option');
$instagram_url = get_field('instagram', 'option');
$twitter_url = get_field('twitter', 'option');
$facebook_url = get_field('facebook', 'option');
$linkedin_url = get_field('linkedin', 'option');

?>

<footer class="footer">
	<div class="content">
		<div class="row">
			<div class="col-md-3 col-sm-12">
				<ul class="no-bullets">
					<li class="footer__list-title">Contact Us</li>
					<li class="footer__list-item"><?php echo $address ?>
						<!-- <p> <a href="tel: <?php //echo $phone ?>"><?php // echo $phone_display ?></a></p>
						<p> <a href="mailto: <?php //echo $email ?>"><?php // echo $email ?></a></p> -->
					</li>
				</ul>
			</div>
			<div class="col-md-3 col-sm-12">
				<p class="footer__list-title">&nbsp;</p>
				<?php foundationpress_footer_nav1(); ?>
			</div>
			<div class="col-md-3 col-sm-12">
				<p class="footer__list-title">&nbsp;</p>
				<?php foundationpress_footer_nav2(); ?>
			</div>
			<div class="col-md-3 col-sm-12">
				<ul class="no-bullets">
					<li class="footer__list-title">Connect on social</li>
					<div class="social-container"><a target="_blank" href="<?php echo $facebook_url ?>"><span class="icon"><i class="fab fa-facebook"></i></span></a><a target="_blank" href="<?php echo $twitter_url ?>"><span class="icon"><i class="fab fa-twitter"></i></span></a><a target="_blank" href="<?php echo $linkedin_url ?>"><span class="icon"><i class="fab fa-linkedin"></i></span></a><a target="_blank" href="<?php echo $instagram_url ?>"><span class="icon"><i class="fab fa-instagram"></i></span></a><a target="_blank" href="<?php echo $youtube_url ?>"><span class="icon"><i class="fab fa-youtube"></i></span></a></div>
				</ul>
				<div id="footer-logo"> <a href="<?php echo get_home_url(); ?>"><img src="<?php echo get_theme_file_uri() ?>/dist/img/logo-white.svg" alt="logo" /></a></div>
			</div>
		</div>
		<div class="row baseline-content">
			<div class="col-md-3 col-sm-12">
				<p>Copyright <?php echo date('Y'); ?></p>
			</div>
			<div class="col-md-3 col-sm-12"> <a href="../terms-conditions/">Terms &amp; Conditions</a></div>
			<div class="col-md-3 col-sm-12"> <a href="../privacy/">Privacy &amp; Cookies</a></div>
		</div>
	</div>
	
</footer>
<div id="back-top">
	<span class="icon"><i class="fa fa-arrow-up"></i></span>
</div>
<?php wp_footer(); ?>
</body>

</html>