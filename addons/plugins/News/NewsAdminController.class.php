<?php
// Copyright 2014 Aleksandr Tsiolko

if (!defined("IN_ESOTALK")) exit;

class NewsAdminController extends ETAdminController {

	protected function model()
	{
		return ET::getInstance("newsModel");
	}

	protected function plugin()
	{
		return ET::$plugins["News"];
	}

	public function action_index()
	{
		$news = $this->model()->get();

		$this->addCSSFile($this->plugin()->resource("admin.css"));

		$this->addJSFile("core/js/lib/jquery.ui.js");
		$this->addJSFile($this->plugin()->resource("admin.js"));
		$this->addJSLanguage("message.confirmDelete");

		$this->data("news", $news);
		$this->render($this->plugin()->view("admin/news"));
	}

	public function action_edit($newId = "")
	{
		if (!($new = $this->model()->getById((int)$newId))) {
			$this->render404();
			return;
		}

		$form = ETFactory::make("form");
		$form->action = URL("admin/news/edit/".$new["newId"]);
		$form->setValues($new);

		if ($form->isPostBack("cancel")) $this->redirect(URL("admin/news"));

		if ($form->validPostBack("save")) {

			$data = array(
				"title"          => $form->getValue("title"),
				"content"        => $form->getValue("content"),
				"hideFromGuests" => (bool)$form->getValue("hideFromGuests"),
				"startTime"      => time(),

			);

			$model = $this->model();
			$model->updateById($new["newId"], $data);

			if ($model->errorCount()) $form->errors($model->errors());

			else $this->redirect(URL("admin/news"));
		}

		$this->data("form", $form);
		$this->data("new", $new);
		$this->render($this->plugin()->view("admin/editNew"));
	}


	public function action_create()
	{
		$form = ETFactory::make("form");
		$form->action = URL("admin/news/create");

		if ($form->isPostBack("cancel")) $this->redirect(URL("admin/news"));

		if ($form->validPostBack("save")) {

			$model = $this->model();
			
			date_default_timezone_set('America/New_York');
			$time = time();
			$data = array(
				"title" => $form->getValue("title"),
				"content" => $form->getValue("content"),
				"hideFromGuests" => (bool)$form->getValue("hideFromGuests"),
				"position" => $model->count(),
				"startTime" =>$time
			);

			$model->create($data);

			if ($model->errorCount()) $form->errors($model->errors());

			else $this->redirect(URL("admin/news"));
		}

		$this->data("form", $form);
		$this->data("new", null);
		$this->render($this->plugin()->view("admin/editNew"));
	}


	public function action_delete($newId = "")
	{
		if (!$this->validateToken()) return;

		// Get this field's details. If it doesn't exist, show an error.
		if (!($new = $this->model()->getById((int)$newId))) {
			$this->render404();
			return;
		}

		$this->model()->deleteById($new["newId"]);

		$this->redirect(URL("admin/news"));
	}

	public function action_reorder()
	{
		if (!$this->validateToken()) return;

		$ids = (array)R("ids");

		for ($i = 0; $i < count($ids); $i++) {
			$this->model()->updateById($ids[$i], array("position" => $i));
		}
	}

}
