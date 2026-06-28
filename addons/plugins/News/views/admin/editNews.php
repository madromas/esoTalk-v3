<?php
// This file is part of esoTalk. Please see the included license file for usage information.

if (!defined("IN_ESOTALK")) exit;

/**
 * Displays a sheet with a form to edit a news item, or create a new one.
 *
 * @package esoTalk
 */

$form = $data["form"];
$news = $data["news"];
?>

<div class='sheet' id='editFieldSheet'>
<div class='sheetContent'>

<?php echo $form->open(); ?>

<h3><?php echo T($news ? "Edit News Item" : "Create News Item"); ?></h3>

<div class='sheetBody'>

<div class='section' id='editFieldForm'>

<ul class='form'>

<li>
<label><?php echo T("Date"); ?></label>
<?php 
// Show the date if editing, or current date if creating
echo $news ? date("m.d.Y", $news["startTime"]) : date("m.d.Y", time()); 
?>
</li>
<li class='sep'></li>

<li>
<label><?php echo T("News Title"); ?></label>
<?php echo $form->input("title"); ?>
</li>
<li class='sep'></li>

<li>
<label><?php echo T("News Content"); ?></label>
<?php echo $form->input("content", "textarea"); ?>
</li>
<li class='sep'></li>

<li>
<label><?php echo T("Options"); ?></label>
<div class='checkboxField'>
<label class='checkbox'><?php echo $form->checkbox("hideFromGuests"); ?> <?php echo T("Hide news from guests"); ?></label>
</div>
</li>

</ul>

</div>

</div>

<div class='buttons'>
<?php
echo $form->saveButton();
echo $form->cancelButton();
?>
</div>

<?php echo $form->close(); ?>

</div>
</div>