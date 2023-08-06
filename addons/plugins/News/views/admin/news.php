<?php
// Copyright 2011 Toby Zerner, Simon Zerner
// This file is part of esoTalk. Please see the included license file for usage information.

if (!defined("IN_ESOTALK")) exit;

/**
 * Displays a sheet with a list of static pages and controls to edit, delete, or create them.
 *
 * @package esoTalk
 */

$news = $data["news"];

?>
<script>
$(function() {
	AdminProfiles.init();
});
</script>

<div class='sheet' id='profilesSheet'>
<div class='sheetContent' id='adminProfiles'>

<h3><?php echo T("Manage Forum News"); ?></h3>

<div class='sheetBody'>

<div class='section'>

<ul class='list'>
<?php foreach ($news as $new): ?>
<li data-id='<?php echo $new["newId"]; ?>' class='hasControls'>
<div class='controls'><a href='<?php echo URL("admin/news/edit/".$new["newId"]); ?>' class='control-edit' title='<?php echo T("Edit"); ?>'><i class='icon-edit'></i></a> <a href='<?php echo URL("admin/news/delete/".$new["newId"]."?token=".ET::$session->token); ?>' class='control-delete' title='<?php echo T("Delete"); ?>'><i class='icon-remove'></i></a></div>
<strong><?php echo $new["title"]; ?></strong>
</li>
<?php endforeach; ?>
</ul>

<a href='<?php echo URL("admin/news/create"); ?>' class='button' id='addFieldButton'><i class='icon-plus-sign'></i> <?php echo T("Create New"); ?></a>

</div>

</div>

</div>
</div>
