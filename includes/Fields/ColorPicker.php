<?php

/**
 * Template for color picker
 * 
 * @package WpPromoGames
 */

namespace WpPromoGames\Fields;

/**
 * Colorpicker Metabox field
 */
class ColorPicker
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
        $value = isset( $fieldData['value'] ) ? esc_attr($fieldData['value']) : '';
        $width = isset( $fieldData['width']) ? 'style="width:' . $fieldData['width'] . '%"' : '';

        ob_start();

        ?>

            <div class="wppgs-fieldgroup" <?php echo $width ?>>
                <div class="wppgs-fieldgroupinner">
                    <label class="wppgs-fieldgroup__label wppgs-label" for="<?php echo $name ?>">
                        <?php echo $label; ?>
                    </label>

                    <input 
                        id="<?php echo $name ?>"
                        class="js-wppgs-color-field" 
                        name="<?php echo $name ?>" 
                        type="text" 
                        value="<?php echo $value ?>" 
                    >
                </div>
            </div>
        <?php

        echo ob_get_clean();
    }
}
