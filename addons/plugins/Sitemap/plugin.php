<?php
// Copyright 2014 Tristan van Bokkem

use SitemapPHP\Sitemap;

if (!defined("IN_ESOTALK")) exit;

ET::$pluginInfo["Sitemap"] = array(
	"name" => "Sitemap",
	"description" => "Generate XML index and sitemap files.",
	"version" => "1.0.0",
	"author" => "Tristan van Bokkem",
	"authorEmail" => "tristanvanbokkem@gmail.com",
	"authorURL" => "https://madway.net",
	"license" => "GPLv2",
	"dependencies" => array(
		"esoTalk" => "1.0.0g4"
	)
);

class ETPlugin_Sitemap extends ETPlugin
{
	public function setup($oldVersion = "")
	{
		// Don't enable this plugin if we are not running PHP >= 5.3.0.
		if (version_compare(PHP_VERSION, '5.3.0') < 0) {
			return "PHP >= 5.3.0 is required to enable this plugin.<br />However, you are running PHP ".PHP_VERSION;
		} else {

			// Lets create a sitemap on init.
			$this->action_create();

			// Submit the sitemap to Google and Bing.
			$this->autoSubmit();

			ET::$controller->message(T("Sitemap generated!"), "success autoDismiss");

			return true;
		}
	}

	public function init()
	{
		// Define default language definitions.
		ET::define("message.Sitemap.cache", "To reduse server load, the sitemap will be cached for some time. After this time it will be recreated. Enter the number of hours for which the sitemap will be cached. Or enter 0 for disabling caching.");
		ET::define("message.Sitemap.exclude", "Channels selected here and topics inside them will be excluded from the Sitemap.");
	}

	public function handler_conversationModel_createAfter($model, $conversation, $postId, $content)
	{
	    // Create a sitemap after a new conversation has been posted,
		// but only if the cache has expired to prevent flooding the system.
		if (!file_exists(PATH_ROOT."/sitemap.xml") or filemtime(PATH_ROOT."/sitemap.xml") < time() - (C("plugin.Sitemap.cache") * 3600) - 200) {
			$this->action_create();
		}
	}


	public function action_create()
	{
		// Include the file needed to create the sitemap.
		include "lib/Sitemap.php";

		$sitemap = new Sitemap(C("esoTalk.baseURL"));
		$sitemap->setPath(PATH_ROOT."/");
		$sitemap->addItem("", "1.0", "hourly", 'now');

		$result = ET::SQL()
			->select("ch.channelId")
			->select("ch.slug")
		    ->from("channel ch")
			->orderBy("ch.channelId ASC")
		    ->exec();

		$channels = $result->allRows("channelId");

		foreach ($channels as $channel) {
			if(!in_array($channel["slug"], C("plugin.Sitemap.channels"))) {
				$sitemap->addItem("conversations/".$channel["slug"], C("plugin.Sitemap.priority3"), C("plugin.Sitemap.frequency3"), 'now');

				$result = ET::SQL()
					->select("c.conversationId")
					->select("c.title")
					->select("c.channelId")
					->select("c.sticky")
					->select("lastPostTime")
					->from("conversation c")
					->where("c.channelId = :channelId")
					->where("private", 0)
					->orderBy("c.conversationId ASC")
					->bind(":channelId", $channel["channelId"])
					->exec();

				$conversations = $result->allRows();

				foreach ($conversations as $conversation) {
					$url = conversationURL($conversation["conversationId"], $conversation["title"]);

					if($conversation["sticky"]) {
						$sitemap->addItem($url, C("plugin.Sitemap.priority2"), C("plugin.Sitemap.frequency2"), $conversation["lastPostTime"]);
					} else {
						$sitemap->addItem($url, C("plugin.Sitemap.priority1"), C("plugin.Sitemap.frequency1"), $conversation["lastPostTime"]);
					}
				}
			}
		}

		$sitemap->createSitemapIndex("https://madway.net", 'now');
	}

	public function settings($sender)
	{
		$sender->addCSSFile($this->resource("sitemap.css"));

		// Set up the settings form.
		$form = ETFactory::make("form");
		$form->action = URL("admin/plugins/settings/Sitemap");

		// Add the section for the restore element.
        $form->addSection("channels");

		// Add the field for the restore select element.
        $form->addField("channels", "channels", array($this, "renderChannelsField"), array($this, "processChannelsField"));

		$form->setValue("channels[]", C("plugin.Sitemap.channels"));

		// Set the values for the sitemap options.
		$form->setValue("cache", C("plugin.Sitemap.cache", "24"));
		$form->setValue("prio1", C("plugin.Sitemap.priority1", "0.5"));
		$form->setValue("prio2", C("plugin.Sitemap.priority2", "0.6"));
		$form->setValue("prio3", C("plugin.Sitemap.priority3", "0.7"));
		$form->setValue("freq1", C("plugin.Sitemap.frequency1", "daily"));
		$form->setValue("freq2", C("plugin.Sitemap.frequency2", "daily"));
		$form->setValue("freq3", C("plugin.Sitemap.frequency3", "hourly"));
		$form->setValue("auto1", C("plugin.Sitemap.google", true));
		$form->setValue("auto2", C("plugin.Sitemap.bing", true));


		// If the form was submitted...
		if ($form->validPostBack()) {

			// Get the value from the dynamically created "compress" field.
			$form->runFieldCallbacks($data);

			// Construct an array of config options to write.
			$config = array();
			$config["plugin.Sitemap.cache"] = $form->getValue("cache");
			$config["plugin.Sitemap.channels"] = array_combine($data["channels"], $data["channels"]);
			$config["plugin.Sitemap.priority1"] = $form->getValue("prio1");
			$config["plugin.Sitemap.priority2"] = $form->getValue("prio2");
			$config["plugin.Sitemap.priority3"] = $form->getValue("prio3");
			$config["plugin.Sitemap.frequency1"] = $form->getValue("freq1");
			$config["plugin.Sitemap.frequency2"] = $form->getValue("freq2");
			$config["plugin.Sitemap.frequency3"] = $form->getValue("freq3");
			$config["plugin.Sitemap.google"] = $form->getValue("auto1");
			$config["plugin.Sitemap.bing"] = $form->getValue("auto2");

			// Write the config file.
			ET::writeConfig($config);

			$this->action_create();

			$sender->message(T("The sitemap has been regenerated!"), "success autoDismiss");

			if(!C("plugin.Sitemap.google") && !C("plugin.Sitemap.bing")) {
				$sender->message(T("Please submit <strong><i>".C("esoTalk.baseURL")."sitemap.xml</i></strong> to <a href='https://support.google.com/sites/answer/100283?hl=en' target='_blank'>Google Webmaster Tools</a> and <a href='http://www.bing.com/webmaster/help/how-to-submit-sitemaps-82a15bd4' target='_blank'>Bing Webmaster Tools</a>."), "success");
			}

			$this->autoSubmit();

			$sender->redirect(URL("admin/plugins"));
		}

		$sender->data("SitemapSettingsForm", $form);
		return $this->view("settings");
	}

	function processChannelsField($form, $key, &$data)
    {
        $data["channels"] = $form->getValue($key);
    }


	function renderChannelsField($form)
    {
		$channels = ET::channelModel()->getAll();

		$titles = array();

		foreach ($channels as $channel) {
			$titles[] = $channel["title"];
			$slug[] = $channel["slug"];
        }

		// Set the keys of the titles array
		// the same as the values.
		$channelslist = array_combine($slug, $titles);

		$channelslist[] = T("(no channels excluded)");
		// Set up the select element.
		$settings = array(
					"style" => "width:230px",
					"size" => count($channelslist) ,
					"multiple" => "multiple"
				);

		// Return the restore select element.
        return  $form->select("channels[]", $channelslist, $settings);
    }

	function autoSubmit()
	{
		if(C("plugin.Sitemap.google")) {
			$response = $this->cURL("https://www.google.com/ping?sitemap=".urlencode(C("esoTalk.baseURL")."sitemap.xml"));
			ET::$controller->message(T("<strong>Google Sitemaps</strong> has been pinged. (response code: ".$response.")"), (($response == '200') ? "success" : "warning")." autoDismiss");
		}
		if(C("plugin.Sitemap.bing")) {
			$response = $this->cURL("https://www.bing.com/ping?sitemap=".urlencode(C("esoTalk.baseURL")."sitemap.xml"));
			ET::$controller->message(T("<strong>Bing Sitemaps</strong> has been pinged. (response code: ".$response.")"), (($response == '200') ? "success" : "warning")." autoDismiss");
		}
	}

	function cURL($url)
	{
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_exec($ch);
		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		return $httpCode;
	}
}
