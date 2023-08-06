<?php

if (! defined ( "IN_ESOTALK" ))

	exit ();



$form = $data ["form"];

?>



<div class='area'>



	<h3>Edit the config.php configuration file directly</h3>	
	
	<p>Make changes carefully. Before submitting, you must pay attention to whether there are syntax errors, etc. If the configuration file is wrong, the entire website, including the management page, cannot be opened!</p>	

	<p>

		<a href='?loadbackup=1' class="button">Load previous backup</a>

	</p>

<?php echo $form->open(); ?>

<div>

<?php echo $form->input("content","textarea", array("rows" => "20", "tabindex" => 20, "style"=> 'width: 100%;')); ?>

</div>

	<p style="margin-top: 10px;"><?php echo $form->saveButton(); ?></p>



<?php echo $form->close(); ?>

</div>

