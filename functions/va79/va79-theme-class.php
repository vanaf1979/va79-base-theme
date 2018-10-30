<?php

defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

class Theme
{

	protected $theme_name;

	protected $version;

	protected $actions;

	protected $filters;


	public function __construct()
	{
		$this->theme_name = 'va79-base-theme';
		$this->version = '1.0.0';

		$this->actions = array();
		$this->filters = array();

		$this->load_dependencies();
		$this->define_theme_frontend_hooks();
		$this->define_theme_admin_hooks();
		$this->define_theme_shortcode_hooks();
		$this->define_theme_utils_hooks();
		$this->run_actions();
	}


	private function load_dependencies()
	{
		require_once get_template_directory() . '/functions/va79/va79-theme-class-utils.php';
	}


	/*
	** FRONTEND METHODS
	*/


	private function define_theme_frontend_hooks()
	{
		if( ! is_admin() )
		{
			/** Remove all unnecessary junk from header **/
			$this->add_action( 'wp_print_scripts' , $this , 'disable_emoji_dequeue_script' , 100 );
			$this->add_action( 'init' , $this , 'clean_up_header' );
			$this->add_action( 'the_generator' , $this , 'remove_wp_version' );

			/** Remove the rest api **/
			$this->add_action( 'after_setup_theme' , $this , 'remove_json_api_from_head' );
			$this->add_action( 'after_setup_theme' , $this , 'disable_json_api' );

			/** Add styles and scripts. **/
			$this->add_action( 'wp_enqueue_scripts' , $this , 'define_theme_styles' );
			$this->add_action( 'wp_enqueue_scripts' , $this , 'define_theme_scripts' );

			/** Add async and defer to our app js script. **/
			$this->add_action( 'script_loader_tag' , $this , 'optimize_script_tags' , 10 , 4 );
			
			$this->add_action( 'wp_head' , $this , 'add_manifest_tags_to_head' , 1 , 1 );

			/** Add custom thumbnail sizes. **/
			$this->add_action( 'setup_theme' , $this , 'register_thumbnail_sizes' , 1 );

			/** Add theme support for Title, Html5 and Menus **/
			$this->add_action( 'after_setup_theme' , $this , 'theme_support' , 1 , 1 );
			/** Alter the default titles **/
			$this->add_action( 'pre_get_document_title' , $this , 'handle_custom_title_in_header' , 10 );

			/** Remove unnecessary junk from footer. **/
			$this->add_action( 'wp_footer' , $this , 'remove_wpembed_scripts' );
		}
	}


	public function define_theme_styles()
	{
		/** Enqueue header css file. **/
		wp_enqueue_style( $this->theme_name  . '-css', get_stylesheet_directory_uri() . '/public/css/header.css', array() , $this->version , 'screen' );

		/** Enqueue header IE 9 css file. **/
		wp_enqueue_style( $this->theme_name . '-ie9' , get_stylesheet_directory_uri() . '/public/css/header-ie9.css', array() , $this->version , 'screen' );
		wp_style_add_data( $this->theme_name . '-ie9' , 'conditional' , 'IE 9' );

		/** Enqueue header lt IE 9 css file. **/
		wp_enqueue_style( $this->theme_name . '-lt-ie8' , get_stylesheet_directory_uri() . '/public/css/header-ie8.css', array() , $this->version , 'screen' );
		wp_style_add_data( $this->theme_name . '-lt-ie8' , 'conditional' , 'lt IE 9' );
	}


	public function define_theme_scripts()
	{
		/** Enqueue the bundled app js to the footer. **/
		wp_enqueue_script( $this->theme_name . '-js' , get_stylesheet_directory_uri() . '/public/js/app.js' , array() , $this->version , true );

		/** Enqueue a conditional html 5 ie fix. **/
		wp_enqueue_script( $this->theme_name . '-html5' , 'https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js' , array() , $this->version , true );
    	wp_script_add_data( $this->theme_name . '-html5'  , 'conditional' , 'lt IE 9' );
	}


	public function optimize_style_tags( $html , $handle , $href , $media )
	{
		/** Remove type from all stylesheets. **/
		return "<link rel='stylesheet' id='{$handle}' href='{$href}' media='{$media}' />\n";
	}


	public function optimize_script_tags( $tag , $handle , $src )
	{
		/** Add async defer to theme scripts, and remove type from all scripts. **/
		$async = ( strpos( $handle , $this->theme_name ) !== false ) ? 'async defer src' : 'src';
		return str_replace( array( "type='text/javascript'" , "src" , "  " ) , array( '' , $async , " " ) , $tag );
	}


	public function add_manifest_tags_to_head()
	{
		echo '<link rel="manifest" href="/app/themes/vanaf1979/public/manifest.json">' . "\n";
	}


	public function register_thumbnail_sizes()
	{
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'theme-resposive-img', 600, 9999, true );
	}


	public function theme_support()
	{
		add_theme_support( 'title-tag' );
		add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
		add_theme_support( 'menus' );
	}


	public function handle_custom_title_in_header()
	{
		if( ! is_admin() )
		{
			global $post;
			return esc_attr( apply_filters( 'the_title', $post->post_title ) . ' | ' . get_option( 'blogname' ) );
		}
	}


	public function disable_emoji_dequeue_script()
	{
	    wp_dequeue_script( 'emoji' );
	}


	public function clean_up_header()
	{
		remove_action( 'wp_head' , 'rsd_link' );
		remove_action( 'wp_head' , 'wp_generator' );
		remove_action( 'wp_head' , 'feed_links' , 2 );
		remove_action( 'wp_head' , 'feed_links_extra' , 3 );
		remove_action( 'wp_head' , 'index_rel_link' );
		remove_action( 'wp_head' , 'wlwmanifest_link' );
		remove_action( 'wp_head' , 'start_post_rel_link' , 10 , 0 );
		remove_action( 'wp_head' , 'parent_post_rel_link' , 10 , 0 );
		remove_action( 'wp_head' , 'adjacent_posts_rel_link' , 10 , 0 );
		remove_action( 'wp_head' , 'adjacent_posts_rel_link_wp_head' , 10 , 0 );
		remove_action( 'wp_head' , 'wp_shortlink_wp_head' , 10 , 0 );
		remove_action( 'wp_head' , 'print_emoji_detection_script' , 7 );
		remove_action( 'wp_head' , 'wp_resource_hints' , 2 );
		remove_action( 'wp_head' , 'rel_canonical' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
	}


	public function remove_json_api_from_head()
	{
		remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
		remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
		remove_action( 'rest_api_init', 'wp_oembed_register_route' );
		remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );
		remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
		remove_action( 'wp_head', 'wp_oembed_add_host_js' );
		add_filter( 'embed_oembed_discover', '__return_false' );
		add_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );
	}


	public function disable_json_api()
	{
		/** Filters for WP-API version 1.x **/
		// add_filter('json_enabled', '__return_false');
		// add_filter('json_jsonp_enabled', '__return_false');
		/** Filters for WP-API version 2.x **/
		add_filter('rest_enabled', '__return_false');
		add_filter('rest_jsonp_enabled', '__return_false');
	}


	public function remove_wpembed_scripts()
	{
		wp_deregister_script( 'wp-embed' );
	}


	public function remove_wp_version()
	{
		return '';
	}


	/*
	** ADMIN AEWA METHODS
	*/


  	private function define_theme_admin_hooks()
	{
		if( is_admin() )
		{
			/** Unhide the kitchensink from the editor. **/
			$this->add_action( 'tiny_mce_before_init' , $this , 'unhide_kitchensink' );

			/** Control the dashboard widgets. **/
			$this->add_action( 'wp_dashboard_setup' , $this , 'register_dashboard_widgets' );

			/** Set the number of revisions to keep. **/
			$this->add_action( 'init' , $this , 'set_revision_count' );

			/** Remove admin sections for non admins. **/
			$this->add_action( 'admin_menu' , $this , 'remove_menus_non_admins' );

			/** Change the admin footer tekst. **/
			$this->add_action( 'admin_footer_text' , $this , 'custom_footer_admin' );
		}

		/** Register navigation menus. **/
		$this->add_action( 'init' , $this , 'register_nav_menus' );

		/** Register widgert areas. **/
		$this->add_action( 'widgets_init' , $this , 'register_widget_areas' );

		/** Register a custom posttype. **/
		$this->add_action( 'init' , $this , 'register_custom_posttype' );

		/** Hide notifications from non super admins. **/
		$this->add_action( 'admin_notices' , $this , 'hide_update_notice' , 1 );
	}


	public function register_nav_menus()
	{
		register_nav_menus(
			array(
				'header-menu' => __( 'Header Menu' ),
				'footer-menu' => __( 'Footer Menu' ),
				'social-menu' => __( 'Social Menu' ),
				'mobile-menu' => __( 'Mobile Menu' )
			)
		);
	}


	function register_widget_areas()
	{
		register_sidebar( array(
			'name'          => 'Footer area one',
			'id'            => 'footer_area_one',
			'before_widget' => '<div>',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="footer-area-one">',
			'after_title'   => '</h4>',
		) );

		register_sidebar( array(
			'name'          => 'Footer area two',
			'id'            => 'footer_area_two',
			'before_widget' => '<div>',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="footer-area-two">',
			'after_title'   => '</h4>',
		) );

		register_sidebar( array(
			'name'          => 'Footer area three',
			'id'            => 'footer_area_three',
			'before_widget' => '<div>',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="footer-area-three">',
			'after_title'   => '</h4>',
		) );

		register_sidebar( array(
			'name'          => 'Footer area four',
			'id'            => 'footer_area_four',
			'before_widget' => '<div>',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="footer-area-four">',
			'after_title'   => '</h4>',
		) );
	}


	public function register_custom_posttype()
	{
		// NOTE: Read the codex on register_post_type
		// https://codex.wordpress.org/Function_Reference/register_post_type

		// NOTE: Custom post types now support custum templates with the below snippet
		/*
		Template Name: Full-width layout
		Template Post Type: post, page, product
		*/

		// $args = array(
		// 	'label' => __('Portfolio'),
		// 	'singular_label' => __('Project'),
		// 	'public' => true,
		// 	'show_ui' => true,
		// 	'capability_type' => 'post',
		// 	'hierarchical' => false,
		// 	'rewrite' => array('slug' => 'POST-TYPE-SLUG-HERE'),
		// 	'supports' => array('title', 'editor', 'thumbnail')
		// );
		//
		// register_post_type( 'custom-post-type' , $args );
	}


	public function hide_update_notice()
	{
		if( is_user_logged_in() )
		{
			$current_user = wp_get_current_user();
			if( $current_user->ID != 1 )
			{
				remove_action( 'admin_notices', 'update_nag', 3 );
			}
		}
	}


	public function remove_menus_non_admins()
	{
		$current_user = wp_get_current_user();
		if( is_user_logged_in() and $current_user->ID != 1 )
		{
		  // remove_menu_page( 'index.php' );
		  // remove_menu_page( 'edit.php' );
		  // remove_menu_page( 'upload.php' );
		  // remove_menu_page( 'edit.php?post_type=page' );
		  remove_menu_page( 'edit-comments.php' );
		  // remove_menu_page( 'themes.php' );
		  remove_menu_page( 'plugins.php' );
		  remove_menu_page( 'users.php' );
		  remove_menu_page( 'tools.php' );
		  remove_menu_page( 'options-general.php' );
		}
	}


	public function unhide_kitchensink( $args )
	{
		$args['wordpress_adv_hidden'] = false;
		return $args;
	}


	public function register_dashboard_widgets()
	{
		global $wp_meta_boxes;

		/** Remove the standard dashboard widgets. **/
		global $wp_meta_boxes;
		$wp_meta_boxes['dashboard']['normal']['core'] = array();
		$wp_meta_boxes['dashboard']['side']['core'] = array();

		/** Add custom dashboard widgets. **/
		wp_add_dashboard_widget('custom_dashboard_widget', 'Custom dashboard widget', array( $this , 'custom_dashboard_widget' ) , 'dashboard', 'side', 'high');
	}


	public function custom_dashboard_widget()
	{
		echo '<h3>Custom dashboard widget</h3>';
		echo '<p>Custom dashboard widget content</p>';
	}


	public function set_revision_count()
	{
		if ( ! defined('WP_POST_REVISIONS') )
		{
			define( 'WP_POST_REVISIONS' , 5 );
		}
	}


	public function custom_footer_admin ()
	{
	  echo 'Powerd by <a href="http://www.wordpress.org" target="_blank">WordPress</a></p>';
	}


	/*
	** SHORTCODE METHODS
	*/


	private function define_theme_shortcode_hooks( )
	{
		/** Register all custom shortcodes. **/
		$this->add_action( 'init' , $this , 'register_theme_shortcodes' );
	}


	public function register_theme_shortcodes( )
	{
		add_shortcode( 'scname' , array(  $this , 'handle_scname_tag') );
	}


	public function handle_scname_tag( $atts , $content = null )
	{
		$a = shortcode_atts( array(
			'class' => 'classname'
		), $atts );

		return "<scname class=\"{a['class']}\">{$content}</scname>";
	}


	/*
	** REGISTER THEME UTILITY CLASS
	*/


	private function define_theme_utils_hooks()
	{
		if( ! is_admin() )
		{
			/** Register the theme utils class. **/
			$this->add_action( 'wp' , $this , 'register_theme_utils_class' );
		}
	}


	public function register_theme_utils_class()
	{
		global $theme;
		$theme = new Theme_Utils();
		set_query_var( 'theme' , $theme );
	}


	/*
	** HELPER FUNTIONS
	*/


	private function get_theme_name()
	{
		return $this->theme_name;
	}


	private function get_theme_version()
	{
		return $this->version;
	}


	private function add_action( $hook , $component , $callback , $priority = 10 , $accepted_args = 1 )
	{
		$this->actions = $this->add( $this->actions , $hook , $component , $callback , $priority , $accepted_args );
	}


	private function add_filter( $hook , $component , $callback , $priority = 10 , $accepted_args = 1 )
	{
		$this->filters = $this->add( $this->filters , $hook , $component , $callback , $priority , $accepted_args );
	}


	private function add( $hooks , $hook , $component , $callback , $priority , $accepted_args )
	{
		$hooks[] = array(
			'hook'          => $hook,
			'component'     => $component,
			'callback'      => $callback,
			'priority'      => $priority,
			'accepted_args' => $accepted_args
		);

		return $hooks;
	}


	private function run_actions()
	{
		foreach ( $this->filters as $hook )
		{
			add_filter( $hook['hook'] , array( $hook['component'] , $hook['callback'] ) , $hook['priority'] , $hook['accepted_args'] );
		}

		foreach ( $this->actions as $hook )
		{
			add_action( $hook['hook'] , array( $hook['component'] , $hook['callback'] ) , $hook['priority'] , $hook['accepted_args'] );
		}

	}

}
