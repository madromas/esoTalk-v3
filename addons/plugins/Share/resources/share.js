$(function() {
	if ($("#conversationShareControls").length) {
		if($("#conversationControls").length) {
			// Place the share controls below the conversation controls.
			$("#conversationControls").parent().after($("#conversationShareControls").popup({
				alignment: "right",
				class: "share",
				content: "<i class='icon-share'></i> <span class='text'>" + T("Share") + "</span> <i class='icon-caret-down'></i>"
			}).find(".button").addClass("big").end());
		} else {
			$("#conversation .search").after($("#conversationShareControls").popup({
				alignment: "right",
				class: "share",
				content: "<i class='icon-share'></i> <span class='text'>" + T("Share") + "</span> <i class='icon-caret-down'></i>"
			}).find(".button").addClass("big").end());
		}
	}
});
