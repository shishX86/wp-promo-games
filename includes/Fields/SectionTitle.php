<?php

/**
 * Template for section title
 * 
 * @package WpPromoGames
 */

namespace WpPromoGames\Fields;

/**
 * Subheader Metabox field
 */
class SectionTitle
{

    /**
     * Render generak metabox template
     *
     * @param $post - current post object
     * @return void
     */
    public static function render($fieldData): void
    {
        $label = isset( $fieldData['label'] ) ? esc_attr( $fieldData['label'] ) : '';
        $width = isset( $fieldData['width']) ? 'style="width:' . $fieldData['width'] . '%"' : '';

        ob_start();

        ?>

            <div class="wppgs-fieldgroup" <?php echo $width ?>>
                <div class="wppgs-fieldgroupinner">
                    <label class="wppgs-subheader">
                        <?php echo $label; ?>
                    </label>
                </div>
            </div>

        <?php

        echo ob_get_clean();
    }
}
