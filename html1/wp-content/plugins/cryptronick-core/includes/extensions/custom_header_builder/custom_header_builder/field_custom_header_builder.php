<?php
/**
 * Redux Framework is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * Redux Framework is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Redux Framework. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package     ReduxFramework
 * @author      Dovy Paukstys
 * @version     3.1.5
 */

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) exit;

// Don't duplicate me!
if( !class_exists( 'ReduxFramework_custom_header_builder' ) ) {

    /**
     * Main ReduxFramework_custom_header_builder class
     *
     * @since       1.0.0
     */
    class ReduxFramework_custom_header_builder{
    
        /**
         * Field Constructor.
         *
         * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
        function __construct( $field = array(), $value ='', $parent ) {
        
            
            $this->parent = $parent;
            $this->field = $field;
            $this->value = $value;

            if ( empty( $this->extension_dir ) ) {
                $this->extension_dir = trailingslashit( str_replace( '\\', '/', dirname( __FILE__ ) ) );
                $this->extension_url = site_url( str_replace( trailingslashit( str_replace( '\\', '/', ABSPATH ) ), '', $this->extension_dir ) );
            }    

            // Set default args for this field to avoid bad indexes. Change this to anything you use.
            $defaults = array(
                'options'           => array(),
                'stylesheet'        => '',
                'output'            => true,
                'enqueue'           => true,
                'enqueue_frontend'  => true
            );
            $this->field = wp_parse_args( $this->field, $defaults );            
        }

        public function render() {
            // HTML output goes here       
            if ( ! is_array( $this->value ) && isset( $this->field['options'] ) ) {
                $this->value = $this->field['options'];
            }

            // Make sure to get list of all the default blocks first
            $all_blocks = ! empty( $this->field['options'] ) ? $this->field['options'] : array();
            $temp       = array(); // holds default blocks
            $temp2      = array(); // holds saved blocks

           foreach ( $all_blocks as $blocks ) {
                $temp = array_merge( $temp, $blocks );
            }
  
            $sortlists = $this->value;
            //Add Thickbox https://codex.wordpress.org/ThickBox
            add_thickbox();

            foreach ( $sortlists as $sortlist ) {
                $temp2 = array_merge( $temp2, $sortlist );
            }

            // now let's compare if we have anything missing
           foreach ( $temp as $k => $v ) {
                        // k = id/slug
                        // v = name
                if ( ! empty( $temp2 ) ) {
                    if ( ! array_key_exists( $k, $temp2 ) ) {
                        $sortlists['items'][ $k ] = $v;
                    }
                }
            }

            if ( $sortlists ) {
                echo '<fieldset id="' . esc_attr($this->field['id']) . '" class="redux-sorter-container redux-sorter">';
                $index = 0;
                
                foreach ( $sortlists as $group => $sortlist ) {
                    
                    if($index == 0){
                        echo '<div class="bpt_header_items">';
                    }elseif($index % 3 == 1 || $index == 1){
                        echo '<div class="bpt_header_row">';
                    }
                    echo '<ul id="' . esc_attr($this->field['id'] . '_' . $group) . '" class="sortlist_' . esc_attr($this->field['id']) . '" data-id="' . esc_attr($this->field['id']) . '" data-group-id="' . esc_attr($group) . '">';

                    echo '<h3>' . esc_html($group) . '</h3>';

                    if ( ! isset( $sortlist['placebo'] ) ) {
                        array_unshift( $sortlist, array( "placebo" => "placebo" ) );
                    }

                    foreach ( $sortlist as $key => $list ) {
                        echo '<input class="sorter-placebo" type="hidden" name="' . esc_attr($this->field['name']) . '[' . $group . '][placebo]' . esc_attr($this->field['name_suffix']) . '" value="placebo">';
                        if ( $key != "placebo" && $key != 'pos_column') {
                            echo '<li id="sortee-' . esc_attr($key) . '" class="sortee" data-id="' . esc_attr($key) . '">';
                            echo '<input class="position ' . esc_attr($this->field['class']) . '" type="hidden" name="' . esc_attr($this->field['name'] . '[' . $group . '][' . $key . ']' . $this->field['name_suffix']) . '" value="' . esc_attr($list) . '">';
                            echo esc_html($list);
                            echo '</li>';
                        }                                                
                    } 
                     
                    if($index != 0){
                        /**
                        * Modal Window
                        *
                        *
                        * @since 1.0
                        * @access public
                        */
                        $id = sanitize_html_class(esc_attr($this->field['name']) . '[' . $group . '][select]' . esc_attr($this->field['name_suffix']));

                        echo '<span class="edit_column"><a href="/?TB_inline&width=500&height=400&inlineId=select_'.$id.'" class="thickbox"><i class="fa fa-cog" aria-hidden="true"></i></a></span>';
                        
                        echo '<div id="select_' . $id . '" style="display:none;" tabindex="-1">';                        

                        /**
                        * Header Horizontal Align Column
                        *
                        *
                        * @since 1.0
                        * @access public
                        */
                        echo '<div class="bpt_column">';
                        echo '<h3>' . esc_html__("Horizontal Align", 'cryptronick-core') . '</h3>';
                        $h_alignment = $index == 2 || $index == 5 || $index == 8 ? "center" : "left";
                        $h_alignment = $index == 3 || $index == 6 || $index == 9 ? "right" : $h_alignment;

                        $params_h = isset($sortlist['pos_column']['h_align']) ? $sortlist['pos_column']['h_align'] : $h_alignment;               
                        echo '<input type="hidden" name="' . esc_attr($this->field['name']) . '[' . $group . '][pos_column][h_align]' . esc_attr($this->field['name_suffix']) . '" class="select2_params" value="'.$params_h.'">';

                        echo '<select name="select-' . esc_attr($this->field['name']) . '[' . $group . '][select][h_align]' . esc_attr($this->field['name_suffix']) . '" class="redux-select-item ' . $this->field['class'] . '"' . ' rows="6">';
                        echo '<option value="left" '.selected( $params_h, "left" ).'>' . esc_html__('Left', 'cryptronick-core') . '</option>'; 
                        echo '<option value="center" '.selected( $params_h, "center" ).'>' . esc_html__('Center', 'cryptronick-core') . '</option>'; 
                        echo '<option value="right" '.selected( $params_h, "right" ).'>' . esc_html__('Right', 'cryptronick-core') . '</option>'; 
                        echo '</select>';
                        echo '</div>';                        

                        /**
                        * Header Vertical Align Column
                        *
                        *
                        * @since 1.0
                        * @access public
                        */
                        echo '<div class="bpt_column">';
                        echo '<h3>' . esc_html__("Vertical Align", 'cryptronick-core') . '</h3>';
                        $params_v = isset($sortlist['pos_column']['v_align']) ? $sortlist['pos_column']['v_align'] : "middle";           
                        echo '<input type="hidden" name="' . esc_attr($this->field['name']) . '[' . $group . '][pos_column][v_align]' . esc_attr($this->field['name_suffix']) . '" class="select2_params" value="'.$params_v.'">';
                        echo '<select name="select-' . esc_attr($this->field['name']) . '[' . $group . '][select][v_align]' . esc_attr($this->field['name_suffix']) . '" class="redux-select-item ' . $this->field['class'] . '"' . ' rows="6">';
                        echo '<option value="top" '.selected( $params_v, "top" ).'>' . esc_html__('Top', 'cryptronick-core') . '</option>'; 
                        echo '<option value="middle" '.selected( $params_v, "middle" ).'>' . esc_html__('Middle', 'cryptronick-core') . '</option>'; 
                        echo '<option value="bottom" '.selected( $params_v, "bottom" ).'>' . esc_html__('Bottom', 'cryptronick-core') . '</option>'; 
                        echo '</select>';
                        echo '</div>';

                        /**
                        * Header Dispay Column
                        *
                        *
                        * @since 1.0
                        * @access public
                        */
                        echo '<div class="bpt_column">';
                        echo '<h3>' . esc_html__("Display", 'cryptronick-core') . '</h3>';
                        $params_d = isset($sortlist['pos_column']['display']) ? $sortlist['pos_column']['display'] : "normal";               
                        echo '<input type="hidden" name="' . esc_attr($this->field['name']) . '[' . $group . '][pos_column][display]' . esc_attr($this->field['name_suffix']) . '" class="select2_params" value="'.$params_d.'">';

                        echo '<select name="select-' . esc_attr($this->field['name']) . '[' . $group . '][select][display]' . esc_attr($this->field['name_suffix']) . '" class="redux-select-item ' . $this->field['class'] . '"' . ' rows="6">';
                        echo '<option value="normal" '.selected( $params_d, "normal" ).'>' . esc_html__('Normal', 'cryptronick-core') . '</option>'; 
                        echo '<option value="grow" '.selected( $params_d, "grow" ).'>' . esc_html__('Grow', 'cryptronick-core') . '</option>'; 
                        echo '</select>';
                        echo '</div>';

                        // Close Modal Window
                        echo '</div><!-- .bpt_column -->';
                    }

                    echo '</ul>';                    
                    if($index == 0){
                        echo '</div>';
                    }elseif($index % 3 == 0 && $index != 0){                 
                        echo '</div><!-- .bpt_header_row -->';
                    }
                                       
                    $index++;    
                
                }
                echo '</fieldset>';
            }

        }        

        /**
         * Enqueue Function.
         *
         * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
        public function enqueue() {
            wp_enqueue_script(
                'redux-field-icon-select-js', 
                $this->extension_url . 'field_custom_header_builder.js', 
                array( 'jquery' ),
                time(),
                true
            );

            wp_enqueue_style(
                'redux-field-icon-select-css', 
                $this->extension_url . 'field_custom_header_builder.css',
                time(),
                true
            );
        
        }
        
        /**
         * Output Function.
         *
         * Used to enqueue to the front-end
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */        
        public function output() {

            if ( $this->field['enqueue_frontend'] ) {

            }
            
        }


        private function replace_id_with_slug( $arr ) {
            $new_arr = array();
            if ( ! empty( $arr ) ) {
                foreach ( $arr as $id => $name ) {

                    if ( is_numeric( $id ) ) {
                        $slug = strtolower( $name );
                        $slug = str_replace( ' ', '-', $slug );

                        $new_arr[ $slug ] = $name;
                    } else {
                        $new_arr[ $id ] = $name;
                    }
                }
            }

            return $new_arr;
        }
        private function is_value_empty( $val ) {
            if ( ! empty( $val ) ) {
                foreach ( $val as $section => $arr ) {
                    if ( ! empty( $arr ) ) {
                        return false;
                    }
                }
            }


            return true;
        }        
        
    }
}
