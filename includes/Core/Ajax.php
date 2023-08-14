<?php

/**
 * @package WpPromoGames
 */

namespace WpPromoGames\Core;

use WpPromoGames\Environment\GlobalConfig;
use WpPromoGames\Environment\GameFieldsConfig;


class Ajax
{

    /**
     * Register hooks handlers for adding 
     * scripts and styles
     *
     * @return void
     */
    function init(): void
    {
        //admin
        add_action('wp_ajax_wppgsGetRelatedMetabox', [$this, 'wppgsGetRelatedMetabox']);

        //public
        add_action('wp_ajax_wppgsGetGameData', [$this, 'wppgsGetGameData']);
        add_action('wp_ajax_nopriv_wppgsGetGameData', [$this, 'wppgsGetGameData']);
    }

    /**
     * Read assets manifest
     *
     * @return void
     */
    function wppgsGetRelatedMetabox(): void
    {
        $gameIndex = (int) $_POST['gameindex'];
        $postId = (int) $_POST['postid'];

        $generalConfig = GameFieldsConfig::generalGameConfig();
        $data = get_post_meta($postId, '_' . $generalConfig['basename'] . '_key', true);
        $currGameConfigSet = GameFieldsConfig::concreteGameConfig($gameIndex);

        $dataToRender = [];

        foreach ($currGameConfigSet as $config) {
            if (isset($config['id'])) {
                $dataToRender[] = isset($data[$config['id']])
                    ? $data[$config['id']]
                    : $config;
            }
        }

        FieldsRenderer::renderFields((isset($dataToRender) ? $dataToRender : $currGameConfigSet));

        wp_send_json_success(ob_get_clean(), 200);
    }

    function wppgsGetGameData(): void
    {
        $gameId = (int) $_POST['gameId'];

        if (!$gameId) {
            $output = [
                'data' => null,
                'status' => 'FAIL',
                'message' => 'Not valid game id'
            ];

            wp_send_json_error($output);
        }

        $config = GameFieldsConfig::generalGameConfig();
        $key = '_' . $config['basename'] . '_key';
        $data = get_post_meta($gameId, $key);

        $output = [
            'data' => $data,
            'status' => 'OK',
            'message' => 'Fields loaded succeseful'
        ];

        wp_send_json_success($output, 200);
    }
}
