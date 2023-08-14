<?php

/**
 * Template for select
 * 
 * @package WpPromoGames
 */

namespace WpPromoGames\Fields;

use WpPromoGames\Core\Utils;

/**
 * Select Metabox field
 */
class AjaxSelect
{

    /**
     * Render generak metabox template
     *
     * @param $post - current post object
     * @return void
     */
    public static function render($fieldData): void
    {
        $name = isset( $fieldData['name'] ) ? $fieldData['name'] : '';
        $label = isset( $fieldData['label'] ) ? esc_attr($fieldData['label']) : '';
        $action = isset( $fieldData['action'] ) ? $fieldData['action'] : '';
        $width = isset( $fieldData['width']) ? 'style="width:' . $fieldData['width'] . '%"' : '';
        $optionsData = is_array( $fieldData['data'] ) ? $fieldData['data'] : [];
        $htmlCont = isset( $fieldData['html_cont'] ) ? esc_attr( $fieldData['html_cont'] ) : '';
        $selectClass = isset( $fieldData['select_class'] ) ? esc_attr( $fieldData['select_class'] ) : '';

        if( isset($fieldData['value']) ) {
            $value = ( is_array($fieldData['value']) 
                ? Utils::sanitizeArray($fieldData['value']) 
                : sanitize_text_field($fieldData['value']) );
        } else {
            $value = '';
        }

        ob_start();

        ?>

            <div class="wppgs-fieldgroup" <?php echo $width ?>>
                <div class="wppgs-fieldgroupinner">
                    <label class="wppgs-label" for="<?php echo $name ?>">
                        <?php echo $label ?>
                    </label>

                    <select 
                        name="<?php echo $name ?>" 
                        id="<?php echo $name ?>"
                        class="wppgs-input <?php echo $selectClass ?>"
                        data-cont="<?php echo $htmlCont ?>"
                        data-action="<?php echo $action ?>"
                        data-postid="<?php the_ID() ?>"
                    >
                        <?php foreach( $optionsData as $option ): ?>
                            <?php 
                                $oValue = (int) $option['value'];
                                $oLabel = esc_attr( $option['label'] );
                                
                                //is it just value or [value: xxx, label: yyy]
                                if( isset( $value['value'] ) ) {
                                    $selected = ($value['value'] == $oValue ) ? ' selected="selected"' : '';
                                } else {
                                    $selected = ($value == $oValue ) ? ' selected="selected"' : '';
                                }
                            ?>

                            <option 
                                value="<?php echo $oValue ?>" 
                                <?php echo $selected ?>
                            >
                                <?php echo $oLabel ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="wppgs-fieldscont js-game-strategy-cont"></div>

        <?php

        echo ob_get_clean();
    }
}
