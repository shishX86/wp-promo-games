<?php

/**
 * @package WpPromoGames
 */

namespace WpPromoGames\Core;

use WpPromoGames\Environment\GlobalConfig;

/**
 * It's class fo registering scripts and
 * styles. For public and admin area.
 */
class Enqueue
{
    private $manifest;
    private $manifest_path;

    /**
     * Register hooks handlers for adding 
     * scripts and styles
     *
     * @return void
     */
    function init(): void
    {
        add_action('admin_enqueue_scripts', [$this, 'enqueueAdmin']);
        add_action('wp_enqueue_scripts', [$this, 'enqueuePublic']);

        $this->getManifest();
    }

    /**
     * Read assets manifest
     *
     * @return void
     */
    function getManifest(): void
    {
        $this->manifest_path = GlobalConfig::pluginUrl() . 'mix-manifest.json';

        if ($this->manifest_path) {
            $url = $this->manifest_path;
            $this->manifest = json_decode(file_get_contents($url), true);
        }
    }

    /**
     * Read asset version from given string
     *
     * @param string $asset
     * @return string|null
     */
    function getAssetVersion(string $asset): ?string
    {
        //can't find version number
        if (strpos($asset, 'id=') === false) return null;

        $ver_arr = parse_url($asset);
        //clear from id=
        $ver_out = substr($ver_arr['query'], 3);

        return $ver_out;
    }

    /**
     * Register admin scripts and styles
     *
     * @return void
     */
    function enqueueAdmin(): void
    {
        $js_key = '/build/admin/app.js';
        $enqueue_js = ($this->manifest) ? $this->manifest[$js_key] : $js_key;
        $js_ver = $this->getAssetVersion($enqueue_js);

        $css_key = '/build/admin/app.css';
        $enqueue_css = ($this->manifest) ? $this->manifest[$css_key] : $css_key;
        $css_ver = $this->getAssetVersion($enqueue_css);

        wp_enqueue_media();
        wp_enqueue_style('wp-color-picker');
        wp_enqueue_script('wp-color-picker');

        wp_enqueue_style('wppgs_admin_styles', GlobalConfig::pluginUrl() . $css_key, [], $css_ver);
        wp_enqueue_script('wppgs_admin_scripts', GlobalConfig::pluginUrl() . $js_key, ['jquery'], $js_ver);
    }

    /**
     * Register public scripts and styles
     *
     * @return void
     */
    function enqueuePublic(): void
    {
        $js_key = '/build/public/app.js';
        $enqueue_js = ($this->manifest) ? $this->manifest[$js_key] : $js_key;
        $js_ver = $this->getAssetVersion($enqueue_js);

        $css_key = '/build/public/app.css';
        $enqueue_css = ($this->manifest) ? $this->manifest[$css_key] : $css_key;
        $css_ver = $this->getAssetVersion($enqueue_css);

        wp_enqueue_style('wppgs_styles', GlobalConfig::pluginUrl() . $css_key, [], $css_ver);
        wp_enqueue_script('wppgs_scripts', GlobalConfig::pluginUrl() . $js_key, [], $js_ver);
    }
}
