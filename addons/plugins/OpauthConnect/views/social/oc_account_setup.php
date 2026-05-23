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

<div class="sheet confirm-info-sheet">
    <div class='sheetContent confirm-info-sheet-wrapper'>
        <h3><?php print T("One more step to complete your authorization..."); ?></h3>
        <?php print $data["form"]->open(); ?>
            <?php print $data["form"]->input("avatar", "hidden"); ?>
            <div class='sheetBody'>
                <ul class='form form-confirm-info'>
                    <?php if(!$data["email_only"]): ?>
                        <li>
                            <label><?php print T("Username"); ?></label>
                            <?php print $data["form"]->input("username", "text"); ?>
                        </li>
                        <li class='sep'></li>
                    <?php endif; ?>
                    <li>
                        <label><?php print T("Email"); ?></label>
                        <?php
                            $attributes = array();
                            if(!$data["show_email"]) {
                                $attributes["disabled"] = "disabled";
                            }
                            print $data["form"]->input("email", "text", $attributes);
                        ?>
                    </li>
                    <li class='sep'></li>
                    <?php if(!$data["email_only"]): ?>
                        <li class="advanced-info-button <?php if($data['show_password']) print 'show_password'; ?>">
                            <label>
                                <a href="#">
                                    <span>+</span>
                                    <span style="display: none;">-</span> 
                                    <?php print T("advanced"); ?>
                                </a>
                            </label>
                        </li>
                        <li class="advanced-info advanced-info-password">
                            <label><?php print T("Password"); ?></label>
                            <?php print $data["form"]->input("password", "password", array("disabled" => "disabled")); ?>
                        </li>
                        <li class="advanced-info advanced-info-password">
                            <label><?php print T("Repeat password"); ?></label>
                            <?php print $data["form"]->input("password_repeat", "password", array("disabled" => "disabled")); ?>
                        </li>
                        <li class="or-separator advanced-info">or</li>
                        <li class="generate-password advanced-info">
                            <div class="generate-password-wrapper">
                                <div><?php print $data["form"]->checkBox("generate_password", array("checked" => "checked")); ?></div>
                                <div class="generate-password-label"><?php print T("Generate my password automatically (it will be sent to your email)"); ?></div>
                            </div>
                        </li>
                        <li class='sep advanced-info'></li>
                    <?php endif; ?>
                    <li><?php print $data["form"]->button("save", T("Complete authorization"), array("class" => "big submit")); ?></li>
                </ul>
            </div>
        <?php print $data["form"]->close(); ?>
    </div>
</div>