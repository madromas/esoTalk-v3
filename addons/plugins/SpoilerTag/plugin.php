<?php
if (!defined("IN_ESOTALK")) exit;
 
 ET::$pluginInfo["SpoilerTag"] = array(
	"name" => "SpoilerTag",
	"description" => "Enable [spoiler] and [nsfw] tag to hide spoilers.",
	"version" => "1.0.2",
    "author" => "esoTalk Team",
    "authorEmail" => "5557720max@gmail.com",
    "authorURL" => "https://github.com/phpSoftware/esoTalk-v2/",
	"license" => "GPLv2"
);

class ETPlugin_SpoilerTag extends ETPlugin {

	public function handler_conversationController_renderBefore($sender){
			$sender->addCSSFile($this->resource("spoiler.css"));
			$sender->addJSFile($this->resource("spoiler.js"));
	}
	
	public function handler_memberController_renderBefore($sender){
		$this->handler_conversationController_renderBefore($sender);
	}
	
	public function handler_format_format( $sender ){
		// Spoiler - [spoiler:title]text[/spoiler]
		$regexp = "/(.*?)\n?\[spoiler(?:(?::|=)(.*?)(]?))?\]\n?(.*?)\n?\[\/spoiler\]\n{0,2}/is";
		while (preg_match($regexp, $sender->content)) {
			$sender->content = preg_replace($regexp,
				"$1</p><div class=\"spoiler\"><span class=\"button\">".T("Spoiler!")."</span> &nbsp; <span>$2$3</span><div class=\"content\">$4</div></div><p>", $sender->content);
		}
		
		// NSFW - [nsfw:title]text[/nsfw]
		$regexp = "/(.*?)\n?\[nsfw(?:(?::|=)(.*?)(]?))?\]\n?(.*?)\n?\[\/nsfw\]\n{0,2}/is";
		while (preg_match($regexp, $sender->content)) {
			$sender->content = preg_replace($regexp,
				"$1</p><div class=\"nsfw\"><span class=\"button\">".T("NSFW")."</span> &nbsp; <span>$2$3</span><div class=\"content\">$4</div></div><p>", $sender->content);
		}
	}
	
	/**
	 * Add an event handler to the "getEditControls" method of the conversation controller to add Spoiler bbcode
	 *
	 * @return void
	 */
	public function handler_conversationController_getEditControls($sender, &$controls, $id)
	{
		addToArrayString($controls, "spoiler", "<a href='javascript:SpoilerTag.spoiler(\"$id\");void(0)' title='".T("Spoiler")."' class='control-spoiler'><i class='icon-off'></i></a>", 0);
		addToArrayString($controls, "nsfw", "<a href='javascript:SpoilerTag.nsfw(\"$id\");void(0)' title='".T("NotSafeForWork")."' class='control-nsfw'><i class='icon-eye-close'></i></a>", 0);	
	}
}

?>
