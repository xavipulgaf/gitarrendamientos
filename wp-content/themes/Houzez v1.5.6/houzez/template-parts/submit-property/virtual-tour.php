<?php
/**
 * Virtual Tour
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 21/10/16
 * Time: 7:24 PM
 * Since v1.4.4
 */
global $is_multi_steps;
?>
<div class="account-block <?php echo esc_attr($is_multi_steps);?>">
    <div class="add-title-tab">
        <h3><?php esc_html_e( '360° Virtual Tour', 'houzez' ); ?></h3>
        <div class="add-expand"></div>
    </div>
    <div class="add-tab-content">
        <div class="add-tab-row push-padding-bottom">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <textarea class="form-control" name="virtual_tour" id="virtual_tour" rows="6" placeholder="<?php esc_html_e('Enter virtual tour iframe/embeded code', 'houzez');?>"></textarea>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
