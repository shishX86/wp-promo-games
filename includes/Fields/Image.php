<?php

/**
 * Template for image from media library
 * 
 * @package WpPromoGames
 */

namespace WpPromoGames\Fields;

/**
 * Image Metabox field
 */
class Image {
    public static function render($fieldData) {
        $activeClass = $value ? 'active' : '';
        $value = isset( $fieldData['value'] ) ? esc_attr( $fieldData['value'] ) : '';
        $bgImg = $value ? 'style="background-image: url(' . $value . ')"' : '';
        $name = isset( $fieldData['name'] ) ? $fieldData['name'] : '';
        $label = isset( $fieldData['label'] ) ? esc_attr( $fieldData['label'] ) : '';
        $btntxt = isset( $fieldData['btntxt'] ) ? esc_attr( $fieldData['btntxt'] ) : '';
        $width = isset( $fieldData['width']) ? 'style="width:' . $fieldData['width'] . '%"' : '';

        ob_start()
        ?>

        <div class="wppgs-fieldgroup" <?php echo $width ?>>
            <div class="wppgs-fieldgroupinner">
                <label for="<?php echo $name ?>" class="wppgs-label">
                    <?php echo $label ?>
                </label>

                <input 
                    type="hidden" 
                    name="<?php echo $name ?>" 
                    id="<?php echo $name ?>" 
                    class="js-wppgs-media-url"
                    value="<?php echo $value ?>"
                >

                <div 
                    class="js-wppgs-media-preview wppgs-image-preview <?php echo $activeClass ?>"
                    <?php echo $bgImg ?>
                >
                </div>
                
                <input 
                    type="button" 
                    id="upload-btn" 
                    class="button-secondary js-wppgs-media-trigger" 
                    value="<?php echo $btntxt ?>"
                >
            </div>
        </div>

        <?php
        echo ob_get_clean();
    }
}