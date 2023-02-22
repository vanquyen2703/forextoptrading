<?php
/*
  Plugin Name: Z.com WordPressHosing Plugin
  Plugin URI: http://cloud.z.com/
  Description: WordPressHosing original plugin
  Author: Z.com
  Version: 1.0.0
 */


define('ZWP_PLUGIN_BASE', __FILE__);

$plugin_datas = get_file_data(ZWP_PLUGIN_BASE, array('Version' => 'Version'));
define('ZWP_PLUGIN_VERSION', $plugin_datas['Version']);

$cp_base_url = 'https://console.cloudnetvn.com';
$brand_key = constant('ZWP_BRAND_KEY');
if ($brand_key == null) {
    $brand_key = "zjp";
}
$iso_code = substr($brand_key, 1, 2);
define('ZWP_CP_URL', sprintf($cp_base_url, $iso_code));


if (is_multisite()) {
    define('ZWP_PLUGIN_URL', network_site_url('/wp-content/mu-plugins/zwp-common'));
} else {
    define('ZWP_PLUGIN_URL', content_url('/mu-plugins/zwp-common'));
}

define('ZWP_PLUGIN_DIR', dirname(__FILE__) . "/zwp-common/");
require_once(ZWP_PLUGIN_DIR . "zwp-plugin.php");
