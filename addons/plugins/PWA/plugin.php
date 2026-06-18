<?php
if (!defined("IN_ESOTALK")) exit;

ET::$pluginInfo["PWA"] = array(
    "name" => "PWA",
    "description" => "Turns your forum into a Progressive Web App.",
    "version" => "1.0.0",
    "author" => "MadRomas",
    "authorURL" => "https://madway.net",
    "license" => "GPLv2"
);

class ETPlugin_PWA extends ETPlugin {

    public function __construct($rootDirectory) {
        parent::__construct($rootDirectory);
        ETFactory::registerController("pwa", "PWAController", dirname(__FILE__)."/PWAController.class.php");
    }

    public function handler_init($sender) {
        $sender->addToHead('<link rel="manifest" href="'.URL("pwa/manifest").'">');
        $sender->addToHead('<meta name="theme-color" content="'.C("plugin.PWA.themeColor", "#ffffff").'">');
        
        $sender->addJSFile($this->resource("sw-registration.js"));
    }

    public function settings($sender) {
        $form = ETFactory::make("form");
        $form->action = URL("admin/plugins/settings/PWA");
        
        $form->setValue("pwaName", C("plugin.PWA.name", "esoTalk Forum"));
        $form->setValue("pwaShortName", C("plugin.PWA.shortName", "Forum"));
        $form->setValue("pwaThemeColor", C("plugin.PWA.themeColor", "#ffffff"));

        if ($form->validPostBack("pwaSave")) {
            $config = array(
                "plugin.PWA.name" => $form->getValue("pwaName"),
                "plugin.PWA.shortName" => $form->getValue("pwaShortName"),
                "plugin.PWA.themeColor" => $form->getValue("pwaThemeColor"),
            );
            ET::writeConfig($config);
            $sender->message(T("message.changesSaved"), "success autoDismiss");
            $sender->redirect(URL("admin/plugins"));
        }

        $sender->data("pwaSettingsForm", $form);
        return $this->view("settings");
    }
}