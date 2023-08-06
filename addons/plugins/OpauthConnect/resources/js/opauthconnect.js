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
    $(".advanced-info-button a").click(function() {
        $(this).children("span").toggle();
        $(this).parents("li").toggleClass("opened")
                             .siblings(".advanced-info").toggle();
        return false;
    })    
    
    $(".generate-password input[type=\"checkbox\"]").click(function() {
        if(typeof $(this).attr("checked") == 'undefined') {
            $(".advanced-info-password input").val('');
        }
        $(".advanced-info-password input").attr("disabled", function(idx, oldAttr) {
            return !oldAttr;
        })
        $(".advanced-info-password:first input").focus();
    })
    
    $(".generate-password-label").click(function() {
        $(this).siblings().children("input").click();
    })
    
    if($(".advanced-info-button").hasClass("show_password")) {
        $(".generate-password input[type=\"checkbox\"]").click();
    }
    $(".advanced-info-button.show_password a").click();
    
    $("body").on("click", "div#remember-container a", function() {
        var _this = $(this);
        $.ajax({
            url: ET.webPath + "/user/social/remember",
            data: {remember: _this.children("i").hasClass("icon-check-empty") ? 1 : 0},
            type: "POST",
            success: function() {
                _this.toggleClass("button-pressed")
                     .children("i").toggleClass("icon-check-empty icon-check");
            }
        })
        return false;
    })
});