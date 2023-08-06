<?php

ET::$pluginInfo["Shit"] = array(
    "name" => "Shit",
    "description" => "A plugin enabling the label of shit posts",
    "version" => "1.0",
    "author" => "MadRomas",
    "authorEmail" => "madromas@yahoo.com",
    "authorURL" => "https://madway.net",
    "license" => "GPLv2"
);

class ETPlugin_shit extends ETPlugin
{
    public static $icon_shit;

    public function init()
    {

        ET::define("label.shit", "Shit");
        ET::define("gambit.shit", "Shit");

        ET::conversationModel();
        ETConversationModel::addLabel("shit", "IF(c.shit = 1, 1, 0)", "fas fa-poo");

        ET::activityModel();
        ETActivityModel::addType("shit", array(
            "notification" => array(
                $this,
                "shitNotification"
            )
        ));
    }

    public function setup($oldVersion = "")
    {
        $structure = ET::$database->structure();
        $structure->table("conversation")->column("shit", "bool", 0)->exec(false);
        return true;
    }

    public function handler_renderBefore($sender)
    {
        $sender->addCSSFile($this->resource("shit.css"));
    }

    public function handler_conversationController_conversationIndexDefault($sender, $conversation, $controls, $replyForm, $replyControls)
    {
        if ($conversation["canModerate"]) {
            $controls->add("shit", "<a href='" . URL("conversation/shit/" . $conversation["conversationId"] . "/?token=".ET::$session->token."&return=".urlencode($sender->selfURL))."' id='control-shit'><i class='fas fa-poo'></i> <span>" . T($conversation["shit"] ? "Un-shit it" : "Shit it") . "</span></a>", 0);
		
		}
    }

    public function handler_conversationController_renderBefore($sender)
    {
        $sender->addJSFile($this->resource("shit.js"));
        $sender->addJSLanguage("Feature it", "Un-feature it");
    }

    public function action_conversationController_shit($controller, $conversationId = false)
    {
        if (!$controller->validateToken())
        return;

        // Get the conversation.
        if (!($conversation = $controller->getConversation($conversationId)))
        return;

        if (!ET::$session->isAdmin() and !$conversation["canModerate"])
        return;

        $shit = !$conversation["shit"];
        $this->setshit($conversation, $shit);
        $this->notifyshit($conversation, $shit);

        $controller->json("shit", $shit);

        if ($controller->responseType === RESPONSE_TYPE_DEFAULT) {
            redirect(URL(R("return", conversationURL($conversation["conversationId"], $conversation["title"]))));
        }

        elseif ($controller->responseType === RESPONSE_TYPE_AJAX)
        $controller->json("labels", $controller->getViewContents("conversation/labels", array(
            "labels" => $conversation["labels"]
        )));

        $controller->render();
    }

    public function setshit(&$conversation, $shit)
    {
        $shit = (bool) $shit;

        $model = ET::conversationModel();
        $model->updateById($conversation["conversationId"], array(
            "shit" => $shit
        ));

        $model->addOrRemoveLabel($conversation, "shit", $shit);
        $conversation["shit"] = $shit;
    }

    public function handler_conversationsController_init($sender)
    {
        if (!ET::$session->user)
        return;

        ET::searchModel(); // Load the search model so we can add this gambit.
        ETSearchModel::addGambit('return $term == strtolower(T("gambit.shit"));', array(
            $this,
            "gambitshit"
        ));
    }

    public function handler_conversationsController_constructGambitsMenu($sender, &$gambits)
    {
        if (!ET::$session->user)
        return;

        addToArrayString($gambits["main"], T("gambit.shit"), array(
            "gambit-shit",
            $this::$icon_shit
        ));
    }

    public static function gambitshit(&$search, $term, $negate)
    {
        if (!ET::$session->user or $negate)
        return;
        $sql = ET::SQL()->select("DISTINCT conversationId")->from("conversation")->where("shit=1");
        $search->addIDFilter($sql);
    }

    public function shitNotification(&$activity)
    {
        if ($activity["data"]["shit"])
        return array(
            sprintf(T('%s shit %s by you.'), name($activity["fromMemberName"]), "<strong>" . sanitizeHTML($activity["data"]["title"]) . "</strong>"),
            URL(conversationURL($activity["data"]["conversationId"]))
        );
        else
        return array(
            sprintf(T("A moderator un-shit %s by you."), "<strong>" . sanitizeHTML($activity["data"]["title"]) . "</strong>"),
            URL(conversationURL($activity["data"]["conversationId"]))
        );
    }
    
    public function notifyshit(&$conversation, $shit)
    {
        ET::activityModel()->create("shit", ET::memberModel()->getById($conversation["startMemberId"]), ET::$session->user, array(
            "conversationId" => $conversation["conversationId"],
            "title" => $conversation["title"],
            "shit" => $shit
        ));
    }

}

?>
