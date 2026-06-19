<?php
if (!defined("IN_ESOTALK")) exit;

ET::$pluginInfo["HideTag"] = array(
    "name" => "HideTag",
    "description" => "Securely hide content. Enable [hide], [hide=100], [groups=1,4], [users=Toby,Tristan], [rep=50] and [visitor] tags to hide content.",
    "version" => "1.0.2",
    "author" => "MadRomas",
    "authorURL" => "https://madway.net",
    "license" => "GPLv2"
);

class ETPlugin_HideTag extends ETPlugin {

    public function handler_conversationController_renderBefore($sender){
        $sender->addCssFile($this->resource("hide.css"));
    }

    public function handler_conversationController_formatPostForTemplate($sender, &$formatted, $post, $conversation)
    {
        $this->secureContent($formatted["body"]);
    }

    private function secureContent(&$content) {
        $tags = [
            'hide'    => ['!\[hide\](.*?)\[/hide\]!s', "hidden.YouMustBeLoggedIn", 1],
            'hide100' => ['!\[hide\=([0-9]+)\](.*?)\[/hide\]!s', "hidden.YouMustHavePosts", 2],
            'groups'  => ['!\[groups\=([a-zA-Z0-9-+.,_ ]+)\](.*?)\[/groups\]!s', "hidden.YouMustBeInGroups", 2],
            'users'   => ['!\[users\=([a-zA-Z0-9-+.,_ ]+)\](.*?)\[/users\]!s', "hidden.ContentForUsers", 2],
            'rep'     => ['!\[rep\=([0-9]+)\](.*?)\[/rep\]!s', "hidden.YouMustHaveRep", 2]
        ];

        foreach ($tags as $key => $data) {
            $regexp = $data[0];
            $langKey = $data[1];
            $contentIndex = $data[2];

            $content = preg_replace_callback($regexp, function($matches) use ($key, $langKey, $contentIndex) {
                $isAuthorized = false;
                $user = ET::$session->user;

                if ($key == 'hide') {
                    $isAuthorized = (bool)ET::$session->userId;
                } elseif ($user) {
                    if ($key == 'hide100') {
                        $isAuthorized = ($user['countPosts'] >= (int)$matches[1]) || $user['account'] == 'administrator' || $user['account'] == 'moderator';
                    } elseif ($key == 'rep') {
                        $isAuthorized = ($user['reputationPoints'] >= (int)$matches[1]) || $user['account'] == 'administrator' || $user['account'] == 'moderator';
                    } elseif ($key == 'groups') {
                        $groups = explode(',', (string)$matches[1]);
                        $isAuthorized = $user['account'] == 'administrator' || $user['account'] == 'moderator' || count(array_intersect($groups, ET::$session->getGroupIds())) > 0;
                    } elseif ($key == 'users') {
                        $users = explode(',', (string)$matches[1]);
                        $isAuthorized = $user['account'] == 'administrator' || $user['account'] == 'moderator' || in_array($user['username'], $users);
                    }
                }

                if ($isAuthorized) {
                    return $matches[$contentIndex];
                } else {
                    $message = T($langKey);
                    if (!empty($matches[1])) {
                        $message = sprintf($message, $matches[1]);
                    }
                    return "<div class=\"hiddenContent\">" . $message . "</div>";
                }
            }, $content);
        }

        // [visitor]...[/visitor]
        if (isset(ET::$session->user['username'])) {
            $content = preg_replace('!\[visitor\](.*?)\[/visitor\]!s', '<strong>' . ET::$session->user['username'] . "</strong>", $content);
        }
    }
}