<?php
if (!defined("IN_ESOTALK")) exit;

ET::$pluginInfo["Matomo"] = array(
    "name" => "Matomo Integration",
    "description" => "Allows you to set a tracking code or image in the settings, rendered on every page",
    "version" => "1.0.0",
    "author" => "MadRomas",
    "authorURL" => "https://madway.net",
    "license" => "GPLv3"
);

class ETPlugin_Matomo extends ETPlugin {

    /**
     * Construct and process the settings form.
     */
    public function settings($sender)
    {
        $form = ETFactory::make("form");
        $form->action = URL("admin/plugins/settings/Matomo");
        
        $form->setValue("trackingcode", C("plugin.Matomo.trackingcode", ""));
        $form->setValue("imagetrackingcode", C("plugin.Matomo.imagetrackingcode", ""));

        if ($form->validPostBack("matomoSettingsSave")) {
            $config = array();
            $config["plugin.Matomo.trackingcode"] = $form->getValue("trackingcode");
            $config["plugin.Matomo.imagetrackingcode"] = $form->getValue("imagetrackingcode");

            if (!$form->errorCount()) {
                ET::writeConfig($config);
                $sender->message(T("message.changesSaved"), "success");
                $sender->redirect(URL("admin/plugins"));
            }
        }

        $sender->data("matomoSettingsForm", $form);
        return $this->view("settings");
    }

    /**
     * Adds the tracking code to html header
     */
    public function handler_renderBefore($controller)
    {
        $trackingcode = (string)C('plugin.Matomo.trackingcode', "");
        $imagetrackingcode = (string)C('plugin.Matomo.imagetrackingcode', "");

        // Defensive check: only inject if trackingcode exists and image code is empty
        if ($trackingcode !== "" && $imagetrackingcode === "") {
            $controller->addToHead($trackingcode);
        }
    }

    /**
     * Render the imagetracking image at the bottom of the page
     */
    public function handler_pageEnd($sender)
    {
        $imagetrackingcode = (string)C('plugin.Matomo.imagetrackingcode', "");

        if ($imagetrackingcode !== "") {
            echo $imagetrackingcode;
        }
    }
}