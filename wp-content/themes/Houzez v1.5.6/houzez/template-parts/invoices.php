<?php
/**
 * Invoices - template/user_dashboard_invoices
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 07/04/16
 * Time: 11:34 PM
 */
global $houzez_local, $dashboard_invoices;
$fave_meta = houzez_get_invoice_meta( get_the_ID() );
$user_info = get_userdata($fave_meta['invoice_buyer_id']);
$invoice_detail = add_query_arg( 'invoice_id', get_the_ID(), $dashboard_invoices );
?>
<tr>
    <td>#<?php echo get_the_ID(); ?></td>
    <td><?php echo get_the_date(); ?></td>
    <td>
        <?php
        $invoice_status = get_post_meta(  get_the_ID(), 'invoice_payment_status', true );
        if( $invoice_status == 0 ) {
            echo $houzez_local['not_paid'];
        } else {
            echo $houzez_local['paid'];
        }
        ?>
    </td>
    <td><?php echo houzez_get_invoice_price( $fave_meta['invoice_item_price'] );?></td>
    <td><a href="<?php echo esc_url($invoice_detail); ?>" class="btn btn-invoice"><?php echo $houzez_local['view_details']; ?></a></td>
</tr>