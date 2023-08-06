/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


var ETBBCodes = {
initadmin: function() { 
    $(".popupWrapper").each(function() {
		var item = $(this).find('.button').last();
                item.tooltip();
                item.click(function(e) {
                if (!confirm(T("message.confirmDelete")))
                        {
                         e.preventDefault();
                         return;
                        }
		return;
	});
	});
},
        
init: function() {
     $("form").ajaxForm("save",function(fields) { ETBBCodes.querysubmit(fields);}); 
	$("input[name=cancel]").click(function(e) {
		e.preventDefault();
		$(window).unbind("beforeunload.ajax");
        	window.location = ET.webPath + "/?p=admin/advancedbbcode/";
		return;
	});     
},
        
querysubmit: function(fields) {
                $.ETAjax({
                        id: "validate_bb",
                        url: "admin/advancedbbcode/create/",
                        data: fields,
                        type: "POST",
                        global: true,
                        success: function(data) {
                                 ETBBCodes.processanswer(data);
                        }
                });
            },
            
processanswer: function(data) {
                    if (data.confirmwarning==1) {
                        if (confirm(T("message.tplBBWarning")))
                        {
                            $("form input").prepend('<input type="hidden" value="1" name="warning_confirmed">');
                            $("form").submit();
                        }
                    }
                    if (data.error)
                        {
                            alert(T(data.error));
                        }
                    if (data.result==1)
                        {
                            alert(T("AdvancedBBCode.BBCODE_SAVED"));
                            $(window).unbind("beforeunload.ajax");
                            window.location = ET.webPath + "/?p=admin/advancedbbcode/";                            
                        }
            }          
};