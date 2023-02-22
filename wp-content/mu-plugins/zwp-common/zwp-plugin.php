<?php

class ZwpCommon
{

    public static function instance()
    {
        static $self = false;
        if (!$self) {
            $self = new ZwpCommon();
        }
        return $self;
    }

    public function add_zwp_admin_menu()
    {
        require_once(ZWP_PLUGIN_DIR . "zwp-dashboard.php");
        $dashboard = new ZwpDashboard();
    }

    public function set_object_cache($state)
    {
        $path = WP_CONTENT_DIR . "/object-cache.php";
        if ($state) {
            if (file_exists($path)) {
                return false;
            }
            copy(dirname(__FILE__) . "/object-cache.php", $path);
        } else {
            if (!file_exists($path)) {
                return false;
            }
            unlink($path);
        }
    }

    public function set_advanced_cache($state)
    {
        $path = WP_CONTENT_DIR . "/advanced-cache.php";
        if ($state) {
            if (file_exists($path)) {
                return false;
            }
            copy(dirname(__FILE__) . "/advanced-cache.php", $path);
        } else {
            if (!file_exists($path)) {
                return false;
            }
            unlink($path);
        }
    }

    public function set_update_settings()
    {
        require_once(ZWP_PLUGIN_DIR . "/zwp-update-settings.php");
    }
}

$zwp_common = ZwpCommon::instance();
$zwp_common->add_zwp_admin_menu();
$zwp_common->set_update_settings();
$zwp_common->set_object_cache(WP_CACHE);
$zwp_common->set_advanced_cache(WP_CACHE);
