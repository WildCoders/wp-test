<?php

global $post;

$customer_email     = get_post_meta( $post->ID, LSPT_META_PREFIX.'email', true );
$customer_budget    = get_post_meta( $post->ID, LSPT_META_PREFIX.'budget', true );
$customer_phone     = get_post_meta( $post->ID, LSPT_META_PREFIX.'phone', true );
$customer_date      = get_post_meta( $post->ID, LSPT_META_PREFIX.'date', true );
$customer_time      = get_post_meta( $post->ID, LSPT_META_PREFIX.'time', true );

?>
<table>
    <tr>
        <th><?= __('Phone Number', 'lspt'); ?></th>
        <td><input type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="lspt_lead_phone_number" id="lspt_lead_phone_number" class="lspt-lead-phone-number" value="<?= $customer_phone ?>"></td>
    </tr>
    <tr>
        <th><?= __('Email Address', 'lspt'); ?></th>
        <td><input type="email" name="lspt_lead_email" id="lspt_lead_email" class="lspt-lead-email" value="<?= $customer_email ?>"></td>
    </tr>
    <tr>
        <th><?= __('Desired Budget', 'lspt'); ?></th>
        <td><input type="number" name="lspt_lead_budget" id="lspt_lead_budget" class="lspt-lead-budget" value="<?= $customer_budget ?>"></td>
    </tr>
    <tr>
        <th><?= __('Date Inserted', 'lspt'); ?></th>
        <td><input type="date" name="lspt_lead_date" id="lspt_lead_date" class="lspt-lead-date" value="<?= $customer_date ?>"></td>
    </tr>
    <tr>
        <th><?= __('Time Inserted', 'lspt'); ?></th>
        <td><input type="text" name="lspt_lead_time" id="lspt_lead_time" class="lspt-lead-time" value="<?= $customer_time ?>"></td>
    </tr>
</table>