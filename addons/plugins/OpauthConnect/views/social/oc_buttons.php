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

/**
 * Available variables:
 * 
 * $data["remember"] - Does plugin set login cookies
 * $data["services"] - Array of available services. Each service has following structure:
 *                     "service_name" => array(
 *                         "url" => Login URL
 *                         "icon" => Service icon
 *                     )
 */
?>

<span style="padding:1.5em;">
    <?php foreach($data['services'] as $service_name => $service): ?>
        <a href="<?php print $service['url']; ?>">
            <i class="icon"><img src="<?php print $service['icon']; ?>" width="32px" alt="<?php print $service_name." icon"; ?>" title="<?php print T('Log in using ').$service_name; ?>"/></i>&nbsp;
        </a>
    <?php endforeach; ?>
</span>
    
<div id="remember-container"  style="display: none;">
    <a href="#" class="button toggle <?php if($data["remember"]): ?>button-pressed<?php endif; ?>">
        <i class="icon-check<?php if(!$data["remember"]): ?>-empty<?php endif; ?>"></i> <?php print T('Keep me logged in'); ?>
    </a>
</div>