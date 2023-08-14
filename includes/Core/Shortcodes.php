<?php

/**
 * @package WpPromoGames
 */

namespace WpPromoGames\Core;

use WpPromoGames\Environment\GlobalConfig;
use WpPromoGames\Environment\GameFieldsConfig;
use WpPromoGames\Environment\LeaderboardFieldsConfig;

/**
 * It's class for registering shortcodes 
 */
class Shortcodes
{

    /**
     * Static method for displaying current post shortcode
     *
     * @param string $label - shortcode label
     * @param object $post - post object
     * @return void
     */
    public static function showCurrent( string $label, object $post ): void {
        $id = $post->ID;
        
        $output = '';
        $output .= '<div class="wppgs-shortcode js-wppgs-shortcode">';
        $output .=   '<div class="wppgs-shortcode__code js-wppgs-shortcode-code">';
        $output .=     "[$label id='$id']";
        $output .=   '</div>';
        $output .=   '<div class="wppgs-shortcode__info">';
        $output .=     __('Click to select and copy as usual', 'wp-promo-games');
        $output .=   '</div>';
        $output .= '</div>';

        echo $output;
    }

    /**
     * Initialize method
     *
     * @return void
     */
    function init(): void
    {
        add_shortcode(GlobalConfig::gameShortcode(), [$this, 'gameShortcode']);
        add_shortcode(GlobalConfig::leaderboardShortcode(), [$this, 'leaderboardShortcode']);
    }

    /**
     * Shortcode template for game post types
     *
     * @param array $atts
     * @return string
     */
    function gameShortcode(array $atts): string
    {
        $atts = shortcode_atts([
            'id' => -1,
        ], $atts);

        ob_start();
        ?>
            <div 
                class="js-wppgs-game wppgs-game wppgs-game-<?php echo $atts['id']?>"
                id="wppgs_<?php echo $atts['id'] ?>"
                data-ajaxurl="<?php echo admin_url( 'admin-ajax.php' ) ?>"
                data-id="<?php echo $atts['id'] ?>"
                data-action="wppgsGetGameData"
            >

                <!-- game container -->
                <div class="wppgs-game__game" id="wppromogames_<?php echo $atts['id'] ?>">
                </div>

                <!-- forms templates -->
                <template id="wppgs_start_template_<?php echo $atts['id'] ?>" style="width:100%; height:100%; overflow:auto;">
                    <div class="wppgs-game__starttemplate">
                        <div class="wppgs-game__panelbg">

                            <!-- html from wysiwyg -->
                            <br>
                            <h3 align="center">Flappy Bird Clone</h3>
                            <p align="center">
                                <img alt="game_icon" src="">
                            </p>
                            <p>This is description examle.</p>
                            <br>
                            <button class="js-wppgs-start-game" type="button">Start</button>
                        </div>
                    </div>
                </template>
            </div>
        <?php

        return ob_get_clean();
    }

    /**
     * Shortcode template for leaderboard post type
     *
     * @param array $atts
     * @return string
     */
    function leaderboardShortcode(array $atts): string
    {
        $atts = shortcode_atts([
            'id' => -1,
        ], $atts);

        $config = LeaderboardFieldsConfig::getConfig();
        $key = '_' . $config['basename'] . '_key';
        $data = get_post_meta( $atts['id'], $key);

        $colNames = array_column($data[0]['lb_columns']['value'], 'lb_columns_name');

        //TODO: real data for fields
        $colVals = array_column($data[0]['lb_columns']['value'], 'lb_columns_select');

        ob_start();
        ?>

        <div 
            class="wppgs-leaderboard" 
            id="wppgs-leaderboard-<?php echo $atts['id']?>"
            data-leaderboard="<?php echo htmlspecialchars(json_encode($data), ENT_QUOTES, 'UTF-8') ?>">

            <?php //table head ?>
            <div class="wppgs-leaderboard__thead">
                <?php foreach($colNames as $colName): ?>
                    <div class="wppgs-leaderboard__th">
                        <?php echo $colName['value'] ?>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <?php //table body ?>
            <div class="wppgs-leaderboard__trow">
                <?php foreach($colVals as $colVal): ?>
                    <div class="wppgs-leaderboard__td" data-val="<?php echo $colVal['label']?>">
                        <?php echo $colVal['value']['label'] ?>
                    </div>
                <?php endforeach; ?>
            </div>

            Доска рекордов
        </div>

        <?php
        return ob_get_clean();
    }
}
