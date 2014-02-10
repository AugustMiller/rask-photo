<?
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_about',
		'title' => 'About',
		'fields' => array (
			array (
				'key' => 'field_52ecacaed83bb',
				'label' => 'Profile Image',
				'name' => 'profile_image',
				'type' => 'image',
				'instructions' => 'Preferably, something wide, to be used for the strip at the top of the page.',
				'save_format' => 'object',
				'preview_size' => 'medium',
				'library' => 'all',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'about.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_homepage',
		'title' => 'Homepage',
		'fields' => array (
			array (
				'key' => 'field_52eb665df8453',
				'label' => 'Featured Projects',
				'name' => 'featured_projects',
				'type' => 'repeater',
				'instructions' => 'Select an image and a project to link to from the slideshow on the homepage.',
				'sub_fields' => array (
					array (
						'key' => 'field_52eb666af8454',
						'label' => 'Image',
						'name' => 'image',
						'type' => 'image',
						'column_width' => '',
						'save_format' => 'object',
						'preview_size' => 'thumbnail',
						'library' => 'all',
					),
					array (
						'key' => 'field_52eb667af8455',
						'label' => 'Project',
						'name' => 'project',
						'type' => 'relationship',
						'column_width' => '',
						'return_format' => 'object',
						'post_type' => array (
							0 => 'project',
						),
						'taxonomy' => array (
							0 => 'all',
						),
						'filters' => array (
							0 => 'search',
						),
						'result_elements' => array (
							0 => 'post_title',
						),
						'max' => 1,
					),
				),
				'row_min' => '',
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add Featured Item',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'home.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_project',
		'title' => 'Project',
		'fields' => array (
			array (
				'key' => 'field_52e88ac7f1388',
				'label' => 'Intro Text',
				'name' => 'intro',
				'type' => 'textarea',
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'formatting' => 'br',
			),
			array (
				'key' => 'field_52e88cd6eaba7',
				'label' => 'Story',
				'name' => 'story',
				'type' => 'wysiwyg',
				'instructions' => 'If there is an accompanying story for the images, tell it here!',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
			array (
				'key' => 'field_52e74c499bd5a',
				'label' => 'Hero Images',
				'name' => 'hero_images',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_52e74c589bd5b',
						'label' => 'Image',
						'name' => 'image',
						'type' => 'image',
						'column_width' => '',
						'save_format' => 'object',
						'preview_size' => 'medium',
						'library' => 'all',
					),
					array (
						'key' => 'field_52e74c6c9bd5c',
						'label' => 'Description',
						'name' => 'description',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'none',
						'maxlength' => '',
					),
				),
				'row_min' => '',
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add Image',
			),
			array (
				'key' => 'field_52e74c9a9bd5d',
				'label' => 'Main Column Images',
				'name' => 'main_images',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_52e74c9a9bd5e',
						'label' => 'Image',
						'name' => 'image',
						'type' => 'image',
						'column_width' => '',
						'save_format' => 'object',
						'preview_size' => 'medium',
						'library' => 'all',
					),
					array (
						'key' => 'field_52e74c9a9bd5f',
						'label' => 'Description',
						'name' => 'description',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'none',
						'maxlength' => '',
					),
				),
				'row_min' => '',
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add Image',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'project',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
				0 => 'permalink',
				1 => 'the_content',
				2 => 'excerpt',
				3 => 'custom_fields',
				4 => 'discussion',
				5 => 'comments',
				6 => 'revisions',
				7 => 'author',
				8 => 'format',
				9 => 'send-trackbacks',
			),
		),
		'menu_order' => 0,
	));
}
