<?php
// Copyright 2014 andrewks
// This file is part of esoTalk. Please see the included license file for usage information.

if (!defined("IN_ESOTALK")) exit;

/**
 * Displays the 'Edit script' form for the UserScripts plugin.
 *
 * @package esoTalk
 */

$form = $data["form"];
$scriptType = $data["scriptType"];
?>
<div>

<?php echo $form->open(); ?>

<?php echo "<ul class='form edit-script-form' data-type='$scriptType'>"; ?>

<li><div style='height:15px'></div></li>
<li><?php echo $form->input("scriptsrc", "textarea"); ?></li>
<li><div style='height:5px'></div></li>
<li><?php echo $form->saveButton(); ?></li>

</ul>

<?php echo $form->close(); ?>

</div>