<?php
// Copyright 2011 Toby Zerner, Simon Zerner
// This file is part of esoTalk. Please see the included license file for usage information.

if (!defined("IN_ESOTALK")) exit;

?>
<div class='sheet' id='onlineSheet'>
<div class='sheetContent'>

<h3><?php echo $data["caption"]; ?><?php if (count($data["members"])) echo " (".count($data["members"]).")"; ?></h3>

<?php
// If there are members, list them.
if (count($data["members"])): ?>

<div class='section' id='onlineList'>

<ul class='list'>
<?php foreach ($data["members"] as $memberId => $member): ?>
<li>
<span class='action'>
<?php echo avatar($member, "thumb"), " ", memberLink($memberId, $member["username"]), " "; ?>
</span>
</li>
<?php endforeach; ?>
</ul>

</div>

<?php
// Otherwise, display a 'no members' message.
else: ?>

<div class='section'>
<div class='noResults help'>
</div>
</div>

<?php endif; ?>

</div>
</div>