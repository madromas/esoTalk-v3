<?php
// Copyright 2014 andrewks
// This file is part of esoTalk. Please see the included license file for usage information.

if (!defined("IN_ESOTALK")) exit;

require PATH_CONTROLLERS."/ETSettingsController.class.php";

class UserScriptsController extends ETSettingsController {


	/**
	 * Get the full path to a view contained within the plugin folder.
	 *
	 * @param string $view The name of the view.
	 * @return string
	 */
	public function getViewPlugin($view)
	{
		return PATH_ROOT."/addons/plugins/UserScripts/views/".$view.".php";
	}
	
	
	public function getResourcePlugin($rsrc)
	{
		return "addons/plugins/UserScripts/resources/".$rsrc;
	}

	
	// Show the settings page for user scripts.
	public function action_settings()
	{

		$member = $this->profile("scripts");

		// Construct the form.
		$form = ETFactory::make("form");
		$form->action = URL("scripts/settings");
		
		$form->addSection("personalJS", T("setting.personalJS.label"));
	
		// Add the "personal JS" field.
		$form->setValue("usePersonalJS", ET::$session->preference("usePersonalJS", false));
		$form->addField("personalJS", "usePersonalJS", array($this, "fieldUsePersonalJS"), array($this, "saveBoolPreference"));
		$form->addField("personalJS", "personalJS", array($this, "fieldPersonalJS"), array($this, "savePersonalFile"));
		
		$form->addSection("personalCSS", T("setting.personalCSS.label"));
	
		// Add the "personal CSS" field.
		$form->setValue("usePersonalCSS", ET::$session->preference("usePersonalCSS", false));
		$form->addField("personalCSS", "usePersonalCSS", array($this, "fieldUsePersonalCSS"), array($this, "saveBoolPreference"));
		$form->addField("personalCSS", "personalCSS", array($this, "fieldPersonalCSS"), array($this, "savePersonalFile"));
		
		$form->addSection("personalCSSmob", T("setting.personalCSSmob.label"));
		
		// Add the "personal CSS mobile" field.
		$form->setValue("usePersonalCSSmob", ET::$session->preference("usePersonalCSSmob", false));
		$form->addField("personalCSSmob", "usePersonalCSSmob", array($this, "fieldUsePersonalCSSmob"), array($this, "saveBoolPreference"));
		$form->addField("personalCSSmob", "personalCSSmob", array($this, "fieldPersonalCSSmob"), array($this, "savePersonalFile"));

		// If the save button was clicked...
		if ($form->validPostBack("save")) {

			// Create an array of preferences to write to the database and run the form field callbacks on it.
			$preferences = array();
			$form->runFieldCallbacks($preferences);

			// If no errors occurred, we can write the preferences to the database.
			if (!$form->errorCount()) {

				if (count($preferences)) ET::$session->setPreferences($preferences);

				$this->message(T("message.changesSaved"), "success autoDismiss");
				$this->redirect(URL("scripts/settings"));

			}
		}

		// If the "remove JS" button was clicked...
		elseif ($form->validPostBack("removePersonalJS")) {

			// Delete the JS file
			$model = ET::getInstance("UserScriptsModel");
			@unlink($model->getPathUserJS());
			$preferences = array('usePersonalJS' => false);
			ET::$session->setPreferences($preferences);

			$this->message(T("message.changesSaved"), "success autoDismiss");
			$this->redirect(URL("scripts/settings"));
		}

		// If the "remove CSS" button was clicked...
		elseif ($form->validPostBack("removePersonalCSS")) {

			// Delete the CSS file
			$model = ET::getInstance("UserScriptsModel");
			@unlink($model->getPathUserCSS());
			$preferences = array('usePersonalCSS' => false);
			ET::$session->setPreferences($preferences);

			$this->message(T("message.changesSaved"), "success autoDismiss");
			$this->redirect(URL("scripts/settings"));

		}
		
		// If the "remove CSS mobile" button was clicked...
		elseif ($form->validPostBack("removePersonalCSSmob")) {

			// Delete the CSS mobile file
			$model = ET::getInstance("UserScriptsModel");
			@unlink($model->getPathUserCSSmob());
			$preferences = array('usePersonalCSSmob' => false);
			ET::$session->setPreferences($preferences);

			$this->message(T("message.changesSaved"), "success autoDismiss");
			$this->redirect(URL("scripts/settings"));

		}

		
		$this->data("form", $form);
		$this->renderProfile($this->getViewPlugin("usersettings"));
		
		
	}

	
	public function action_editjs()
	{
		$this->title = T("plugin.UserScripts.editJS.title");
		$model = ET::getInstance("UserScriptsModel");
		$filename = $model->getPathUserJS();
		// Construct the form.
		$form = ETFactory::make("form");
		
		$key = "scriptsrc";
		if (is_file($filename)) $form->setValue($key, file_get_contents($filename));
		else $form->setValue($key, "");
		
		// If the save button was clicked...
		if ($form->validPostBack("save")) {

			try {
				file_put_contents($filename, $form->getValue($key, ""));
			} catch (Exception $e) {
				// If something went wrong up there, add the error message to the form.
				$form->error($key, $e->getMessage());
			}
			
			// If no errors occurred
			if (!$form->errorCount()) {
				$this->message(T("message.changesSaved"), "success");
				$this->redirect(URL("scripts/editjs"));
			}
		}
		
		$this->data("form", $form);
		$this->data("scriptType", "javascript");
		$groupKey = 'EditScript';
		$this->addJSFile($this->getResourcePlugin("lib/codemirror.js"), false, $groupKey);
		$this->addCSSFile($this->getResourcePlugin("lib/codemirror.css"), false, $groupKey);
		$this->addJSFile($this->getResourcePlugin("lib/javascript.js"), false, $groupKey);
		$this->addJSFile($this->getResourcePlugin("lib/active-line.js"), false, $groupKey);
		
		// LINT
		$this->addCSSFile($this->getResourcePlugin("lib/lint/lint.css"), false, $groupKey);
		$this->addJSFile($this->getResourcePlugin("lib/lint/jshint.js"), false, $groupKey);
		$this->addJSFile($this->getResourcePlugin("lib/lint/javascript-lint.js"), false, $groupKey);
		$this->addJSFile($this->getResourcePlugin("lib/lint/lint.js"), false, $groupKey);
		
		$this->addJSFile($this->getResourcePlugin("editscript.js"), false, $groupKey);
		$this->render($this->getViewPlugin("editscript"));
	}
	

	public function action_editcss($csstype = false)
	{
		$this->title = T("plugin.UserScripts.editCSS.title");
		$model = ET::getInstance("UserScriptsModel");
		if ($csstype == "mob") $filename = $model->getPathUserCSSmob();
		else $filename = $model->getPathUserCSS();
		// Construct the form.
		$form = ETFactory::make("form");
		
		$key = "scriptsrc";
		if (is_file($filename)) $form->setValue($key, file_get_contents($filename));
		else $form->setValue($key, "");
		
		// If the save button was clicked...
		if ($form->validPostBack("save")) {

			try {
				file_put_contents($filename, $form->getValue($key, ""));
			} catch (Exception $e) {
				// If something went wrong up there, add the error message to the form.
				$form->error($key, $e->getMessage());
			}
			
			// If no errors occurred
			if (!$form->errorCount()) {
				$this->message(T("message.changesSaved"), "success");
				$this->redirect(URL("scripts/editcss".($csstype ? "/".$csstype : "")));
			}
		}
		
		$this->data("form", $form);
		$this->data("scriptType", "css");
		$groupKey = 'EditScript';
		$this->addJSFile($this->getResourcePlugin("lib/codemirror.js"), false, $groupKey);
		$this->addCSSFile($this->getResourcePlugin("lib/codemirror.css"), false, $groupKey);
		$this->addJSFile($this->getResourcePlugin("lib/css.js"), false, $groupKey);
		$this->addJSFile($this->getResourcePlugin("lib/active-line.js"), false, $groupKey);
		
		// LINT
		$this->addCSSFile($this->getResourcePlugin("lib/lint/lint.css"), false, $groupKey);
		$this->addJSFile($this->getResourcePlugin("lib/lint/csslint.js"), false, $groupKey);
		$this->addJSFile($this->getResourcePlugin("lib/lint/css-lint.js"), false, $groupKey);
		$this->addJSFile($this->getResourcePlugin("lib/lint/lint.js"), false, $groupKey);
		
		$this->addJSFile($this->getResourcePlugin("editscript.js"), false, $groupKey);
		$this->render($this->getViewPlugin("editscript"));
	}

	
	/**
	 * Return the HTML to render the "fieldUsePersonalJS" field in the settings form.
	 *
	 * @param ETForm $form The form object.
	 * @return string
	 */
	public function fieldUsePersonalJS($form)
	{
		return "<label class='checkbox'>".$form->checkbox("usePersonalJS")." ".T("setting.usePersonalJS.label")."</label>";
	}
	
	/**
	 * Return the HTML to render the personalJS field in the settings form.
	 *
	 * @param ETForm $form The form object.
	 * @return string
	 */
	public function fieldPersonalJS($form)
	{
		$model = ET::getInstance("UserScriptsModel");
		$exists = $model->isResourceExists('js');
		if ($exists) {
			$url = getResource($model->getUrlUserJS());
			$titleView = T("plugin.UserScripts.view.label");
		}
		$urlEdit = URL("scripts/editjs");
		$titleEdit = T("plugin.UserScripts.edit.label");
		
		return "<div class='avatarChooser'>".
			"<div class='script-box'><a href='$urlEdit' target='_blank' class='control-edit' title='$titleEdit'><i class='icon-edit'></i></a>".($exists ? "<a href='$url' target='_blank' class='control-link' title='$titleView'><i class='icon-link'></i></a>" : "")."</div>".
			$form->input("personalJS", "file").
			"<small>".sprintf(T("setting.personalJS.desc"), (ET::uploader()->maxUploadSize() / (1024*1024))." MB", "JS")."</small>".
			($exists ? $form->button("removePersonalJS", T("setting.personalJS.remove")) : "").
			"</div>";
	}


	/**
	 * Return the HTML to render the "fieldUsePersonalCSS" field in the settings form.
	 *
	 * @param ETForm $form The form object.
	 * @return string
	 */
	public function fieldUsePersonalCSS($form)
	{
		return "<label class='checkbox'>".$form->checkbox("usePersonalCSS")." ".T("setting.usePersonalCSS.label")."</label>";
	}
	
	/**
	 * Return the HTML to render the personalCSS field in the settings form.
	 *
	 * @param ETForm $form The form object.
	 * @return string
	 */
	public function fieldPersonalCSS($form)
	{
		$model = ET::getInstance("UserScriptsModel");
		$exists = $model->isResourceExists('css');
		if ($exists) {
			$url = getResource($model->getUrlUserCSS());
			$titleView = T("plugin.UserScripts.view.label");
		}
		$urlEdit = URL("scripts/editcss");
		$titleEdit = T("plugin.UserScripts.edit.label");
		
		return "<div class='avatarChooser'>".
			"<div class='script-box'><a href='$urlEdit' target='_blank' class='control-edit' title='$titleEdit'><i class='icon-edit'></i></a>".($exists ? "<a href='$url' target='_blank' class='control-link' title='$titleView'><i class='icon-link'></i></a>" : "")."</div>".
			$form->input("personalCSS", "file").
			"<small>".sprintf(T("setting.personalJS.desc"), (ET::uploader()->maxUploadSize() / (1024*1024))." MB", "CSS")."</small>".
			($exists ? $form->button("removePersonalCSS", T("setting.personalCSS.remove")) : "").
			"</div>";
	}


	/**
	 * Return the HTML to render the "fieldUsePersonalCSSmob" field in the settings form.
	 *
	 * @param ETForm $form The form object.
	 * @return string
	 */
	public function fieldUsePersonalCSSmob($form)
	{
		return "<label class='checkbox'>".$form->checkbox("usePersonalCSSmob")." ".T("setting.usePersonalCSSmob.label")."</label>";
	}
	
	/**
	 * Return the HTML to render the personalCSSmob field in the settings form.
	 *
	 * @param ETForm $form The form object.
	 * @return string
	 */
	public function fieldPersonalCSSmob($form)
	{
		$model = ET::getInstance("UserScriptsModel");
		$exists = $model->isResourceExists('css-mob');
		if ($exists) {
			$url = getResource($model->getUrlUserCSSmob());
			$titleView = T("plugin.UserScripts.view.label");
		}
		$urlEdit = URL("scripts/editcss/mob");
		$titleEdit = T("plugin.UserScripts.edit.label");
		
		return "<div class='avatarChooser'>".
			"<div class='script-box'><a href='$urlEdit' target='_blank' class='control-edit' title='$titleEdit'><i class='icon-edit'></i></a>".($exists ? "<a href='$url' target='_blank' class='control-link' title='$titleView'><i class='icon-link'></i></a>" : "")."</div>".
			$form->input("personalCSSmob", "file").
			"<small>".sprintf(T("setting.personalJS.desc"), (ET::uploader()->maxUploadSize() / (1024*1024))." MB", "CSS")."</small>".
			($exists ? $form->button("removePersonalCSSmob", T("setting.personalCSSmob.remove")) : "").
			"</div>";
	}

	
	/**
	 * Save the contents of the file field when the settings form is submitted.
	 *
	 * @param ETForm $form The form object.
	 * @param string $key The name of the field that was submitted.
	 * @param array $preferences An array of preferences to write to the database.
	 * @return string
	 */
	public function savePersonalFile($form, $key, &$preferences)
	{
		$model = ET::getInstance("UserScriptsModel");
		if (empty($_FILES[$key]["tmp_name"])) return;
		if ($key == "personalJS") {
			$destFileName = $model->getPathUserJS();
			$prefName = 'usePersonalJS';
			$extPattern = '/\.js$/i';
		}
		elseif ($key == "personalCSS") {
			$destFileName = $model->getPathUserCSS();
			$prefName = 'usePersonalCSS';
			$extPattern = '/\.css$/i';
		}
		elseif ($key == "personalCSSmob") {
			$destFileName = $model->getPathUserCSSmob();
			$prefName = 'usePersonalCSSmob';
			$extPattern = '/\.css$/i';
		}
		else return;
		
		if (!preg_match($extPattern, $_FILES[$key]["name"])) {
			$form->error($key, ''.$_FILES[$key]["name"].': '.T('plugin.UserScripts.message.invalidFileExtension'));
			return;
		}

		$uploader = ET::uploader();

		try {

			// Validate and get the uploaded file from this field.
			$file = $uploader->getUploadedFile($key);

			// Save it as a file.
			
			$userFile = $uploader->saveAs($file, $destFileName);

			$preferences[$prefName] = true;

		} catch (Exception $e) {

			// If something went wrong up there, add the error message to the form.
			$form->error($key, $e->getMessage());

		}
	}



}