<?php
if (!defined('IN_ESOTALK')) exit;
$form = $data['form'];
?>
<div class="captcha">
  <img src="/captcha" srcset="/captcha/2x 2x" alt="" width="102" height="34" title="Click to change verification code" role="button">
  <?php echo $form->input('captcha', 'text', array('placeholder' => 'Enter confirmation code', 'value' => '', 'tabindex' => $data['tabindex'] )) ?>
  <?php if ($data['tips']): ?>
  <br><small>Please enter the verification code in the picture</small>
  <?php endif ?>
</div>
