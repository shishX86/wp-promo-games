<?php

/**
 * Template for label
 * 
 * @package WpPromoGames
 */

namespace WpPromoGames\Fields;

use WpPromoGames\Core\FieldsRenderer;

/**
 * Label Metabox field
 */
class Repeater
{

    /**
     * Render generak metabox template
     *
     * @param $post - current post object
     * @return void
     */
    public static function render($fieldData): void
    {
        $id = isset( $fieldData['id'] ) ? (int)$fieldData['id'] : null;
        $label = isset( $fieldData['label'] ) ? esc_attr($fieldData['label']) : '';
        $width = isset( $fieldData['width']) ? 'style="width:' . $fieldData['width'] . '%"' : '';
        $template = isset( $fieldData['template'] ) ? $fieldData['template']: '';
        $value = isset( $fieldData['value'] ) ? $fieldData['value'] : null;

        ob_start();

        ?>

            <div class="wppgs-fieldgroup" <?php echo $width ?>>
                <div class="wppgs-fieldgroupinner">
                    <label class="wppgs-label">
                        <?php echo $label ?>
                    </label>
        
                    <div class="wppgs-repeater">
                        <template id="<?php echo $id . '_tml'?>">
                            <?php FieldsRenderer::renderFields($template); ?>
                            <button type="button" class="wppgs-removebtn">del</button>
                        </template>

                        <div class="wppgs-fieldscont js-repeater-container">
                            <?php 
                                if($value && is_array($value)) {
                                    foreach( $value as $item ) {
                                        FieldsRenderer::renderFields($item); 
                                    }
                                }
                            ?>
                            <button type="button" class="wppgs-removebtn">del</button>
                        </div>
                        
                        <div class="wppgs-repeater__row">
                            <button type="button" 
                                class="wppgs-repeater__add button action js-repeater-add-row"
                                data-templateid="<?php echo $id . '_tml'?>"
                            >
                                + add
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        <?php

        echo ob_get_clean();
    }
}
