<?php
/*
Plugin Name: Произвольные поля в записях
Plugin URI: http://wp-shop.ru/blog/all-plugins/postmeta-in-posts/
Description: Замена шорткодов <code>[meta имя-поля]</code> или комментариев <code>&lt;!--meta имя-поля--&gt;</code> на значение указанного поля.
Author: WP Shop Team
Version: 0.1
Author URI: http://wp-shop.ru
*/

add_filter('the_content', 'display_meta',0);

function display_meta($content)
{
	$content = preg_replace_callback('|\[meta\s+(.*)\s*\]|i', 'display_meta_replace', $content);
	$content = preg_replace_callback('|\<\!\-\-meta\s+(.*)\s*\-\-\>|i', 'display_meta_replace', $content);
	return $content;
}

function display_meta_replace($m)
{
	global $post;
	return get_post_meta($post->ID, $m[1], true);
}

?>