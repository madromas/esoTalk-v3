<?php
/**
 *   Displays the settings form for the Matomo plugin.
 * */

if (!defined("IN_ESOTALK")) exit;

$form = $data["matomoSettingsForm"];
?>
<?php echo $form->open(); ?>

<div class='section'>

<ul class='form'>

<li>
<label>Trackingcode</label>
<?php echo $form->input("trackingcode", "textarea"); ?>
<small><?php echo T("Enter the trackingcode generated over the matomo backend."); ?></small>
</li>

<li>
<label>Image trackingcode</label>
<?php echo $form->input("imagetrackingcode", "text"); ?>
<small><?php echo T("If you want to use the imagetracking possibilities of matomo, just enter the imagetracking code here! <br /><strong>Attention:</strong> Will exclude js tracking code!!!"); ?></small>
</li>

</ul>

</div>

<div class='buttons'>
<?php echo $form->saveButton("matomoSettingsSave"); ?>
</div>

<?php echo $form->close(); ?>
