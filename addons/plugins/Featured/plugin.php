<?php

ET::$pluginInfo["Featured"] = array(
    "name" => "Featured",
    "description" => "A plugin enabling the label of featured posts",
    "version" => "1.4",
    "author" => "Z. Tong Zhang",
    "authorEmail" => "zhang@zhantong.org",
    "authorURL" => "https://ztong.me",
    "license" => "GPLv2"
);

class ETPlugin_Featured extends ETPlugin
{
    public static $icon_featured;

    public function init()
    {

        ET::define("label.featured", "Featured");
        ET::define("gambit.featured", "featured");

        ET::conversationModel();
        ETConversationModel::addLabel("featured", "IF(c.featured = 1, 1, 0)", "icon-lightbulb");

        ET::activityModel();
        ETActivityModel::addType("featured", array(
            "notification" => array(
                $this,
                "featuredNotification"
            )
        ));
    }

    public function setup($oldVersion = "")
    {
        $structure = ET::$database->structure();
        $structure->table("conversation")->column("featured", "bool", 0)->exec(false);
        return true;
    }

    public function handler_renderBefore($sender)
    {
        $sender->addCSSFile($this->resource("featured.css"));
    }

    public function handler_conversationController_conversationIndexDefault($sender, $conversation, $controls, $replyForm, $replyControls)
    {
        if ($conversation["canModerate"]) {
            $controls->add("featured", "<a href='" . URL("conversation/featured/" . $conversation["conversationId"] . "/?token=".ET::$session->token."&return=".urlencode($sender->selfURL))."' id='control-featured'><i class='icon-lightbulb'></i> <span>" . T($conversation["featured"] ? "Un-feature it" : "Feature it") . "</span></a>", 0);
		
		}
    }

    public function handler_conversationController_renderBefore($sender)
    {
        $sender->addJSFile($this->resource("featured.js"));
        $sender->addJSLanguage("Feature it", "Un-feature it");
    }

    public function action_conversationController_featured($controller, $conversationId = false)
    {
        if (!$controller->validateToken())
        return;

        // Get the conversation.
        if (!($conversation = $controller->getConversation($conversationId)))
        return;

        if (!ET::$session->isAdmin() and !$conversation["canModerate"])
        return;

        $featured = !$conversation["featured"];
        $this->setFeatured($conversation, $featured);
        $this->notifyFeatured($conversation, $featured);

        $controller->json("featured", $featured);

        if ($controller->responseType === RESPONSE_TYPE_DEFAULT) {
            redirect(URL(R("return", conversationURL($conversation["conversationId"], $conversation["title"]))));
        }

        elseif ($controller->responseType === RESPONSE_TYPE_AJAX)
        $controller->json("labels", $controller->getViewContents("conversation/labels", array(
            "labels" => $conversation["labels"]
        )));

        $controller->render();
    }

    public function setFeatured(&$conversation, $featured)
    {
        $featured = (bool) $featured;

        $model = ET::conversationModel();
        $model->updateById($conversation["conversationId"], array(
            "featured" => $featured
        ));

        $model->addOrRemoveLabel($conversation, "featured", $featured);
        $conversation["featured"] = $featured;
    }

    public function handler_conversationsController_init($sender)
    {
        if (!ET::$session->user)
        return;

        ET::searchModel(); // Load the search model so we can add this gambit.
        ETSearchModel::addGambit('return $term == strtolower(T("gambit.featured"));', array(
            $this,
            "gambitFeatured"
        ));
    }

    public function handler_conversationsController_constructGambitsMenu($sender, &$gambits)
    {
        if (!ET::$session->user)
        return;

        addToArrayString($gambits["main"], T("gambit.featured"), array(
            "gambit-featured",
            $this::$icon_featured
        ));
    }

    public static function gambitFeatured(&$search, $term, $negate)
    {
        if (!ET::$session->user or $negate)
        return;
        $sql = ET::SQL()->select("DISTINCT conversationId")->from("conversation")->where("featured=1");
        $search->addIDFilter($sql);
    }

    public function featuredNotification(&$activity)
    {
        if ($activity["data"]["featured"])
        return array(
            sprintf(T('%s featured %s by you.'), name($activity["fromMemberName"]), "<strong>" . sanitizeHTML($activity["data"]["title"]) . "</strong>"),
            URL(conversationURL($activity["data"]["conversationId"]))
        );
        else
        return array(
            sprintf(T("A moderator un-featured %s by you."), "<strong>" . sanitizeHTML($activity["data"]["title"]) . "</strong>"),
            URL(conversationURL($activity["data"]["conversationId"]))
        );
    }
    
    public function notifyFeatured(&$conversation, $featured)
    {
        ET::activityModel()->create("featured", ET::memberModel()->getById($conversation["startMemberId"]), ET::$session->user, array(
            "conversationId" => $conversation["conversationId"],
            "title" => $conversation["title"],
            "featured" => $featured
        ));
    }

}

?>
