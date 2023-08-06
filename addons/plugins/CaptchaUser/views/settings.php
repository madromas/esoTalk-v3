<?php
// Copyright 2014 andrewks
// This file is part of esoTalk. Please see the included license file for usage information.

if (!defined("IN_ESOTALK")) exit;

/**
 * Displays the settings form for the CaptchaUser plugin.
 *
 * @package esoTalk
 */

$form = $data["captchaUserSettingsForm"];
?>
<?php echo $form->open(); ?>

<div class='section'>

<ul class='form'>

<li>
<label><?php echo T("plugin.CaptchaUser.joinSheetLabel"); ?></label>
<div class='checkboxGroup'>
<label class='checkbox'><?php echo $form->checkbox("joinSheet") . T("plugin.CaptchaUser.joinSheetDesc"); ?></label>
</div>
</li>

<li>
<label><?php echo T("plugin.CaptchaUser.forgotSheetLabel"); ?></label>
<div class='checkboxGroup'>
<label class='checkbox'><?php echo $form->checkbox("forgotSheet") . T("plugin.CaptchaUser.forgotSheetDesc"); ?></label>
</div>
</li>

</ul>

</div>

<div class='buttons'>
<?php echo $form->saveButton("captchaUserSave"); ?>
</div>

<?php echo $form->close(); ?>
