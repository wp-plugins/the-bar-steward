<?php /*
Plugin Name: The Bar Steward
Version: 0.1
Plugin URI: https://github.com/PointandStare/The-Bar-Steward
Author: Lee Rickler
Author URI: http://rickler.com
Description: Certain WordPress plugins hijack your back and front end admin bar. Kick them out with this plugin.
*/

// DESTROY YOAST EXTERNALS

function pands_remove() {
	global $wp_admin_bar;
	$wp_admin_bar->add_menu( array( 'id' => 'wpseo-menu', 'title' => __( 'SEO', 'wordpress-seo' ), 'href' => get_admin_url('admin.php?page=wpseo_dashboard'), ) );
	$wp_admin_bar->remove_menu('wpseo-menu');
}
add_action( 'wp_before_admin_bar_render', 'pands_remove' );

// DESTROY CDN LINKS

function pands_remove_cdn() {
	global $wp_admin_bar;
		$wp_admin_bar->add_menu( array( 'title' => 'CDN Sync Tool', 'href' => get_admin_url('admin.php?page=cst-main'), 'id' => 'cst-main') );		
		$wp_admin_bar->remove_menu('cst-main');
	}
add_action( 'wp_before_admin_bar_render', 'pands_remove_cdn' );

// DESTROY NEXTGEN LINKS

function pands_remove_nxg() {
	global $wp_admin_bar;
		$wp_admin_bar->add_menu( array( 'id' => 'ngg-menu', 'title' => __( 'Gallery' ), 'href' => admin_url('admin.php?page=nextgen-gallery') ) );		
		$wp_admin_bar->remove_menu('ngg-menu');
	}
add_action( 'wp_before_admin_bar_render', 'pands_remove_nxg' );

?>