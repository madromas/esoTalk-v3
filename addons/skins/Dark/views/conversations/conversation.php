<?php
// Copyright 2011 Toby Zerner, Simon Zerner
// This file is part of esoTalk. Please see the included license file for usage information.

if (!defined("IN_ESOTALK")) exit;

$conversation = $data["conversation"];

// Work out the class name to apply to the row.
$className = "channel-".$conversation["channelId"];
if ($conversation["starred"]) $className .= " starred";
if ($conversation["unread"] and ET::$session->user) $className .= " unread";
if ($conversation["startMemberId"] == ET::$session->user) $className .= " mine";
foreach ($conversation["labels"] as $label) $className .= " label-$label";

?>
<li id='c<?php echo $conversation["conversationId"]; ?>' style="position: relative;" class='<?php echo $className; ?>'>

    <?php if ($conversation["starred"]): ?>
    <span class="following-indicator label" 
          title="Following" 
          style="position: absolute; left: 0; top: 0; bottom: 0; width: 4px; z-index: 10; cursor: help; background-color: #58a6ff6b; display: block;">
    </span>
<?php endif; ?>

    <div class='col-firstPost'>
        <?php echo "<span class='action' title='Author (".$conversation["startMember"].")'><a href='".URL(memberURL($conversation["startMemberId"], $conversation["startMember"]))."'>".avatar(array(
            "memberId" => $conversation["startMemberId"],
            "username" => $conversation["startMember"],
            "avatarFormat" => $conversation["startMemberAvatarFormat"]
        ), "start")."</a></span>"; ?>
    </div>

    <div class='col-channel'>
        <?php 
        $channel = $data["channelInfo"][$conversation["channelId"]];
        echo "<a href='".URL(searchURL("", $channel["slug"]))."' class='channel channel-{$conversation["channelId"]}' data-channel='{$channel["slug"]}'>{$channel["title"]}</a>";
        ?>
    </div>

    <div class='col-conversation'>
        <?php
        $conversationURL = conversationURL($conversation["conversationId"], $conversation["title"]);

        if (ET::$session->user and $conversation["unread"])
            echo " <a href='".URL("conversation/markAsRead/".$conversation["conversationId"]."?token=".ET::$session->token."&return=".urlencode(ET::$controller->selfURL))."' class='unreadIndicator' title='".T("Mark as read")."'>".$conversation["unread"]."</a> ";

        echo "<span class='labels'>";
        foreach ($conversation["labels"] as $label) echo label($label, $label == "draft" ? URL($conversationURL."#reply") : "");
        echo "</span> ";

        echo "<strong class='title'><a href='".URL($conversationURL.((ET::$session->user and $conversation["unread"]) ? "/unread" : ""))."'>".highlight(sanitizeHTML($conversation["title"]), ET::$session->get("highlight"))."</a></strong> ";

        if (ET::$session->get("highlight"))
            echo "<span class='controls'><a href='".URL($conversationURL."/?search=".urlencode($data["fulltextString"]))."' class='showMatchingPosts'>".T("Show matching posts")."</a></span>";

        if ($conversation["firstPost"]) {

            $excerpt = ET::formatter()->init($conversation["firstPost"])->firstLine()->format()->inline(true)->clip(150)->get();
            
            $excerpt = preg_replace('/<div class="hiddenContent">.*?<\/div>/s', '', $excerpt);
            
            $excerpt = preg_replace('/\[[^\]]*\]/', '', $excerpt);
            
            // Strip everything else except the allowed formatting
            $excerpt = strip_tags($excerpt, '<p><a><b><strong><em><ul><li><br>');
            
            echo "<div class='excerpt'>".$excerpt."</div>";
        }
        ?>
    </div>

    <div class='col-replies'>
        <?php echo "<span><a href='".URL($conversationURL."/unread")."'>"?>
        <i class='icon-comment<?php if (!$conversation["replies"]) echo "-alt"; ?>'></i>
        <?php echo "".Ts("%s", "%s", $conversation["replies"])."</a></span>"; ?>
    </div>

    <div class='col-views'>
        <?php echo "<i class='icon-eye-open'></i> ".Ts("%s", "%s", $data["conversation"]["views"])."";?>
    </div>

    <div class='col-lastPost'>
        <?php echo "<span class='action'><a href='".URL(memberURL($conversation["lastPostMemberId"], $conversation["lastPostMember"]))."'>".avatar(array(
            "memberId" => $conversation["lastPostMemberId"],
            "username" => $conversation["lastPostMember"],
            "avatarFormat" => $conversation["lastPostMemberAvatarFormat"],
            "email" => $conversation["lastPostMemberEmail"]
        ), "thumb")."</a>",
        sprintf(T("%s <i class='far fa-clock'></i> %s"),
            "<span class='lastPostMember name'>".memberLink($conversation["lastPostMemberId"], $conversation["lastPostMember"])."</span>",
            "<a href='".URL($conversationURL."/unread")."' class='lastPostTime' title='Go to last unread'>".relativeTime($conversation["lastPostTime"], true)."</a>"),
        "</span>"; ?>
    </div>

</li>