<?php
echo json_encode([
    "name" => C("plugin.PWA.name", "esoTalk Forum"),
    "short_name" => C("plugin.PWA.shortName", "Forum"),
    "start_url" => "/",
    "display" => "standalone",
    "background_color" => "#ffffff",
    "theme_color" => C("plugin.PWA.themeColor", "#ffffff"),
    "icons" => [
        ["src" => "/addons/plugins/PWA/resources/icon-192.png", "sizes" => "192x192", "type" => "image/png"],
        ["src" => "/addons/plugins/PWA/resources/icon-512.png", "sizes" => "512x512", "type" => "image/png"]
    ]
]);