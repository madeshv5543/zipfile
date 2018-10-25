<?php

class Author extends WP_Widget
{
private $isMultilingual = FALSE; //Is this site multilingual?
    
    function __construct() 
    {
        parent::__construct(
            'combined_image_text_widget', // Base ID
            esc_html__( 'Author Said', 'cryptronick' ), // Name
            array( 'description' => esc_html__( 'Widget ', 'cryptronick' ), ) // Args
        );

        //If WPML is active and was setup to have more than one language this website is multilingual.
        
        if ( is_admin() === TRUE ) {
            add_action('admin_enqueue_scripts', array($this, 'enqueue_backend_scripts') );
        }
    }


    public function enqueue_backend_scripts()
    {
        wp_enqueue_media(); //Enable the WP media uploader
        wp_enqueue_script('cryptronick-upload-img', get_template_directory_uri() . '/core/admin/js/img_upload.js', array('jquery'), false, true);
    }
    

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) 
    {
        
        $title_name = 'title';
        $text_name = 'text';
        $image_name = 'image';
    
        $imageAlt = ( isset($instance['image_alt']) && ($instance['image_alt'] != '') )? $instance['image_alt'] : FALSE;

        $imageAlt = ($imageAlt) ? esc_attr($imageAlt) : '';
        $widgetImg = ( (isset($instance[$image_name])) && (!empty($instance[$image_name])) )? '<img class="author-widget_img" src="' . esc_attr($instance[$image_name]) . '" alt="'.$imageAlt.'">':'';
        $title = ( (isset($instance[$title_name])) && (!empty($instance[$title_name])) )? $instance[$title_name]:FALSE; 
        $text = ( (isset($instance[$text_name])) && (!empty($instance[$text_name])) )? $instance[$text_name] : '';

        $facebook = ( (isset( $instance['facebook'])) && (!empty($instance['facebook'])) )? $instance['facebook'] : '';
        $instagram = ( (isset( $instance['instagram'])) && (!empty($instance['instagram'])) )? $instance['instagram'] : '';
        $twitter = ( (isset( $instance['twitter'])) && (!empty($instance['twitter'])) )? $instance['twitter'] : '';
        $linkedin = ( (isset( $instance['linkedin'])) && (!empty($instance['linkedin'])) )? $instance['linkedin'] : '';



        
        $widgetClasses = 'cryptronick_author-widget';

        $widgetClasses.= ' widget cryptronick_widget';
        $html = '<div class="' . esc_attr($widgetClasses) . '">';
        
        $html.= '<div class="author-widget_img-wrapper">' . $widgetImg . '</div>';

            if ( !empty($title) ) $html .= '<h4 class="author-widget_title">' . esc_html($title) . '</h4>';

            if ( !empty($text) ) $html .= '<p class="author-widget_text">' . esc_html($text) . '</p>';

            $html.= '<div class="clear"></div>';

            if ( !empty($facebook) ) $html.= '<a class="author-widget_social-link fa fa-facebook" href="'.esc_url($facebook).'"></a>';


            if ( !empty($twitter) ) $html.= '<a class="author-widget_social-link fa fa-twitter" href="'.esc_url($twitter).'"></a>';


            if ( !empty($linkedin) ) $html.= '<a class="author-widget_social-link fa fa-linkedin" href="'.esc_url($linkedin).'"></a>';


            if ( !empty($instagram) ) $html.= '<a class="author-widget_social-link fa fa-instagram" href="'.esc_url($instagram).'"></a>';

        $html.= '</div>';

        echo Cryptronick_Theme_Helper::render_html($html);
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {

        $title_name = 'title';
        $title = ( (isset($instance[$title_name])) && (!empty( $instance[$title_name])) )? $instance[$title_name] : '';
        $text_name = 'text';
        $text = ( (isset($instance[$text_name])) && (!empty($instance[$text_name])) )? $instance[$text_name] : '';
        $image_name = 'image';
        $image = ( (isset($instance[$image_name])) && (!empty($instance[$image_name])) )? $instance[$image_name] : '';
        $imageAlt = ( (isset( $instance['image_alt'])) && (!empty($instance['image_alt'])) )? $instance['image_alt'] : '';

        $facebook = ( (isset( $instance['facebook'])) && (!empty($instance['facebook'])) )? $instance['facebook'] : '';
        $instagram = ( (isset( $instance['instagram'])) && (!empty($instance['instagram'])) )? $instance['instagram'] : '';
        $twitter = ( (isset( $instance['twitter'])) && (!empty($instance['twitter'])) )? $instance['twitter'] : '';
        $linkedin = ( (isset( $instance['linkedin'])) && (!empty($instance['linkedin'])) )? $instance['linkedin'] : '';

        ?>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( $title_name ) ); ?>">Author Name:</label> 
            <input class="widefat" id="<?php echo esc_attr(  $this->get_field_id( $title_name ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $title_name ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( $text_name ) ); ?>">Text:</label> 
            <textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( $text_name ) ); ?>" name="<?php echo esc_attr(  $this->get_field_name( $text_name ) ); ?>" row="2"><?php echo esc_html( $text ); ?></textarea>
        </p>

        <p>
          <label for="<?php echo esc_attr( $this->get_field_id($image_name) ); ?>">Image:</label><br />
            <img class="cryptronick_media_image" src="<?php if(!empty($instance[$image_name])){echo esc_attr( $instance[$image_name] );} ?>" style="max-width: 100%" />
            <input type="text" class="widefat cryptronick_media_url" name="<?php echo esc_attr( $this->get_field_name($image_name) ); ?>" id="<?php echo esc_attr( $this->get_field_id($image_name) ); ?>" value="<?php echo esc_attr( $image ); ?>">
            <a href="#" class="button cryptronick_media_upload"><?php esc_html_e('Upload', 'cryptronick'); ?></a>
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'facebook' ) ); ?>"><?php esc_html_e( 'Facebook:', 'cryptronick' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'facebook' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'facebook' ) ); ?>" type="text" value="<?php echo esc_attr( $facebook ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'instagram' ) ); ?>"><?php esc_html_e( 'Instagram:', 'cryptronick' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'instagram' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'instagram' ) ); ?>" type="text" value="<?php echo esc_attr( $instagram ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'twitter' ) ); ?>"><?php esc_html_e( 'Twitter:', 'cryptronick' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'twitter' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'twitter' ) ); ?>" type="text" value="<?php echo esc_attr( $twitter ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'linkedin' ) ); ?>"><?php esc_html_e( 'Linkedin:', 'cryptronick' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'linkedin' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'linkedin' ) ); ?>" type="text" value="<?php echo esc_attr( $linkedin ); ?>">
        </p>
        <?php

    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) 
    {

        $new_instance['image_alt'] = sanitize_text_field( $new_instance['image_alt'] );

        return $new_instance;
    }
}

function author_register_widgets() {
    register_widget('author');
}

add_action('widgets_init', 'author_register_widgets');

?>