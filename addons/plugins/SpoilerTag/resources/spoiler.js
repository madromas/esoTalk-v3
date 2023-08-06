$(document).ready(function() { 
	$(document).on("click",".spoiler span", function(){
		$(this).siblings(".content").slideToggle(400);
	});
	$(document).on("click",".nsfw span", function(){
		$(this).siblings(".content").slideToggle(400);
	});
});

var SpoilerTag = {

spoiler: function(id) {ETConversation.wrapText($("#"+id+" textarea"), "[spoiler]", "[/spoiler]");},
nsfw: function(id) {ETConversation.wrapText($("#"+id+" textarea"), "[nsfw]", "[/nsfw]");},

};