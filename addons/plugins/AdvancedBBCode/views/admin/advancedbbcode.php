<?php
// Copyright 2014 sda553
// This file is plugin view for esoTalk. Please see the included license file for usage information.

if (!defined("IN_ESOTALK")) exit;
?>
<script>
$(function() {
	ETBBCodes.initadmin();
});
</script>
<div class='area' id='bbcodes'>
<h3><?php echo T("AdvancedBBCode.ActiveCodes"); ?></h3>
<ul id='bbcodeList'>   
<?php foreach ($data["bblist"] as $k => $v) { ?>   
<li id="bbcode_<?php echo $v["bbcode_tag"] ?>" class="bbcode thing"> 
    <div class="controls bbcodeControls">
        <div class="popupWrapper">
            <a href='<?php echo URL("admin/".strtolower($this->GetPluginName()) ."/modify/".$v["bbcode_id"]); ?>' class="popupButton button" title='<?php echo T("Edit"); ?>' id="bbcodeControls-<?php echo $v["bbcode_tag"] ?>-button">
                <i class="icon-cog"></i> 
            </a>
            <a href='<?php echo URL("admin/".strtolower($this->GetPluginName()) ."/delete/".$v["bbcode_id"]); ?>' class="popupButton button" title='<?php echo T("Delete"); ?>' id="bbcodeControls-<?php echo $v["bbcode_tag"] ?>-button">
                <i class="icon-trash"></i> 
            </a>            
        </div> 
    </div> 
    <strong><?php echo $v["bbcode_tag"] ?></strong> 
    <small class="description"><?php echo $v["bbcode_helpline"] ?></small> 
</li>
<?php } ?>   
</ul>
<a href='<?php echo URL("admin/".strtolower($this->GetPluginName())."/create"); ?>' class="button" id="createBBCodeLink"><span class="icon-plus"></span><?php echo T("AdvancedBBCode.CreateCode"); ?></a>
</div>

