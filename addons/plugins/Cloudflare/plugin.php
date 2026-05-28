<?php

if (!defined('IN_ESOTALK')) exit;

ET::$pluginInfo['Cloudflare'] = array(
  'name' => 'Cloudflare',
  'description' => 'Cloudflare R2 storage',
  'version' => '0.1.0',
  'author' => 'MadRomas',
  'authorEmail' => 'madromas@yahoo.com',
  'authorURL' => 'https://madway.net',
  'license' => 'MIT'
);

class ETPlugin_Cloudflare extends ETPlugin {

  public function __construct($rootDirectory)
  {
    parent::__construct($rootDirectory);
    ETFactory::registerController('cloudflare', 'CloudflareController', dirname(__FILE__).'/CloudflareController.class.php');
  }

  public function handler_conversationController_renderBefore($sender)
  {
    $sender->addJSFile($this->resource('cloudflare.js'));
    $sender->addCssFile($this->resource('cloudflare.css'));
  }
  public function handler_conversationController_getEditControls($sender, &$controls, $id)
  {
    addToArrayString($controls, "imageup", "<a href='javascript:Cloudflare.imageup(\"$id\");void(0)' title='".T("File Upload")."' class='control-fixed'><i class='icon-paper-clip'></i></a>", 0);

  }
 
  public function handler_format_format($sender)
  {
    $sender->content = preg_replace_callback("/\[cloud\]((?:\w+:\/\/|\/).*?)\[\/cloud\]/i", array($this, "cloudflareCallback"), $sender->content);
  }

  public function cloudflareCallback($matches, $expanded = true)
  {
    $cloudflare = $matches[1];
    $extension = strtolower(pathinfo($cloudflare, PATHINFO_EXTENSION));
    $url = $cloudflare;
    $filename = basename($cloudflare);
    $displayFilename = ET::formatter()->init($filename)->highlight(ET::$session->get("highlight"))->get();


    
    // For images, either show them directly or show a thumbnail.
   if (in_array($extension, array("jpg", "jpeg", "png", "gif"))) {
    return "<a href='".$url."' target='_blank'><img src='".$url."' alt='".$displayFilename."' title='".$displayFilename."'></a>";
}

    // Embed video.
    if (in_array($extension, array("mp4", "mov", "mpg", "avi", "m4v")) and $expanded) {
      return "<video width='400' height='225' controls><source src='".$url."'></video>";
    }

    // Embed audio.
    if (in_array($extension, array("mp3", "mid", "wav")) and $expanded) {
      return "<audio controls><source src='".$url."'></audio>";
    }

    $icons = array(
      "pdf" => "file-text-alt",
      "doc" => "file-text-alt",
      "docx" => "file-text-alt",
      "zip" => "archive",
      "rar" => "archive",
      "gz" => "archive"
    );
    $icon = isset($icons[$extension]) ? $icons[$extension] : "file";
    return "<a href='".$url."' class='upyuns' target='_blank'><i class='icon-$icon'></i><span class='filename'>".$displayFilename."</span></a>";
  }


  public function settings($sender)
{
    $form = ETFactory::make('form');
    $form->action = URL('admin/plugins/settings/Cloudflare');

    // Load existing values
    $form->setValue('bucket', C('plugin.cloudflare.bucket'));
    $form->setValue('accessKey', C('plugin.cloudflare.accessKey')); // Add this
    $form->setValue('secret', C('plugin.cloudflare.secret'));

    if ($form->validPostBack('submit')) {
        $config = array();
        $config['plugin.cloudflare.bucket'] = $form->getValue('bucket');
        $config['plugin.cloudflare.accessKey'] = $form->getValue('accessKey'); // Add this
        $config['plugin.cloudflare.secret'] = $form->getValue('secret');

        if (!$form->errorCount()) {
            ET::writeConfig($config);
            $sender->message(T('message.changesSaved'), 'success autoDismiss');
            $sender->redirect(URL('admin/plugins'));
        }
    }
    $sender->data('form', $form);
    return $this->view('settings');
}
}
