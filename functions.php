<?php 

// ADD FIELDS TO WP REST API

function gocats_custom_rest() {
	register_rest_field( "post", "theauthor", array(
		'get_callback' => function () {return get_the_author_meta('display_name');}  
	));

}

add_action("rest_api_init", 'gocats_custom_rest');

// ADD PAGE BANNER

function page_banner($args = NULL) { 
    
    if (!$args['title']) {
        $args['title'] = get_the_title();
    }
    
    ?>
	<section class="page_section notes_section">
      <h1><?php echo $args['title'] ?></h1>
      <div class="links"><a href="<?php echo esc_url(home_url()); ?>">home</a> / <a href="#"><?php echo $args['title'] ?></a></div>
    </section>
<?php }

/** THEME STYLES & SCRIPTS */

function gocast_theme_add_styles() {
	wp_dequeue_style('contact-form-7');
	wp_dequeue_style('wp-block-library');
	wp_deregister_script('lodash');
	wp_enqueue_style('font-awesome', get_theme_file_uri('/src/scss/purgefa.css'), false, 1.0, 'all');

    if ( is_front_page() || is_page( 'episodes' ) || is_singular("podcasts")) {
        wp_enqueue_script('audio-script', get_theme_file_uri('/js/audio.js'), false, 1.0, true);
    };
	
	if ( is_front_page() ) {
        wp_enqueue_style('front_css', get_theme_file_uri('src/scss/front.min.css'), false, 1.0, 'all');
    } else {
		wp_enqueue_style( 'main_css', get_theme_file_uri('src/scss/main.min.css'), false, 1.0, 'all');
	};
    //wp_enqueue_style('google_fonts', 'https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@200;300;400;500;700&display=swap');
	wp_enqueue_script( 'search', get_theme_file_uri('/js/search.js'), false, 1.0, true );
	wp_localize_script( 'search', 'gocastVariables', array(
		"main_url" => home_url(),
		"nonce" => wp_create_nonce("wp_rest")
	));

	if( is_page("notes")) {
		wp_enqueue_script( 'notes_feature', get_theme_file_uri('/js/notes_1.1.0.js'), false, 1.0, true );
	};

	if(is_single()) {
		wp_enqueue_script( 'like_feature', get_theme_file_uri('/js/like.js'), false, 1.0, true );
	};
};
add_action('wp_enqueue_scripts', 'gocast_theme_add_styles');

/** ADDING THEME SUPPORT */

function gogast_theme_support() {
    add_theme_support( 'post-thumbnails');
    add_theme_support('custom-logo');
	add_theme_support('title-tag');
	add_theme_support('automatic-feed-links');		
};

add_action('init', 'gogast_theme_support');

/** REGISTER MENUS */

function gogast_theme_add_menus() {

    register_nav_menus(array(
        'primary' => __('Header Menu', 'themegocast'),
        'footer' => __('Footer Menu', 'themegocast'),
    ));
};

add_action('after_setup_theme', 'gogast_theme_add_menus');


// redirect user to frontpage

function redirect_user_to_front_page() {
	$myCurrentUser = wp_get_current_user();

	if( count($myCurrentUser->roles) == 1 AND $myCurrentUser->roles[0] == "user" ) {
		wp_redirect( home_url());
		exit;
	};
};

add_action('admin_init', 'redirect_user_to_front_page');


function hide_user_admin_bar() {
	$myCurrentUser = wp_get_current_user();

	if( count($myCurrentUser->roles) == 1 AND $myCurrentUser->roles[0] == "user" ) {
		show_admin_bar(false);
	};
};

add_action('wp_loaded', 'hide_user_admin_bar');

// Change url in login

function change_url_login_user() {
	return esc_url( home_url());
};

add_filter('login_headerurl', "change_url_login_user");

// load css & js in login page

function gocast_load_login_scripts() {
	wp_enqueue_style('custom-login', get_theme_file_uri('src/scss/login.css'), false, 1.0, 'all');
	wp_enqueue_script('login-script', get_theme_file_uri('/js/login.js'), false, 1.0, true);	
};

add_action('login_enqueue_scripts', 'gocast_load_login_scripts');

// filter post requests 

function filter_note_request($data) {
	if ($data['post_type'] == "usernote") {
		$data['post_content'] = sanitize_textarea_field($data['post_content']);
		$data['post_title'] = sanitize_text_field($data['post_title']);
	};
	if($data['post_type'] == "usernote" && $data['post_status'] != "trash") {
		$data['post_status'] = "private";
	};
	return $data;
};

add_filter('wp_insert_post_data', 'filter_note_request');

// 	add text domain

add_action('init', function() {
	load_theme_textdomain( "themegocast", get_theme_file_path('/languages'));
});

// insert chat scripts

add_action('wp_footer', function () { ?>
	<!--Start of Tawk.to Script-->
	<script type="text/javascript">
		var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
		(function(){
		var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
		s1.async=true;
		s1.src='https://embed.tawk.to/60a97efba4114e480ad05ab0/1f6b1g25q';
		s1.charset='UTF-8';
		s1.setAttribute('crossorigin','*');
		s0.parentNode.insertBefore(s1,s0);
		})();
	</script>
<!--End of Tawk.to Script-->
<?php });

require get_theme_file_path( 'inc/TGM.php' );
require get_theme_file_path( 'inc/edit_fields.php' );
require get_theme_file_path( 'inc/rest_gocast.php' );
require get_theme_file_path( 'inc/like_route.php' );

?>