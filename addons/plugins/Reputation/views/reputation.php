<?php
// Created by Yathish
// This file is part of esoTalk. Please see the included license file for usage information.

if (!defined("IN_ESOTALK")) exit;

/**
 * Displays the top reputation members sheet.
 *
 * @package esoTalk
 */
?>

<style>
/* Spacing for the list rows */
.list {
    list-style: none;
    padding: 0;
}

.list li {
    padding: 10px 0;
}

.list li:last-child {
    border-bottom: none;
}

.action {
    display: flex;
    align-items: center;
}

/* Ensure rank numbers are aligned */
.rank-number {
    width: 25px;
    font-weight: bold;
    color: #8b949e;
}

.member-avatar {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    object-fit: cover;
    margin-right: 12px;
    display: inline-block;
}

.avatar-letter {
    background: #444;
    color: #fff;
    text-align: center;
    line-height: 32px;
    font-weight: bold;
    font-size: 14px;
}
</style>
<div class='sheetContent'><h1>Wall of Reputation</h1>
Following are 10 of the top members.
</div>
<div class='sheet' id='onlineSheet'>
<div class='sheetContent'>

<h3 style="text-align:center"><?php echo T("Top 10 members"); ?></h3>

<div class='sheetBody'>

<div class='section' id='onlineList'>
<ul class='list'>


<?php foreach ($data["topMembers"] as $member): 
    $avatarUrl = "uploads/avatars/" . $member["memberId"] . ".jpg";
    $avatarExists = file_exists($avatarUrl);
    
    if (!$avatarExists) {
        $avatarUrl = "uploads/avatars/" . $member["memberId"] . ".png";
        $avatarExists = file_exists($avatarUrl);
    }
?>
    <li>
        <span class='action'>
            <span class="rank-number"><?php echo $member["rank"]; ?>.</span>
            
            <?php if ($avatarExists): ?>
                <img src="<?php echo $avatarUrl; ?>" class="member-avatar" />
            <?php else: ?>
                <span class="member-avatar avatar-letter"><?php echo strtoupper(substr($member["username"], 0, 1)); ?></span>
            <?php endif; ?>
            
            <?php echo memberLink($member["memberId"], $member["username"]); ?>
            <span style="margin-left: auto; color: #58a6ff;">
                <?php echo " +", number_format($member["reputationPoints"]), " " . T("Reputation Points"); ?>
            </span>
        </span>
    </li>
<?php endforeach; ?>

</ul>

</div>

</div>

</div>
</div>


<div class='sheet' id='onlineSheet'>
<div class='sheetContent'>

<h3 style="text-align:center"><?php echo T("Members nearby your rank"); ?></h3>

<div class='sheetBody'>

<div class='section' id='onlineList'>
<ul class='list'>

<?php if($data["nearbyMembers"]): ?>

<?php foreach ($data["nearbyMembers"] as $member): ?>
<li>
<span class='action'>
<?php echo $member["rank"], ". ", $member["avatar"], " ", memberLink($member["memberId"], $member["username"]), " +", number_format($member["reputationPoints"]), " Reputation Points"; ?>
</span>
</li>
<?php endforeach; ?>

<?php else: echo "Congrats! You're already in the top 10."; ?>
<?php endif; ?>

</ul>

</div>

</div>

</div>
</div>