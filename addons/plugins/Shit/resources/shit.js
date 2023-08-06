$(function() {
	ETConversation.toggleshit = function() {
		$("#control-shit span").html(T($("#control-shit span").html() == T("Feature it") ? "Un-feature it" : "Feature it"));
		$.ETAjax({
			url: "conversation/shit.ajax/" + ETConversation.id,
			success: function(data) {
				$("#conversationHeader .labels").html(data.labels);
			}
		});
	};

	$("#control-shit").click(function(e) {
		e.preventDefault();
		ETConversation.toggleshit();
	});

});
