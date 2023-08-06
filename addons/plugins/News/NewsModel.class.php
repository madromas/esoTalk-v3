<?php
// Copyright 2014 Aleksandr Tsiolko

if (!defined("IN_ESOTALK")) exit;

class NewsModel extends ETModel {

	public function __construct()
	{
		parent::__construct("new", "newId");
	}

	public function getWithSQL($sql)
	{
		return $sql
			->select("f.*")
			->from("new f")
			->orderBy("f.position ASC")
			->exec()
			->allRows();
	}

	public function setData($values)
	{
		if (!isset($values["title"])) $values["title"] = "";
		$this->validate("title", $values["title"], array($this, "validateTitle"));
		
	
		if ($this->errorCount()) return false;

		$newId = parent::create($values);		
		return $newId;
	}

	public function deleteById($id)
	{
		return $this->delete(array("newId" => $id));
	}
	
	public function validateTitle($title)
	{
		if (!strlen($title)) return "empty";
	}
}
