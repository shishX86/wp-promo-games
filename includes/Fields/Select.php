<?php

/**
 * Template for select
 * 
 * @package WpPromoGames
 */

namespace WpPromoGames\Fields;

use WpPromoGames\Environment\GlobalConfig;

/**
 * Select Metabox field
 */
class Select
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
        $optionsData = is_array( $fieldData['data'] ) ? $fieldData['data'] : [];

        //if data is dynamic
        if(isset($optionsData['source'])) {

            //if it posttypes
            if(array_key_exists('post_type', $optionsData['source'])) {
                $optionsData = self::getOptionsByPostType($optionsData['source']['post_type']);
            }
            
        }
        
        //TODO: CLEAN VALUE
        $value = isset( $fieldData['value'] ) ? $fieldData['value']: '';

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
                        class="wppgs-input"
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

        <?php

        echo ob_get_clean();
    }

    public static function getOptionsByPostType(string $postType): array {
        $output = []; 

        $args = [
            'post_type' => $postType,
            'post_status' => 'publish',
            'numberposts' => -1
        ];

        $query = new \WP_Query($args);
        
        while ($query->have_posts()) {
            $query->the_post();
            
            $output[] = [
                'label' => get_the_title(),
                'value' => get_the_ID(),
            ];
        }
        
        wp_reset_query();

        return $output;
    }
}
