<!DOCTYPE html>
<html>
	<head>
		<title><? bloginfo('title'); ?></title>
		<meta name="viewport" content="width=device-width, user-scalable=no">
		<? wp_head(); ?>
	</head>

	<body <? body_class(); ?>>

		<section class="header">
			<div class="wrapper">
				<div class="column col-8 mobile-half site-title">
					<h1>
						<a href="<?= home_url() ?>"><? bloginfo('title'); ?></a>
					</h1>
				</div>
				<div class="column col-4 mobile-half">
					<div class="menu-button-open hamburger">
						<span class="part bun"></span>
						<span class="part meat"></span>
						<span class="part bun"></span>
					</div>
				</div>
				<div class="flyout desktop-quarter tablet-third mobile-full">
					<div class="inner">
						<div class="menu-button-close">
							&#10005;
						</div>
						<?
							$header_nav = array(
								'theme_location' => 'primary',
								'container' => false
							);
							wp_nav_menu( $header_nav );

							$social_nav = array(
								'theme_location' => 'social',
								'container' => false
							);
							wp_nav_menu( $social_nav );
						?>
					</div>
				</div>
			</div>
		</section>