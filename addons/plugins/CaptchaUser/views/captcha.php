<?php
// Copyright 2014 andrewks
// This file is part of esoTalk. Please see the included license file for usage information.

if (!defined("IN_ESOTALK")) exit;

/**
 * Displays the channel list.
 *
 * @package esoTalk
 */
 
$form = $data["form"];
$resURL = $data["captchaResURL"];
?>

<li>
<img id="siimage" style="border: 1px solid #000; margin-right: 15px" src="<?php echo URL('captcha/generate'); ?>" alt="CAPTCHA Image" align="left">
<object type="application/x-shockwave-flash" data="<?php echo $resURL; ?>/securimage_play.swf?bgcol=%23ffffff&amp;icon_file=<?php echo $resURL; ?>/images/audio_icon.png&amp;audio_file=<?php echo URL('captcha/play'); ?>" height="32" width="32">
<param name="movie" value="<?php echo $resURL; ?>/securimage_play.swf?bgcol=%23ffffff&amp;icon_file=<?php echo $resURL; ?>/images/audio_icon.png&amp;audio_file=<?php echo URL('captcha/play'); ?>" />
</object>
&nbsp;
<a tabindex="-1" style="border-style: none;" href="#" title="<?php echo T("plugin.CaptchaUser.message.refreshImage"); ?>" onclick="document.getElementById('siimage').src = '<?php echo URL('captcha/generate'); ?>/' + Math.random(); this.blur(); return false"><img src="<?php echo $resURL; ?>/images/refresh.png" alt="Reload Image" onclick="this.blur()" align="bottom" border="0"></a><br />
</li>
    
<li><label><?php echo T("plugin.CaptchaUser.captchaLabel"); ?></label> <?php echo $form->input("captcha", 'text', array('size' => 12, 'maxlength' => 16, 'value' => '')); ?><small><?php echo T("plugin.CaptchaUser.captchaDesc"); ?></small></li>