<? get_header(); ?>

	<section class="content">
		<div class="wrapper">
			<div class="post">
				<? the_post(); ?>
				<div class="post-header">
					<h2><? the_title(); ?></h2>
				</div>
				<div class="post-content">
					<? the_content(); ?>
				</div>
			</div>
		</div>
	</section>

<? get_footer(); ?>