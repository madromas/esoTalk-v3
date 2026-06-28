$string.='<p><strong>'.addslashes($news['title']).'</strong> '.addslashes($news['content']).' <small>'.date("d-m-Y H:i", $news['startTime']).'</small></p>';

$js = '<script>$(document).ready(function(){ if ($("div.triangle-border.top").length == 0) { $("<div class=\"triangle-border top\"'.$string.'</div>").insertBefore("div#messages");} });</script>'; // Before OR After
