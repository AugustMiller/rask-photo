<? /*
	Template Name: About
*/ ?>

<? get_header(); ?>

<? $fields = get_fields(); ?>

	<section class="profile">
		<img src="<?= $fields['profile-image']; ?>" />
	</section>

	<section class="content">
		<div class="posts">
			<? while ( have_posts() ) { ?>
				<div class="post">
					<div class="wrapper">
						<div class="column col-8">
							<? the_post(); ?>
							<div class="post-header">
								<h2><a href="<? the_permalink(); ?>"><? the_title(); ?></a></h2>
							</div>
							<div class="post-content">
								<? the_content(); ?>
							</div>
						</div>
					</div>
				</div>
			<? } ?>
		</div>
	</section>

<? get_footer(); ?>