<?

/*
	ACF
*/

include("acf-fields.php");

/*
	Scripts
*/

function lou_scripts ( ) {

	// jQuery
	// wp_register_script( 'lou-jquery' , '//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js' , '1.10.1' , true );
	wp_register_script( 'lou-jquery' , '//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js' , '1.10.1' , true );
	wp_enqueue_script( 'lou-jquery' );

	// PJAX
	wp_register_script( 'lou-pjax' , ( get_template_directory_uri() . '/scripts/pjax.js' ) , array( 'jquery' ) , '' , true );
	wp_enqueue_script( 'lou-pjax' );

	// Typekit
	wp_register_script( 'lou-fonts' , ( '//use.typekit.net/qgi5unz.js' ) , array() , '' , true );
	wp_enqueue_script( 'lou-fonts' );

	// Site Scripts
	wp_register_script( 'lou-script' , ( get_template_directory_uri() . '/scripts/lou.js' ) , array( 'jquery' , 'lou-pjax' ) , '1.0.0' , true );
	wp_enqueue_script( 'lou-script' );
}

add_action( 'wp_enqueue_scripts', 'lou_scripts' );

/*
	Styles
*/

function lou_styles ( ) {
	wp_register_style( 'lou-style' , ( get_template_directory_uri() . '/css/lou.css' ) );
	wp_enqueue_style( 'lou-style' );
}

add_action( 'wp_enqueue_scripts' , 'lou_styles' );

/*
	Images
*/

add_theme_support( 'post-thumbnails' );

add_image_size( 'project-photo-retina' , 2800 , false , false );
add_image_size( 'project-photo' , 1400 , false , false );

add_image_size( 'project-thumbnail' , 500 , 500 , true );

/*
	Projects
*/

function lou_post_types ( ) {

	add_theme_support( 'post-thumbnails' );

	register_post_type( 'project' , array(
			'label' => 'projects',
			'labels' => array(
				'name' => 'Projects',
				'singular_name' => 'Project',
				'add_new' => 'Add New',
				'add_new_item' => 'Add Project',
				'edit_item' => 'Edit Project',
				'new_item' => 'New Project',
				'view_item' => 'View Project',
				'search_items' => 'Find Project',
				'not_found' => 'No Projects Found',
				'not_found_in_trash' => 'No Projects Found in Trash'
			),
			'description' => 'Collections of photos representing photoshoots or projects.',
			'public' => true,
			'menu_position' => 5,
			'supports' => array('title','editor','thumbnail','revisions','page-attributes'),
			'has_archive' => true
		)
	);

}

add_action( 'init' , 'lou_post_types' );


/*
	Photos (Project Fields)
*/

function get_photos ( $id ) {
	if ( $photos = get_transient( 'photos_' . $id ) ) {
		// Cool, got'em!
	} else {
		$photos = get_fields( $id );
		set_transient( 'photos_' . $id , $photos , 0 );
	}

	return $photos;
}

function scrub_photos ( $post_id ) {
	delete_transient( 'photos_' . $post_id );
	set_transient( 'photos_' . $post_id , get_photos( $post_id ) );
}

add_action( 'save_post' , 'scrub_photos' );


/*
	Home
*/

function get_home ( $id ) {
	if ( $home = get_transient( 'home' ) ) {
		// Cool, got'em!
	} else {
		$project_tiles = array();
		$projects = new WP_Query( array( 'post_type' => 'project' ) );

		foreach ( $projects->posts as $project ) {
			$tile = array(
				'post' => $project,
				'fields' => get_fields( $project->ID )
			);
			array_push( $project_tiles , $tile );
		}
		$home = array(
			'fields' => get_fields( $id ),
			'projects' => $project_tiles
		);
		set_transient( 'home' , $home , 0 );
	}
	return $home;
}

function scrub_home ( $post_id ) {
	delete_transient( 'home' );
	set_transient( 'home', get_home( get_option('page_on_front') ) , 0 );
}

add_action( 'save_post' , 'scrub_home' );


/*
	Menus
*/

register_nav_menus( array(
	'primary' => 'Primary',
	'footer' => 'Footer Links',
	'social' => 'Social links'
));


/*
	Miscellaneous
*/

function clog ( $var ) {
	echo '<script>console.log(' . json_encode( $var ) . ');</script>';
}

function plog ( $var ) {
	echo '<pre>';
	print_r( $var );
	echo '</pre>';
}