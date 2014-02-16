<? /*
	Template Name: Work
*/ ?>
<? get_header(); ?>

<? $home = get_home( $post->ID ); ?>
<? // clog($home); ?>

	<section class="slideshow">
		<? if ( count( $home["fields"]["featured_projects"] ) ) { ?>
			<div class="home-heroes">
				<div class="controls">
					<div class="prev"><img src="<?= bloginfo('template_directory') ?>/images/slide_prev.svg" /></div>
					<div class="next"><img src="<?= bloginfo('template_directory') ?>/images/slide_next.svg" /></div>
				</div>
				<div class="indicators"></div>
				<div class="slides">
					<? $featured = $home["fields"]["featured_projects"]; ?>
					<? foreach ( $featured as $hero ) { ?>
						<? // clog($hero); ?>
						<div class="slide hero">
							<?
								$sizes = $hero["image"]["sizes"];

								$hero_image_retina = $sizes["project-photo-retina"];
								$hero_image_normal = $sizes["project-photo"];
								$hero_image_mobile = $sizes["large"];
								$aspect_ratio = ( $hero["image"]["width"] / $hero["image"]["height"] );
							?>
							<div class="image-wrap">
								<a href="<?= get_permalink( $hero["project"][0]->ID ) ?>">
									<img data-src-retina="<?= $hero_image_retina ?>" data-src-mobile="<?= $hero_image_mobile ?>" data-src-normal="<?= $hero_image_normal ?>" data-aspect-ratio="<?= $aspect_ratio ?>" />
								</a>
							</div>
						</div>
					<? } ?>
				</div>
			</div>
		<? } ?>
	</section>
	<section class="projects clearfix">
		<? //plog($home); ?>
		<? $projects = $home["projects"]; ?>
		<? foreach ( $projects as $project ) { ?>
			<?
				$tile_post = $project["post"];
				$tile_fields = $project["fields"];
				$thumbnail = $tile_fields["hero_images"][0]["image"];
			?>
			<div class="project-tile desktop-quarter tablet-third mobile-half">
				<a href="<?= get_permalink( $tile_post->ID ) ?>">
					<? //clog( $project ); ?>
					<div class="tile-image">
						<img src="<?= $thumbnail["sizes"]["project-thumbnail"] ?>" />
					</div>
					<div class="project-info">
						<h2><?= $tile_post->post_title ?></h2>
						<div class="view-button">View</div>
					</div>
				</a>
			</div>
		<? } ?>
	</section>

<? get_footer(); ?>