<?php
if (!defined("IN_ESOTALK")) exit;
 
 ET::$pluginInfo["HideTag"] = array(
	"name" => "HideTag",
	"description" => "Enable [hide], [hide=100], [groups=1,4], [users=Toby,Tristan] and [visitor] tags to hide content.",
	"version" => "1.0.0",
	"author" => "Firestarter",
	"authorURL" => "http://ifirestarter.ru",
	"license" => "GPLv2"
);

class ETPlugin_HideTag extends ETPlugin {

	public function handler_conversationController_renderBefore($sender){
		$sender->addCssFile($this->resource("hide.css"));
	}
	
	public function handler_memberController_renderBefore($sender){
		$this->handler_conversationController_renderBefore($sender);
	}
	
	public function handler_format_format( $sender ){

		//[hide]Hello word[/hide]
		$regexp = '!\[hide\](.*?)\[/hide\]!s';
		while (preg_match($regexp, (string) $sender->content)) {
			if (ET::$session->userId) {
				$sender->content = preg_replace($regexp,
					"$1</p>", $sender->content);
			} else {
				$sender->content = preg_replace($regexp,
				"<div class=\"hiddenContent\">".T("hidden.YouMustBeLoggedIn")."</div>", $sender->content);
			}
			
		}
		
		//[hide=100]Hello word[/hide]
		$regexp = '!\[hide\=([0-9]+)\](.*?)\[/hide\]!s';
		while (preg_match($regexp, (string) $sender->content, $matches)) {
			if (ET::$session->userId AND ET::$session->user['countPosts']  >= (int)$matches[1] OR ET::$session->user['account']=='administrator' OR ET::$session->user['account']=='moderator') {
				$sender->content = preg_replace($regexp,
					"$2</p>", $sender->content);
			}else{
				$sender->content = preg_replace($regexp,
					"<div class=\"hiddenContent\">".T("hidden.YouMustHavePosts")."</div>", $sender->content);
			}
			
		}
		
		//[groups=1,4]Hello word[/groups];
		$regexp = '!\[groups\=([a-zA-Z0-9-+.,_ ]+)\](.*?)\[/groups\]!s';
		$groups = array();
		while (preg_match($regexp, (string) $sender->content, $matches)) {
			$groups = explode(',',(string) $matches[1]); 
			if (ET::$session->user['account']=='administrator' OR ET::$session->user['account']=='moderator' OR count(array_intersect($groups,ET::$session->getGroupIds())) >0 ) {
				$sender->content = preg_replace($regexp,
					"$2</p>", $sender->content);
			} else {
				$sender->content = preg_replace($regexp,
					"<div class=\"hiddenContent\">".T("hidden.YouMustBeInGroups")."</div>", $sender->content);
			}
			
		}
		
		//[users=Toby,Tristan]Hello word[/users]
		$regexp = '!\[users\=([a-zA-Z0-9-+.,_ ]+)\](.*?)\[/users\]!s';
		$users = array();
		while (preg_match($regexp, (string) $sender->content, $matches)) {
			$users = explode(',',(string) $matches[1]); 
			if (ET::$session->user['account']=='administrator' OR ET::$session->user['account']=='moderator' OR in_array(ET::$session->user['username'],$users)) {
				$sender->content = preg_replace($regexp,
					"$2</p>", $sender->content);
			} else {
				$sender->content = preg_replace($regexp,
					"<div class=\"hiddenContent\">".T("hidden.ContentForUsers")."</div>", $sender->content);
			}
			
		}

		//Hello, [visitor][/visitor]!
		$regexp = '!\[visitor\]\[/visitor\]!s';
		while (preg_match($regexp, (string) $sender->content, $matches)) {			
			$sender->content = preg_replace($regexp,
				'<strong>'.ET::$session->user['username']."</strong></p>", $sender->content);			
		}			
		
	}
}

?>
