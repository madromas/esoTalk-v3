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
 * $data["isNewUser"] - Whether the user is newly registered or just linked one more social network account
 * $data["userName"] - Forum username
 * $data["confirmationUrl"] - No description needed, I guess:)
 * $data["socialNetwork"] - User's social network name
 * $data["socialName"] - User's name in that network
 * $data["profileLink"] - Link to user's social network account
 */
?>

<?php if($data["isNewUser"]): ?>
    Wellcome to <?php print $data["forumName"]; ?>, <?php print $data["socialName"]; ?>!
<?php else: ?>
    You just linked your <a href="<?php print $data["profileLink"]; ?>"><?php print $data["socialNetwork"]; ?> account</a>.
<?php endif; ?>
<br/>
Please <a href="<?php print $data["confirmationUrl"]; ?>">click here</a> to confirm your email address