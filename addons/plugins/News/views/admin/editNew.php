<?php
// This file is part of esoTalk. Please see the included license file for usage information.

if (!defined("IN_ESOTALK")) exit;

/**
 * Displays a sheet with a form to edit a static pages, or create a new one.
 *
 * @package esoTalk
 */

$form = $data["form"];
$new = $data["new"];


echo $new['startTime'];

//date_default_timezone_set('America/New_York');

//echo date_default_timezone_get();

//echo $new->startTime;
//echo '555';

?>

<div class='sheet' id='editFieldSheet'>
<div class='sheetContent'>

<?php echo $form->open(); ?>

<h3><?php echo T($new ? "Edit New" : "Create New"); ?></h3>

<div class='sheetBody'>

<div class='section' id='editFieldForm'>

<ul class='form'>

<li>
<label><?php echo T("Start Time"); ?></label>
<?php echo date("m.d.Y", time());

// $form->input("startTime");  

//print_r($new);
//print_r($form);
//echo '555';

//$ts = $new['startTime'];
//$date $_COOKIE= new DateTime("@$ts");
//echo $date->format('U = Y-m-d H:i:s');
//echo $ts);

?>
</li>
<li class='sep'></li>

<li>
<label><?php echo T("New title"); ?></label>
<?php echo $form->input("title"); ?>
</li>
<li class='sep'></li>

<li>
<label><?php echo T("New content"); ?></label>
<?php echo $form->input("content", "textarea"); ?>
</li>
<li class='sep'></li>
<li>
<label><?php echo T("Options"); ?></label>
<div class='checkboxField'>
<label class='checkbox'><?php echo $form->checkbox("hideFromGuests"); ?> <?php echo T("Hide new from guests"); ?></label>
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
