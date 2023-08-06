<?php
/**
 * OpauthConnect
 * 
 * @copyright Copyright © 2012 Oleksandr Golubtsov
 * @license   GPLv2 License
 * @package   OpauthСonnect
 * 
 * This file is part of OpauthСonnect plugin. Please see the included license file for usage information
 */
?>

<script>
    $(document).ready(function() {
        $(":checkbox:not(.static)").each(function() {
            toggleFields(this);
        })
    });
</script>

<?php print $data["form"]->open(); ?>
    <div class='section opauth-settings clearfix'>

        <div class="category first-category">
            <div class="row category-toggle">
                Common settings <span>+</span><span style="display: none;">-</span>
            </div>
            <div class="category-settings">
                <div class="row clearfix">
                    <div class="status">
                        <label><?php print T('Security salt'); ?></label>
                    </div>
                    <div>
                        <ul class='form'>
                            <li>
                                <?php print $data["form"]->input(OCSettings::SECURITY_SALT, "text"); ?>
                                <div class="help"><?php print T('Strongly recommend to set your own value!'); ?></div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="status">
                        <?php print $data["form"]->checkbox(OCSettings::ALLOW_UNLINK, array("class" => "static")); ?>
                        <label><?php print T('Unlink accounts'); ?></label>
                    </div>
                    <div>
                        <?php print T('Allows users to unlink their social accounts.'); ?><br/>
                        <?php print T('Without removing forum account, for sure.'); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="category">
            <div class="row category-toggle">
                Social networks settings <span>+</span><span style="display: none;">-</span>
            </div>
            <div class="category-settings">
                <?php foreach($data['form_services'] as $service): ?>
                    <div class="row clearfix">
                        <div class="status">
                            <?php
                                $data["form"]->setValue($service['enabled']['key'], $service['enabled']['value']);
                                print $data["form"]->checkbox($service['enabled']['key']);
                            ?>
                            <label><?php print $service['name']; ?></label>
                        </div>
                        <div>
                            <ul class='form'>
                                <li>
                                    <label><?php print $service['name']." ".$service['raw_key']; ?></label>
                                    <?php
                                        $data["form"]->setValue($service['key']['key'], $service['key']['value']);
                                        print $data["form"]->input($service['key']['key'], "text");
                                    ?>
                                </li>
                                <li>
                                    <label><?php print $service['name']." ".$service['raw_secret']; ?></label>
                                    <?php
                                        $data["form"]->setValue($service['secret']['key'], $service['secret']['value']);
                                        print $data["form"]->input($service['secret']['key'], "text");
                                    ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="category">
            <div class="row category-toggle">
                Emails settings <span>+</span><span style="display: none;">-</span>
            </div>
            <div class="category-settings">
                <div class="row clearfix">
                    <div class="status">
                        <label><?php print T('Confrimation email subject'); ?></label>
                    </div>
                    <div>
                        <ul class='form'>
                            <li>
                                <?php print $data["form"]->input(OCSettings::CONFIRM_EMAIL_SUBJ, "textarea", array("rows" => 3)); ?>
                                <div class="help">
                                    <?php print T('Available wildcards:'); ?><br/>
                                    [forumName] - <?php print T("Forum title"); ?><br/>
                                    [userName] - <?php print T("Forum username"); ?><br/>
                                    [socialNetwork] - <?php print T("User's social network"); ?><br/>
                                    [socialName] - <?php print T("User's name in this network"); ?>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="status">
                        <label><?php print T('Password email subject'); ?></label>
                    </div>
                    <div>
                        <ul class='form'>
                            <li>
                                <?php print $data["form"]->input(OCSettings::PASS_EMAIL_SUBJ, "textarea", array("rows" => 3)); ?>
                                <div class="help">
                                    <?php print T('Available wildcards:'); ?><br/>
                                    [forumName] - <?php print T("Forum title"); ?><br/>
                                    [userName] - <?php print T("Forum username"); ?>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class='buttons'>
        <?php print $data["form"]->saveButton(); ?>
    </div>
<?php print $data["form"]->close(); ?>