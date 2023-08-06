<?php
// Copyright 2011 Toby Zerner, Simon Zerner
// This file is part of esoTalk. Please see the included license file for usage information.

if (!defined("IN_ESOTALK")) exit;

/**
 * This controller displays the dashboard section of the admin CP. Not much to see here!
 *
 * @package esoTalk
 */
class ETDashboardAdminController extends ETAdminController {


/**
 * Show the administrator dashboard view.
 *
 * @return void
 */
public function action_index()
{
	$this->title = T("Dashboard");

	// Work out a UNIX timestamp of one week ago.
	$oneWeekAgo = time() - 60 * 60 * 24 * 7;

	// Create an array of statistics to show on the dashboard.
	$statistics = array(

		// Number of members.
		"<a href='".URL("members")."'>".T("Members")."</a>" => number_format(ET::SQL()->select("COUNT(*)")->from("member")->exec()->result()),

		// Number of conversations.
		T("Conversations") => number_format(ET::SQL()->select("COUNT(*)")->from("conversation")->exec()->result()),

		// Number of posts.
		T("Posts") => number_format(ET::SQL()->select("COUNT(*)")->from("post")->exec()->result()),

		// Members who've joined in the past week.
		T("New members in the past week") => number_format(ET::SQL()->select("COUNT(*)")->from("member")->where(":time<joinTime")->bind(":time", $oneWeekAgo)->exec()->result()),

		// Conversations which've been started in the past week.
		T("New conversations in the past week") => number_format(ET::SQL()->select("COUNT(*)")->from("conversation")->where(":time<startTime")->bind(":time", $oneWeekAgo)->exec()->result()),

		// Posts which've been made in the past week.
		T("New posts in the past week") => number_format(ET::SQL()->select("COUNT(*)")->from("post")->where(":time<time")->bind(":time", $oneWeekAgo)->exec()->result()),

	);

	// Determine if we should show the welcome sheet.
	if (!C("esoTalk.admin.welcomeShown")) {
		$this->data("showWelcomeSheet", true);
		ET::writeConfig(array("esoTalk.admin.welcomeShown" => true));
	}

	$this->data("statistics", $statistics);
	$this->render("admin/dashboard");
}


/**
 * Get a list of the most recent posts on the esoTalk blog. Also check for updates to the esoTalk software
 * and return the update notification area.
 *
 * @return void
 */
public function action_news()
{
	// ***** Hotfix
	return;
	// ***** /Hotfix
}

}
