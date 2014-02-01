<? get_header(); ?>

	<section class="content">
		<div class="wrapper">
			<div class="posts">
				<div class="post">
					<? while ( have_posts() ) { ?>
						<? the_post(); ?>
						<div class="post-header">
							<h2><a href="<? the_permalink(); ?>"><? the_title(); ?></a></h2>
						</div>
						<div class="post-content">
							<? the_content(); ?>
						</div>
					<? } ?>
				</div>
			</div>
		</div>
	</section>

<? get_footer(); ?>