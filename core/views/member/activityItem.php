<?php
// Copyright 2011 Toby Zerner, Simon Zerner
// This file is part of esoTalk. Please see the included license file for usage information.

if (!defined("IN_ESOTALK")) exit;

/**
 * Displays a single activity item in a member's profile.
 *
 * @package esoTalk
 */

$activity = $data["activity"];
$member = $data["member"];
?>
<div class='activity hasControls'<?php if (!empty($activity["activityId"])): ?> id='a<?php echo $activity["activityId"]; ?>'<?php endif; ?>>
<div class='controls'>
<span class='time'><?php echo _strftime(T("date.full"), $activity["time"]); ?></span>
<?php if (($member["memberId"] == ET::$session->userId or $activity["fromMemberId"] == ET::$session->userId) and !empty($activity["activityId"])): ?>
<a href='<?php echo URL("member/deleteActivity/".$activity["activityId"]."/?token=".ET::$session->token); ?>' class='control-delete' title='<?php echo T("Delete"); ?>'><?php echo T("Delete"); ?></a>
<?php endif; ?>
</div>
<div class='action'>
<?php echo avatar($activity + array("memberId" => $activity["fromMemberId"], "username" => $activity["fromMemberName"]), "thumb"), "\n"; ?>
<?php echo $activity["description"]; ?>
</div>
<?php if (!empty($activity["body"])): ?>
<div class='activityBody postBody thing'>
<?php 
    // 1. Remove all BBCode tags like [attachment...], [hide...], [rep...]
    $excerpt = preg_replace('/\[(.*?)\]/', '', $activity["body"]);
    
    // 2. Strip any remaining HTML tags to keep it clean
    $excerpt = strip_tags($excerpt);
    
    // 3. Truncate to a reasonable length (e.g., 100 characters)
    echo (strlen($excerpt) > 100) ? mb_substr($excerpt, 0, 100) . '...' : $excerpt;
?>
</div>
<?php endif; ?>
</div>
