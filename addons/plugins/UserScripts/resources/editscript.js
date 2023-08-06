$(function() {
	
	function getTextarea()
	{
		var elems = document.getElementsByTagName("textarea");
		for (var i = 0; i < elems.length; i++)
		{
			if (elems[i].getAttribute('name') == 'scriptsrc')
			{
				return elems[i];
			}
		}
	}
	
	var scriptType = $('.edit-script-form').attr('data-type');
	var editor = CodeMirror.fromTextArea(getTextarea(), {
		mode: scriptType,
		styleActiveLine: true,
		lineNumbers: true,
		lineWrapping: true,
		autofocus: true,
		indentUnit: 4,
		indentWithTabs: true,
		viewportMargin: Infinity,
		gutters: ["CodeMirror-lint-markers"],
		lint: true
	});
	
	
});
