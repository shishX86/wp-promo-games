<?php

/**
 * Template for General metabox
 * 
 * @package WpPromoGames
 */

namespace WpPromoGames\Metaboxes;

use WpPromoGames\Core\FieldsRenderer;
use WpPromoGames\Environment\GameFieldsConfig;

/**
 * General Game Metabox
 */
class GameMetabox
{
    /**
     * Render general metabox template
     *
     * @param $post - current post object
     * @return void
     */
    public static function render( $post ): void
    {
        $config = GameFieldsConfig::generalGameConfig();
        wp_nonce_field($config['basename'], $config['basename'] . '_nonce');
        $data = get_post_meta($post->ID, '_' . $config['basename'] . '_key', true);
        $data = ( isset( $data ) && !empty( $data ) ) ? $data : $config['config'];
        $dataToRender = [];

        if( !$config['config'] ) return;

        foreach ($config['config'] as $conf) {
            if( isset($conf['id']) ) {
                $dataToRender[] = isset( $data[$conf['id']] ) 
                    ? $data[$conf['id']]
                    : $conf;
            }
        }

        $dataToRender = isset($dataToRender) ? $dataToRender : $config['config'];

        //Render
        echo '<div class="wppgs-fieldscont">';

        FieldsRenderer::renderFields( $dataToRender );

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
        $config = GameFieldsConfig::generalGameConfig();
        $basename = GameFieldsConfig::$basename;
        $gameSelectName = GameFieldsConfig::$gameSelectName;

        $nonce = isset($_POST[$basename . '_nonce']) ? $_POST[$basename . '_nonce'] : null;

        if (
            !$nonce
            || !wp_verify_nonce($nonce, $basename)
            || (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            || !current_user_can('edit_post', $postId)
        )
            return $postId;

        //save general fields
        $data = self::saveValidFields($config['config'], $data);

        //Save current game settings
        $currGameIndex = isset($_POST[$basename . '_' . $gameSelectName])
            ? (int) $_POST[$basename . '_' . $gameSelectName]
            : 1; //first game mechanics by default

        if($currGameIndex) {
            $gameConfig = GameFieldsConfig::concreteGameConfig( $currGameIndex );
            $data = self::saveValidFields($gameConfig, $data);
        }

        update_post_meta($postId, '_' . $config['basename'] . '_key', $data);
    }


    private static function saveValidFields( array $configData, array $saveData=[] ) {
        foreach ($configData as $conf) {
            $val = '';
            
            if (isset($conf['id']) && isset($conf['name']) && isset($_POST[$conf['name']])) {
                $fieldName = $conf['name'];
                $type = $conf['type'];

                switch ($type) {
                    case 'wysiwyg':
                        $val = sanitize_text_field($_POST[$fieldName]);
                        break;

                    case 'ajax_select':
                        $optionsData = $conf['data'];
                        $valToFind = esc_html($_POST[$fieldName]);
                        $valIndex = array_search($valToFind, array_column($optionsData, 'value'));
                        $val = $optionsData[$valIndex];
                        break;

                    default:
                        $val = esc_html($_POST[$fieldName]);
                }
            }

            $saveData[$conf['id']] = array_merge($conf, ['value' => $val]);
        }

        return $saveData;
    }
}
