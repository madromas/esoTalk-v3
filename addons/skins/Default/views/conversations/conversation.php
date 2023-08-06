<?php
// Copyright 2011 Toby Zerner, Simon Zerner
// This file is part of esoTalk. Please see the included license file for usage information.

if (!defined("IN_ESOTALK")) exit;

/**
 * Displays a single conversation row in the context of a list of results.
 *
 * @package esoTalk
 */

$conversation = $data["conversation"];
// Work out the class name to apply to the row.
$className = "channel-".$conversation["channelId"];
if ($conversation["starred"]) $className .= " starred";
if ($conversation["unread"] and ET::$session->user) $className .= " unread";
if ($conversation["startMemberId"] == ET::$session->user) $className .= " mine";
foreach ($conversation["labels"] as $label) $className .= " label-$label";

?>
<li id='c<?php echo $conversation["conversationId"]; ?>' class='<?php echo $className; ?>'>
<?php if (ET::$session->user): ?>
<div class='col-star'>

<?php echo star($conversation["conversationId"], $conversation["starred"]); ?></div>
<?php endif; ?>
<div class='col-conversation'><?php
$conversationURL = conversationURL($conversation["conversationId"], $conversation["title"]);

// Output an "unread indicator", allowing the user to mark the conversation as read.
if (ET::$session->user and $conversation["unread"])
	echo " <a href='".URL("conversation/markAsRead/".$conversation["conversationId"]."?token=".ET::$session->token."&return=".urlencode(ET::$controller->selfURL))."' class='unreadIndicator' title='".T("Mark as read")."'>".$conversation["unread"]."</a> ";

// Output the conversation's labels.
echo "<span class='labels'>";
foreach ($conversation["labels"] as $label) echo label($label, $label == "draft" ? URL($conversationURL."#reply") : "");
echo "</span> ";

// Output the conversation title, highlighting search keywords.
echo "<strong class='title'><a href='".URL($conversationURL.((ET::$session->user and $conversation["unread"]) ? "/unread" : ""))."'>".highlight(sanitizeHTML($conversation["title"]), ET::$session->get("highlight"))."</a></strong> ";

// Output the Jump To Last post ">>".
// echo "<span class='controls'><a href='".URL($conversationURL."/last")."' class='jumpToLast' title='Jump to last'><i class='fas fa-angle-double-right'></i></a></span>";

// If we're highlighting search terms (i.e. if we did a fulltext search), then output a "show matching posts" link.
if (ET::$session->get("highlight"))
	echo "<span class='controls'><a href='".URL($conversationURL."/?search=".urlencode($data["fulltextString"]))."' class='showMatchingPosts'>".T("Show matching posts")."</a></span>";

// If this conversation is stickied, output an excerpt from its first post. Add "->firstLine()" after "inline(true)" to 
// show only first line. Add "format()" to show html. 

// Add or remove "firstPost" from "if ($conversation["firstPost"])" to show or not to show excerpt.
if ($conversation[""])
    echo "<div class='excerpt'>".ET::formatter()->init($conversation["firstPost"])->format()->inline(false)->clip(100)->get()."</div>";

?></div>

<div class='col-firstPost'><?php
	echo "<span class='action' title='Author (".$conversation["startMember"].")'><a href='".URL(memberURL($conversation["startMemberId"], $conversation["startMember"]))."'>".avatar(array(
		"memberId" => $conversation["startMemberId"],
		"username" => $conversation["startMember"],
		"avatarFormat" => $conversation["startMemberAvatarFormat"],
		"email" => $conversation["startMemberEmail"]
	), "start"), " ",
	"</span>";
?></div>

<div class='col-channel'><?php
$channel = $data["channelInfo"][$conversation["channelId"]];
echo "<a href='".URL(searchURL("", $channel["slug"]))."' class='channel channel-{$conversation["channelId"]}' data-channel='{$channel["slug"]}'>{$channel["title"]}</a>";
?></div>
<div class='col-lastPost'>
<?php
echo "<span class='action'><a href='".URL(memberURL($conversation["lastPostMemberId"], $conversation["lastPostMember"]))."'>".avatar(array(
		"memberId" => $conversation["lastPostMemberId"],
		"username" => $conversation["lastPostMember"],
		"avatarFormat" => $conversation["lastPostMemberAvatarFormat"],
		"email" => $conversation["lastPostMemberEmail"]
	), "thumb"), "  ",
	"</a>",
	sprintf(T("%s <i class='far fa-clock'></i> %s"),
		"<span class='lastPostMember name'>".memberLink($conversation["lastPostMemberId"], $conversation["lastPostMember"])."</span>",
		"<a href='".URL($conversationURL."/unread")."' class='lastPostTime' title='Go to last reply'>".relativeTime($conversation["lastPostTime"], true)."</a>"),
	"</span>";
?></div>

<div class='col-replies'>
<?php echo "<span><a href='".URL($conversationURL."/unread")."'>"?>
<i class='icon-comment<?php if (!$conversation["replies"]) echo "-alt"; ?>'></i>
<?php echo "".Ts("%s", "%s", $conversation["replies"])."</a></span>";
?></div>

<div class='col-views'>
<?php echo "<i class='icon-eye-open'></i> ".Ts("%s", "%s", $data["conversation"]["views"])."";?>
</div>
</li>

