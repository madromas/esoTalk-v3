<?php
if (!defined('IN_ESOTALK')) exit;

class CloudflareController extends ETController {

    public function action_index() {
        $this->render404(T('message.pageNotFound'));
        return false;
    }

    public function action_signature() {
        if (!ET::$session->user) {
            $this->render404(T('message.pageNotFound'));
            return false;
        }

        $bucket = C('plugin.cloudflare.bucket');
        $accessKey = C('plugin.cloudflare.accessKey');
        $secret = C('plugin.cloudflare.secret');
        
        // R2 uses standard S3 logic
        $expiration = gmdate('Y-m-d\TH:i:s\Z', time() + 3600);
        $policy = base64_encode(json_encode([
            'expiration' => $expiration,
            'conditions' => [
                ['bucket' => $bucket],
                ['starts-with', '$key', 'esotalk/'],
            ],
        ]));

        $signature = base64_encode(hash_hmac('sha1', $policy, $secret, true));

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode([
            'bucket' => $bucket,
            'url' => "https://{$bucket}.r2.cloudflarestorage.com",
            'accessKey' => $accessKey,
            'policy' => $policy,
            'signature' => $signature,
            'key' => 'esotalk/' . uniqid() . '.png'
        ]);
    }
}