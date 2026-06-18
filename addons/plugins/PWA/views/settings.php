<?php $form = $data["pwaSettingsForm"]; ?>
<?php echo $form->open(); ?>
<div class='section'>
    <ul class='form'>
        <li><label><?php echo T("App Name"); ?></label><?php echo $form->input("pwaName", "text"); ?></li>
        <li><label><?php echo T("Short Name"); ?></label><?php echo $form->input("pwaShortName", "text"); ?></li>
        <li><label><?php echo T("Theme Color"); ?></label><?php echo $form->input("pwaThemeColor", "text"); ?></li>
    </ul>
</div>
<div class='buttons'><?php echo $form->saveButton("pwaSave"); ?></div>
<?php echo $form->close(); ?>