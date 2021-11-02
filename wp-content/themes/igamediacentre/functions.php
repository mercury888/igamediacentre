<?php
/**
 * TIM SALVADOR THEME functions and definitions
 */

include ('svg-icons.php');

if ( version_compare( $GLOBALS['wp_version'], '5.2.4', '<' ) ) {
    require get_template_directory() . '/inc/back-compat.php';
    return;
}

/**
 * Fire on the initialization of WordPress.
 */
function wp_mobile_detection_function() {
	/** to detect mobile*/
	function my_wp_is_mobile() {
			if( wp_is_mobile() ){
			static $is_mobile;
			if ( isset($is_mobile) )
				return $is_mobile;
			if ( empty($_SERVER['HTTP_USER_AGENT']) ) {
				$is_mobile = false;
			} elseif (
				strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== false
				|| strpos($_SERVER['HTTP_USER_AGENT'], 'Silk/') !== false
				|| strpos($_SERVER['HTTP_USER_AGENT'], 'Kindle') !== false
				|| strpos($_SERVER['HTTP_USER_AGENT'], 'BlackBerry') !== false
				|| strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== false ) {
					$is_mobile = true;
			} elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') !== false && strpos($_SERVER['HTTP_USER_AGENT'], 'iPad') == false) {
					$is_mobile = true;
			} elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'iPad') !== false) {
				$is_mobile = false;
			} else {
				if (preg_match('~MSIE|Internet Explorer~i', $_SERVER['HTTP_USER_AGENT']) || (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/7.0; rv:11.0') !== false)) {
				$is_mobile = 'ie11';
			} else {
				$is_mobile = false;
			}
			}
			return $is_mobile;
		}
	}
}
add_action( 'init', 'wp_mobile_detection_function' );

function wp_IE_detection_function(){
	function my_wp_is_IE() {
		if( wp_is_mobile() ){
		} else {
			static $is_IE;
			if ( isset($is_IE) )
				return $is_IE;
			if ( empty($_SERVER['HTTP_USER_AGENT']) ) {
				$is_IE = false;
			} elseif (
				strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== false
				|| strpos($_SERVER['HTTP_USER_AGENT'], 'Silk/') !== false
				|| strpos($_SERVER['HTTP_USER_AGENT'], 'Kindle') !== false
				|| strpos($_SERVER['HTTP_USER_AGENT'], 'BlackBerry') !== false
				|| strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== false ) {
					$is_IE = false;
			} elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') !== false && strpos($_SERVER['HTTP_USER_AGENT'], 'iPad') == false) {
					$is_IE = false;
			} elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'iPad') !== false) {
				$is_IE = false;
			} else {
				if (preg_match('~MSIE|Internet Explorer~i', $_SERVER['HTTP_USER_AGENT']) || (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/7.0; rv:11.0') !== false)) {
				$is_IE = 'ie11';
			} else {
				$is_IE = false;
			}
			}
			return $is_IE;
		}
	}
}
add_action( 'init', 'wp_IE_detection_function' );


/** wp image function */
function wp_image($imgID = '', $size = 'large', $classes = '' ){
	ob_start();
	$webPUrl = wp_get_attachment_image_url( $imgID, $size ) . '.webp';
	$uploadedfile=parse_url($webPUrl);
	$fileUrl =  $_SERVER['DOCUMENT_ROOT'] . $uploadedfile['path'];
    $path_info = pathinfo( wp_get_attachment_image_url( $imgID, $size ) );
    $imageExt = $path_info['extension'];
	echo '<picture class="cell-12 h-100 ">' .
        (
            file_exists($fileUrl)
            ? (
                $size == 'full'
                ? '<source type="image/webp" media="(min-width:320px)" srcset="'. wp_get_attachment_image_url( $imgID, $size ) . '.webp">'
                : ''
            ) .
            '<source type="image/webp" media="(min-width:320px)" srcset="'. wp_get_attachment_image_url( $imgID, 'full' ) . '.webp">'
            : ''
        ) .
        (
            $size == 'full'
            ? '<source type="image/' . $imageExt . '" media="(min-width:320x)" srcset="'. wp_get_attachment_image_url( $imgID, $size ) . '">'
            : ''
        ) .
        (
            $size == 'large'
            ? '<source type="image/' . $imageExt . '" media="(min-width:320px)" srcset="'. wp_get_attachment_image_url( $imgID, 'full' ) . '">'
            : ''
        ) .
        (
            $size == 'medium_large'
            ? '<source type="image/' . $imageExt . '" media="(min-width:640px)" srcset="'. wp_get_attachment_image_url( $imgID, 'medium_large' ) . '">' .
            '<source type="image/' . $imageExt . '" media="(min-width:320px)" srcset="'. wp_get_attachment_image_url( $imgID, 'full' ) . '">'
            : ''
        ) .
        '<source type="image/' . $imageExt . '" media="(min-width:650px)" srcset="'. wp_get_attachment_image_url( $imgID, $size ) . '">' .
        wp_get_attachment_image( $imgID, $size, '', array( "class" => "attachment-$size size-$size $classes" ) ) .
    '</picture>';

	return ob_get_clean();
}

/** wp icon function **/
function wp_icon( $wp_icon, $classes="" ){
	ob_start();
        $context = stream_context_create(
            array(
                "http" => array(
                    "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
                )
            )
        );
        $wp_iconSVG = file_get_contents( $wp_icon , false, $context);
        echo $wp_iconSVG;
	return ob_get_clean();
}

if ( ! function_exists( 'igamediacentre_setup' ) ) :

	function igamediacentre_setup() {

		load_theme_textdomain( 'igamediacentre', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1568, 9999 );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				 'main-navigation' => __( 'Primary', 'igamediacentre' ),
			)
		);

    	/* Footer logo*/
		function footer_logo($wp_customize) {
		    // add a setting
		    $wp_customize->add_setting('footer_logo');
		    // Add a control to upload the hover logo
		    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'footer_logo', array(
		        'label' => 'Footer Logo',
		        'section' => 'title_tagline', //this is the section where the custom-logo from WordPress is
		        'settings' => 'footer_logo',
		        'priority' => 9 // show it just below the custom-logo
		    )));
		}
		add_action('customize_register', 'footer_logo');

		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'script',
				'style',
				'navigation-widgets',
			)
		);

		add_theme_support(
			'custom-logo',
			array(
				'flex-width'  => false,
        'flex-height' => false,
			)
		);

		add_theme_support( 'customize-selective-refresh-widgets' );
		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'align-wide' );
		add_theme_support( 'editor-styles' );
		add_editor_style( 'style-editor.css' );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'custom-line-height' );
	}
endif;
add_action( 'after_setup_theme', 'igamediacentre_setup' );


// Widgets
function igamediacentre_widgets_init() {
  register_sidebar( array(
        'name' => __( 'Posts Widget Area', 'igamediacentre' ),
        'id' => 'posts_widgets',
        'description' => __('Appears in the Blog Page of the site.', ' '),
        'before_widget' => '<li id="%1$s" class="widget %2$s pb-0 bg-white">',
        'after_widget' => '</li>',
        'before_title' => '<h2 class="widgettitle text-24 text-white px-15 py-10 mb-0">',
        'after_title' => '</h2>',
    ) );

	register_sidebar(
		array(
			'name'          => __( 'Footer About Menu', 'igamediacentre' ),
			'id'            => 'footer-about-menu',
			'description'   => __( 'Appears in the footer of the site.', 'igamediacentre' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widget-title text-white mb-10">',
			'after_title'   => '</h4>',
		)
	);

  register_sidebar(
		array(
			'name'          => __( 'Footer IGA Menu', 'igamediacentre' ),
			'id'            => 'footer-iga-menu',
			'description'   => __( 'Appears in the footer of the site.', 'igamediacentre' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widget-title text-white mb-10">',
			'after_title'   => '</h4>',
		)
	);
}
add_action( 'widgets_init', 'igamediacentre_widgets_init' );


function igamediacentre_excerpt_more( $link ) {
	if ( is_admin() ) {
		return $link;
	}

	$link = sprintf(
		'<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Post title. */
		sprintf( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'igamediacentre' ), get_the_title( get_the_ID() ) )
	);
	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'igamediacentre_excerpt_more' );


function igamediacentre_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'igamediacentre_content_width', 640 );
}
add_action( 'after_setup_theme', 'igamediacentre_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function igamediacentre_scripts() {
	if( is_front_page() ) {
			 wp_enqueue_style( 'igamediacentre-style', get_template_directory_uri() . '/assets/css/style.css' , array(), wp_get_theme()->get( 'Version' ) );
	 } else {
			 wp_enqueue_style( 'igamediacentre-style', get_template_directory_uri() . '/assets/css/inner-styles.css' , array(), wp_get_theme()->get( 'Version' ) );
	 }

	wp_enqueue_style( 'igamediacentre-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );

	wp_style_add_data( 'igamediacentre-style', 'rtl', 'replace' );

	if ( has_nav_menu( 'menu-1' ) ) {
		wp_enqueue_script( 'igamediacentre-priority-menu', get_theme_file_uri( '/js/priority-menu.js' ), array(), '20181214', true );
		wp_enqueue_script( 'igamediacentre-touch-navigation', get_theme_file_uri( '/js/touch-keyboard-navigation.js' ), array(), '20181231', true );
	}

	wp_enqueue_style( 'igamediacentre-print-style', get_template_directory_uri() . '/print.css', array(), wp_get_theme()->get( 'Version' ), 'print' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	wp_enqueue_style( 'all-default', get_theme_file_uri() . '/assets/css/all-default.css' );

}
add_action( 'wp_enqueue_scripts', 'igamediacentre_scripts' );


function site_script() {
	global $wp_query;

  wp_enqueue_script('jquery');
  wp_script_add_data( 'jquery', 'rtl', 'replace' );
  wp_enqueue_script( 'slick-script', get_theme_file_uri() . '/js/slick.min.js', array(), wp_get_theme()->get( 'Version' ) , true );
  wp_enqueue_script( 'general-script', get_theme_file_uri() . '/js/general.js', array(), wp_get_theme()->get( 'Version' ) , true );
  wp_enqueue_script( 'counter-script', get_theme_file_uri() . '/js/jquery.counterup.min.js', array(), wp_get_theme()->get( 'Version' ) , true );
  wp_enqueue_script( 'waypoint-script', get_theme_file_uri() . '/js/jquery.waypoints.js', array(), wp_get_theme()->get( 'Version' ) , true );
	wp_enqueue_script( 'fancybox-script', get_theme_file_uri() . '/js/jquery.fancybox.min.js', array(), wp_get_theme()->get( 'Version' ) , true );
	wp_localize_script( 'general-script', 'my_ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

}
add_action( 'wp_enqueue_scripts', 'site_script' );

/**
 * SVG Icons class.
 */
require get_template_directory() . '/classes/class-igamediacentre-svg-icons.php';

/**
 * Custom Comment Walker template.
 */
require get_template_directory() . '/classes/class-igamediacentre-walker-comment.php';

/**
 * Common theme functions.
 */
require get_template_directory() . '/inc/helper-functions.php';

/**
 * SVG Icons related functions.
 */
require get_template_directory() . '/inc/icon-functions.php';

/**
 * Enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Custom template tags for the theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Block Patterns.
 */
require get_template_directory() . '/inc/block-patterns.php';



/* ACF Options page Multiple choices */
if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'page_title' 	=> 'Theme General Options',
        'menu_title'	=> 'Theme options',
        'menu_slug' 	=> 'theme-general-options',
    ));
    acf_add_options_sub_page(array(
        'page_title' 	=> 'Theme Header Options',
        'menu_title'	=> 'Header',
        'parent_slug'	=> 'theme-general-options',
    ));
    acf_add_options_sub_page(array(
        'page_title' 	=> 'Theme Social Options',
        'menu_title'	=> 'Social',
        'parent_slug'	=> 'theme-general-options',
    ));
    acf_add_options_sub_page(array(
        'page_title' 	=> 'Theme 404 Options',
        'menu_title'	=> '404',
        'parent_slug'	=> 'theme-general-options',
    ));
	acf_add_options_sub_page(array(
        'page_title' 	=> 'Theme Common Options',
        'menu_title'	=> 'Common',
        'parent_slug'	=> 'theme-general-options',
    ));
}

/* section wise css */
add_action( 'init', 'action__init' );
function action__init() {
    wp_register_script( 'isotop-lib', get_stylesheet_directory_uri() . '/js/isotope.pkgd.min.js', array( 'jquery' ), 'init' );
    wp_register_script( 'isotop-function', get_stylesheet_directory_uri() . '/js/isotop-function.js', array( 'isotop-lib' ), 'init' );




}

/** svg file upload permission */
function cc_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');


/** Admin Logo */
function my_login_logo() { ?>
<style type="text/css">
    #login h1 a, .login h1 a {
        background-image: url(https://s3.ap-southeast-2.amazonaws.com/igamediacentre.metcdn.com/wp-content/uploads/2021/10/20032818/admin-logo.png);
        height:100px;
        width:100%;
        background-size: contain;
        background-repeat: no-repeat;
    }
</style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );
add_filter( 'login_headerurl', 'custom_loginlogo_url' );
function custom_loginlogo_url($url) {
    return site_url();
}


/** stop autoupdate wp-scss plugin  */
function my_filter_plugin_updates( $value ) {
   if( isset( $value->response['WP-SCSS-1.2.4/wp-scss.php'] ) ) {
      unset( $value->response['WP-SCSS-1.2.4/wp-scss.php'] );
    }
    return $value;
 }
 add_filter( 'site_transient_update_plugins', 'my_filter_plugin_updates' );

/** main navigation */
function main_navigation() {
    ob_start();
    wp_nav_menu(
        array(
            'theme_location' => 'main-navigation',
            'menu_class' => 'nav_menu',
        )
    );
    return ob_get_clean();
}

/** footer navigation */
function footer_navigation() {
    ob_start();
    if ( is_active_sidebar( 'footer-about-menu' ) ) {
      echo '<div class="single-menu cell-6 cell-767-12">';
        dynamic_sidebar( 'footer-about-menu' );
      echo '</div>';
    }
    if ( is_active_sidebar( 'footer-iga-menu' ) ) {
      echo '<div class="single-menu cell-6 cell-767-12">';
        dynamic_sidebar( 'footer-iga-menu' );
      echo '</div>';
    }
    return ob_get_clean();
}
add_shortcode('footer-navigation', 'footer_navigation');

/** Footer Logo Function Start */
function footer_logo_new() {
    ob_start();
        if( has_custom_logo() ) {
            $footerLogoID = attachment_url_to_postid( get_theme_mod( 'footer_logo' ) ) ;
            $footerLogoImage = wp_get_attachment_image( $footerLogoID ,'large', '', ["class" => "footer-logo transition"] );

            echo '<div class="footer-logo position-relative transition">' .
                '<a href="' . get_option('home') . '" class="d-block transition position-relative">' .
                    ( $footerLogoID ? $footerLogoImage : '' ) .
                '</a>' .
            '</div>';
        }
    return ob_get_clean();
}


/** Social Media Function Start */
function social_media_options(){
    ob_start();
    global $facebook;
    global $insta;
    global $twitter;
    global $youtube;
    global $linkedin;
    global $yelp;
    if( have_rows('social_media', 'options') ){
        echo '<div class="socialmedialinks"><ul class="justify-content-center">';
            while ( have_rows('social_media', 'options')) : the_row();
            $icon = get_sub_field('social_media_name', 'options');
            echo '<li class="p-0">' .
                    '<a href="' . get_sub_field('social_media_link', 'options') . '" target="_blank" class="' . get_sub_field('social_media_name', 'options') . '">';
                        if($icon == "facebook"){
                            echo $facebook . '<span>Facebook</span>';
                        } else if($icon == "insta") {
                            echo $insta . '<span>Instagram</span>';
                        } else if($icon == "twitter") {
                            echo $twitter . '<span>Twitter</span>';
                        } else if($icon == "youtube") {
                            echo $youtube . '<span>Youtube</span>';
                        } else if($icon == "linkedin") {
                            echo $linkedin . '<span>Linkedin</span>';
                        } else if($icon == "yelp") {
                            echo $yelp . '<span>Yelp</span>';
                        }
                    echo '</a>' .
                '</li>';
            endwhile;
        echo '</ul></div>';
    }
    return ob_get_clean();
}
/** Social Media Function End */


function custom_post_type() {

// Set UI labels for Custom Post Type
    $labels_Case_Studies = array(
        'name'                => _x( 'Case Studies', 'Post Type General Name', 'igamediacentre' ),
        'singular_name'       => _x( 'Case Study', 'Post Type Singular Name', 'igamediacentre' ),
        'menu_name'           => __( 'Case Studies', 'igamediacentre' ),
        'parent_item_colon'   => __( 'Parent Case Study', 'igamediacentre' ),
        'all_items'           => __( 'All Case Studies', 'igamediacentre' ),
        'view_item'           => __( 'View Case Study', 'igamediacentre' ),
        'add_new_item'        => __( 'Add New Case Study', 'igamediacentre' ),
        'add_new'             => __( 'Add New', 'igamediacentre' ),
        'edit_item'           => __( 'Edit Case Study', 'igamediacentre' ),
        'update_item'         => __( 'Update Case Study', 'igamediacentre' ),
        'search_items'        => __( 'Search Case Study', 'igamediacentre' ),
        'not_found'           => __( 'Not Found', 'igamediacentre' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'igamediacentre' ),
    );

// Set other options for Custom Post Type

    $args_Case_Studies = array(
        'label'               => __( 'Case Studies', 'igamediacentre' ),
        'description'         => __( 'Case Study news and reviews', 'igamediacentre' ),
        'labels'              => $labels_Case_Studies,
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
        'show_in_rest'        => true,
        'taxonomies'          => array( 'case_studies_cat' ),
     );

	// Registering your Custom Post Type
    register_post_type( 'case_studies', $args_Case_Studies );

	 // Set UI labels for Custom Post Type
    $labels_Media_kits = array(
        'name'                => _x( 'Media kits', 'Post Type General Name', 'igamediacentre' ),
        'singular_name'       => _x( 'Media kit', 'Post Type Singular Name', 'igamediacentre' ),
        'menu_name'           => __( 'Media kits', 'igamediacentre' ),
        'parent_item_colon'   => __( 'Parent Media kit', 'igamediacentre' ),
        'all_items'           => __( 'All Media kits', 'igamediacentre' ),
        'view_item'           => __( 'View Media kit', 'igamediacentre' ),
        'add_new_item'        => __( 'Add New Media kit', 'igamediacentre' ),
        'add_new'             => __( 'Add New', 'igamediacentre' ),
        'edit_item'           => __( 'Edit Media kit', 'igamediacentre' ),
        'update_item'         => __( 'Update Media kit', 'igamediacentre' ),
        'search_items'        => __( 'Search Media kit', 'igamediacentre' ),
        'not_found'           => __( 'Not Found', 'igamediacentre' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'igamediacentre' ),
    );

	// Set other options for Custom Post Type

    $args_Media_kits = array(
        'label'               => __( 'Media kits', 'igamediacentre' ),
        'description'         => __( 'Media kit news and reviews', 'igamediacentre' ),
        'labels'              => $labels_Media_kits,
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
        'show_in_rest'        => true,
        'taxonomies'          => array( 'media_kits_cat' ),
     );

	// Registering your Custom Post Type
    register_post_type( 'media_kits', $args_Media_kits );

}

/* Hook into the 'init' action so that the function
* Containing our post type registration is not
* unnecessarily executed.
*/

add_action( 'init', 'custom_post_type' );


function custom_posttype_taxonomy() {
    register_taxonomy(
		'case_studies_cat',
        'case_studies',        			//post type name
        array(
            'hierarchical' => true,
            'label' => 'Case Studies',  	//Display name
            'query_var' => true,
			'has_archive' => true,
        )
    );

	register_taxonomy(
		'media_kits_cat',
        'media_kits',        			//post type name
        array(
            'hierarchical' => true,
            'label' => 'Media Kits',  	//Display name
            'query_var' => true,
			'has_archive' => true,
        )
    );
}
add_action( 'init', 'custom_posttype_taxonomy');


// request button
function request_button() {
	ob_start();

	$link = get_field('header_button','options');
	if( $link ) {
	    $link_url = $link['url'];
	    $link_title = $link['title'];
	    $link_target = $link['target'] ? $link['target'] : '_self';

	    echo '<a class="read-more" href="'. esc_url( $link_url ) .'" target="'. esc_attr( $link_target ) .'"><span>'. esc_html( $link_title ) .'</span></a>';
		}
	return ob_get_clean();
}
