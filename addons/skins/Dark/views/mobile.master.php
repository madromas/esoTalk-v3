<?php
// Copyright 2011 Toby Zerner, Simon Zerner
// This file is part of esoTalk. Please see the included license file for usage information.

if (!defined("IN_ESOTALK")) exit;

/**
 * Mobile master view. Displays a simplified HTML template with a header and footer.
 *
 * @package esoTalk
 */
?>
<!DOCTYPE html>
<html id="h">
<head>
<meta charset='<?php echo T("charset", "utf-8"); ?>'>
<title><?php echo sanitizeHTML($data["pageTitle"]); ?></title>
<link rel="stylesheet" href="../fancybox/fancybox.css">
<?php echo $data["head"]; ?>
<script>
// Turn off JS effects and fixed positions, and disable tooltips.
jQuery.fx.off = true;
ET.disableFixedPositions = true;
$.fn.tooltip = function() { return this; };
// Make the user menu into a popup, and take notifications out of the user menu.
$(function() {
	$("#forumTitle").before($("#userMenu").popup({alignment: "right", content: "<i class='icon-reorder'></i>"}));
	$("#forumTitle").before($("#notifications").parent())
		.css("webkitTransform", "scale(1)"); // force a redraw to fix a webkit layout bug
});
</script>
</head>

<body class='<?php echo $data["bodyClass"]; ?>'>
<script>
$(function(){ //on document ready
    $(document).scroll(function (e) { //bind scroll event

        var intBottomMargin = 60; //Pixels from bottom when script should trigger

        //if less than intBottomMargin px from bottom
        if ($(window).scrollTop() >= $(document).height() - $(window).height() - intBottomMargin) {
            $(".viewMore").click(); //trigger click
        }

    });
});
</script>
<script src="../fancybox/fancybox.js"></script>
<?php $this->trigger("pageStart"); ?>

<div id='messages'>


<?php foreach ($data["messages"] as $message): ?>
<div class='messageWrapper'>
<div class='message <?php echo $message["className"]; ?>' data-id='<?php echo isset($message["id"]) ? $message["id"] : ""; ?>'><?php echo $message["message"]; ?></div>
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


<ul id='userMenu' class='menu'>


<li><a href='<?php echo URL("conversation/start"); ?>' class='link-newConversation'>New conversation</a></li>

<li class='sep'></li>
<?php echo $data["userMenuItems"]; ?>
</ul>

<h1 id='forumTitle'><a href='<?php echo URL(""); ?>'><?php echo $data["forumTitle"]; ?></a></h1>

<div class='popupMode'>

<li class="item-Links mode-switch">
     <button  class="sel-dark-toggle" id="toggle-darkmod">
   <svg class="i__moon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="butt" stroke-linejoin="bevel"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg>
   
    <svg  class="i__sun" xmlns="http://www.w3.org/2000/svg" style="display:none;" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="12" r="5"/><path d="M12 1v2M12 21v2M4.2 4.2l1.4 1.4M18.4 18.4l1.4 1.4M1 12h2M21 12h2M4.2 19.8l1.4-1.4M18.4 5.6l1.4-1.4"/>  
         </svg></button></li>
		 
		</div> 
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
</ul>
</div>
</div>
<?php $this->trigger("pageEnd"); ?>

</div>

</body>
</html>
