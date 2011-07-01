<?php
/*
Plugin Name: Like Buttons
Description: Adds Open Graph tags to your posts/pages/etc, adds a Facebook Like button to posts using simple Theme functions. Requires a Facebook Application ID (instructions are provided)
Author: Scott Taylor
Version: 0.3.1
Author URI: http://tsunamiorigami.com
*/

/**
 * You must register you app with Facebook to have full-featured Like buttons
 * If you don't want to register your app, you can use the <iframe> buttons (the_like_iframe())
 *
 */
define('FACEBOOK_APP_ID', 0);
define('FACEBOOK_ADMINS', 0);

function the_like_image() {
	global $post;
	$id = (int) $post->ID;

	if ($id > 0) {
		$image = get_posts(array(	
			'order' => 'ASC',
			'orderby' => 'menu_order',
			'post_parent' => $id,
			'post_type'   => 'attachment',
			'post_mime_type' => 'image',
			'post_status' => 'inherit',
			'numberposts' => 1
		));	
		
		if (is_array($image) && count($image)) { ?>
<meta property="og:image" content="<?= esc_attr($image[0]->guid) ?>" />
<?php	
		}
	}	
}

function add_open_graph_atts($value) {
	$append = array();
	$append[] = $value;
	if (!preg_match('/xmlns=/', $value)) {
		$append[] = 'xmlns="http://www.w3.org/1999/xhtml"';
	}
	
	if (!preg_match('/xmlns:og=/', $value)) {
		$append[] = 'xmlns:og="http://ogp.me/ns#"';	
	}
	
	if (!preg_match('/xmlns:fb=/', $value)) {
		$append[] = 'xmlns:fb="http://www.facebook.com/2008/fbml"';
	}	
	return implode(' ', $append);		
}
add_filter('language_attributes', 'add_open_graph_atts');

function the_open_graph_meta_tags() {
if (is_single()): 
	global $post;
	$content = strip_tags(apply_filters('the_excerpt', $post->post_excerpt));
	if (empty($content)) {
		$content = strip_tags(apply_filters('the_content', $post->post_content));
	}	
	
	$content = str_replace(array("\r\n", "\r", "\n", "\t"), '', $content);
?>
<meta property="og:title" content="<?php echo esc_attr(apply_filters('the_title', $post->post_title)) ?>" />
<meta property="og:type" content="article" />
<?php the_like_image() ?>
<meta property="og:url" content="<?php echo esc_attr( get_permalink( $post->ID ) ) ?>" />
<meta property="og:site_name" content="<?php echo esc_attr(get_bloginfo('name')) ?>" />
<meta property="og:description" content="<?php echo esc_attr(trim($content)) ?>" />
<?php else: ?>
<meta property="og:title" content="<?php echo esc_attr(get_bloginfo('name')) ?>" />
<meta property="og:type" content="website" />
<?php the_like_image() ?>
<meta property="og:url" content="<?php echo esc_attr(home_url()) ?>" />
<meta property="og:site_name" content="<?php echo esc_attr(get_bloginfo('name')) ?>" />
<meta property="og:description" content="<?php echo esc_attr(trim(get_bloginfo('description'))) ?>" />
<?php endif; ?>
<?php if ((int) FACEBOOK_ADMINS > 0): ?>
<meta property="fb:admins" content="<?php echo esc_attr(trim(FACEBOOK_ADMINS)) ?>" />
<?php endif; ?>
<?php if ((int) FACEBOOK_APP_ID > 0): ?>
<meta property="fb:app_id" content="<?php echo esc_attr(trim(FACEBOOK_APP_ID)) ?>" />
<?php endif; ?>
<script type="text/javascript">var FACEBOOK_APP_ID = <?= FACEBOOK_APP_ID ?>;</script>
<script type="text/javascript" src="<?php echo plugin_dir_url('') . 'like-buttons/like-buttons.js' ?>"></script>
<?php
}
add_action('wp_head', 'the_open_graph_meta_tags');

function like_buttons_app_id() {
?>
	<div id="like-buttons-warning" class="updated fade">
		<p><strong>Warning!</strong> For Like Buttons to work properly, you need to register your site as a Facebook app <a href="http://www.facebook.com/developers/createapp.php" target="_blank">here</a>. Once you enter your Application Name and complete the security Captcha, select the Website tab on the left to obtain your Application ID and set Site URL to your site's root URL.</p>
	</div>
<?php
}

function like_buttons_init() {
	if ((int) FACEBOOK_APP_ID === 0) {
		add_action('admin_notices', 'like_buttons_app_id');
	}
}
add_action('admin_init', 'like_buttons_init');


function init_like_button_js() {
	wp_enqueue_script('jquery');
}
add_action('init', 'init_like_button_js');

/**
 *
 * Theme Functions
 *
 */
function the_blog_like_button($height = 80, $width = 640) {
	?><fb:like href="<?= home_url() ?>" action="like" layout="standard" colorscheme="light" show_faces="true" height="<?= $height ?>" width="<?= $width ?>"></fb:like><?php
}

function the_like_iframe() {
	?><iframe src="http://www.facebook.com/plugins/like.php?href=<?= rawurlencode(get_permalink()) ?>&amp;layout=button_count&amp;show_faces=false" scrolling="no" frameborder="0" style="border: none; overflow: hidden; width:85px; height: 21px" allowTransparency="true"></iframe><?php
}

function the_like_button() {
	?><fb:like></fb:like><?php
}
?>