<?php
// Copyright 2013 Toby Zerner, Simon Zerner
// This file is part of esoTalk. Please see the included license file for usage information.

if (!defined("IN_ESOTALK")) exit;

/**
 * Displays the configuration settings for the Attachments plugin.
 */

$form = $data["attachmentsSettingsForm"];
?>

<?php echo $form->open(); ?>

<div class='section'>
    <p><?php echo T("Configure how files are handled when uploaded to posts."); ?></p>

    <ul class='form'>
        <li>
            <label><?php echo T("Allowed file types"); ?></label>
            <?php echo $form->input("allowedFileTypes", "text", array("placeholder" => "e.g., jpg jpeg webp")); ?>
            <small><?php echo T("Enter file extensions separated by a space (e.g., jpg jpeg webp). Leave blank to allow all file types."); ?></small>
        </li>

        <li>
            <label><?php echo T("Max file size"); ?></label>
            <?php echo $form->input("maxFileSize", "text", array("placeholder" => "e.g., 100")); ?>
            <small><?php echo T("Enter the maximum allowed size in KB (e.g., 100 for 100KB). Leave blank for unlimited size."); ?></small>
        </li>
    </ul>
</div>

<div class='buttons'>
    <?php echo $form->saveButton("attachmentsSave"); ?>
</div>

<?php echo $form->close(); ?>