<?php
/**
 * Class Houzez_Query
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 28/09/16
 * Time: 11:22 PM
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Houzez_Query {
    /**
     * Sets agency agents into loop
     *
     * @access public
     * @param null|int $post_id
     * @param null|int $count
     * @return void
     */
    public static function loop_agency_agents( $agency_id = null, $count = null ) {
        if ( null == $agency_id ) {
            $agency_id = get_the_ID();
        }

        $args = array(
            'post_type'         => 'houzez_agent',
            'posts_per_page'    => -1,
            'meta_query'        => array(
                array(
                    'key'       =>  'fave_agent_agencies',
                    'value'     => $agency_id,
                    'compare'   => 'LIKE',
                ),
            ),
        );

        if ( ! empty( $count ) ) {
            $args['posts_per_page'] = $count;
        }

        query_posts( $args );
    }

    /**
     * Gets agency agents ids
     *
     * @access public
     * @param null|int $post_id
     * @return array
     */
    public static function get_agency_agents_ids( $agency_id = null ) {
        if ( null == $agency_id ) {
            $agency_id = get_the_ID();
        }

        $agent_ids_array = array();
        $args = array(
            'post_type'         => 'houzez_agent',
            'posts_per_page'    => -1,
            'meta_query'        => array(
                array(
                    'key'       => 'fave_agent_agencies',
                    'value'     => $agency_id,
                    'compare'   => '=',
                ),
            ),
        );

        $agency_agents = new WP_Query( $args );

        if( $agency_agents->have_posts() ):
            while( $agency_agents->have_posts() ):
                $agency_agents->the_post();

                    $agent_ids_array[] = get_the_ID();
            endwhile;
        endif;
        Houzez_Query::loop_reset();

        return $agent_ids_array;
    }

    /**
     * Gets agency agents
     *
     * @access public
     * @param null|int $post_id
     * @return WP_Query
     */
    public static function get_agency_agents( $agency_id = null ) {
        if ( null == $agency_id ) {
            $agency_id = get_the_ID();
        }

        $args = array(
            'post_type'         => 'houzez_agent',
            'posts_per_page'    => -1,
            'meta_query'        => array(
                array(
                    'key'       => 'fave_agent_agencies',
                    'value'     => $agency_id,
                    'compare'   => '=',
                ),
            ),
        );

        return new WP_Query( $args );
    }

    /**
     * Gets all agents
     *
     * @access public
     * @param int $count
     * @return WP_Query
     */
    public static function get_agents( $count = -1) {
        $args = array(
            'post_type'         => 'agent',
            'posts_per_page'    => $count,
        );

        return new WP_Query( $args );
    }

    /**
     * Sets agency agents properties into loop
     *
     * @access public
     * @param null|int $agent_ids
     * @return WP_Query
     */
    public static function loop_get_agency_agents_properties( $agent_ids = null ) {
        if ( null == $agent_ids ) {
            return;
        }

        $args = array(
            'post_type'         => 'property',
            'posts_per_page'    => -1,
            'meta_query'        => array(
                array(
                    'key'       =>  'fave_agents',
                    'value'     => $agent_ids,
                    'compare'   => 'IN',
                ),
            ),
        );

        return new WP_Query( $args );
    }

    /**
     * Sets agency properties into loop
     *
     * @access public
     * @param null|int $post_id
     * @return void
     */
    public static function loop_agency_properties( $agency_id = null ) {
        if ( null == $agency_id ) {
            $agency_id = get_the_ID();
        }

        global $paged;
        if ( is_front_page()  ) {
            $paged = (get_query_var('page')) ? get_query_var('page') : 1;
        }

        $agency_listing_args = array(
            'post_type' => 'property',
            'posts_per_page' => 9,
            'paged' => $paged,
            'meta_query' => array(
                array(
                    'key' => 'fave_property_agency',
                    'value' => $agency_id,
                    'compare' => '='
                )
            )
        );

        $agency_qry = new WP_Query( $agency_listing_args );
        return $agency_qry;
    }

    /**
     * Sets agent properties into loop
     *
     * @access public
     * @param null|int $post_id
     * @return void
     */
    public static function loop_agent_properties( $agent_id = null ) {
        if ( null == $agent_id ) {
            $agent_id = get_the_ID();
        }

        $args = array(
            'post_type'         => 'property',
            'posts_per_page'    => -1,
            'meta_query'        => array(
                array(
                    'key'       =>  'fave_agents',
                    'value'     => $agent_id,
                    'compare'   => '=',
                ),
            ),
        );

        query_posts( $args );
    }


    /**
     * Resets current query
     *
     * @access public
     * @return void
     */
    public static function loop_reset() {
        wp_reset_query();
    }

    /**
     * Resets current query postdata
     *
     * @access public
     * @return void
     */
    public static function loop_reset_postdata() {
        wp_reset_postdata();
    }

    /**
     * Checks if there is another post in query
     *
     * @access public
     * @return bool
     */
    public static function loop_has_next() {
        global $wp_query;

        if ( $wp_query->current_post + 1 < $wp_query->post_count ) {
            return true;
        }

        return false;
    }
}