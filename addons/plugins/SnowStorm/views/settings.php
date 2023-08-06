<?php
// Copyright 2013 andrewks
// This file is part of esoTalk. Please see the included license file for usage information.

if (!defined("IN_ESOTALK")) exit;

/**
 * Displays the settings form for the SnowStorm plugin.
 *
 * @package esoTalk
 */

$form = $data["snowStormSettingsForm"];
?>
<?php echo $form->open(); ?>

<div class='section'>

<ul class='form'>

<li id='snowColor'>
<label><?php echo T("plugin.SnowStorm.snowColorLabel"); ?></label>
<?php echo $form->input("snowColor", "text", array("class" => "color")); ?> <a href='#' class='reset'><?php echo T("Reset"); ?></a>
<small><?php echo T("plugin.SnowStorm.snowColorDesc"); ?></small>
</li>

<li>
<label><?php echo T("plugin.SnowStorm.snowCharacterLabel"); ?></label>
<?php echo $form->input("snowCharacter", "text"); ?>
<small><?php echo T("plugin.SnowStorm.snowCharacterDesc"); ?></small>
</li>

<li>
<label><?php echo T("plugin.SnowStorm.flakesMaxActiveLabel"); ?></label>
<?php echo $form->input("flakesMaxActive", "text"); ?>
<small><?php echo T("plugin.SnowStorm.flakesMaxActiveDesc"); ?></small>
</li>

<li>
<label><?php echo T("plugin.SnowStorm.useTwinkleEffectLabel"); ?></label>
<?php echo $form->checkbox("useTwinkleEffect"); ?>
<small><?php echo T("plugin.SnowStorm.useTwinkleEffectDesc"); ?></small>
</li>

<li>
<label><?php echo T("plugin.SnowStorm.enableSnowmanLabel"); ?></label>
<?php echo $form->checkbox("enableSnowman"); ?>
<small><?php echo T("plugin.SnowStorm.enableSnowmanDesc"); ?></small>
</li>

</ul>

</div>

<div class='buttons'>
<?php echo $form->saveButton("snowStormSave"); ?>
</div>

<?php echo $form->close(); ?>

<script>
$(function() {

	// Turn a normal text input into a color picker, and run a callback when the color is changed.
	function colorPicker(id, callback) {

		// Create the color picker container.
		var picker = $("<div id='"+id+"-colorPicker'></div>").appendTo("body").addClass("popup").hide();

		// When the input is focussed upon, show the color picker.
		$("#"+id+" input").focus(function() {
			picker.css({position: "absolute", top: $(this).offset().top + $(this).outerHeight(), left: $(this).offset().left}).show();
		})

		// When focus is lost, hide the color picker.
		.blur(function() {
			picker.hide();
		})

		// Add a color swatch before the input.
		.before("<span class='colorSwatch'></span>");

		// Create a handler function for when the color is changed to update the input and swatch, and call
		// the custom callback function.
		var handler = function(color) {
			callback(color, picker);
			$("#"+id+" input").val(color.toUpperCase());
			$("#"+id+" .colorSwatch").css("backgroundColor", color);
			$("#"+id+" .reset").toggle(!!color);
		}

		// Set up a farbtastic instance inside the picker we've created.
		$.farbtastic(picker, function(color) {
			handler(color);
		}).setColor($("#"+id+" input").val());

		// When the "reset" link is clicked, reset the color.
		$("#"+id+" .reset").click(function(e) {
			e.preventDefault();
			handler("");
		}).toggle(!!$("#"+id+" input").val());
		
		// Register the Esc hotkey.
		$("#"+id).keydown(function(e) { 
			if (e.which == 27) {
				picker.hide();
			}
		});

	}
	
	// Turn the "snow color" field into a color picker.
	colorPicker("snowColor", function(color, picker) {

		// If no color is selected, use the default one.
		color = color ? color : "#77aaff";

	});

});
</script>