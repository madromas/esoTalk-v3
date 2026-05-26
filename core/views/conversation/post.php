<?php
// Copyright 2011 Toby Zerner, Simon Zerner
// This file is part of esoTalk. Please see the included license file for usage information.


if (!defined("IN_ESOTALK")) exit;

/**
 * Displays a single post.
 *
 * @package esoTalk
 */

$post = $data["post"];
?>

<div class='post hasControls <?php echo implode(" ", (array)$post["class"]); ?>' id='<?php echo $post["id"]; ?>'<?php
if (!empty($post["data"])):
foreach ((array)$post["data"] as $dk => $dv)
	echo " data-$dk='$dv'";
endif; ?>>

<?php if (!empty($post["avatar"])): ?>
<div class='avatar'<?php if (!empty($post["hideAvatar"])): ?> style='display:none'<?php endif; ?>><?php echo $post["avatar"]; ?></div>
<?php endif; ?>

<div class='postContent thing'>

<div class='postHeader'>
<div class='info'>
<h3>
    <?php 
    echo $post["title"]; 
    
    // Check if the user is an administrator
    // We look up the account type for the current post author
    $member = ET::SQL()
        ->select("account")
        ->from("member")
        ->where("memberId", $post["memberId"])
        ->exec()
        ->firstRow();

    if ($member && $member["account"] === "administrator"): ?>
        <span class='verified-badge' title='Administrator' style='color:#f39c12; margin-left:5px;'>
            <i class='icon-star'></i>
        </span>
    <?php endif; ?>
</h3>
<?php if (!empty($post["badge"])) foreach ((array)$post["badge"] as $badge) echo $badge, "\n"; ?>
<?php if (!empty($post["info"])) foreach ((array)$post["info"] as $info) echo $info, "\n"; ?>
</div>
<div class='controls'>
<?php if (!empty($post["controls"])) foreach ((array)$post["controls"] as $control) echo $control, "\n"; ?>
</div>
</div>

<?php if (!empty($post["body"])): ?>
<div class='postBody'>
<?php echo $post["body"]; ?>
</div>
<?php endif; ?>

<?php if (!empty($post["footer"])): ?>
<div class='postFooter'>
<?php foreach ((array)$post["footer"] as $footer) echo $footer, "\n"; ?>
</div>
<?php endif; ?>

</div>

</div>
