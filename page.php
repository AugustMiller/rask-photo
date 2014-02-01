<? get_header(); ?>

	<section class="content">
		<div class="wrapper">
			<div class="page">
				<div class="column col-12">
					<? the_post(); ?>
					<div class="page-header">
						<h2><? the_title(); ?></h2>
					</div>
					<div class="page-content">
						<? the_content(); ?>
					</div>
				</div>
			</div>
		</div>
	</section>

<? get_footer(); ?>