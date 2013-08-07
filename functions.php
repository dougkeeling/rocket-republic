<?php

// Remove width & height from images in posts, and wrapping length.
// -------------------------------------------------------------------

  add_filter( 'post_thumbnail_html', 'remove_width_attribute', 10 );
  add_filter( 'image_send_to_editor', 'remove_width_attribute', 10 );

  function remove_width_attribute( $html ) {
     $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
     return $html;
  }

  update_option('image_default_link_type', 'none');

// Enqueue jQuery
// --------------------------------------------------
  wp_enqueue_script('jquery');

// Register Sidebars 
// --------------------------------------------------

	if ( function_exists('register_sidebar')) {
		register_sidebar(
			array(
				'name' => 'Sidebar',
				'before_widget' => '<div class="widget">',
				'after_widget' => '</div>',
				'before_title' => '<h3>',
				'after_title' => '</h3>'
			)
		);
	}



// Register Menus 
// --------------------------------------------------
	
	add_theme_support('nav_menus');
	function register_theme_menus() {
	  register_nav_menus(
			array( 
				'primary' => 'Header',
				'secondary' => 'Footer',
		  )
	  );
	}
	add_action( 'init', 'register_theme_menus' );


// Add Post Format Support 
// --------------------------------------------------

	add_theme_support( 'post-formats', array( 'audio', 'video' ) );


// Add Thumbnail Support 
// --------------------------------------------------
	
	add_theme_support( 'post-thumbnails', array( 'post', 'page' ) );

	if ( function_exists( 'add_image_size' ) ) { 
		//add_image_size( 'featured-image-thumbnail', 440, 280, true );
	}


// Modify excerpt length & ellipsis 
// --------------------------------------------------
  function custom_excerpt_length( $length ) {
    return 20;  // 20 words 
  }
  add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

  function new_excerpt_more( $more ) {
    return '...';
  }
  add_filter('excerpt_more', 'new_excerpt_more');


// Add Template Shortcodes for Pages/Posts 
// --------------------------------------------------
	
	function fetch_template_url() {
		return get_bloginfo('template_directory');
	}

	function fetch_site_url() {
		return get_bloginfo('url');
	}

	add_shortcode('template-url', 'fetch_template_url');
	add_shortcode('site-url', 'fetch_site_url');

// Output the template name at the top of the page
// --------------------------------------------------

  add_action('wp_head', 'show_template'); 
 
  function show_template() {  
    global $template;
    $templateName = substr( $template, strrpos( $template, '/' )+1 );

    echo "<div style='
      position: relative;
      width: 100%;
      background: rgba(0,0,0,0.5); 
      padding: 10px 0; 
      font-family: Arial, Helvetica, sans-serif; 
      font-size:14px; 
      font-weight:bold; 
      font-style: italic;
      text-align: center;
      color: #FFF;
      z-index: 100;
      '>Template: ";
    print_r($templateName);
    echo "</div>";
  }




// Add "http://" to links that are missing them
// --------------------------------------------------

  function addhttp($url) {
    if($url != "#") {
      if(filter_var($url, FILTER_VALIDATE_EMAIL)) {
        // If valid address, add "mailto:"
        $url = 'mailto:'.$url;
      } else {
        // If url without "http://", add it
        if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
            $url = "http://" . $url;
        }
      }
    }
    return $url;
  }

 

// Custom WordPress Dashboard Footer, and Support Widget
// ---------------------------------------------------------------------------------

  // Custom WordPress Footer
  function remove_footer_admin () {
    echo 'Theme by <a href="http://rocketrepublic.com">Rocket Republic</a>.';
  }
  add_filter('admin_footer_text', 'remove_footer_admin');


  // Add a widget in WordPress Dashboard
  function rocket_dashboard_widget_function() {
    // Entering the text between the quotes
    echo "<iframe src='http://rocketrepublic.info/rocket-info/main.html'></iframe>";
  }
  function rocket_add_dashboard_widgets() {
    //wp_add_dashboard_widget('wp_dashboard_widget', 'Support Info', 'rocket_dashboard_widget_function');
    add_meta_box('rocket_dashboard_widget', 'Rocket Republic', 'rocket_dashboard_widget_function', 'dashboard', 'side', 'high');
  }
  add_action('wp_dashboard_setup', 'rocket_add_dashboard_widgets' );


/*// Add Custom Post Types
// --------------------------------------------------

add_action( 'init', 'custom_post_types' );

function custom_post_types() {
  
  // Photo Gallery 
  // --------------------------------------------------

  $labels = array(
    'name' => 'Photos',
    'singular_name' => 'Photo',
    'add_new' => 'Add New Gallery',
    'add_new_item' => 'Add New Photo Gallery',
    'edit_item' => 'Edit Photo Gallery',
    'new_item' => 'New Photo Gallery',
    'all_items' => 'All Galleries',
    'view_item' => 'View this gallery',
    'search_items' => 'Search Photos',
    'not_found' =>  'No photos',
    'not_found_in_trash' => 'No photos in Trash',
    'parent_item_colon' => '',
    'menu_name' => 'Galleries',

  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'exclude_from_search' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'query_var' => true,
    'capability_type' => 'page',
    'rewrite' => array('slug' => 'galleries', 'with_front' => false),
    'hierarchical' => false,
    'menu_position' => null,
    'supports' => array('title'),
  );
  register_post_type('photo_gallery',$args);
  flush_rewrite_rules();

}*/   

?>