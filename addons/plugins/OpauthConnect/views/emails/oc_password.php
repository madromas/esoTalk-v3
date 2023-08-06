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
 * $data["forumName"] - Forum title
 * $data["userName"] - Forum username
 * $data["password"] - Generated user's password
 */
?>

You have successfully registered on <?php print $data['forumName']; ?>
<br/>
Your username: <?php print $data['userName']; ?>
<br/>
Your password: <?php print $data['password']; ?>