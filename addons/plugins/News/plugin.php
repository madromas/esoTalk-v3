<?php
// Copyright 2014 Aleksandr Tsiolko

if (!defined("IN_ESOTALK")) exit;

ET::$pluginInfo["News"] = array(
	"name" => "News",
	"description" => "Allows add forum news to esotalk.",
	"version" => "2.0.0",
	"author" => "esoTalk Team",
	"authorEmail" => "5557720max@gmail.com",
	"authorURL" => "https://github.com/phpSoftware/esoTalk-v2/",
	"license" => "MIT"
);

class ETPlugin_News extends ETPlugin {

	public function setup($oldVersion = "")
	{
		$structure = ET::$database->structure();
		$structure->table("news") 
			->column("newsId", "int(11) unsigned", false)
			->column("title", "varchar(31)", false)
			->column("content", "text")
			->column("hideFromGuests", "tinyint(1)", 0)
			->column("position", "int(11)", 0)
			->column("startTime", "int(11)", false)
			->key("newsId", "primary")
			->exec(false);

		$this->createDefaultNews();
		return true;
	}
	
	protected function createDefaultNews()
	{
		$time = time();
		$model = ET::getInstance("newsModel");
		$model->setData(array(
			"title"          => "First news",
			"content"        => "We are open.",
			"hideFromGuests" => 0,
			"position"       => 1,
			"startTime"      => $time
		));
		
		return true;
	}

	public function __construct($rootDirectory)
	{
		parent::__construct($rootDirectory);		
		ETFactory::register("newsModel", "NewsModel", dirname(__FILE__)."/NewsModel.class.php");		
		ETFactory::registerAdminController("news", "NewsAdminController", dirname(__FILE__)."/NewsAdminController.class.php");
	}

	public function handler_initAdmin($sender, $menu)
	{
		$menu->add("news", "<a href='".URL("admin/news")."'><i class='icon-pencil'></i> ".T("News")."</a>");
	}
	
	public function handler_init($sender) 
	{
		$model = ET::getInstance("newsModel");
		$news = $model->get();
		if($news){			
			$string = '';
			foreach($news as $news){
				if (ET::$session->userId) {
					$string.='<span title=\''.date("m.d.Y", $news['startTime']).'\'><strong>'.addslashes($news['title']).'</strong> '.addslashes($news['content']).'</span>';
				} 
				elseif($news['hideFromGuests']==0){
					$string.='<span title=\''.date("m.d.Y", $news['startTime']).'\'><strong>'.addslashes($news['title']).'</strong> '.addslashes($news['content']).'</span>';
				}
			}
			
			if(!empty($string)){
				$js = '<script>$(document).ready(function(){ if ($("div.triangle-border.top").length == 0) { $("<div class=\"triangle-border top\">'.$string.'</div>").insertBefore("form#search");} });</script>';
				$sender->addToHead($js);
			}			
		}
		return true;		
	}
	
	public function disable()
	{
		return true;
	}
	
	public function uninstall()
	{
		$structure = ET::$database->structure();
		$structure->table("news")
			->drop();
		return true;
	}
}
