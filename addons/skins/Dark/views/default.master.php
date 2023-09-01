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
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" 
"http://www.w3.org/TR/html4/strict.dtd">
<html id="h">
<head>
 
<meta charset='<?php echo T("charset", "utf-8"); ?>'>
<title><?php echo sanitizeHTML($data["pageTitle"]); ?></title>

<?php echo $data["head"]; ?>

    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta property="og:title" content="<?php echo sanitizeHTML($data["pageTitle"]); ?>" />
    <meta property="og:description" content="If you are normal, you have got to be MAD!" />
	<meta property="og:url" content="<?php echo URL('',true); ?>" />
	<?php if(file_exists('uploads/logo.png')) { ?>
    <meta property="og:image" content="<?php echo URL('',true); ?>uploads/logo.png" />
  <?php } ?>
  <?php if(file_exists('favicon.png')) { ?>
  
    <link rel="shortcut icon" type="image/png" href="<?php echo URL('',true); ?>favicon.png" />
  <?php } ?> 
  <link rel="manifest" href="/manifest.json">
<link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v6.4.2/css/all.css">
<link rel="shortcut icon" href="/favicon.png" />
<link rel="stylesheet" type="text/css" href="/fancybox/fancybox.css">
<link type="text/css" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500&display=swap" rel="stylesheet">

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

<script src="/fancybox/fancybox.js"></script>
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

<a href='<?php echo $data["backButton"]["url"]; ?>' id='backButton' title='<?php echo T("Back to {$data["backButton"]["type"]}"); ?>'><i class="icon-chevron-left"></i></a>

<?php endif; ?>

<a href='<?php echo URL(""); ?>'><h1 id='forumTitle'><?php echo $data["forumTitle"]; ?></h1></a>

<ul id='mainMenu' class='menu'>
<?php if (!empty($data["mainMenuItems"])) echo $data["mainMenuItems"]; ?>
</ul>

<ul id='userMenu' class='menu'>
<?php echo $data["userMenuItems"]; ?>







<li class="item-Links mode-switch">
     <button  class="sel-dark-toggle" id="toggle-darkmod">
   <svg class="i__moon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="butt" stroke-linejoin="bevel"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg>
   
    <svg  class="i__sun" xmlns="http://www.w3.org/2000/svg" style="display:none;" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="12" r="5"/><path d="M12 1v2M12 21v2M4.2 4.2l1.4 1.4M18.4 18.4l1.4 1.4M1 12h2M21 12h2M4.2 19.8l1.4-1.4M18.4 5.6l1.4-1.4"/>  
         </svg></button></li>
		 
 <script>
const
g=i=>document.getElementById(i),
classes=g('h').classList,
cl="dark";

if(localStorage.getItem("toggled-ttl")>Date.now())
classes.toggle(cl,localStorage.getItem("toggled"));

g("toggle-darkmod").addEventListener("click",function(e){
e.preventDefault();

if(classes.contains(cl)) {
localStorage.removeItem("toggled");
localStorage.removeItem("toggled-ttl");
classes.remove(cl);
}
else {
localStorage.setItem("toggled",1);
localStorage.setItem("toggled-ttl",Date.now() + 60*86400000);
classes.add(cl);
}
});
</script>






 

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

<?php if (!empty($data["metaMenuItems"])) echo $data["metaMenuItems"]; ?>
<?php if (!empty($data["statisticsMenuItems"])) echo $data["statisticsMenuItems"]; ?>
</ul>
</div>
</div>
<?php $this->trigger("pageEnd"); ?>

</div>

</body>
</html>
