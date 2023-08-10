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
<html lang="ar">
<head>
<meta charset='<?php echo T("charset", "utf-8"); ?>'>
<title><?php echo sanitizeHTML($data["pageTitle"]); ?></title>
<?php echo $data["head"]; ?>
<link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
<link rel="stylesheet" type="text/css" href="/fancybox/fancybox.css">
</head>

<body class='<?php echo $data["bodyClass"]; ?>'>
<script>
//Infinite Scroll
$(function(){ //on document ready
    $(document).scroll(function (e) { //bind scroll event

        var intBottomMargin = 60; //Pixels from bottom when script should trigger

        //if less than intBottomMargin px from bottom
        if ($(window).scrollTop() >= $(document).height() - $(window).height() - intBottomMargin) {
          //  $(".viewMore").click(); //trigger click
        }

    });
});
</script>
<script src="/fancybox/fancybox.js"></script>
<a href='#' class='scrollToTop'><i class='fas fa-chevron-up'></i></a>
 <script>
$(document).ready(function(){

    //Check to see if the window is top if not then display button
    $(window).scroll(function(){
        if ($(this).scrollTop() > 100) {
            $('.scrollToTop').fadeIn();
        } else {
            $('.scrollToTop').fadeOut();
        }
    });

    //Click event to scroll to top
    $('.scrollToTop').click(function(){
        $('html, body').animate({scrollTop : 0},800);
        return false;
    });

});
</script> 
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
<div id='hdr'>
<div id='hdr-content'>

<div id='hdr-inner'>

<?php if ($data["backButton"]): ?>
<a href='<?php echo $data["backButton"]["url"]; ?>' id='backButton' title='<?php echo T("Back to {$data["backButton"]["type"]}"); ?>'><i class="icon-chevron-right"></i></a>
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
<div id='ftr'>
<div id='ftr-content'>
<ul class='menu'>
<?php echo $data["metaMenuItems"]; ?>
<?php if (!empty($data["statisticsMenuItems"])) echo $data["statisticsMenuItems"]; ?>
</ul>
</div>
</div>
<?php $this->trigger("pageEnd"); ?>

</div>

</body>
</html>
