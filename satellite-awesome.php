<?php
/*
 * Plugin Name: Satellite Awesome
 * Plugin URI: http://c-pr.es/satellite
 * Author: C- Pres
 * Author URI: http://c-pr.es
 * Description: Display people in innovative ways using Satellite
 * Version: 0.1
 */

/**
 * New Views for displaying people
 * @param gallery html $out
 */

// This plugin should have it's own precursing unique and original name - 'STLAWE'
if (!defined('STLAWE_PLUGIN_BASENAME'))
    define('STLAWE_PLUGIN_BASENAME', plugin_basename(__FILE__));
if (!defined('STLAWE_PLUGIN_NAME'))
    define('STLAWE_PLUGIN_NAME', trim(dirname(STLAWE_PLUGIN_BASENAME), '/'));
if (!defined('STLAWE_PLUGIN_DIR'))
    define('STLAWE_PLUGIN_DIR', WP_PLUGIN_DIR . '/' . STLAWE_PLUGIN_NAME);
if (!defined('STLAWE_PLUGIN_URL'))
    define('STLAWE_PLUGIN_URL', WP_PLUGIN_URL . '/' . STLAWE_PLUGIN_NAME);

class SatelliteAwesomePlugin
{
    // Should be unique to this plugin
    var $pre = 'STLAWE';

    // Keep as Satellite
    var $basename = 'Satellite';

    function __construct()
    {
        $this->initialize_options();
        add_action('wp_enqueue_scripts',array('SatelliteAwesomePlugin', 'enqueue_scripts'));
        add_filter('satl_add_theme_view', array('SatelliteAwesomePlugin', 'addViews'));
        add_filter('satl_add_menu', array('SatelliteAwesomePlugin', 'add_menu'));
        add_filter('satl_render_view', array('SatelliteAwesomePlugin', 'addRender'));

    }

    public static function addViews($themes)
    {
        $themes[] = array("id" => "awesomeness", "title" => "Awesomeness");
        return $themes;
    }

    public static function addRender($params)
    {
        list($view, $slides) = $params;
        $plugin = new SatelliteAwesomePlugin();
        return $plugin->render($view, array('slides' => $slides, 'frompost' => 'false'), false);
    }

    public static function add_menu($menus)
    {
        add_meta_box('awesomediv', 'Awesome Settings', array('SatelliteAwesomePlugin', 'settings_awesome'), $menus, 'normal', 'core');
    }

    public static function settings_awesome()
    {
        $plugin = new SatelliteAwesomePlugin();
        $plugin->render('settings-awesome', false, true);
    }

    public function render($file = '', $params = array(), $output = true)
    {
        if (!empty($file)) {
            $filename = $file . '.php';
            $filepath = $this->plugin_base() . '/views/';
            $filefull = $filepath . $filename;
            if (file_exists($filefull)) {
                if (!empty($params)) {
                    foreach ($params as $pkey => $pval) {
                        ${$pkey} = $pval;
                    }
                }
                if ($output == false) {
                    ob_start();
                }
                include($filefull);
                if ($output == false) {
                    $data = ob_get_clean();
                    return $data;
                } else {
                    flush();
                    return true;
                }
            }
        }
        return false;
    }

    public function enqueue_scripts()
    {
        wp_register_script(STLAWE_PLUGIN_NAME . '_js', STLAWE_PLUGIN_URL . '/js/awesome.js', array('jquery'));
        wp_enqueue_script(STLAWE_PLUGIN_NAME . '_js');

        wp_register_style(STLAWE_PLUGIN_NAME . '_css', STLAWE_PLUGIN_URL . '/css/awesome.css');
        wp_enqueue_style(STLAWE_PLUGIN_NAME . '_css');

    }

    public function initialize_options()
    {
        $settings = array(
            'width' => '180',
            'startOpacity' => '7'
        );
        $this->add_option('Awesome', $settings);
    }

    function plugin_base()
    {
        return rtrim(dirname(__FILE__), '/');
    }

    function add_option($name = '', $value = '')
    {
        if (add_option($this->basename . $this->pre . $name, $value)) {
            return true;
        }
        return false;
    }

    function update_option($name = '', $value = '')
    {
        if (update_option($this->basename . $this->pre . $name, $value)) {
            return true;
        }
        return false;
    }

    function get_option($name = '', $stripslashes = true)
    {
        if ($option = get_option($this->basename . $this->pre . $name)) {
            if ( !is_array($option) && @unserialize($option) !== false) {
                return unserialize($option);
            }
            if ($stripslashes == true) {
                $option = stripslashes_deep($option);
            }
            return $option;
        } elseif ($option = get_option($this->basename . $name)) {
            if ( !is_array($option) && @unserialize($option) !== false) {
                return unserialize($option);
            }
            if ($stripslashes == true) {
                $option = stripslashes_deep($option);
            }
            return $option;
        }
        return false;
    }


}

$SatelliteAwesomePlugin = new SatelliteAwesomePlugin();