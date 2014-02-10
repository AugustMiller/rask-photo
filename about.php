<? /*
	Template Name: About
*/ ?>

<? get_header(); ?>
<? the_post(); ?>

<? $fields = get_fields(); ?>

	<section class="profile">
		<? $profile = $fields['profile_image']; ?>
		<img src="<?= $profile['sizes']['large'] ?>" />
	</section>

	<section class="content">
		<div class="wrapper">
			<div class="column col-8 centered">
				<div class="about-content">
					<? the_content(); ?>
				</div>
			</div>
		</div>
	</section>

<? get_footer(); ?>