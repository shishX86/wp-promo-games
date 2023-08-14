<?php

/**
 * Template for General metabox
 * 
 * @package WpPromoGames
 */

namespace WpPromoGames\Metaboxes;

use WpPromoGames\Core\FieldsRenderer;
use WpPromoGames\Environment\LeaderboardFieldsConfig;

/**
 * General Game Metabox
 */
class LeaderboardMetabox
{
    /**
     * Render general metabox template
     *
     * @param $post - current post object
     * @return void
     */
    public static function render($post): void
    {
        $config = LeaderboardFieldsConfig::getConfig();
        wp_nonce_field($config['basename'], $config['basename'] . '_nonce');

        $data = get_post_meta($post->ID, '_' . $config['basename'] . '_key', true);
        $data = (isset($data) && !empty($data)) ? $data : $config['config'];

        $dataToRender = [];

        if (!$config['config']) return;

        //we 
        foreach ($config['config'] as $conf) {
            if (isset($conf['id'])) {
                $dataToRender[] = isset($data[$conf['id']])
                    ? $data[$conf['id']]
                    : $conf;
            }
        }

        $dataToRender = isset($dataToRender) ? $dataToRender : $config['config'];

        //Render
        echo '<div class="wppgs-fieldscont">';

        FieldsRenderer::renderFields($dataToRender);

        echo '</div>';
    }

    /**
     * Saves custom metabox
     *
     * @param $postId - current post id
     * @return int|null - current post id
     */
    public static function save($postId)
    {
        $data = [];
        $config = LeaderboardFieldsConfig::getConfig();
        $basename = LeaderboardFieldsConfig::$basename;

        $nonce = isset($_POST[$basename . '_nonce']) ? $_POST[$basename . '_nonce'] : null;

        if (
            !$nonce
            || !wp_verify_nonce($nonce, $basename)
            || (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            || !current_user_can('edit_post', $postId)
        )
            return $postId;

        $data = self::saveValidFields($config['config'], $data);

        update_post_meta($postId, '_' . $config['basename'] . '_key', $data);
    }


    private static function saveValidFields(array $configData, array $saveData = [])
    {
        foreach ($configData as $conf) {
            $val = '';

            if (isset($conf['id'])) {
                if ((isset($conf['name']) && isset($_POST[$conf['name']])) 
                    || $conf['type'] === 'repeater'
                    //dynamic selects
                    || ($conf['type'] === 'select' && isset($conf['data']['source'])) ) {
                    
                    switch ($conf['type']) {
                        case 'wysiwyg':
                            $val = esc_html($_POST[$conf['name']]);
                            break;

                        case 'repeater':
                            //TODO: CLEANUP POST DATA
                            $val = [];

                            $firstFieldName = str_replace(array('[', ']'), '', $conf['template'][0]['name']);
                            $rIterations = isset($_POST[$firstFieldName]) ? count($_POST[$firstFieldName]) : 0;

                            for ($i = 0; $i < $rIterations; $i++) {
                                $tempArr = [];
                                
                                foreach ($conf['template'] as $rConfFields) {
                                    $name = str_replace(array('[', ']'), '', $rConfFields['name']);

                                    if( isset($rConfFields['data']) ) {
                                        $fiterVal = array_filter( $rConfFields['data'], function($arr) use ($name, $i) {
                                            if( $arr['value'] == $_POST[$name][$i] ) 
                                                return $arr;
                                        } );

                                        $fiterVal = isset($fiterVal) ? array_values($fiterVal) : [];

                                        $rConfFields['value'] = (isset($fiterVal[0])) 
                                            ? $fiterVal[0]
                                            : [];

                                        $tempArr[$rConfFields['id']] = $rConfFields;
                                    } else {
                                        $rConfFields['value'] = sanitize_text_field( $_POST[$name][$i] );
                                        $tempArr[$rConfFields['id']] = $rConfFields;
                                    }

                                }

                                $val[] = $tempArr;
                            }

                            break;

                        default:
                            $val = sanitize_text_field($_POST[$conf['name']]);
                    }
                }

                $saveData[$conf['id']] = array_merge($conf, ['value' => $val]);
            }
        }

        return $saveData;
    }
}
