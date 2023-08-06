<?php
// Copyright 2013 Toby Zerner, Simon Zerner
// This file is part of esoTalk. Please see the included license file for usage information.

if (!defined("IN_ESOTALK")) exit;

ET::$pluginInfo["Answers"] = array(
	"name" => "Answers",
	"description" => "Allow posters to mark a reply as having answered their question.",
	"version" => ESOTALK_VERSION,
    "author" => "esoTalk Team",
    "authorEmail" => "5557720max@gmail.com",
    "authorURL" => "https://github.com/phpSoftware/esoTalk-v2/",
	"license" => "GPLv2",
	"dependencies" => array(
		"esoTalk" => "1.0.0g4"
	)
);

class ETPlugin_Answers extends ETPlugin {

	// Setup: add an answered column to the conversation table.
	public function setup($oldVersion = "")
	{
		$structure = ET::$database->structure();
		$structure->table("conversation")
			->column("answered", "int(11) unsigned")
			->exec(false);

		return true;
	}

	public function init()
	{
		ET::conversationModel();
		ETConversationModel::addLabel("answered", "IF(c.answered > 0,1,0)", "icon-ok-sign");

		ET::define("label.answered", T("Answered"));
	}

	public function handler_renderBefore($sender)
	{
		$sender->addCSSFile($this->resource("answers.css"));
	}

	public function handler_conversationController_formatPostForTemplate($sender, &$formatted, $post, $conversation)
	{
		if ($post["deleteTime"]) return;

		$isAnswer = $conversation["answered"] == $post["postId"];
		$isFirstPost = $post["memberId"] == $conversation["startMemberId"] && $post["time"] == $conversation["startTime"];
		$isAuthor = $conversation["startMemberId"] == ET::$session->userId;

		if (!$isFirstPost && ($isAuthor || $conversation["canModerate"]) && !$isAnswer) {
			$label = $conversation["startMemberId"] == ET::$session->userId ? "This answers my question" : "This answers the question";
			addToArray($formatted["info"], "<a href='".URL("conversation/answer/".$post["postId"]."?token=".ET::$session->token)."' class='markAsAnswer' title=' ".T($label)."'><i class='icon-ok'></i></a>", 0);
		}

		// If this post is the answer...
		if ($isAnswer) {
			$formatted["class"][] = "answer";
			addToArray($formatted["info"], "<span class='label label-answered'><i class='icon-ok-sign'></i> ".T("Answer")."</span>", 100);
		}

		// If this is the first post in the conversation and there is an answer...
		if ($conversation["answered"] and $isFirstPost) {

			// Get the answer post.
			$answer = ET::postModel()->getById($conversation["answered"]);
			$view = $sender->getViewContents("answers/answer", array("answer" => $answer, "conversation" => $conversation));

			$formatted["body"] = $formatted["body"].$view;

		}
	}

	public function action_conversationController_answer($sender, $postId)
	{
		$conversation = ET::conversationModel()->getByPostId($postId);

		if (!$conversation or !$sender->validateToken()) return;

		// Stop here with an error if the user isn't allowed to mark the conversation as answered.
		if ($conversation["startMemberId"] != ET::$session->userId and !$conversation["canModerate"]) {
			$sender->renderMessage(T("Error"), T("message.noPermission"));
			return false;
		}

		$model = ET::conversationModel();
		$model->updateById($conversation["conversationId"], array("answered" => $postId));

		redirect(URL(R("return", postURL($postId))));
	}

	public function action_conversationController_unanswer($sender, $conversationId)
	{
		$conversation = ET::conversationModel()->getById($conversationId);

		if (!$conversation or !$sender->validateToken()) return;

		// Stop here with an error if the user isn't allowed to mark the conversation as answered.
		if ($conversation["startMemberId"] != ET::$session->userId and !$conversation["canModerate"]) {
			$sender->renderMessage(T("Error"), T("message.noPermission"));
			return false;
		}

		$model = ET::conversationModel();
		$model->updateById($conversation["conversationId"], array("answered" => 0));

		redirect(URL(R("return", conversationURL($conversation["conversationId"], $conversation["title"]))));
	}

}
