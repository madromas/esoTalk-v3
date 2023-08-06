<?php
// Copyright 2014 andrewks
// This file is part of esoTalk. Please see the included license file for usage information.

if (!defined("IN_ESOTALK")) exit;

/**
 * Displays the settings form. Since all sections/fields are defined in the controller's form, all we
 * do here is output them one-by-one.
 *
 * @package esoTalk
 */

$form = $data["form"];
?>
<div id='settings-scripts'>

<?php echo $form->open(); ?>

<ul class='form'>

<?php
// Loop through the form sections
foreach ($form->getSections() as $k => $v): ?>

<li><label><?php echo $v; ?></label> <div class='checkboxGroup'>
<?php
// Loop through each of the fields in this section and output it.
foreach ($form->getFieldsInSection($k) as $field): ?>

<?php echo $field; ?>

<?php endforeach; ?>
</div></li>

<?php if (!preg_match("/.+-no-sep/", $k, $matches)): ?>
<li class='sep'></li>
<?php endif; ?>
<?php endforeach; ?>

<li><?php echo $form->saveButton(); ?></li>

</ul>

<?php echo $form->close(); ?>

</div>