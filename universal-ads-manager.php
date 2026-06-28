<?php
/**
 * Plugin Name: Universal Ads Manager
 * Plugin URI: https://github.com/DionSalvador/project
 * Description: Remote Adsterra Manager menggunakan config.json
 * Version: 1.0.0
 * Author: Dion Salvador
 * License: GPL2
 */

if (!defined('ABSPATH')) {
    exit;
}

define('UAM_VERSION', '1.0.0');
define('UAM_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('UAM_PLUGIN_URL', plugin_dir_url(__FILE__));

define('UAM_OPTION_URL', 'uam_config_url');
define('UAM_CACHE_KEY', 'uam_remote_config');
define('UAM_CACHE_TIME', 6 * HOUR_IN_SECONDS);

require_once UAM_PLUGIN_PATH . 'admin.php';
require_once UAM_PLUGIN_PATH . 'cache.php';
require_once UAM_PLUGIN_PATH . 'ads.php';

class UniversalAdsManager
{
    private static $instance = null;

    public static function instance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function __construct()
    {
        add_action('admin_menu', ['UAM_Admin', 'menu']);
        add_action('admin_init', ['UAM_Admin', 'register']);

        add_filter('the_content', ['UAM_Ads', 'insert']);

        add_action('wp_footer', ['UAM_Ads', 'footer']);
    }
}

UniversalAdsManager::instance();
