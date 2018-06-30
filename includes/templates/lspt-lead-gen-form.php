<?php

if( !defined('ABSPATH') )
    exit;

$date_now = date( 'd-m-Y' );
$time_now = date( 'h:i a' );

if( !empty( $max_length_name ) ) {
    $name_maxlength = 'maxlength="' . $max_length_name . '"';
}

if( !empty( $max_length_phone ) ) {
    $phone_maxlength = 'maxlength="' . $max_length_phone . '"';
}

if( !empty( $max_length_email ) ) {
    $email_maxlength = 'maxlength="' . $max_length_email . '"';
}

if( !empty( $max_length_budget ) ) {
    $budget_maxlength = 'maxlength="' . $max_length_budget . '"';
}

if( !empty( $max_length_message ) ) {
    $message_maxlength = 'maxlength="' . $max_length_message . '"';
}

// Make API Call for getting current date & time
$api_url = add_query_arg( array( 
                                    'key' => LSPT_DATE_TIME_API_KEY, 
                                    'format' => 'json',
                                    'country' => 'US',
                                    'zone'  => 'America/New_York'
                                ), LSPT_DATE_TIME_API_URI );

$api_response = wp_remote_get( $api_url );
if ( is_array( $api_response ) && !is_wp_error( $api_response ) ) {

    $body = json_decode($api_response['body']); // use the content
    $response_timestamp = $body->zones[0]->timestamp;
    $date_now = date('Y-m-d', $response_timestamp);
    $time_now = date('h:i a', $response_timestamp);
}
?>
<div class="lspt-message"></div>
<form id="lspt_lead_gen_form">
    <table>
        <tr>
            <th colspan="2"><?= _e('Lead Generation Form', 'lspt'); ?></th>
            <input type="hidden" name="lspt_lead_date" id="lspt_lead_date" value="<?= $date_now ?>">
            <input type="hidden" name="lspt_lead_time" id="lspt_lead_time" value="<?= $time_now ?>">
        </tr>
        <tr>
            <th><?= $label_name ?><span class="lspt-required"> *</span></th>
            <td><input type="text" name="lspt_lead_name" id="lspt_lead_name" required="required" class="lspt-lead-name" <?= $name_maxlength ?>></td>
        </tr>
        <tr>
            <th><?= $label_phone ?><span class="lspt-required"> *</span></th>
            <td><input type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required="required" name="lspt_lead_phone_number" id="lspt_lead_phone_number" class="lspt-lead-phone-number" <?= $phone_maxlength ?>></td>
        </tr>
        <tr>
            <th><?= $label_email ?><span class="lspt-required"> *</span></th>
            <td><input type="email" name="lspt_lead_email" id="lspt_lead_email" required="required" class="lspt-lead-email" <?= $email_maxlength ?>></td>
        </tr>
        <tr>
            <th><?= $label_budget ?><span class="lspt-required"> *</span></th>
            <td><input type="number" name="lspt_lead_budget" id="lspt_lead_budget" required="required" class="lspt-lead-budget" <?= $budget_maxlength ?>></td>
        </tr>
        <tr>
            <th><?= $label_message ?><span class="lspt-required"> *</span></th>
            <td><textarea rows="<?= $rows_message ?>" cols="<?= $cols_message ?>" required="required" <?= $message_maxlength; ?> name="lspt_lead_message" id="lspt_lead_message" class="lspt-lead-message"></textarea></td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" class="button button-primary button-large" id="lspt_lead_gen_submit" name="lspt_lead_gen_submit" value="<?= $label_save ?>"></td>
        </tr>
    </table>
</form>