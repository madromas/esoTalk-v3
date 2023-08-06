<?php
// This file is part of esoTalk. Please see the included license file for usage information.

if (!defined("IN_ESOTALK")) exit;

ET::$pluginInfo["Pages"] = array(
	"name" => "Pages",
	"description" => "Allows custom static pages.",
	"version" => ESOTALK_VERSION,
	"author" => "Aleksandr Tsiolko",
	"authorEmail" => "support@esotalk.org",
	"authorURL" => "http://ifirestarter.ru",
	"license" => "MIT"
);

class ETPlugin_Pages extends ETPlugin {

	public function setup($oldVersion = "")
	{
		$structure = ET::$database->structure();
		$structure->table("page")
			->column("pageId", "int(11) unsigned", false)
			->column("title", "varchar(31)", false)
			->column("content", "text")
			->column("slug", "varchar(255) unique")
			->column("hideFromGuests", "tinyint(1)", 0)
			->column("menu", "enum('user','statistics','meta')", "user")
			->column("position", "int(11)", 0)
			->key("pageId", "primary")
			->exec(false);

		/*:-)*/
		if (!$oldVersion){
			$this->createDefaultPages();
		}
		elseif (version_compare($oldVersion, "1.0.0g4", "<")) {
			$this->createDefaultPages();
		}else{
			$this->createDefaultPages();
		}
		/*:-)*/
		return true;
	}
	
	protected function createDefaultPages()
	{
		$model = ET::getInstance("pageModel");
		$model->setData(array(
			"pageId"     => 1,
			"title"        => "About",
			"content" => "Write something about yourself.",
			"slug" => "about-page",
			"hideFromGuests"        => 0,
			"menu"=>"user",
			"position"        => 1
		));
		$model->setData(array(
			"pageId"     => 2,
			"title"        => "EsoTalk",
			"content" => "Write something about Esotalk Forum.",
			"slug" => "esotalk-page",
			"hideFromGuests"        => 0,
			"menu"=>"user",
			"position"        => 2
		));
	}

	public function __construct($rootDirectory)
	{
		parent::__construct($rootDirectory);
		
		ETFactory::register("pageModel", "PageModel", dirname(__FILE__)."/PageModel.class.php");
		
		ETFactory::registerAdminController("pages", "PagesAdminController", dirname(__FILE__)."/PagesAdminController.class.php");
		ETFactory::registerController("pages", "PagesController", dirname(__FILE__)."/PagesController.class.php");
	}


	public function handler_initAdmin($sender, $menu)
	{
		$menu->add("pages", "<a href='".URL("admin/pages")."'><i class='icon-book'></i> ".T("Pages")."</a>");
	}
	
	public function handler_init($sender) 
	{
		$model = ET::getInstance("pageModel");
		$pages = $model->get();
		if($pages){
			foreach($pages as $page){
				if (ET::$session->userId) {
					$sender->addToMenu($page['menu'], $page['slug'].'-page', '<a href="'.URL("pages").'/'.$page['pageId'].'-'.$page['slug'].'">'.$page['title'].'</a>');
				} 
				elseif($page['hideFromGuests']==0){
					$sender->addToMenu($page['menu'], $page['slug'].'-page', '<a href="'.URL("pages").'/'.$page['pageId'].'-'.$page['slug'].'">'.$page['title'].'</a>');
				}				
			}
		}		
	}
	
	public function disable()
	{
		return true;
	}
	
	public function uninstall()
	{
		$structure = ET::$database->structure();
		$structure->table("page")
			->drop();
		return true;
	}
}
