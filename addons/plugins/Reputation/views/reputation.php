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
<div class='sheetContent'><h1>Wall of Reputation</h1>
Following are 10 of the top members.
</div>
<div class='sheet' id='onlineSheet'>
<div class='sheetContent'>

<h3 style="text-align:center"><?php echo T("Top 10 members"); ?></h3>

<div class='sheetBody'>

<div class='section' id='onlineList'>
<ul class='list'>

<?php foreach ($data["topMembers"] as $member): ?>
<li>
<span class='action'>
<?php echo $member["rank"], ". ", $member["avatar"], " ", memberLink($member["memberId"], $member["username"]), " +", number_format($member["reputationPoints"]), " Reputation Points"; ?>
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