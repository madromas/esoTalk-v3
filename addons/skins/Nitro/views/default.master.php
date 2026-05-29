<?php
// Copyright 2011 Toby Zerner, Simon Zerner
// This file is part of esoTalk. Please see the included license file for usage information.

if (!defined("IN_ESOTALK")) exit;

/**
 * Default master view. Displays a HTML template with a header and footer.
 *
 * @package esoTalk
 */
?>
<!DOCTYPE html>
<html>
<head>
<meta charset='<?php echo T("charset", "utf-8"); ?>'>
<title><?php echo sanitizeHTML($data["pageTitle"]); ?></title>
<?php echo $data["head"]; ?>

</head>

<body class='<?php echo $data["bodyClass"]; ?>'>
<?php $this->trigger("pageStart"); ?>

<div id='messages'>
<?php foreach ($data["messages"] as $message): ?>
<div class='messageWrapper'>
<div class='message <?php echo $message["className"]; ?>' data-id='<?php echo @$message["id"]; ?>'><?php echo $message["message"]; ?></div>
</div>
<?php endforeach; ?>
</div>

<div id='wrapper'>

<!-- HEADER -->
<div class='header'><div class='header_content'><a href='<?php echo URL(""); ?>' class='title_alt'><?php echo $data["forumTitle"]; ?></a></div></div>
<div id='hdr'>
<div id='hdr-content'>

<div id='hdr-inner'>

<?php if ($data["backButton"]): ?>
<a href='<?php echo $data["backButton"]["url"]; ?>' id='backButton' title='<?php echo T("Back to {$data["backButton"]["type"]}"); ?>'><i class="icon-chevron-left"></i></a>
<?php endif; ?>

<h1 id='forumTitle'><a href='<?php echo URL(""); ?>'><?php echo $data["forumTitle"]; ?></a></h1>

<ul id='mainMenu' class='menu'>
<?php if (!empty($data["mainMenuItems"])) echo $data["mainMenuItems"]; ?>
</ul>

<ul id='userMenu' class='menu'>
<?php echo $data["userMenuItems"]; ?>
<li><a href='<?php echo URL("conversation/start"); ?>' class='link-newConversation button'><?php echo T("New Conversation"); ?></a></li>
</ul>

</div>
</div>
</div>

<!-- BODY -->
<div id='body'>
<div id='body-content'>
<?php echo $data["content"]; ?>
</div>
</div>




<!-- FOOTER -->
<div id='ftr'><div class='footer'></div>
<div id='ftr-content'>

<!-- footer link -->
<div id="footer_container">
<ul>
<li><div class="footer_block">
<!-- block content -->

Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur


<!-- block content -->
</div></li>

<!-- block content -->


<li><div class="footer_block"
>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum...


<!-- block content -->
</div></li>

<li><div class="footer_block">
<!-- block content -->

<ul style="list-style:none;">
<li><a href="#" class="link_1">Example link</a><li>
<li><a href="#" class="link_1">Example link</a><li>
<li><a href="#" class="link_1">Example link</a><li>
<li><a href="#" class="link_2">Example link</a><li>
<li><a href="#" class="link_3">Example link</a><li>
</ul>

<!-- block content -->
</div></li>

<li><div class="footer_block">
<!-- block content -->


Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud... 


<!-- block content -->
</div></li>
</ul>
</div>

<!-- footer link -->


<ul class='menu'>
<!-- theme designer -->
<li class='mfd' title='Design: myforum-design.ru'></li>
<!-- theme designer -->
<li id='goToTop'><a href='#'><?php echo T("Go to top"); ?></a></li>
<?php echo $data["metaMenuItems"]; ?>
<?php if (!empty($data["statisticsMenuItems"])) echo $data["statisticsMenuItems"]; ?>

</ul>


</div>

<?php $this->trigger("pageEnd"); ?>


</div>


</div>






</body>
</html>
