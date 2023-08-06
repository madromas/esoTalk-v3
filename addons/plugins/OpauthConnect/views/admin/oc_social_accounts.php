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

<?php if(!$data["accounts_exist"]): ?>
    <p class="help">No accounts linked yet</p>
<?php else: ?>
    <div class="settings-accounts">
        <?php foreach($data["accounts"] as $account): ?>
            <div class="settings-account clearfix">
                <div class="account-logo">
                    <img src="<?php print $account["logo"]; ?>" />
                </div>
                <div class="account-description">
                    <a target="blank" class="account-link" href="<?php print $account["profileLink"]; ?>"><?php print $account["name"]; ?></a>
                    <?php if($account["confirmed"]): ?>
                        <div class="account-confirmed">Confirmed</div>
                    <?php else: ?>
                        <div class="account-not-confirmed">
                            <span>Not confirmed</span> | 
                            <a href="<?php print URL("user/social/sendconfirmation/".$account["id"]); ?>">Send confirmation to email</a>
                        </div>
                    <?php endif; ?>
                    <?php if($data["allow_unlink"]): ?>
                        <div class="account-unlink">
                            <a href="<?php print URL("settings/social/unlink/".$account["id"]); ?>">Unlink this account</a>
                            <span style="display: none;"><?php print T('Are you sure to unlink "'.$account["name"].'" account?'); ?></span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>