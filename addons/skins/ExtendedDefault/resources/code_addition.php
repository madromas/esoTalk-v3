/* This file is not meant to be run. It's here just to show what code */
/* has been added to file core/views/conversations/conversation.php   */
/* (ver 1.0.0g4) if anyone wants to do the same with a later version  */
/* Line 55 of that file (ver 1.0.0g4) was */
<div class='col-channel'><?php
$channel = $data["channelInfo"][$conversation["channelId"]];
// .....etc

/* The code below was added at line 55 of the file (i.e just before the code above) */
<div class='col-firstPost'><?php
	echo "<span class='action'>".avatar(array(
		"memberId" => $conversation["startMemberId"],
		"username" => $conversation["startMember"],
		"avatarFormat" => $conversation["startMemberAvatarFormat"],
		"email" => $conversation["startMemberEmail"]
	), "thumb"), " ",
	sprintf(T("%s "),
		"<span class='lastPostMember name'>".memberLink($conversation["startMemberId"], $conversation["startMember"])."</span>", true),
	"</span>";
?></div>
/* end add code */

/* I have also commented out line 49-52 of the same file to remove excerpt */
/* print-outs of sticky posts. Does not look nice with this skin */
