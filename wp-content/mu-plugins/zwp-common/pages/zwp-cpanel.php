<?php
require ZWP_PLUGIN_DIR . 'common/encryption.php';
require ZWP_PLUGIN_DIR . 'common/util.php';
if (basename($_SERVER["SCRIPT_NAME"]) == basename(__FILE__)) {
    exit;
}

define('CPANEL_STG_PLUGIN_URL', ZWP_CP_URL . '/WPPlugin');
define('TOKEN_FORMAT', 'Y/m/d H:i:s');
define('TOKEN_LIMIT', '+ 1 hour');
define('TOKEN_TIMEZONE', 'UTC');
define('TOKEN_DELIMITER', '|');

global $wpdb;

// get key
$key = $wpdb->get_var($wpdb->prepare("SELECT meta_value FROM $wpdb->usermeta WHERE user_id = %d AND meta_key = %s;", 0, 'zwp_key'));
if (empty($key)) {
    $key = ZwpUtil::generateKey(30);
    $wpdb->insert('wp_usermeta', array('user_id' => 0, 'meta_key' => 'zwp_key', 'meta_value' => $key), array('%d', '%s', '%s'));
}

// get unique key
$ukey = $wpdb->get_var($wpdb->prepare("SELECT meta_value FROM $wpdb->usermeta WHERE user_id = %d AND meta_key = %s;", 0, 'zwp_ukey'));
if (empty($ukey)) {
    $ukey = ZwpUtil::generateKey(30);
    $wpdb->insert('wp_usermeta', array('user_id' => 0, 'meta_key' => 'zwp_ukey', 'meta_value' => $ukey), array('%d', '%s', '%s'));
}

// create token.
$dtz = date_default_timezone_get();
date_default_timezone_set(TOKEN_TIMEZONE);
$expiration_date = date(TOKEN_FORMAT, strtotime(TOKEN_LIMIT));
date_default_timezone_set($dtz);
$token = ZwpEncryption::encrypt($ukey . TOKEN_DELIMITER . $expiration_date, $key);
$id = DB_NAME;
$region = constant('ZWP_REGION_NAME');
if ($region == null) {
    $region = "tyo1";
}

$data = array(
    'id' => $id,
    'region' => $region,
    'token' => $token
);

$parameter = http_build_query($data);
$iframe_url = CPANEL_STG_PLUGIN_URL . '?' . $parameter;

// load scripts
wp_enqueue_style('zwp-settings-style', ZWP_PLUGIN_URL . '/pages/css/common/style.css', array(), ZWP_PLUGIN_VERSION);
wp_enqueue_script('zwp-settings-script', ZWP_PLUGIN_URL . '/pages/js/common/frame.js', array(), ZWP_PLUGIN_VERSION);
?>
<iframe id="zwp-settings" src="<?php echo $iframe_url; ?>"></iframe>