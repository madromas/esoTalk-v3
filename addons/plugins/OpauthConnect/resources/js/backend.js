/**
 * OpauthConnect
 * 
 * @copyright Copyright © 2012 Oleksandr Golubtsov
 * @license   GPLv2 License
 * @package   OpauthСonnect
 * 
 * This file is part of OpauthСonnect plugin. Please see the included license file for usage information
 */

$(document).ready(function() {
    $(".settings-accounts .account-unlink a").click(function() {
        return confirm($(this).siblings("span").text()) ? true : false;
    })
    
    $("body").on("click", ".opauth-settings .category-toggle", function() {
        $(this).children("span").toggle();
        $(this).siblings(".category-settings").slideToggle();
    })
    
    $("body").on("click", ".opauth-settings :checkbox:not(.static)", function() {
        toggleFields(this);
        $(this).parent().siblings("div:not(.disabled)").find(":input:first").focus();
    })
});

function toggleFields(checkbox) {
    if($(checkbox).is(":checked")) {
        $(checkbox).parent().siblings("div").removeClass('disabled').find(":input").removeAttr("disabled");
    }
    else {
        $(checkbox).parent().siblings("div").addClass('disabled').find(":input").attr("disabled", 'disabled').removeAttr('value');
    }
}