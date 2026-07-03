<?php
// Copyright 2011 Toby Zerner, Simon Zerner
// This file is part of esoTalk. Please see the included license file for usage information.
if (!defined("IN_ESOTALK")) exit;

// Detect mobile device
$isMobile = preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);

if ($isMobile):
    // --- MOBILE: ---
?>
<div id='conversationsFilter' class='bodyHeader'>
    <form class='search big' id='search' action='<?php echo sanitizeHTML(URL("conversations/".sanitizeHTML($data["channelSlug"]))); ?>' method='get'>
        <fieldset>
            <i class='icon-search'></i>
            <input name='search' type='text' class='text' value='<?php echo sanitizeHTML($data["searchString"]); ?>' spellcheck='false' placeholder='<?php echo T("Search conversations..."); ?>'/>
            <a class='control-reset' href='<?php echo sanitizeHTML(URL("conversations/".sanitizeHTML($data["channelSlug"]))); ?>'><i class='icon-remove'></i></a>
        </fieldset>
    </form>

    <ul id='channels' class='channels tabs'>
        <li class='channelListItem'><a href='<?php echo URL("channels"); ?>' class='channel-list' data-channel='list' title='<?php echo T("Channel List"); ?>'><i class="icon-list"></i></a></li>
        <?php $this->renderView("channels/tabs", $data); ?>
    </ul>

    <?php if ($data["controlsMenu"]->count()): ?>
    <ul id='searchControls' class='controls'>
        <?php echo $data["controlsMenu"]->getContents(); ?>
    </ul>
    <?php endif; ?>

    <?php if ($data["gambitsMenu"]->count()): ?>
    <div id='gambits'>
        <ul class='popupMenu'>
            <?php echo $data["gambitsMenu"]->getContents(); ?>
        </ul>
    </div>
    <?php endif; ?>
</div>

<div id='conversations'>
    <?php $this->renderView("conversations/results", $data); ?>
</div>

<?php else: 
    // --- DESKTOP: ---
?>
<div id='forum-wrapper' class='sidebar-layout'>
    <aside id='channel-sidebar'>
        <ul id='channels' class='channels tabs' style="display:flex;">
            <li class='channelListItem'>
                <a href='<?php echo URL("channels"); ?>' class='channel-list' data-channel='list' title='<?php echo T("Channel List"); ?>'>
                    <i class="icon-list"></i> <?php echo T("All Channels"); ?>
                </a>
            </li>
            <?php $this->renderView("channels/tabs", $data); ?>
        </ul>
    </aside>

    <main id='discussion-main' style='flex-grow: 1;'>
        <div id='conversationsFilter' class='bodyHeader'>
            <form class='search big' id='search' action='<?php echo sanitizeHTML(URL("conversations/".sanitizeHTML($data["channelSlug"]))); ?>' method='get'>
                <fieldset>
                    <i class='icon-search'></i>
                    <input name='search' type='text' class='text' value='<?php echo sanitizeHTML($data["searchString"]); ?>' spellcheck='false' placeholder='<?php echo T("Search conversations..."); ?>'/>
                    <a class='control-reset' href='<?php echo sanitizeHTML(URL("conversations/".sanitizeHTML($data["channelSlug"]))); ?>'><i class='icon-remove'></i></a>
                </fieldset>
            </form>
            <?php if ($data["controlsMenu"]->count()): ?>
            <ul id='searchControls' class='controls'>
                <?php echo $data["controlsMenu"]->getContents(); ?>
            </ul>
            <?php endif; ?>
            <?php if ($data["gambitsMenu"]->count()): ?>
            <div id='gambits'>
                <ul class='popupMenu'>
                    <?php echo $data["gambitsMenu"]->getContents(); ?>
                </ul>
            </div>
            <?php endif; ?>
        </div>
        <div id='conversations'>
            <?php $this->renderView("conversations/results", $data); ?>
        </div>
    </main>
</div>
<?php endif; ?>