<?php 
function bpt_get_all_icon () {
    
    $file = get_template_directory() . '/css/font-awesome.min.css';
    $myfile = call_user_func('fopen', $file, "r") or die("Unable to open file!");
    $fa_content = call_user_func('fread', $myfile, filesize($file)) ;
    call_user_func('fclose', $myfile);

    if ( preg_match_all( "/fa-((\w+|-?)+):before/", $fa_content, $matches, PREG_PATTERN_ORDER ) ){
        $bpt_fa_options = array();
        for ($i=0; $i<count($matches[1]); $i++) {
            $bpt_fa_options['fa fa-'.$matches[1][$i]] = esc_html($matches[1][$i]);
        }
        return $bpt_fa_options;
    }

}

if ( class_exists( 'RWMB_Field' ) )
{
    class RWMB_Social_Field extends RWMB_Field
    {
        /**
         * Get field HTML
         *
         * @param mixed $meta
         * @param array $field
         *
         * @return string
         */
        static public function html( $meta, $field )
        {
            $out = '<fieldset>';
            
            foreach ($field['options'] as $key => $value) {
                $meta[$key] = !empty($meta[$key]) ? $meta[$key] : '';
                $out .= '<label style="display:inline-block; padding: 0 20px 0 0;">'.$value["name"].'<br>';
                $out .= '<input '.($field['clone'] ? 'class="rwmb-fieldset_text"' : '').' id="'.$field['id'].'" type="'.$value["type_input"].'" name="'.$field['field_name'].'['.$key.']" value="'.$meta[$key].'">';
                $out .= '</label>';
            }
            $out .= '</fieldset>';
            return sprintf(
                $out,
                $field['field_name'],
                $field['id'],
                $meta
            );
        }
    }

    class RWMB_Select_Icon_Field extends RWMB_Select_Field {

        /**
         * Enqueue scripts and styles
         */
        public static function admin_enqueue_scripts() {
            parent::admin_enqueue_scripts();
            wp_enqueue_style( 'rwmb-select2', RWMB_CSS_URL . 'select2/select2.css', array(), '4.0.1' );
            wp_enqueue_style( 'rwmb-select-advanced', RWMB_CSS_URL . 'select-advanced.css', array(), RWMB_VER );

            wp_register_script( 'rwmb-select2', RWMB_JS_URL . 'select2/select2.min.js', array( 'jquery' ), '4.0.2', true );

            // Localize
            $dependencies = array( 'rwmb-select2', 'rwmb-select' );
            $locale       = str_replace( '_', '-', get_locale() );
            $locale_short = substr( $locale, 0, 2 );
            $locale       = file_exists( RWMB_DIR . "js/select2/i18n/$locale.js" ) ? $locale : $locale_short;

            if ( file_exists( RWMB_DIR . "js/select2/i18n/$locale.js" ) ) {
                wp_register_script( 'rwmb-select2-i18n', RWMB_JS_URL . "select2/i18n/$locale.js", array( 'rwmb-select2' ), '4.0.2', true );
                $dependencies[] = 'rwmb-select2-i18n';
            }

            wp_enqueue_script( 'rwmb-select', RWMB_JS_URL . 'select.js', array( 'jquery' ), RWMB_VER, true );
            wp_enqueue_script( 'rwmb-select-advanced', RWMB_JS_URL . 'select-advanced.js', $dependencies, RWMB_VER, true );
        }

        public static function walk( $field, $options, $db_fields, $meta ) {
            $attributes = self::call( 'get_attributes', $field, $meta );
            $walker     = new RWMB_Walker_Select( $db_fields, $field, $meta );

            $attributes_select = $attributes;
            $attributes_select['name'] = $attributes['name'].'[select]';

            $output     = sprintf(
                '<select %s>',
                self::render_attributes( $attributes_select )
            );
            if ( false === $field['multiple'] ) {
                $output .= $field['placeholder'] ? '<option value="">' . esc_html( $field['placeholder'] ) . '</option>' : '';
            }
            $output .= $walker->walk( $options, $field['flatten'] ? - 1 : 0 );
            $output .= '</select>';
            $meta['input'] = empty($meta['input']) ? '' : $meta['input'];
            $output .= '<lable style="vertical-align:middle; margin-left: 20px"> Url:';
            $output .= '<input type="text" '.($field['clone'] ? 'class="rwmb-fieldset_text"' : '').' id="'.$field['id'].'" name="'.$attributes['name'].'[input]'.'" value="'.$meta['input'].'">';
            $output .= '</lable>';
            $output .= self::get_select_all_html( $field );
            return $output;
        }

        /**
         * Normalize parameters for field
         *
         * @param array $field
         * @return array
         */
        public static function normalize( $field ) {
            $field = wp_parse_args( $field, array(
                'js_options'  => array(),
                'placeholder' => __( 'Select an item', 'cryptronick-core' ),
            ) );

            $field = parent::normalize( $field );

            $field['js_options'] = wp_parse_args( $field['js_options'], array(
                'allowClear'  => true,
                'width'       => 'none',
                'placeholder' => $field['placeholder'],
            ) );

            return $field;
        }

        /**
         * Get the attributes for a field
         *
         * @param array $field
         * @param mixed $value
         * @return array
         */
        public static function get_attributes( $field, $value = null ) {
            $attributes = parent::get_attributes( $field, $value );
            $attributes = wp_parse_args( $attributes, array(
                'data-options' => wp_json_encode( $field['js_options'] ),
            ) );

            return $attributes;
        }
    }
}

?>