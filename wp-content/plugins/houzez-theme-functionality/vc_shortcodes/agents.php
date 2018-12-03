<?php
/**
 * Agents Grid and Carousel
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 07/01/16
 * Time: 5:17 PM
 */
if( !function_exists('houzez_agents') ) {
    function houzez_agents($atts, $content = null)
    {
        extract(shortcode_atts(array(
            'agents_type' => '',
            'agent_category' => '',
            'posts_limit' => '',
            'offset' => '',
            'orderby' => '',
            'order' => '',
            'custom_title' => '',
            'custom_subtitle' => ''
        ), $atts));

        ob_start();

        $args = array(
            'post_type' => 'houzez_agent',
            'posts_per_page' => $posts_limit,
            'orderby' => $orderby,
            'order' => $order,
            'offset' => $offset
        );

        if (!empty($agent_category)) {
            $tax_query[] = array(
                'taxonomy' => 'agent_category',
                'field' => 'slug',
                'terms' => $agent_category
            );
            $args['tax_query'] = $tax_query;
        }

        $wp_qry = new WP_Query($args);

        $houzez_local = houzez_get_localization();
        ?>

        <!--start agents module-->
        <?php if ($agents_type == 'grid') { ?>

        <div id="agents-module" class="houzez-module agents-module">
            <div class="agents-blocks-main">
                <div class="row no-margin">
                    <?php
                    if ($wp_qry->have_posts()): while ($wp_qry->have_posts()): $wp_qry->the_post();
                        $des = get_post_meta(get_the_ID(), 'fave_agent_des', true);
                        $position = get_post_meta(get_the_ID(), 'fave_agent_position', true);
                        $company = get_post_meta(get_the_ID(), 'fave_agent_company', true);
                        $logo_id = get_post_meta(get_the_ID(), 'fave_agent_logo', true);

                        if (has_post_thumbnail()) {
                            $img_array = houzez_get_image_url('thumbnail');
                            $agent_photo = $img_array[0];
                        } else {
                            $agent_photo = houzez_get_image_placeholder_url('thumbnail');
                        }

                        ?>

                        <div class="col-md-3 col-sm-6">
                            <div class="agents-block">

                                <figure class="auther-thumb">
                                    <a href="<?php the_permalink(); ?>"
                                       class="view">
                                    <img src="<?php echo esc_url($agent_photo); ?>" class="img-circle" width="150"
                                         height="150" alt="<?php the_title(); ?>">
                                        </a>
                                </figure>


                                <div class="web-logo text-center">
                                    <?php if (!empty($logo_id)) { ?>
                                        <?php echo wp_get_attachment_image($logo_id, 'large'); ?>
                                    <?php } ?>
                                </div>

                                <div class="block-body">
                                    <p class="auther-info">
                                        <span class="blue"><?php the_title(); ?></span>
                                        <?php if( !empty($position) || !empty($company) ) { ?>
                                        <span>
                                            <?php echo esc_attr($position); ?>
                                            <?php if( !empty($company) ) { ?>
                                            , <?php echo esc_attr($company); ?>

                                            <?php } ?>
                                        </span>
                                        <?php } ?>
                                    </p>
                                    <?php if( !empty( $des ) ) { ?>
                                    <p class="description"><?php echo wp_kses_post($des); ?></p>
                                    <?php } ?>
                                    <a href="<?php the_permalink(); ?>"
                                       class="view"><?php echo $houzez_local['view_profile']; ?></a>
                                </div>
                            </div>
                        </div>

                    <?php endwhile; endif; ?>
                    <?php wp_reset_postdata(); ?>
                </div>
            </div>
        </div>

    <?php } elseif ($agents_type == 'Carousel') { ?>

        <div id="agents-carousel-module" class="houzez-module agents-carousel-module">
            <div class="row">
                <div class="col-sm-12">
                    <div class="module-title-nav clearfix">

                        <?php if (!empty($custom_title)) { ?>
                            <div>
                                <h2><?php echo esc_attr($custom_title); ?></h2>
                                <h4 class="sub-title"><?php echo esc_attr($custom_subtitle); ?></h4>
                            </div>
                        <?php } ?>

                        <div class="module-nav">
                            <button
                                class="btn btn-carousel btn-sm btn-prev-agents"><?php echo $houzez_local['prev_text']; ?></button>
                            <button
                                class="btn btn-carousel btn-sm btn-next-agents"><?php echo $houzez_local['next_text']; ?></button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div id="agents-carousel" class="agents-carousel slide-animated owl-carousel owl-theme">

                        <?php
                        if ($wp_qry->have_posts()): while ($wp_qry->have_posts()): $wp_qry->the_post();
                            $des = get_post_meta(get_the_ID(), 'fave_agent_des', true);
                            $position = get_post_meta(get_the_ID(), 'fave_agent_position', true);
                            $company = get_post_meta(get_the_ID(), 'fave_agent_company', true);
                            $logo_id = get_post_meta(get_the_ID(), 'fave_agent_logo', true);

                            if (has_post_thumbnail()) {
                                $img_array = houzez_get_image_url('thumbnail');
                                $agent_photo = $img_array[0];
                            } else {
                                $agent_photo = houzez_get_image_placeholder_url('thumbnail');
                            }
                            ?>
                            <div class="item">
                                <div class="agents-block">
                                    <figure class="auther-thumb">
                                        <a href="<?php the_permalink(); ?>"
                                           class="view">
                                        <img src="<?php echo esc_url($agent_photo); ?>" class="img-circle" width="70"
                                             height="70" alt="<?php the_title(); ?>">
                                        </a>
                                    </figure>

                                        <div class="web-logo text-center">
                                        <?php if (!empty($logo_id)) { ?>
                                             <?php echo wp_get_attachment_image($logo_id, 'large'); ?>
                                        <?php } ?>
                                        </div>

                                    <div class="block-body">
                                        <p class="auther-info">
                                            <span class="blue"><?php the_title(); ?></span>
                                            <span><?php echo esc_attr($position); ?>
                                            <?php if( !empty($company) ) { ?>
                                                , <?php echo esc_attr($company); ?></span>
                                            <?php } ?>
                                        </p>

                                        <p class="description"><?php echo wp_kses_post($des); ?></p>
                                        <a href="<?php the_permalink(); ?>"
                                           class="view"><?php echo $houzez_local['view_profile']; ?></a>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; endif; ?>
                        <?php wp_reset_postdata(); ?>

                    </div>
                </div>
            </div>
        </div>

    <?php } ?>
        <!--end post agents module-->


        <?php
        $result = ob_get_contents();
        ob_end_clean();
        return $result;

    }
    add_shortcode('houzez-agents', 'houzez_agents');
}
?>