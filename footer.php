		<section class="footer">
			<div class="wrapper">
				<div class="column col-12">
					<?
						$footer_nav = array(
							'theme_location' => 'footer',
							'container' => false
						);
						wp_nav_menu( $footer_nav );

						$social_nav = array(
							'theme_location' => 'social',
							'container' => false
						);
						wp_nav_menu( $social_nav );
					?>
					<ul>
						<li>All work and images &copy; Cindi Rask, <?= date('Y') ?></li>
					</ul>
				</div>
			</div>
		</section>
	</body>

	<? wp_footer(); ?>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
	
</html>