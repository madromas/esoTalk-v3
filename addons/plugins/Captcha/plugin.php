<?php

if (!defined('IN_ESOTALK')) exit;

ET::$pluginInfo['Captcha'] = array(
  'name' => 'Captcha',
  'description' => 'Require the user to identify a graphic captcha during user registration',
  'version' => '0.1.0',
  'author' => 'MadRomas',
  'authorEmail' => 'madromas@yahoo.com',
  'authorURL' => 'https://madway.net',
  'license' => 'MIT',
  'priority' => 0,
);

class ETPlugin_Captcha extends ETPlugin {

  public function __construct($rootDirectory)
  {
    parent::__construct($rootDirectory);
    ETFactory::registerController('captcha', 'CaptchaController', dirname(__FILE__).'/CaptchaController.class.php');
  }

  public function handler_renderBefore($sender)
  {
    $sender->addCSSFile($this->resource('captcha.css'));
    $sender->addJSFile($this->resource('captcha.js'));
  }

  public function handler_userController_initJoin($sender, $form)
  {
    if ($this->skipCaptcha()) return;
    $form->addSection('captcha', 'Verification code');
    $form->addField('captcha', 'captcha', function($form) use ($sender)
    {
      return $sender->getViewContents($this->view('captcha/captcha'), array('form' => $form, 'tips' => true));
    },
    function($form, $key, &$data) use ($sender)
    {
      if ( !self::verifyCode($form->getValue($key)) ) {
        $form->error($key, 'Verification code error');
      }
    });
  }


  public function handler_conversationController_renderFormButtonsAfter($sender, &$content, $form, $conversation)
  {
    if ($this->skipCaptcha()) return;
    $result = $sender->getViewContents($this->view('captcha/captcha'), array('form' => $form, 'tabindex' => 290));
    addToArray($content, $result, 0);
  }

  public function handler_conversationController_reply($sender, $form)
  {
    if ($this->skipCaptcha()) return;
    $form->addField('captcha', 'captcha', null,
    function($form, $key, &$data) use ($sender)
    {
      if ( !self::verifyCode($form->getValue($key)) ) {
        $form->error($key, 'Verification code error');
      }
    });
  }
  public function handler_conversationController_start($sender, $form)
  {
    if ($this->skipCaptcha()) return;
    $form->addField('captcha', 'captcha', null,
    function($form, $key, &$data) use ($sender)
    {
      if ( !self::verifyCode($form->getValue($key)) ) {
        $form->error($key, 'Verification code error');
      }
    });
  }


  private function skipCaptcha()
  {
    if (ET::$session->user && ET::$session->user['countPosts'] >= 10) {
      return true;
    }
    return false;
  }


  public static function verifyCode($code = '') {
    $code = strtoupper($code);
    return ET::$session->get('plugin_captcha') === $code;
  }
  public static function generateCode() {
    static $codes = 'ABCDEFGHIJKLMNPQRSTUVWXYZ01245678';
    $count = strlen($codes);

    $code = '';
    for ($i=0; $i < 4; $i++) {
      $code .= substr($codes, rand() % $count, 1);
    }

    // case insensitive
    $code = strtoupper($code);
    ET::$session->store('plugin_captcha', $code);
    return $code;
  }
}
