<?php
class PWAController extends ETController {
    
    public function action_manifest() {
        header('Content-Type: application/json');
        include(dirname(__FILE__)."/manifest.json.php");
        exit;
    }

    public function action_sw() {
        header('Content-Type: application/javascript');
        header('Service-Worker-Allowed: /');
        include(dirname(__FILE__)."/resources/sw.js");
        exit;
    }
}