
$(document).ready(function () {

    var MORE_SETTINGS_DIV_HIDDEN = true;
    var everySpesificHourDetail_HIDDEN = true;
    $('#showMoreSettings').click(function () {

        if (MORE_SETTINGS_DIV_HIDDEN === true) {

            MORE_SETTINGS_DIV_HIDDEN = false;
            $(this).html(' Least Settings');
            $('.moreSettingsDiv').removeClass('hidden');
        } else {

            MORE_SETTINGS_DIV_HIDDEN = true;
            $(this).html(' More Settings');
            $('.moreSettingsDiv').addClass('hidden');
        }

    });

    $('#message_publish_type').change(function () {

        var publish_type_value = $(this).val();

        $('.publishTypeExtraDivs').addClass('hidden');
        $('.select_days_extra_div').addClass('hidden');
        $('.timeLenghtDiv').removeClass('hidden');
        
        if (publish_type_value === 'spesificTime') {

            $('.spesificTimeExtraDivs').removeClass('hidden');

        } else if (publish_type_value === 'everySpesificHour') {
            
            $('.everySpesificHourExtraDivs').removeClass('hidden');
        }
    });
    $( "#message_publish_type" ).trigger( "change" );

    if (typeof isLoginPage !== 'undefined') {

        if (isLoginPage === true) {

            $('#clientTimeOffset').val(new Date().getTimezoneOffset());
        }
    }
    
    $('input[name="spesificTime[day_filter]"]').change(function(){
        
        var day_filter_value = $(this).val();
        $('.select_days_extra_div').addClass('hidden');
        
        if(day_filter_value === 'select_days'){
            
            $('.select_days_extra_div').removeClass('hidden');
        }
    });

    $('input[name="smsUsers"]').change(function(){
        var sms_users_value = $(this).val();
        $('.select_sms_users_extra_div').addClass('hidden');

        if(sms_users_value === 'select_users'){

            $('.select_sms_users_extra_div').removeClass('hidden');
        }
    });
    
    
    $('#runBoxDemo').click(function(){
        var message_box_text = $('#message_box_text').val();
        var message_box_layout = $('#message_box_layout').val();
        var message_box_type = $('#message_box_type').val();
        
        var noty_detail = {
            text : message_box_text,
            layout: message_box_layout,
            type : message_box_type
        };
        noty(noty_detail);
    });
    
    /*
     * top menü  için otomatik active ekleme
     */
    var windowUrl =  location.href;
    $("a[href='"+windowUrl+"']").parent().addClass("active").parent().parent().addClass('open').addClass('active');
});