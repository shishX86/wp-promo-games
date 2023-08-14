<?php

/**
 * Template for select
 * 
 * @package WpPromoGames
 */

namespace WpPromoGames\Fields;

/**
 * SwitchToggle Metabox field
 */
class SwitchToggle
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
        $width = isset( $fieldData['width']) ? 'style="width:' . $fieldData['width'] . '%"' : '';
        $checked = isset( $fieldData['value'] ) ? ' checked="checked"' : '';

        ob_start();

        ?>

            <div class="wppgs-fieldgroup" <?php echo $width ?>>
                <div class="wppgs-fieldgroupinner">
                    <label class="wppgs-toggle">
                        <input 
                            type="checkbox" 
                            <?php echo $checked ?>
                            id="<?php echo $name ?>"
                            name="<?php echo $name ?>"
                        >
                        <span class="wppgs-toggle__control"></span>
                    </label>

                    <label for="<?php echo $name ?>">
                        <?php echo $label ?>
                    </label>
                </div>
            </div>

        <?php

        echo ob_get_clean();
    }
}
