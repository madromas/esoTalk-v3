<?php
// Copyright 2011 Toby Zerner, Simon Zerner
// Copyright 2014 andrewks
// This file is part of esoTalk. Please see the included license file for usage information.

if (!defined("IN_ESOTALK")) exit;

ET::$pluginInfo["Likes"] = array(
	"name" => "Likes",
	"description" => "Allows members to like posts.",
	"version" => ESOTALK_VERSION,
	"author" => "Toby Zerner",
	"authorEmail" => "support@esotalk.org",
	"authorURL" => "http://esotalk.org",
	"license" => "GPLv2",
	"dependencies" => array(
		"esoTalk" => "1.0.0g4"
	)
);

class ETPlugin_Likes extends ETPlugin {

protected function like_dislike($postId, $like = 1)
{
	// Get the conversation.
	if (!($conversation = ET::conversationModel()->getByPostId($postId))) return false;

	// Get the post.
	$post = ET::postModel()->getById($postId);
	if (!$this->canLikePost($post, $conversation)) return false;

	$time = time();
	ET::SQL()->insert("like")
		->set("postId", $post["postId"])
		->set("memberId", ET::$session->userId)
		->set("postFromMemberId", $post["memberId"])
		->set("_like", $like)
		->set("time", $time)
		->setOnDuplicateKey("memberId", ET::$session->userId)
		->setOnDuplicateKey("postFromMemberId", $post["memberId"])
		->setOnDuplicateKey("_like", $like)
		->setOnDuplicateKey("time", $time)
		->exec();

	if ($like) {
		$key1name = "likes";
		$key2name = "dislikes";
	} else {
		$key1name = "dislikes";
		$key2name = "likes";
	}
	$post[$key1name][ET::$session->userId] = array("avatarFormat" => ET::$session->user["avatarFormat"], "username" => ET::$session->user["username"]);
	if (isset($post[$key2name][ET::$session->userId])) unset($post[$key2name][ET::$session->userId]);

	$likes = $this->getLikesPane($post);
	
	return $likes;
}

// Like a post.
public function action_conversationController_like($sender, $postId = false)
{
	$sender->responseType = RESPONSE_TYPE_JSON;
	if (!$sender->validateToken() or !$this->canLike()) return;

	$likes = $this->like_dislike($postId, 1);
	
	$sender->json("likes", $likes);
	$sender->render();
}

// Dislike a post.
public function action_conversationController_dislike($sender, $postId = false)
{
	$sender->responseType = RESPONSE_TYPE_JSON;
	if (!$sender->validateToken() or !$this->canDislike()) return;

	$likes = $this->like_dislike($postId, 0);
	
	$sender->json("likes", $likes);
	$sender->render();
}

// Unlike a post.
public function action_conversationController_unlike($sender, $postId = false)
{
	$sender->responseType = RESPONSE_TYPE_JSON;
	if (!$sender->validateToken() or !$this->canLike()) return;

	// Get the conversation.
	if (!($conversation = ET::conversationModel()->getByPostId($postId))) return false;

	// Get the post.
	$post = ET::postModel()->getById($postId);
	if (!$this->canUnlikePost($post, $conversation)) return false;

	ET::SQL()->delete()
		->from("like")
		->where("postId=:postId")->bind(":postId", $post["postId"])
		->where("memberId=:memberId")->bind(":memberId", ET::$session->userId)
		->exec();

	unset($post["likes"][ET::$session->userId]);
	unset($post["dislikes"][ET::$session->userId]);
	
	$likes = $this->getLikesPane($post);

	$sender->json("likes", $likes);
	$sender->render();
}

// Show a list of members who liked a post.
public function action_conversationController_liked($sender, $postId = false, $like = 1)
{
	if (!$postId) return;
	$post = ET::postModel()->getById($postId);
	if (!$post) return;

	$sender->data("caption", ($like ? T("Members Who Liked This Post") : T("Members Who Disliked This Post")));
	$sender->data("members", $post[($like ? "likes" : "dislikes")]);

	$sender->render($this->view("liked"));
}

// Get the likes from the database and attach them to the posts.
public function handler_postModel_getPostsAfter($sender, &$posts)
{
	$keys = array('likes' => 1, 'dislikes' => 0);
	
	$postsById = array();
	foreach ($posts as &$post) {
		$postsById[$post["postId"]] = &$post;
		foreach ($keys as $k => $v) $post[$k] = array();
	}

	if (!count($postsById)) return;
	if (ET::$session->preference("disallowLikes", false)) return;
	if (!ET::$session->preference("allowDislikes", false)) unset($keys["dislikes"]);

	foreach ($keys as $k => $v) {
		$result = ET::SQL()
			->select("postId, m.memberId, m.email, username, avatarFormat")
			->from("like l")
			->from("member m", "m.memberId=l.memberId", "left")
			->where("postId IN (:ids)")
			->where("l._like = :like")
			->bind(":ids", array_keys($postsById))
			->bind(":like", $v)
			->orderBy("time ASC")
			->exec();

		while ($row = $result->nextRow()) {
			$postsById[$row["postId"]][$k][$row["memberId"]] = array("memberId" => $row["memberId"], "username" => $row["username"], "email" => $row["email"], "avatarFormat" => $row["avatarFormat"]);
		}
	}
}

public function handler_conversationController_renderBefore($sender)
{
	$sender->addJSVar("likePaneSlide", ET::$session->preference("hideLikesPane", false));
	$sender->addJSFile($this->resource("likes.js"));
	$sender->addCSSFile($this->resource("likes.css"));
}

public function handler_conversationController_formatPostForTemplate($sender, &$formatted, $post, $conversation)
{
	if (!$this->canLikePost($post, $conversation)) return;

	$likesCount = count($post["likes"]);
	$dislikesCount = count($post["dislikes"]);
	
	if (!$this->canLike() and !$likesCount and !$dislikesCount) return;
	if (ET::$session->preference("disallowLikes", false)) return;

	$likes = $this->getLikesPane($post, $conversation);

	$formatted["footer"][] = $likes;
}

public function getLikesPane(&$post, &$conversation = false)
{
	$liked = array_key_exists(ET::$session->userId, $post["likes"]);
	$disliked = array_key_exists(ET::$session->userId, $post["dislikes"]);
	$likesCount = count($post["likes"]);
	$dislikesCount = count($post["dislikes"]);
	$canLike = $this->canLike();
	$canDislike = $this->canDislike();
	if ($conversation) {
		if ($liked || $disliked) $canLike = $canLike && $this->canUnlikePost($post, $conversation);
		else $canLike = $canLike && $this->canLikePost($post, $conversation);
	}
	
	$likesMembers = $this->getNames($post["likes"], 1);
	$dislikesMembers = $this->getNames($post["dislikes"], 0);
	
	$likeText = T("Like");
	$dislikeText = T("Dislike");
	$unlikeText = T("Unlike");

	$separator = "<span class='like-separator'>&nbsp;&nbsp;&nbsp;</span>";
	$likes = "<p class='likes".($liked || $disliked ? " liked" : "")."'".($likesCount || $dislikesCount || !ET::$session->preference("hideLikesPane", false) ? "" : " style='display:none'").">" . 
		($canLike ?
		($liked || $disliked ? "
		<a href='#' class='unlike-button' title='$unlikeText'><i class='icon-reply'></i></a>" : "
		<a href='#' class='like-button' title='$likeText'><i class='far fa-thumbs-up'></i></a>".
		($canDislike ?
		"<span class='like-separator'>&nbsp;&nbsp;&nbsp;</span>
		<a href='#' class='dislike-button' title='$dislikeText'><i class='far fa-thumbs-down'></i></a>"
		: "")
		) . $separator
		: "");
	if ($likesMembers) $likes = $likes . "
		<span class='like-members'><i class='icon-plus'>&nbsp;$likesCount</i>&nbsp;&nbsp;$likesMembers</span>";
	if ($dislikesMembers) $likes = $likes . ($likesMembers ? $separator : "") . "
		<span class='dislike-members'><i class='icon-minus'>&nbsp;$dislikesCount</i>&nbsp;&nbsp;$dislikesMembers</span>";
	$likes = $likes . "
	</p>";
	
	return $likes;
}

/*
public function getNames($likes)
{
	$names = array();
	foreach ($likes as $id => $member) $names[] = memberLink($id, $member["username"]);

	// If there's more than one name, construct the list so that it has the word "and" in it.
	if (count($names) > 1) {

		// If there're more than 3 names, chop off everything after the first 3 and replace them with a
		// "x others" link.
		if (count($names) > 3) {
			$otherNames = array_splice($names, 3);
			$lastName = "<a href='#' class='showMore name'>".sprintf(T("%s others"), count($otherNames))."</a>";
		} else {
			$lastName = array_pop($names);
		}

		$members = sprintf(T("%s like this."), sprintf(T("%s and %s"), implode(", ", $names), $lastName));
	}

	// If there's only one name, we don't need to do anything gramatically fancy.
	elseif (count($names)) {
		$members = sprintf(T("%s likes this."), $names[0]);
	}
	else {
		$members = "";
	}

	return $members;
}
*/

public function getNames(&$likes, $like = 1)
{
	$names = array();
	foreach ($likes as $id => $member) $names[] = memberLink($id, $member["username"]);

	$maxCount = 3;
	// If there's more than one name, construct the list.
	if (count($names) > 1) {

		// If there're more than 3 names, chop off everything after the first 3 and replace them with a
		// "others" link.
		if (count($names) > $maxCount) {
			array_splice($names, $maxCount);
			$othersName = "<a href='#' class='showMore name' data-type='$like'> ".T("and others")."</a>";
		} else {
			$othersName = "";
		}

		$members = implode(", ", $names).$othersName;
	}

	// If there's only one name, we don't need to do anything gramatically fancy.
	elseif (count($names)) {
		$members = sprintf("%s", $names[0]);
	}
	else {
		$members = "";
	}

	return $members;
}

public function canLike()
{
	return (ET::$session->userId and !ET::$session->isSuspended());
}

public function canDislike()
{
	return (ET::$session->userId and !ET::$session->isSuspended() and ET::$session->preference("allowDislikes", false));
}

public function canLikePost(&$post, &$conversation)
{
	return (!$post["deleteMemberId"]);
}

public function canUnlikePost(&$post, &$conversation)
{
	return (!$post["deleteMemberId"] && !$conversation["locked"]);
}

public function handler_settingsController_initGeneral($sender, $form)
{
	$sections = $form->sections;
	$pos = array_search("multimediaEmbedding", array_keys($sections));
	if ($pos) $pos++;
	
	$form->addSection("Likes", T("settings.Likes.label"), $pos++);

	// Add the "disallow Likes" field.
	$form->setValue("disallowLikes", ET::$session->preference("disallowLikes", false));
	$form->addField("Likes", "disallowLikes", array(__CLASS__, "fieldDisallowLikes"), array($sender, "saveBoolPreference"));
	
	// Add the "Allow Dislikes" field.
	$form->setValue("allowDislikes", ET::$session->preference("allowDislikes", false));
	$form->addField("Likes", "allowDislikes", array(__CLASS__, "fieldAllowDislikes"), array($sender, "saveBoolPreference"));
	
	// Add the "hide Likes Pane" field.
	$form->setValue("hideLikesPane", ET::$session->preference("hideLikesPane", false));
	$form->addField("Likes", "hideLikesPane", array(__CLASS__, "fieldHideLikesPane"), array($sender, "saveBoolPreference"));

}

/**
 * Return the HTML to render the "fieldDisallowLikes" field in the general
 * settings form.
 *
 * @param ETForm $form The form object.
 * @return string
 */
static function fieldHideLikesPane($form)
{
	return "<label class='checkbox'>".$form->checkbox("hideLikesPane")." ".T("setting.hideLikesPane.label")."</label>";
}

/**
 * Return the HTML to render the "fieldDisallowLikes" field in the general
 * settings form.
 *
 * @param ETForm $form The form object.
 * @return string
 */
static function fieldDisallowLikes($form)
{
	return "<label class='checkbox'>".$form->checkbox("disallowLikes")." ".T("setting.disallowLikes.label")."</label>";
}

/**
 * Return the HTML to render the "fieldAllowDislikes" field in the general
 * settings form.
 *
 * @param ETForm $form The form object.
 * @return string
 */
static function fieldAllowDislikes($form)
{
	return "<label class='checkbox'>".$form->checkbox("allowDislikes")." ".T("setting.allowDislikes.label")."</label>";
}

public function setup($oldVersion = "")
{
	$structure = ET::$database->structure();
	$structure->table("like")
		->column("postId", "int unsigned", false)
		->column("memberId", "int unsigned", false)
		->column("postFromMemberId", "int unsigned", false)
		->column("_like", "tinyint(1)", 1)
		->column("time", "int(11) unsigned", false)
		->key(array("postId", "memberId"), "primary")
		->key("postFromMemberId")
		->exec(false);

	return true;
}

}
