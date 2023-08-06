$(function() {
	
	$(".likes a").tooltip();
	
	if (ET.likePaneSlide) {
		$(document).on("click", ".postHeader", function(e) {
			if (!$(e.target).parents(".controls").length && !$(e.target).parents(".info").length) $(this).siblings(".postFooter").find(".likes").slideDown("fast");
		});
	}
	
	$(document).on("click", ".likes .showMore", function(e) {
		e.preventDefault();
		ETSheet.loadSheet("onlineSheet", "conversation/liked.view/"+$(this).parents(".post").data("id")+"/"+$(this).data("type"));
	});

	$(document).on("click", ".likes .like-button, .likes .dislike-button, .likes .unlike-button", function(e) {
		e.preventDefault();
		var area = $(this).parents(".likes");
		var action = 'like';
		if ($(this).hasClass("dislike-button")) action = 'dislike';
		else if ($(this).hasClass("unlike-button")) action = 'unlike';
		
		$.ETAjax({
			url: "conversation/"+action+".json/"+area.parents(".post").data("id"),
			success: function(data) {
				if (data.likes) area.before(data.likes).remove();
			}
		})
	});

});
