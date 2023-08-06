<?php
// Copyright 2011 Toby Zerner, Simon Zerner
// This file is part of esoTalk. Please see the included license file for usage information.

if (!defined("IN_ESOTALK")) exit;

ET::$pluginInfo["BBCode"] = array(
	"name" => "BBCode",
	"description" => "Formats BBCode within posts, allowing users to style their text.",
	"version" => ESOTALK_VERSION,
    "author" => "esoTalk Team",
    "authorEmail" => "5557720max@gmail.com",
    "authorURL" => "https://github.com/phpSoftware/esoTalk-v2/",
	"license" => "GPLv2"
);


/**
 * BBCode Formatter Plugin
 *
 * Interprets BBCode in posts and converts it to HTML formatting when rendered. Also adds BBCode formatting
 * buttons to the post editing/reply area.
 */
class ETPlugin_BBCode extends ETPlugin {


/**
 * Add an event handler to the initialization of the conversation controller to add BBCode CSS and JavaScript
 * resources.
 *
 * @return void
 */
		 public function handler_conversationController_renderBefore($sender)
     {
         $sender->addJSFile($this->resource("bbcode.js"));
         $sender->addCSSFile($this->resource("bbcode.css"));
     }
 
 
     /**
      * Add an event handler to the "getEditControls" method of the conversation controller to add BBCode
      * formatting buttons to the edit controls.
      *
      * @return void
      */
     public function handler_conversationController_getEditControls($sender, &$controls, $id)
     {

         addToArrayString($controls, "fixed", "<a href='javascript:BBCode.fixed(\"$id\");void(0)' title='".T("Code")."' class='control-fixed'><i class='icon-code'></i></a>", 0);
         addToArrayString($controls, "image", "<a href='javascript:BBCode.image(\"$id\");void(0)' title='".T("Image")."' class='control-img'><i class='icon-picture'></i></a>", 0);
		 // MAP
		 addToArrayString($controls, "map", "<a href='javascript:BBCode.map(\"$id\");void(0)' title='".T("Map")."' class='control-img'><i class='fas fa-map-marker-alt'></i></a>", 0);
         
		 addToArrayString($controls, "link", "<a href='javascript:BBCode.link(\"$id\");void(0)' title='".T("Link")."' class='control-link'><i class='icon-link'></i></a>", 0);
		 addToArrayString($controls, "center", "<a href='javascript:BBCode.center(\"$id\");void(0)' title='".T("Center")."' class='control-c'><i class='icon-align-center'></i></a>", 0);
         addToArrayString($controls, "strike", "<a href='javascript:BBCode.strikethrough(\"$id\");void(0)' title='".T("Strike")."' class='control-s'><i class='icon-strikethrough'></i></a>", 0);

         // vanGato
         addToArrayString($controls, "textcolor", "<a href='javascript:BBCode.textcolor(\"$id\");void(0)' title='".T("Color")."' class='control-textcolor'><i class='icon-tint'></i></a>", 0);

         addToArrayString($controls, "header", "<a href='javascript:BBCode.header(\"$id\");void(0)' title='".T("Header")."' class='control-h'><i class='icon-h-sign'></i></a>", 0);
         addToArrayString($controls, "italic", "<a href='javascript:BBCode.italic(\"$id\");void(0)' title='".T("Italic")."' class='control-i'><i class='icon-italic'></i></a>", 0);
         addToArrayString($controls, "bold", "<a href='javascript:BBCode.bold(\"$id\");void(0)' title='".T("Bold")."' class='control-b'><i class='icon-bold'></i></a>", 0);
 
     }
 
 
     /**
      * Add an event handler to the formatter to take out and store code blocks before formatting takes place.
      *
      * @return void
      */
     public function handler_format_beforeFormat($sender)
     {
         $this->blockFixedContents = array();
         $this->inlineFixedContents = array();
         $self = $this;
 
         $regexp = "/(.*)^\s*\[code\]\n?(.*?)\n?\[\/code]$/ims";
         while (preg_match($regexp, $sender->content)) {
             if ($sender->inline) {
                 $sender->content = preg_replace_callback($regexp, function ($matches) use ($self) {
                     $self->inlineFixedContents[] = $matches[2];
                     return $matches[1].'<code></code>';
                 }, $sender->content);
             } else {
                 $sender->content = preg_replace_callback($regexp, function ($matches) use ($self) {
                     $self->blockFixedContents[] = $matches[2];
                     return $matches[1].'</p><pre></pre><p>';
                 }, $sender->content);
             }
         }
 
         // Inline-level [fixed] tags will become <code>.
         $sender->content = preg_replace_callback("/\[code\]\n?(.*?)\n?\[\/code]/is", function ($matches) use ($self) {
             $self->inlineFixedContents[] = $matches[1];
             return '<code></code>';
         }, $sender->content);

        // vanGato
        $regexp = "/([^\n])\[\/spoiler\]/i";
        while (preg_match($regexp, $sender->content)) {
          $sender->content = preg_replace($regexp, "$1\n[/spoiler]", $sender->content);
        }

     }
 
 
     /**
      * Add an event handler to the formatter to parse BBCode and format it into HTML.
      *
      * @return void
      */
     public function handler_format_format($sender)
     {
         // TODO: Rewrite BBCode parser to use the method found here:
         // http://stackoverflow.com/questions/1799454/is-there-a-solid-bb-code-parser-for-php-that-doesnt-have-any-dependancies/1799788#1799788
         // Remove control characters from the post.
         //$sender->content = preg_replace('/[\x00-\x09\x0B\x0C\x0E-\x1F\x7F]/', '', $sender->content);
         // \[ (i|b|color|url|somethingelse) \=? ([^]]+)? \] (?: ([^]]*) \[\/\1\] )
 
         // Images: [img]url[/img] - IMAGE PROXY - https://images.weserv.nl/?url=
         $replacement = $sender->inline ? "[image]" : "<a data-fancybox='gallery' class='auto-embedded' href='$1'><img src='$1' alt='-image-' border='0' title='Click to enlarge'/></a>";
         $sender->content = preg_replace("/\[img\](https?.*?)\[\/img\]/i", $replacement, $sender->content);
		 
		 // Map: [map]url[/map]
         $replacement = $sender->inline ? "[map]" : "<iframe src='$1' frameborder='0'/></iframe>";
         $sender->content = preg_replace("/\[map\](https?.*?)\[\/map\]/i", $replacement, $sender->content);
 
         // Links with display text: [url=http://url]text[/url]
         $sender->content = preg_replace_callback("/\[url=(?!\s+)(\w{2,6}:\/\/)?([^\]]*?)\](.*?)\[\/url\]/i", array($this, "linksCallback"), $sender->content);
 
         // Bold: [b]bold text[/b]
         $sender->content = preg_replace("/\[b\](.*?)\[\/b\]/si", "<b>$1</b>", $sender->content);
 
         // Italics: [i]italic text[/i]
         $sender->content = preg_replace("/\[i\](.*?)\[\/i\]/si", "<i>$1</i>", $sender->content);
 
         // Strikethrough: [s]strikethrough[/s]
         $sender->content = preg_replace("/\[s\](.*?)\[\/s\]/si", "<del>$1</del>", $sender->content);
 
         // Headers: [h]header[/h]
         $replacement = $sender->inline ? "<b>$1</b>" : "</p><h4>$1</h4><p>";
         $sender->content = preg_replace("/\[h\](.*?)\[\/h\]/", $replacement, $sender->content);

         // Centering: [b]centering text[/b]
	     $sender->content = preg_replace("/\[center\](.*?)\[\/center\]/si", "<center>$1</center>", $sender->content);

         // vanGato
         // Font Color: [color=$1]text[/color]
         $sender->content = preg_replace("/\[color=([#a-z0-9]+)\](.*?)\[\/color\]/is", "<span style=\"color:\\1\">\\2</span>", $sender->content);
     }
 
 
    /**
     * The callback function used to replace URL BBCode with HTML anchor tags.
     *
     * @param array $matches An array of matches from the regular expression.
     * @return string The replacement HTML anchor tag.
     */
    public function linksCallback($matches) {
      return ET::formatter()->formatLink($matches[1].$matches[2],$matches[3]);
    }
    #public function linksCallback($matches)
    #{
    #  // If this is an internal link...
    #  $url = ($matches[1] ? $matches[1] : "http://").$matches[2];
    #  $baseURL = C("esoTalk.baseURL");
    #  if (substr($url, 0, strlen($baseURL)) == $baseURL) {
    #    return "<a href='".$url."' target='_blank' class='link-internal'>".$matches[3]."</a>";
    #  }
    #  
    #
    #  // Otherwise, return an external HTML anchor tag.
    #  return "<a href='".$url."' rel='nofollow external' target='_blank' class='link-external'>".$matches[3]." <i class='icon-external-link'></i></a>";
    #}
 
 
     /**
      * Add an event handler to the formatter to put code blocks back in after formatting has taken place.
      *
      * @return void
      */
     public function handler_format_afterFormat($sender)
     {
         $regexp = "/(.*?)\n?\[spoiler(?:(?::|=)(.*?)(]?))?\]\n?(.*?)\n?\[\/spoiler\]\n{0,2}/is";
        while (preg_match($regexp, $sender->content)) {
          $sender->content = preg_replace($regexp,
            "$1</p><div class=\"spoiler\"><span>".T("Spoiler!")."</span> <span class=\"title\">$2$3</span><div class=\"content\">$4\n</div></div><p>", $sender->content);
        }


         $self = $this;
 
         // Retrieve the contents of the inline <code> tags from the array in which they are stored.
         $sender->content = preg_replace_callback("/<code><\/code>/i", function ($matches) use ($self) {
             return '<code>'.array_shift($self->inlineFixedContents).'</code>';
         }, $sender->content);
 
         // Retrieve the contents of the block <pre> tags from the array in which they are stored.
         if (!$sender->inline) {
             $sender->content = preg_replace_callback("/<pre><\/pre>/i", function ($matches) use ($self) {
                 return '<pre>'.array_pop($self->blockFixedContents).'</pre>';
             }, $sender->content);
         }
     }
 }
