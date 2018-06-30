jQuery(document).ready(function($){
    $("#lspt_lead_gen_submit").click(function(e){

        e.preventDefault();
        var error = false;
        if( $("#lspt_lead_gen_form")[0].checkValidity ){
            if (!$("#lspt_lead_gen_form")[0].checkValidity()) {
                error = true;
                return false;
            }
        }

        if( error === false ) {
            var name = $('#lspt_lead_name').val();
            var phone = $('#lspt_lead_phone_number').val();
            var email = $('#lspt_lead_email').val();
            var budget = $('#lspt_lead_budget').val();
            var message = $('#lspt_lead_message').val();
            var date = $('#lspt_lead_date').val();
            var time = $('#lspt_lead_time').val();
            var data = {
                            action 	: 'lspt_insert_lead',
                            name	: name,
                            phone	: phone,
                            email	: email,
                            budget	: budget,
                            message	: message,
                            date        : date,
                            time        : time
                        };

            jQuery.post( LSPT.ajaxurl, data, function( response ) {
                var response_data = jQuery.parseJSON(response);
                if(response_data['success']){
                    $('.lspt-message').html(response_data['success']);
                    $("#lspt_lead_gen_submit").off('click');
                    $('#lspt_lead_name').val('');
                    $('#lspt_lead_phone_number').val('');
                    $('#lspt_lead_email').val('');
                    $('#lspt_lead_budget').val('');
                    $('#lspt_lead_message').val('');
                }
            });
        }
    });
});