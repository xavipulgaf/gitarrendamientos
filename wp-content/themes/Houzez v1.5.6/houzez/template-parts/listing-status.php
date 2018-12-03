<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 17/12/15
 * Time: 2:24 PM
 */
$term_id = '';
$term_status = wp_get_post_terms( get_the_ID(), 'property_status', array("fields" => "all"));
$label_id = '';
$term_label = wp_get_post_terms( get_the_ID(), 'property_label', array("fields" => "all"));

if( !empty($term_status) ) {
    foreach( $term_status as $status ) {
        $status_id = $status->term_id;
        $status_name = $status->name;
        echo '<span class="label-status label-status-'.intval($status_id).' label label-default">'.esc_attr($status_name).'</span>';
    }
}

if( !empty($term_label) ) {
    foreach( $term_label as $label ) {
        $label_id = $label->term_id;
        $label_name = $label->name;
        echo '<span class="label label-default label-color-'.intval($label_id).'">'.esc_attr($label_name).'</span>';
    }
}
?>