<? get_header(); ?>

<? the_post(); ?>

<? $project = get_photos( $post->ID ); ?>

	<section class="slideshow">
		<? if ( count( $project["hero_images"] ) ) { ?>
			<div class="project-heroes">
				<div class="slides">
					<? $heroes = $project["hero_images"]; ?>
					<? $hero = $heroes[0]; ?>
					<div class="slide hero">
						<?
							$sizes = $hero["image"]["sizes"];

							$hero_image_retina = $sizes["project-photo-retina"];
							$hero_image_normal = $sizes["project-photo"];
							$hero_image_mobile = $sizes["large"];
							$aspect_ratio = ( $hero["image"]["width"] / $hero["image"]["height"] );
						?>
						<div class="image-wrap">
							<img data-src-retina="<?= $hero_image_retina ?>" data-src-mobile="<?= $hero_image_mobile ?>" data-src-normal="<?= $hero_image_normal ?>" data-aspect-ratio="<?= $aspect_ratio ?>" />
						</div>
						<? clog( array( "\$hero" , $hero ) ); ?>
					</div>
				</div>
			</div>
		<? } ?>
	</section>
		
	<section class="content">
		<div class="wrapper">
			<div class="column col-8 centered tablet-full">
				<!--div class="project-header">
					<h2><? the_title(); ?></h2>
				</div-->
				<div class="project-intro">
					<blockquote>
						<?= $project["intro"] ?>
					</blockquote>
				</div>
			</div>
		</div>
		<div class="wrapper">
			<div class="column col-6 centered tablet-two-thirds">
				<div class="project-texts">
					<?= $project["story"] ?>
				</div>
			</div>
		</div>
		<div class="wrapper">
			<div class="column col-10 centered tablet-full">
				<div class="project-images">
					<? foreach ( $project["main_images"] as $image ) { ?>
						<div class="image">
							<?
								$sizes = $image["image"]["sizes"];

								$image_retina = $sizes["project-photo-retina"];
								$image_normal = $sizes["project-photo"];
								$image_mobile = $sizes["large"];
								$aspect_ratio = ( $image["image"]["width"] / $image["image"]["height"] );
							?>
							<img data-src-retina="<?= $image_retina ?>" data-src-mobile="<?= $image_mobile ?>" data-src-normal="<?= $image_normal ?>" data-aspect-ratio="<?= $aspect_ratio ?>" />
						</div>
					<? } ?>
				</div>
				<? //plog( $project ); ?>
			</div>
		</div>
	</section>

<? get_footer(); ?>