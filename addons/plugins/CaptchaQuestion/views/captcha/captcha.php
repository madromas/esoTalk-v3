<?php
if (!defined('IN_ESOTALK')) exit;
$form = $data['form'];
?>
<div class="captcha">
  <small>The original Gundam model is？RX-</small>
  <?php echo $form->input('captcha', 'text', array('placeholder' => 'two digits', 'value' => '', 'tabindex' => $data['tabindex'] )) ?>
</div>
