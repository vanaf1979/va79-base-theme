<?php

require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );

function my_theme_register_required_plugins() {
	
	$plugins = array(

		/* Advanced Custom Fields. */
		array(
			'name'     => 'Advanced Custom Fields',
			'slug'     => 'advanced-custom-fields',
			'required' => true,
		),

		/* Advanced Custom Fields: Repeater Field. */
		array(
			'name'     => 'Advanced Custom Fields: Repeater Field',
			'slug'     => 'acf-repeater',
			'required' => true,
		),

		/* Advanced Custom Fields: Flexible Content Field. */
		array(
			'name'     => 'Advanced Custom Fields: Flexible Content Field',
			'slug'     => 'acf-flexible-content',
			'required' => true,
		),

		/* Advanced Custom Fields: Gallery Field. */
		array(
			'name'     => 'Advanced Custom Fields: Gallery Field',
			'slug'     => 'acf-gallery',
			'required' => true,
		),

		/* CMS Tree Page View. */
		array(
			'name'     => 'CMS Tree Page View',
			'slug'     => 'cms-tree-page-view',
			'required' => true,
		),

		/* Cache Enabler. */
		array(
			'name'     => 'Cache Enabler',
			'slug'     => 'cache-enabler',
			'required' => true,
		),

		/* reSmush.it Image Optimizer. */
		array(
			'name'     => 'reSmush.it Image Optimizer',
			'slug'     => 'resmushit-image-optimizer',
			'required' => true,
		),

	);


	$config = array(
		'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);


	tgmpa( $plugins, $config );

}
