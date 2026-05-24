<?php

if (!defined("IN_ESOTALK")) exit;

ET::$pluginInfo["EmoticonsPlus"] = array(
	"name" => "EmoticonsPlus",
	"description" => "Extends Emoticons plugin with an add emoticon button on the formatting toolbar.",
	"version" => "1.0",
	"author" => "MadRomas",
	"authorEmail" => "madromas@yahoo.com",
	"authorURL" => "https://madway.net",
	"license" => "GPLv2"
);

class ETPlugin_EmoticonsPlus extends ETPlugin {

	private $icons;
    private $iscon;

/**
 * Class constructor.
 *
 * @return void
 */
public function __construct($rootDirectory = 0)
{
	parent::__construct($rootDirectory);
	$this->icons = [
    ":)" => "🙂", ":-)" => "🙂", "=)" => "🙂",
    ":D" => "😀", ":-D" => "😀", "=D" => "😀",
    ";)" => "😉", ";-)" => "😉",
    ":(" => "☹️", ":-(" => "☹️", "=(" => "☹️",
    "T_T" => "😭", ";_;" => "😭",
    "o_O" => "😲", "O_o" => "😲",
    ":P" => "😛", ":-P" => "😛", "=P" => "😛",
    ":)" => "🙂", ":heart:" => "❤️",
    ":laugh:" => "😂", ":rofl:" => "🤣",
    ":thumbsup:" => "👍", ":fire:" => "🔥",
    ":thinking:" => "🤔", ":eyeroll:" => "🙄",
    ":cry:" => "😢", ":heart_eyes:" => "😍",
    ":angry:" => "😡", ":sad:" => "😔",
    ":wow:" => "😮", ":grin:" => "😁",
    ":cool:" => "😎", ":shrug:" => "🤷"
];
}

/**
 * Add an event handler to the "getEditControls" method of the conversation controller to add BBCode
 * formatting buttons to the edit controls.
 *
 * @return void
 */
public function handler_conversationController_getEditControls($sender, &$controls, $id)
{

	addToArrayString($controls, "smileys", "<a href='javascript:EmoticonAdv.showDropDown(\"$id\");void(0)' title='".T("Smileys")."' class='control-smile'><i class='icon-smile'></i></a>", 0);
}
// Not working for some reason, or is it?
//addToArrayString($controls, "smileys", "<a href='javascript:EmoticonAdv.showDropDown(\"$id\");void(0)' title='".T("Smileys")."' class='control-smile'><i class='icon-smile'></i></a>", 0);

public function handler_conversationController_renderBefore($sender)
{
	$sender->addJSFile($this->Resource("emoticon.js"));
	$sender->addCSSFile($this->Resource("emoticon.css"));
    $this->iscon = true;
    
}

public function handler_memberController_renderBefore($sender)
{
	$this->handler_conversationController_renderBefore($sender);
}

public function handler_pageEnd(){
    if($this->iscon){
        $div = "<div id='emoticonDropDown' style='display: none;'><div><ul>";
        
        foreach(array_unique($this->icons) as $shortcut => $emoji){
            $alt = htmlentities($shortcut, ENT_QUOTES);
            // Added EmoticonAdv.hideDropDown(); to the click action
            $jsAction = "javascript:EmoticonAdv.insertSmiley('".str_replace("'","\'",$shortcut)."');EmoticonAdv.hideDropDown();void(0)";
            
            $div .= "<li><a href=\"$jsAction\" title=\"$alt\">{$emoji}</a></li>";
        }
        
        $div .= "</ul></div></div>";
        echo $div;
    }
}

public function handler_format_format($sender)
{
    $from = $to = array();
    foreach ($this->icons as $k => $v) {
        $quoted = preg_quote(sanitizeHTML($k), "/");
        $from[] = "/(?<=^|[\s.,!<>]){$quoted}(?=[\s.,!<>)]|$)/i";
        // Wrap in a span so we can target it with CSS
        $to[] = "<span class='post-emoji'>$v</span>";
    }
    $sender->content = preg_replace($from, $to, $sender->content);
}

}