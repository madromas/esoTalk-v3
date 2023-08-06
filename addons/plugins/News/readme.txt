$string.='<p><strong>'.addslashes($new['title']).'</strong> '.addslashes($new['content']).' <small>'.date("d-m-Y H:i", $new['startTime']).'</small></p>';

$js = '<script>$(document).ready(function(){ if ($("div.triangle-border.top").length == 0) { $("<div class=\"triangle-border top\"'.$string.'</div>").insertBefore("div#messages");} });</script>'; // Before OR After
