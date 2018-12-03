<?php
if( !class_exists('Advance_Search_Widget') ){

class Advance_Search_Widget extends WP_Widget {

    public function __construct(){
        $widget_ops = array( 'classname' => 'Advance_Search_Widget', 'description' => __('This widget displays advance search form.', 'framework'));
        parent::__construct( 'advance_search_widget', __('RealHomes - Advance Search Widget', 'framework'), $widget_ops );
    }

    function widget($args,  $instance) {
        extract($args);

        $title = apply_filters('widget_title', $instance['title']);

        if ( empty($title) ){
            $title = false;
        }

        echo '<section class="widget advance-search">';

        if($title):
            echo '<h4 class="title search-heading">'. $title .'<i class="fa fa-search"></i></h4>';
        endif;

        if ( inspiry_is_search_page_configured() ):
            get_template_part('template-parts/search-form');
        endif;

        echo $after_widget;
    }


    function form($instance) {
        $instance = wp_parse_args( (array) $instance, array( 'title'=> __('Find Your Home', 'framework') ) );
        $title = esc_attr($instance['title']);
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>"><?php _e('Widget Title', 'framework'); ?></label>
            <input id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" class="widefat" />
        </p>
        <?php
    }

    function update($new_instance, $old_instance){
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        return $instance;
    }

}
}
?>