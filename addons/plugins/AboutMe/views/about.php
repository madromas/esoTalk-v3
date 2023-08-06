<?php
// Copyright 2013 Toby Zerner, Simon Zerner
// Copyright 2013 andrewks
// This file is part of esoTalk. Please see the included license file for usage information.

if (!defined("IN_ESOTALK")) exit;

$member = $data["member"];
$about = $data["about"];
$name = $data["name"];
$sex = $data["sex"];
$birthday = $data["birthday"];
$location = $data["location"];
$email = $data["email"];
$icq = $data["icq"];
$url = $data["url"];
?>
<div id='memberAbout'>

<?php if (ET::$session->user): ?>

	<ul class='form'>

		<li><label><?php echo T("plugin.AboutMe.name.label"); ?></label> <div><?php echo $name; ?></div></li>
		<li><label><?php echo T("plugin.AboutMe.sex.label"); ?></label> <div><?php echo $sex; ?></div></li>
		<li><label><?php echo T("plugin.AboutMe.birthday.label"); ?></label> <div><?php echo $birthday; ?></div></li>
		<li><label><?php echo T("plugin.AboutMe.location.label"); ?></label> <div><?php echo $location; ?></div></li>
	<?php if (isset($data["timeZone"])): ?>
		<li><label><?php echo T("plugin.TimeZones.timeZone.label"); ?></label> <div><?php echo $data["timeZone"]; ?></div></li>
		<li><label><?php echo T("plugin.TimeZones.localTime.label"); ?></label> <div><?php echo $data["localTime"]; ?></div></li>
	<?php endif; ?>
		<li><label><?php echo T("plugin.AboutMe.email.label"); ?></label> <div><?php echo "<a href='mailto:".$email."' class='link-email'>".$email."</a>"; ?></div></li>
		<li><label><?php echo T("plugin.AboutMe.icq.label"); ?></label> <div><?php echo ($icq ? "<img src='http://status.icq.com/online.gif?icq=".$icq."&img=26' style='padding-right:5px'></img>" : "") . "<a href='http://www.icq.com/people/".$icq."' rel='nofollow external' target='_blank' class='link-external'>".$icq." </a>"; ?></div></li>
		<li><label><?php echo T("plugin.AboutMe.url.label"); ?></label> <div><?php echo "<a href='".$url."' rel='nofollow external' target='_blank' class='link-external'>".$url." </a>"; ?></div></li>
		<li><label><?php echo T("plugin.AboutMe.about.label"); ?></label> <div><?php echo $about; ?></div></li>

	</ul>

<?php else: ?>
<?php echo T("hidden"); ?>
<?php endif; ?>

</div>