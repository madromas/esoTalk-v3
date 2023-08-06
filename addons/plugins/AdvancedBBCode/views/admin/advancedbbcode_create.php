<?php
// Copyright 2014 sda553
// This file is plugin view for esoTalk. Please see the included license file for usage information.

if (!defined("IN_ESOTALK")) exit;
$form = $data["form"];
?>
<script>
$(function() {
	ETBBCodes.init();
});
</script>
<div class='area' id='bbcodes'>
<h3><?php echo T("AdvancedBBCode.DefaultMenuItem"); ?></h3>
<p><?php echo T("AdvancedBBCode.Description"); ?></p>
<?php echo $form->open(); ?>
<?php echo $form->input("bbcode_id","hidden"); ?>
    <ul class="form"> 
        <li class="sep"></li> 
        <li class="bbcodeedit"><label><h3><?php echo T("AdvancedBBCode.Usage"); ?></h3></label>
            <p><?php echo T("AdvancedBBCode.UsageDescription"); ?></p>
            <dl>
                <dt><label><h3><?php echo T("AdvancedBBCode.Examples"); ?></h3></label>
                <span>
                <small>
                [highlight={COLOR}]{TEXT}[/highlight]
                <br>
                [font={SIMPLETEXT1}]{SIMPLETEXT2}[/font]
                </small>
                </span>
                </dt>
                <dd><?php 
                $attributes = array("rows" => 5,"cols" => 60);
                echo $form->input("bbcode_match","textarea",$attributes); ?>
                </dd>
            </dl>
        </li> 
        <li class="sep"></li> 
        <li class="bbcodeedit"><label><h3><?php echo T("AdvancedBBCode.HTMLTemplate"); ?></h3></label>
            <p><?php echo T("AdvancedBBCode.HTMLTemplateDescription"); ?></p>
            <dl>
                <dt><label><h3><?php echo T("AdvancedBBCode.Examples"); ?></h3></label>
                <span><small>&lt;span style="background-color: {COLOR};"&gt;{TEXT}&lt;/span&gt;
                    <br>
                    &lt;span style="font-family: {SIMPLETEXT1};"&gt;{SIMPLETEXT2}&lt;/span&gt;
                </small></span>
                </dt>
                <dd>
                    <?php echo $form->input("bbcode_tpl","textarea",$attributes); ?>
                </dd>
            </dl>
        </li> 
        <li class="sep"></li> 
        <li class="bbcodeedit"><label><h3><?php echo T("AdvancedBBCode.Hint"); ?></h3></label>
            <p><?php echo T("AdvancedBBCode.HintDescription"); ?></p>
            <dl>
                <dt><label><?php echo T("AdvancedBBCode.HintLabel"); ?></label>
                </dt>
                <dd><?php echo $form->input("bbhint"); ?></dd>
            </dl>
        </li> 
        <li class="sep"></li>         
        <div class="buttons" id="control-savebb">
            <?php echo $form->saveButton(); ?>
            <?php echo $form->cancelButton(); ?>
        </div>
        <table id="down" cellspacing="1"> 
            <thead> 
                <tr> <th colspan="2"><?php echo T("AdvancedBBCode.Lexems"); ?></th> </tr>
                <tr> <td class="row3" colspan="2"><?php echo T("AdvancedBBCode.LexemDescription"); ?></td> </tr> 
                <tr> <th><?php echo T("AdvancedBBCode.Lexem"); ?></th> <th><?php echo T("AdvancedBBCode.LexemUsage"); ?></th> </tr> 
            </thead> 
            <tbody> 
                <tr valign="top"> <td class="row1">{TEXT}</td> <td class="row2"><?php echo T("AdvancedBBCode.LexemTEXT"); ?></td> </tr> 
                <tr valign="top"> <td class="row1">{SIMPLETEXT}</td> <td class="row2"><?php echo T("AdvancedBBCode.LexemSIMPLETEXT"); ?></td> </tr> 
                <tr valign="top"> <td class="row1">{INTTEXT}</td> <td class="row2"><?php echo T("AdvancedBBCode.LexemINTTEXT"); ?></td> </tr> 
                <tr valign="top"> <td class="row1">{IDENTIFIER}</td> <td class="row2"><?php echo T("AdvancedBBCode.LexemIDENTIFIER"); ?></td> </tr> 
                <tr valign="top"> <td class="row1">{NUMBER}</td> <td class="row2"><?php echo T("AdvancedBBCode.LexemNUMBER"); ?></td> </tr> 
                <tr valign="top"> <td class="row1">{EMAIL}</td> <td class="row2"><?php echo T("AdvancedBBCode.LexemEMAIL"); ?></td> </tr> 
                <tr valign="top"> <td class="row1">{URL}</td> <td class="row2"><?php echo T("AdvancedBBCode.LexemURL"); ?></td> </tr> 
                <tr valign="top"> <td class="row1">{LOCAL_URL}</td> <td class="row2"><?php echo T("AdvancedBBCode.LexemLOCAL_URL"); ?></td> </tr> 
                <tr valign="top"> <td class="row1">{RELATIVE_URL}</td> <td class="row2"><?php echo T("AdvancedBBCode.LexemRELATIVE_URL"); ?></td> </tr> 
                <tr valign="top"> <td class="row1">{COLOR}</td> <td class="row2"><?php echo T("AdvancedBBCode.LexemCOLOR"); ?></td> </tr> 
            </tbody> 
        </table>        
    </ul> 
</form>
</div>

