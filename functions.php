<?php
if (class_exists("Attachments")) {
  require_once "lib/attachments.php";
}

if (site_url() == 'http://demo2.com') {
	define("VERSION",time());
}else{
	define("VERSION",wp_get_theme()->get('Version'));
}

function alfa_bootstrapping(){
	load_theme_textdomain("alfa");
	add_theme_support('post-thumbnails'); //for feature image
  add_theme_support("html5",array('search-form'));
  add_theme_support("title-tag"); //for post tag

    $alfa_custom_header_details = array(
      'header-text'        => true,
      'default-text-color' => '#002244',
      'flex-height'        => true,
      'flex-width'         => true
    );

     $alfa_custom_logo_details = array(
      'height' => '100',
      'width' => '100'
    );

    add_theme_support("custom-header",$alfa_custom_header_details);
    add_theme_support('custom-logo', $alfa_custom_logo_details);
    add_theme_support('custom-background');

    register_nav_menu("topmenu", __("Top Menu","alfa"));
    register_nav_menu("footer-menu", __("Footer Menu","alfa"));

    /* register_nav_menus(array(
      'header-menu' => 'Header Menu',
      'footer-menu' => 'Footer Menu'
     ));*/

     add_theme_support("post-formats",array("image","audio","video","quote"));

}
add_action("after_setup_theme","alfa_bootstrapping");

function alfa_assets(){

	wp_enqueue_style("bootstarp",'//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css');
	wp_enqueue_style("featherlight-css",'//cdn.rawgit.com/noelboss/featherlight/1.7.13/release/featherlight.min.css');
  
  wp_enqueue_style("dashicons"); // For adding post formats icons
  wp_enqueue_style( "tns-style","//cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.7.1/tiny-slider.css" );
  wp_enqueue_style("alfa" , get_stylesheet_uri(),null,VERSION); // for getting style.css file

	wp_enqueue_script('featherlight-js', '//cdn.rawgit.com/noelboss/featherlight/1.7.13/release/featherlight.min.js',array("jquery",VERSION,true));

	wp_enqueue_script("alfa_main",get_theme_file_uri("/assets/js/main.js"),array("jquery","featherlight-js"),VERSION,true);

  wp_enqueue_script( "tns-js", "//cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.7.1/min/tiny-slider.js", null, "0.0.1", true ); //for attachemts pluggin slider
  
}
add_action("wp_enqueue_scripts","alfa_assets");

function alfa_sidebar_widgets_init() {

	register_sidebar(
		array(
			'name'          => __( 'Single Post Sidebar', 'alfa' ),
			'id'            => 'sidebar-1', //should be unique
			'description'   => __( 'right sidebar.', 'alfa' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

}

add_action("widgets_init", "alfa_sidebar_widgets_init"); //for showing widgets data


function alfa_footer_left_widgets_init(){
   register_sidebar(
		array(
			'name'          => __( 'Footer Left', 'alfa' ),
			'id'            => 'sidebar-2', //should be unique
			'description'   => __( 'footer sidebar.', 'alfa' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}

add_action("widgets_init", "alfa_footer_left_widgets_init"); //for showing widgets data

function alfa_footer_right_widgets_init(){
   register_sidebar(
		array(
			'name'          => __( 'Footer Right', 'alfa' ),
			'id'            => 'sidebar-3', //should be unique
			'description'   => __( 'footer sidebar.', 'alfa' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}

add_action("widgets_init", "alfa_footer_right_widgets_init"); //for showing widgets data

function alfa_the_excerpt($excerpt){
	 if (!post_password_required()) {
       return $excerpt;
     }else{
      echo get_the_password_form();
    }
}

add_filter("the-excerpt",'alfa_the_excerpt');

function alfa_protected_title_change(){
   return "%s"; //for removing protected word from post title
}
add_filter("protected_title_format",'alfa_protected_title_change');

function alfa_menu_item_class($classes , $item){ // for showing navigation bar inline
	$classes[] = "list-inline-item";
	return $classes;
}
add_filter("nav_menu_css_class","alfa_menu_item_class",10,2);

function alpha_about_page_template_banner(){
    if(is_page()) {
        $alpha_feat_image = get_the_post_thumbnail_url(null,"large");
        ?>
        <style>
            .page-header{
                background-image: url(<?php echo $alpha_feat_image;?>);
            }
        </style>
        <?
    }

    if (is_front_page()) {
    	if (current_theme_supports( "custom-header" )) { ?>
    		
    		<style>
    			.header{
    				 background-image: url(<?php echo header_image();?>);
    				 background-size: cover;
    				 margin-bottom: 50px;
    			}
    			.header h1.heading a, h3.tagline{
                  color: #<?php echo get_header_textcolor(); ?>

                  <?php
                  if (!display_header_text()) {
                  	echo "display: none;";
                   }
                  ?>
    			}
    		</style>
   <?php
    	}
    }
}
add_action("wp_head","alpha_about_page_template_banner",11);

//Author Section
/*
function wpb_author_info_box( $content ) {
 
global $post;
 
// Detect if it is a single post with a post author
if ( is_single() && isset( $post->post_author ) ) {
 
// Get author's display name 
$display_name = get_the_author_meta( 'display_name', $post->post_author );
 
// If display name is not available then use nickname as display name
if ( empty( $display_name ) )
$display_name = get_the_author_meta( 'nickname', $post->post_author );
 
// Get author's biographical information or description
$user_description = get_the_author_meta( 'user_description', $post->post_author );
 
// Get author's website URL 
$user_website = get_the_author_meta('url', $post->post_author);
 
// Get link to the author archive page
$user_posts = get_author_posts_url( get_the_author_meta( 'ID' , $post->post_author));
  
if ( ! empty( $display_name ) )
 
$author_details = '<p class="author_name">About ' . $display_name . '</p>';
 
if ( ! empty( $user_description ) )
// Author avatar and bio
 
$author_details .= '<p class="author_details">' . get_avatar( get_the_author_meta('user_email') , 90 ) . nl2br( $user_description ). '</p>';
 
$author_details .= '<p class="author_links"><a href="'. $user_posts .'">View all posts by ' . $display_name . '</a>';  
 
// Check if author has a website in their profile
if ( ! empty( $user_website ) ) {
 
// Display author website link
$author_details .= ' | <a href="' . $user_website .'" target="_blank" rel="nofollow">Website</a></p>';
 
} else { 
// if there is no author website then just close the paragraph
$author_details .= '</p>';
}
 
// Pass all this info to post content  
$content = $content . '<footer class="author_bio_section" >' . $author_details . '</footer>';
}
return $content;
}
 
// Add our function to the post content filter 
add_action( 'the_content', 'wpb_author_info_box' );
 
// Allow HTML in author bio section 
remove_filter('pre_user_description', 'wp_filter_kses');
*/

add_filter("body_class",function($classes){
  unset($classes[array_search("wp-custom-logo", $classes)]);
  return $classes;
});

add_filter("post_class",function($classes){
  unset($classes[array_search("first_class", $classes)]);
  return $classes;
});

function alpha_highlight_search_results($text){
    if(is_search()){
        $pattern = '/('. join('|', explode(' ', get_search_query())).')/i';
        $text = preg_replace($pattern, '<span class="search-highlight">\0</span>', $text);
    }
    return $text;
}
add_filter('the_content', 'alpha_highlight_search_results');
add_filter('the_excerpt', 'alpha_highlight_search_results');
add_filter('the_title', 'alpha_highlight_search_results');

function alfa_modify_main_query($query){
  if(is_home() && $query->is_main_query()){
    $query->set('post__not_in',array(113));
  }
}
add_action('pre_get_posts','alfa_modify_main_query');