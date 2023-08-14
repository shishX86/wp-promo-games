<?php

/**
 * Template for label
 * 
 * @package WpPromoGames
 */

namespace WpPromoGames\Fields;

/**
 * Label Metabox field
 */
class Label
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
        $label = isset( $fieldData['label'] ) ? esc_attr( $fieldData['label'] ) : '';
        $value = isset( $fieldData['value'] ) ? esc_attr( $fieldData['value'] ) : '';
        $placeholder = isset( $fieldData['placeholder'] ) ? esc_attr($fieldData['placeholder']) : '';
        $width = isset( $fieldData['width']) ? 'style="width:' . $fieldData['width'] . '%"' : '';

        ob_start();

        ?>

            <div class="wppgs-fieldgroup" <?php echo $width ?>>
                <div class="wppgs-fieldgroupinner">
                    <label class="wppgs-label" for="<?php echo $name ?>">
                        <?php echo $label ?>
                    </label>
        
                    <input 
                        class="wppgs-fieldgroup__input wppgs-input"
                        id="<?php echo $name ?>" 
                        type="text"
                        placeholder="<?php echo $placeholder ?>"
                        name="<?php echo $name ?>" 
                        value="<?php echo $value ?>"
                    >
                </div>
            </div>

        <?php

        echo ob_get_clean();
    }
}
