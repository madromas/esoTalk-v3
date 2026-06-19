<?php
// Copyright 2011 Toby Zerner, Simon Zerner
// This file is part of esoTalk. Please see the included license file for usage information.

if (!defined("IN_ESOTALK")) exit;

/**
 * Show a "reply" box, for use on a conversation view or when starting a conversation.
 *
 * @package esoTalk
 */

$form = $data["form"];
$conversation = $data["conversation"];

// Using the provided form object, construct a textarea, save/discard draft buttons, and a submit button.
$body = $form->input("content", "textarea", array("cols" => "200", "rows" => "20", "tabindex" => 200))."
    <div id='reply-preview' class='preview'></div>";

$footer = "<div class='editButtons'>".
	$form->button("postReply", !$conversation["conversationId"] ? T("Start Conversation") : T("Post a Reply"), array("class" => "big submit postReply", "tabindex" => 300)).
	"<span class='draftButtons'>".
	"<a href='".URL("conversation/discard/".$conversation["conversationId"]."?token=".ET::$session->token)."' class='button big discardDraft' title='".T("Discard")."'><i class='icon-trash'></i></a> ".
	$form->button("saveDraft", T("Save Draft"), array("class" => "big saveDraft", "tabindex" => 400)).
	"</span></div>";

$hint = "<div class='hide-hint' style='font-size: 0.85em; color: #888; margin-top: 5px;'>
    Enable [hide], [hide=100], [groups=1,4], [users=Toby,Tristan], [rep=50] and [visitor] tags to hide content.
</div>";

if (ET::$session->user['account'] == 'administrator' || ET::$session->user['account'] == 'moderator') {
    $body .= $hint;
}

// Construct an array for use in the conversation/post view.
$post = array(
	"id" => "reply",
	"title" => !$conversation["conversationId"] ? T("Start a conversation") : T("Write a reply..."),
	"controls" => $data["controls"],
	"class" => "edit",
	"body" => $body,
	"avatar" => avatar(ET::$session->user),
	"footer" => array($footer)
);

$this->trigger("renderReplyBox", array(&$post, $conversation));

$this->renderView("conversation/post", array("post" => $post));

?>
