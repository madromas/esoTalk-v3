/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


var ETBBCodes = {
init: function() {
		
	$('body').on('click', '.edit:not(#reply) ul.abbcodelist li', function(e) {
		e.preventDefault();
		ETBBCodes.fixedLangSel(this);
	});
	
	$("#reply ul.abbcodelist li").on("click", function(e) {
		e.preventDefault();
		ETBBCodes.fixedLangSel(this);
	});	
},
fixedLangSel: function(e) {
	var e = $(e);
	var id = e.parent().data('id');
	var lang = $.trim(e.children('a:first').text());
	ETConversation.wrapText($("#"+id+" textarea"), "["+lang+"]", "[/"+lang+"]");
	
	BBCode.hideList(id);
},
hideList: function(id) {
	var list = $("#"+id+" .abbcodelist");
	if (list.length) {
		list.hide();
	}
}
};
$(function() {
	ETBBCodes.init();
});