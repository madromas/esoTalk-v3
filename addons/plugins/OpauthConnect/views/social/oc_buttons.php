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

<div id="social-container">
    <?php foreach($data['services'] as $service_name => $service): ?>
        <a href="<?php print $service['url']; ?>" class="button toggle">
            <i class="icon"><img src="<?php print $service['icon']; ?>" alt="<?php print $service_name." icon"; ?>"/></i>
            <?php print T('Log in using ').$service_name; ?>
        </a>
    <?php endforeach; ?>
</div>
    
<div id="remember-container">
    <a href="#" class="button toggle <?php if($data["remember"]): ?>button-pressed<?php endif; ?>">
        <i class="icon-check<?php if(!$data["remember"]): ?>-empty<?php endif; ?>"></i> <?php print T('Keep me logged in'); ?>
    </a>
</div>