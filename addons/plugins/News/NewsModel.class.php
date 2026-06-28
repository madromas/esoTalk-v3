<?php
// Copyright 2014 Aleksandr Tsiolko

if (!defined("IN_ESOTALK")) exit;

class NewsModel extends ETModel {

	public function __construct()
	{
		
		parent::__construct("news", "newsId");
		ET::$database->query("SET NAMES 'utf8mb4' COLLATE 'utf8mb4_unicode_ci'");
	}

	public function getWithSQL($sql)
	{
		return $sql
			->select("f.*")
			->from("news f") 
			->orderBy("f.position ASC")
			->exec()
			->allRows();
	}

	public function setData($values)
	{
		if (!isset($values["title"])) $values["title"] = "";
		$this->validate("title", $values["title"], array($this, "validateTitle"));
		
		if ($this->errorCount()) return false;

		$newsId = parent::create($values);		
		return $newsId;
	}

	public function deleteById($id)
	{
		return $this->delete(array("newsId" => $id));
	}
	
	public function validateTitle($title)
	{
		if (!strlen($title)) return "empty";
	}
}