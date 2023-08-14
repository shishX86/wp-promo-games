<?php

/**
 * Template for Wysiwyg
 * 
 * @package WpPromoGames
 */

namespace WpPromoGames\Fields;

/**
 * Wysiwyg Metabox field
 */
class Wysiwyg
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
        $value = isset( $fieldData['value']) ? esc_attr( $fieldData['value'] ) : '';

        ob_start();

        ?>

            <div class="wppgs-fieldgroup" <?php echo $width ?>>
                <div class="wppgs-fieldgroupinner">
                    <?php if($label): ?>
                        <label>
                            <?php echo $label ?>
                        </label>
                    <?php endif; ?>

                    <?php 
                        wp_editor( 
                            wp_specialchars_decode($value), 
                            $name, 
                            ["media_buttons" => false, 'editor_class' => 'wppgs-editor'] 
                        );
                    ?>
                </div>
            </div>

        <?php

        echo ob_get_clean();
    }
}
