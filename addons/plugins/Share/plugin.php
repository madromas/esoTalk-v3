<?php
// Copyright 2014 Tristan van Bokkem

if (!defined("IN_ESOTALK")) exit;

ET::$pluginInfo["Share"] = array(
	"name" => "Share",
	"description" => "Share conversations with Facebook, Twitter and Google+.",
	"version" => "1.1.0",
	"author" => "Tristan van Bokkem",
	"authorEmail" => "tristanvanbokkem@gmail.com",
	"authorURL" => "http://www.bitcoinclub.nl",
	"license" => "GPLv2"
);

class ETPlugin_Share extends ETPlugin {

	// Add the Share controls CSS/JS to the conversation view.
	public function handler_conversationController_renderBefore($sender)
	{
		$sender->addCSSFile($this->resource("share.css"));
		$sender->addJSFile($this->resource("share.js"));
		$sender->addJSLanguage("Share");
	}

	// Display the Share controls above the scrubber.
	
// Title
//   ".$data["conversation"]["title"]."

// Url
//  ".URL(conversationURL($data["conversation"]["conversationId"], $data["conversation"]["title"]), true)."	
	
	public function handler_conversationController_renderScrubberBefore($sender, $data)
	{
		$controls = "<ul id='conversationShareControls'>
						<li><a href='https://www.facebook.com/sharer/sharer.php?u=".URL(conversationURL($data["conversation"]["conversationId"], $data["conversation"]["title"]), true)."' target='_blank'><i class='icon-facebook'></i><span>".T("Share on")." Facebook</span></a></li>
						
						<li><a href='https://twitter.com/share?text=".$data["conversation"]["title"]."&url=".URL(conversationURL($data["conversation"]["conversationId"], $data["conversation"]["title"]), true)."' target='_blank'><i class='icon-twitter'></i><span>".T("Share on")." Twitter</span></a></li>
						
						<li><a href='https://www.linkedin.com/sharing/share-offsite/?url=".URL(conversationURL($data["conversation"]["conversationId"], $data["conversation"]["title"]), true)."' target='_blank'><i class='icon-linkedin'></i><span>".T("Share on")." LinkedIn</span></a></li>
					
					<li><a href='//www.pinterest.com/pin/create/button/?url=".URL(conversationURL($data["conversation"]["conversationId"], $data["conversation"]["title"]), true)."&description=".$data["conversation"]["title"]."' target='_blank'><i class='icon-pinterest'></i><span>".T("Share on")." Pinterest</span></a></li>
					
					<li><a href='https://reddit.com/submit?url=".URL(conversationURL($data["conversation"]["conversationId"], $data["conversation"]["title"]), true)."&title=".$data["conversation"]["title"]."' target='_blank'><i class='fab fa-reddit'></i><span>&nbsp;&nbsp;".T("Share on")." Reddit</span></a></li>
					</ul>";

		echo $controls;
	}
}