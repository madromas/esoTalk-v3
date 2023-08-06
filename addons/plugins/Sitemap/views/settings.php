<?php
// Copyright 2014 Tristan van Bokkem

if (!defined("IN_ESOTALK")) exit;

$form = $data["SitemapSettingsForm"];
?>
<?php echo $form->open(); ?>

<div class='section'>

<ul class='form sitemap'>

<li>
    <label style="width:290px;">
        <strong><?php echo T("Cache Time"); ?></strong><br ?>
        <small><?php echo T("message.Sitemap.cache"); ?></small>
</label>
<br />
<br />
<br />
    <?php echo $form->input("cache", "text", array("maxlength" => 2, "style" => "width:80px;")); ?> <span><?php echo T("Hours"); ?></span>

</li>
<li class="sep"></li>
<li>
    <label style="width:300px;">
        <strong><?php echo T("Exclude Channels"); ?></strong><br />
        <small><?php echo T("message.Sitemap.exclude"); ?></small>
    </label>
    <?php foreach ($form->getSections() as $section => $title): ?>
        <?php foreach ($form->getFieldsInSection($section) as $field): ?>
            <?php echo $field; ?>
        <?php endforeach; ?>
    <?php endforeach; ?>
</li>
<li class="sep"></li>
<li>
    <label style="width:300px;"><strong><?php echo T("Priority for default conversations"); ?></strong></label>
    <?php echo $form->select("prio1", array("0.0" => T("0.0"), "0.1" => T("0.1"), "0.2" => T("0.2"), "0.3" => T("0.3"), "0.4" => T("0.4"), "0.5" => T("0.1"), "0.5" => T("0.5"), "0.6" => T("0.6"), "0.7" => T("0.7"), "0.8" => T("0.8"), "0.9" => T("0.9")), array("style" => "width:80px;")); ?>
</li>
<li>
    <label style="width:300px;"><strong><?php echo T("Priority for sticky conversations"); ?></strong></label>
    <?php echo $form->select("prio2", array("0.0" => T("0.0"), "0.1" => T("0.1"), "0.2" => T("0.2"), "0.3" => T("0.3"), "0.4" => T("0.4"), "0.5" => T("0.1"), "0.5" => T("0.5"), "0.6" => T("0.6"), "0.7" => T("0.7"), "0.8" => T("0.8"), "0.9" => T("0.9")), array("style" => "width:80px;")); ?>
</li>
<li>
    <label style="width:300px;"><strong><?php echo T("Priority for channels"); ?></strong></label>
    <?php echo $form->select("prio3", array("0.0" => T("0.0"), "0.1" => T("0.1"), "0.2" => T("0.2"), "0.3" => T("0.3"), "0.4" => T("0.4"), "0.5" => T("0.1"), "0.5" => T("0.5"), "0.6" => T("0.6"), "0.7" => T("0.7"), "0.8" => T("0.8"), "0.9" => T("0.9")), array("style" => "width:80px;")); ?>
</li>
<li class="sep"></li>
<li>
    <label style="width:300px;"><strong><?php echo T("Frequency for default conversations"); ?></strong></label>
    <?php echo $form->select("freq1", array("always" => T("Always"), "hourly" => T("Hourly"), "daily" => T("Daily"), "weekly" => T("Weekly"), "monthly" => T("Monthly"), "yearly" => T("Yearly"), "never" => T("Never")), array("style" => "width:80px;")); ?>
</li>
<li>
    <label style="width:300px;"><strong><?php echo T("Frequency for sticky conversations"); ?></strong></label>
    <?php echo $form->select("freq2", array("always" => T("Always"), "hourly" => T("Hourly"),  "daily" => T("Daily"), "weekly" => T("Weekly"), "monthly" => T("Monthly"), "yearly" => T("Yearly"), "never" => T("Never")), array("style" => "width:80px;")); ?>
</li>
<li>
    <label style="width:300px;"><strong><?php echo T("Frequency for channels"); ?></strong></label>
    <?php echo $form->select("freq3", array("always" => T("Always"), "hourly" => T("Hourly"),  "daily" => T("Daily"), "weekly" => T("Weekly"), "monthly" => T("Monthly"), "yearly" => T("Yearly"), "never" => T("Never")), array("style" => "width:80px;")); ?>
</li>
<li class="sep"></li>
<li>
    <label style="width:300px;"><strong><?php echo T("Automatically submit to Google"); ?></strong></label>
    <?php echo $form->checkbox("auto1"); ?>
</li>
<li>
    <label style="width:300px;"><strong><?php echo T("Automatically submit to Bing"); ?></strong></label>
    <?php echo $form->checkbox("auto2"); ?>
</li>

</ul>

</div>

<div class='buttons'>
<?php echo $form->saveButton(); ?>
</div>

<?php echo $form->close(); ?>
