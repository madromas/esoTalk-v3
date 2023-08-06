<?php
// Copyright 2013 ciruz
if (!defined("IN_ESOTALK")) exit;

$form = $data["CustomJSForm"];
?>
<?php echo $form->open(); ?>
<div class="section">
	<ul class="form">
		<li>
			<label>CustomJS Code</label>
			<?php echo $form->input('customjscode', 'textarea', array('placeholder' => 'Your Custom JS Code', "style" => "height:200px; width:350px")); ?>
			<small>Enter your CustomJS Code.</small>
		<li>
	</ul>
</div>
<div class="buttons">
	<?php echo $form->saveButton("CustomJSSave"); ?>
</div>
<?php echo $form->close(); ?>