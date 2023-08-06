<?php
// Copyright 2014 Shaun Merchant, Tristan van Bokkem

if (!defined("IN_ESOTALK")) exit;

ET::$pluginInfo["ConversationStatus"] = array(
	"name" => "Conversation Status",
	"description" => "Allow those who can moderate to set a status to conversations.",
	"version" => "0.5.1",
	"author" => "Shaun Merchant",
	"authorEmail" => "shaun@gravitygrip.co.uk ",
	"authorURL" => "http://www.gravitygrip.co.uk/",
	"license" => "GPLv2"
);

class ETPlugin_ConversationStatus extends ETPlugin {



public function setup($oldVersion = "")
    {
        $structure = ET::$database->structure();
        $structure->table("conversation")->column("status", "int(11) unsigned")->exec(false);
        return true;
    }



	public function init() {
		ET::conversationModel();
		ETConversationModel::addLabel("none", "IF(c.status = NULL,1,0)");
		ETConversationModel::addLabel("added", "IF(c.status = 1,1,0)", "icon-check");
		ETConversationModel::addLabel("considered", "IF(c.status = 2,1,0)","icon-question-sign");
		ETConversationModel::addLabel("rejected", "IF(c.status = 3,1,0)","icon-thumbs-down");
		ETConversationModel::addLabel("fixed", "IF(c.status = 4,1,0)","icon-cogs");
		ETConversationModel::addLabel("inprogress", "IF(c.status = 5,1,0)","icon-wrench");
		ETConversationModel::addLabel("nobug", "IF(c.status = 6,1,0)","icon-thumbs-up");
		ETConversationModel::addLabel("highpriority", "IF(c.status = 7,1,0)","icon-circle");
		ETConversationModel::addLabel("lowpriority", "IF(c.status = 8,1,0)","icon-circle-blank");

		ET::define("label.none", "No Status");
		ET::define("label.added", "Added");
		ET::define("label.considered", "Considered");
		ET::define("label.rejected", "Rejected");
		ET::define("label.fixed", "Fixed");
		ET::define("label.inprogress", "In Progress");
		ET::define("label.nobug", "Not a Bug");
		ET::define("label.highpriority", "High Priority");
		ET::define("label.lowpriority", "Low Priority");
	}

	public function handler_renderBefore($sender) {
		$sender->addCSSFile($this->resource("status.css"));
		
		}

public function handler_conversationController_renderBefore($sender)
    {
       $sender->addJSFile($this->resource("status.js"));
		$sender->addJSLanguage("Status");
    }

	public function handler_conversationController_renderScrubberBefore($sender, $data) {
		if(!ET::$session->user) return;
		if($data["conversation"]["canModerate"]) {
			$status = array(
				0 => T("None"),
				1 => T("Added"),
				2 => T("Considered"),
				3 => T("Rejected"),
				4 => T("Fixed"),
				5 => T("In Progress"),
				6 => T("No Bug"),
				7 => T("High Priority"),
				8 => T("Low Priority")
			);
			$status_icons = array(
				0 => "warning-sign",
				1 => "check",
				2 => "question-sign",
				3 => "thumbs-down",
				5 => "wrench",
				4 => "cogs",
				6 => "thumbs-up",
				7 => "circle",
				8 => "circle-blank"
			);
			$status_seperators = array(
				0 => true,
				3 => true,
				6 => true
			);
			$max = sizeof($status);
			$controls = "<ul id='conversationStatusControls' class='statuscontrols'>";
			for($i = 0; $i < $max; $i++) {
				$controls = $controls . "<li><a href='". URL("conversation/status/". $data["conversation"]["conversationId"] .
											"?status=". $i .
											"&token=". ET::$session->token .
											"&return=". urlencode(ET::$controller->selfURL)) .
											"' title='". T($status[$i]) ."'>
									<i class='icon-". $status_icons[$i] ."'></i>
									<span>". $status[$i] . "</span>
								</a></li>";
			}
			echo $controls . "</ul>";
		} else {
			return;
		}
	}

	public function action_conversationController_status($controller, $conversationId = false) {
		
		if (!$controller->validateToken())
        return;

		$conversation = ET::conversationModel()->getById((int)$conversationId);

		if(!$conversation || !$conversation["canModerate"]) {
			$sender->renderMessage(T("Error"), T("message.noPermission"));
			return false;
		}

		$model = ET::conversationModel();
		$model->updateById($conversationId, array("status" => $_GET["status"]));

		redirect(URL(R("return", conversationURL ($conversationId))));
	}

	function setistaatust(&$conversation, $memberId, $unfinished)
	{
		$unfinished = (bool)$unfinished;
		$model = ET::conversationModel();
		$model->setStatus($conversation["conversationId"], $memberId, array("unfinished" => $unfinished));	#conversationModel
		$model->addOrRemoveLabel($conversation, "unfinished", $unfinished);					#conversationModel
		$conversation["unfinished"] = $unfinished;
	}

	function addOrRemoveLabel(&$conversation, $label, $add = true)
	{
        	if ($add and !in_array($label, $conversation["labels"]))
                	$conversation["labels"][] = $label;
        	elseif (!$add and ($k = array_search($label, $conversation["labels"])) !== false)
                	unset($conversation["labels"][$k]);
	}

}