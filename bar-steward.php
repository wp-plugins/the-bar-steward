<?php /*
Plugin Name: The Bar Steward
Version: 1.0
Plugin URI: http://wordpress.org/extend/plugins/the-bar-steward/
Author: Lee Rickler
Author URI: http://rickler.com
Description: Certain WordPress plugins hijack your back and front end admin bar. Kick them out with this plugin.
*/

// add the admin options page
add_action('admin_menu', 'pands_tbs_add_page');
	function pands_tbs_add_page() {
	add_options_page('The Bar Steward', 'The Bar Steward', 'manage_options', 'pands-tbs', 'pands_tbs_page');
}
add_action( 'admin_init', 'pands_tbs_admin_init' );
	function pands_tbs_admin_init() {
	register_setting( 'pands_tbs_options', 'pands_tbs_plugin_options');
}

function pands_tbs_page() {
?>
<style media="screen" type="text/css">
div#heres-jonny {
	display:block;
	width:630px
	}

table.pands-cms-options-table {
	padding:3px
	}

table.pands-cms-options-table td.panel-title {
	background:#777;
	color:#fff;
	-webkit-border-radius: 3px;
	border-radius: 3px;
	}

table.pands-cms-options-table th {
	font-weight:normal;
	text-align:left
	}
table.pands-cms-options-table th, table.pands-cms-options-table td {
	background:#e8e8e8;
	margin:6px;
	padding:6px
	}

input.checkbox {
	background:#fff;
	border:1px solid #000;
	display:inline-block;
	height:16px;
	width:16px
	}
</style>
<div class="wrap">
<h2 id="write-post">The Bar Steward</h2>
<form action="options.php" method="post">
<?php settings_fields('pands_tbs_options'); ?>
<?php $options = get_option('pands_tbs_plugin_options'); ?>
<div id="heres-jonny">
<h3>Some plugins like to embed themselves into the default WordPress admin bar. <br />Some developers and their clients dislike this.</h3>
<p><table class="pands-cms-options-table">
  <tr>
    <td class="panel-title" colspan="2">If installed, remove these extraneous menus from your tool bar:</td>
  </tr>
  <tr><?php
   if (is_plugin_active('wordpress-seo/wp-seo.php')) { ?>
    <td>Remove Yoast WordPress SEO</td>
    <td><input name="pands_tbs_plugin_options[remove_wpseo]" type="checkbox" value="1" <?php checked('1', $options['remove_wpseo']); ?> /></td>
    <?php } else {
    echo '<td colspan="2">You haven\'t installed <a href="http://wordpress.org/extend/plugins/wordpress-seo/" target="_blank">Yoast WordPress SEO</a>.</td>'; } ?>
  </tr>
    <tr><?php
   if (is_plugin_active('cdn-sync-tool/cdn-sync-tool.php')) { ?>
    <td>Remove CDN Synch Tool</td>
    <td><input name="pands_tbs_plugin_options[remove_cdn]" type="checkbox" value="1" <?php checked('1', $options['remove_cdn']); ?> /></td>
    <?php } else {
    echo '<td colspan="2">You haven\'t installed <a href="http://wordpress.org/extend/plugins/cdn-sync-tool/" target="_blank">CDN Synch Tool</a>.</td>'; } ?>
  </tr>
  <tr><?php
   if (is_plugin_active('nextgen-gallery/nggallery.php')) { ?>
    <td>Remove NextGen Gallery</td>
    <td><input name="pands_tbs_plugin_options[remove_nxgen]" type="checkbox" value="1" <?php checked('1', $options['remove_nxgen']); ?> /></td>
    <?php } else {
    echo '<td colspan="2">You haven\'t installed <a href="http://wordpress.org/extend/plugins/nextgen-gallery/" target="_blank">NextGen Gallery</a>.</td>'; } ?>
  </tr> 
</table>
<br />Simply choose the options required, above, and click 'Save changes'.<br />I welcome further suggestions, corrections or simply a better way of doing stuff, so feel free to <a href="mailto:wordpress@pointandstare.com">email</a>.</p>
<div id="tabs-pands-script">
<input name="Submit" class="button-primary" type="submit" value="<?php esc_attr_e('Save Changes'); ?>" />
</form>
<p><strong>Keep up with Point and Stare:</strong><br />
<a href="http://pointandstare.com/feed" target="_blank"><img src="http://pointandstare.com/elements/themes/pointandstare/images/icon_rss.png" alt="Point and Stare RSS feed" /></a> <a href="http://twitter.com/pointandstare" target="_blank"><img src="http://pointandstare.com/elements/themes/pointandstare/images/icon_twitter.png"></a> <a href="mailto:wordpress@pointandstare.com"><img src="http://pointandstare.com/elements/themes/pointandstare/images/icon_email.png" /></a> <a href="http://pointandstare.com/GooglePages" target="_blank"><img src="http://pointandstare.com/elements/themes/pointandstare/images/icon-google-plus.png" alt="Point and Stare on google pages"></a><br /><br />If you find this plug-in just so totally awesome that you develop a massive urge to donate, <a href="http://wordpressfoundation.org/donate/" target="_blank">feel free to donate here</a>.</p></div></div>
<?php
}
if(!function_exists('is_plugin_active'))
require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if(is_plugin_active('wordpress-seo/wp-seo.php'))
{
// REMOVE YOAST WORDPRESS SEO FROM THE TOOL BAR
function pands_remove_yoastwpseo() {
$options = get_option('pands_tbs_plugin_options');
global $wp_admin_bar;
	$wp_admin_bar->add_menu( array( 'id' => 'wpseo-menu', 'title' => __( 'SEO', 'wordpress-seo' ), 'href' => get_admin_url('admin.php?page=wpseo_dashboard'), ) );
	if ($options['remove_wpseo'] == 1) $wp_admin_bar->remove_menu('wpseo-menu');
}
add_action( 'wp_before_admin_bar_render', 'pands_remove_yoastwpseo' );
}
 else {
    echo ''; }
if(is_plugin_active('cdn-sync-tool/cdn-sync-tool.php'))
{
// REMOVE CDN SYNCH TOOL FROM THE TOOL BAR
function pands_remove_cdn() {
	$options = get_option('pands_tbs_plugin_options');
	global $wp_admin_bar;
		$wp_admin_bar->add_menu( array( 'title' => 'CDN Sync Tool', 'href' => get_admin_url('admin.php?page=cst-main'), 'id' => 'cst-main') );		
		if ($options['remove_cdn'] == 1) $wp_admin_bar->remove_menu('cst-main');
	}
add_action( 'wp_before_admin_bar_render', 'pands_remove_cdn' );
}
 else {
    echo ''; }
if(is_plugin_active('nextgen-gallery/nggallery.php'))
{
// REMOVE NEXT GEN FROM THE TOOL BAR
function pands_remove_nxg() {
$options = get_option('pands_tbs_plugin_options');
	global $wp_admin_bar;
		$wp_admin_bar->add_menu( array( 'id' => 'ngg-menu', 'title' => __( 'Gallery' ), 'href' => admin_url('admin.php?page=nextgen-gallery') ) );		
		if ($options['remove_nxgen'] == 1) $wp_admin_bar->remove_menu('ngg-menu');
	}
add_action( 'wp_before_admin_bar_render', 'pands_remove_nxg' );
}
 else {
    echo ''; } 
?>