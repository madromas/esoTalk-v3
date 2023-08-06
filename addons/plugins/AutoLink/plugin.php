<?php

if (!defined("IN_ESOTALK")) exit;

 // An implementation of the string filter interface for plain text strings
ET::$pluginInfo["AutoLink"] = array(
    "name" => "AutoLink",
    "description" => "When you post an URL, AutoLinksLight automatically embeds videos from Youtube, Dailymotion, TwitchTV, RuTube, SoundCloud etc...",
    "version" => "2.0",
    "author" => "MadRomas",
    "authorEmail" => "madromas@yahoo.com",
    "authorURL" => "https://madway.net",
    "license" => "GPLv2"
);

class ETPlugin_AutoLink extends ETPlugin {

	// ACCEPTED PROTOTYPES
	//
	var $accepted_protocols = array(
	  'http://', 'https://', 'ftp://', 'ftps://', 'mailto:', 'telnet://',
	  'news://', 'nntp://', 'nntps://', 'feed://', 'gopher://', 'sftp://' );

	//
	// AUTO-EMBED IMAGE FORMATS
	//
	var $accepted_image_formats = array(
	  'gif', 'jpg', 'jpeg', 'tif', 'tiff', 'bmp', 'png', 'svg', 'webp', 'ico' );


public function handler_format_format($sender)
{
	// quick check to rule out complete wastes of time
	if( strpos( $sender->content, '://' ) !== false || strpos($sender->content, 'mailto:' ) !== false )
	{
	  $sender->content = preg_replace_callback( '/(?<=^|\r\n|\n| |\t|<br>|<br\/>|<br \/>)!?([a-z]+:(?:\/\/)?)([^ <>"\r\n\?]+)(\?[^ <>"\r\n]+)?/i', array( &$this, 'autoLink' ), $sender->content );
	 }
}

public function autoLink( $link = array())
{
  // $link[0] = the complete URL
  // $link[1] = link prefix, lowercase (e.g., 'https://')
  // $link[2] = URL up to, but not including, the ?
  // $link[3] = URL params, including initial ?

  // sanitise input
  $link[1] = strtolower( $link[1] );
  if( !isset( $link[3] ) ) $link[3] = '';

  // check protocol is allowed
  if( !in_array( $link[1], $this->accepted_protocols ) ) return $link[0];

  // check for forced-linking and strip prefix
  $forcelink = substr( $link[0], 0, 1 ) == '!';
  if( $forcelink ) $link[0] = substr( $link[0], 1 );

  $params = array();
  $matches = array();

  
  if( !$forcelink && ( $link[1] == 'http://' || $link[1] == 'https://' ) )
  {
	  $width = isset($width) ? $width : '640';
	  $height = isset($height) ? $height : '380';
	// Webm
	if( strtolower( substr( $link[2], -5 ) ) == '.webm')
	return '<video width="'.$width.'" height="'.$height.'" type="video/webm" controls="controls"><source src="'.$link[0].'" ></source></video>';
	// Mp4
	if( strtolower( substr( $link[2], -4 ) ) == '.mp4')
	return '<video width="'.$width.'" height="'.$height.'" type="video/webm" controls="controls"><source src="'.$link[0].'" ></source></video>';
	// Mp3
	else if( strtolower( substr( $link[2], -4 ) ) == '.mp3' )
	return '<audio data-fancybox="gallery" controls="controls"><source src="'.$link[0].'"></audio>';
	// images
	elseif( preg_match( '/\.([a-z]{1,5})$/i', $link[2], $matches ) && in_array( strtolower( $matches[1] ), $this->accepted_image_formats ) )
	return '<a data-fancybox="gallery" class="auto-embedded" href="'.$link[1].$link[2].$link[3].'"><img src="'.$link[1].$link[2].$link[3].'" alt="-image-" title="Click to enlarge" /></a>';
	// youtube
	if( strcasecmp( 'www.youtube.com/watch', $link[2] ) == 0 && $this->params( $params, $link[3], 'v' ) )
	  return '<iframe width="'.$width.'" height="'.$height.'"  src="'.$link[1].'www.youtube.com/embed/'.$params['v'].'?rel=0&amp;playsinline=1&amp;controls=1&amp;showinfo=0&amp;modestbranding=0" frameborder="0" allowfullscreen></iframe>';
	else if( preg_match( '/^(?:www\.)?youtu\.be\/([^\/]+)/i', $link[2], $matches ))
	  return '<iframe width="'.$width.'" height="'.$height.'"  src="'.$link[1].'www.youtube.com/embed/'.$matches[1].'?rel=0&amp;playsinline=1&amp;controls=1&amp;showinfo=0&amp;modestbranding=0" frameborder="0" allowfullscreen></iframe>';
	// Youtube Shorts
	else if( preg_match( '/^(?:www\.)?youtube\.com\/shorts\/([^\/]+)/i', $link[2], $matches ) )
		return '<iframe width="'.$width.'" height="'.$height.'"  src="'.$link[1].'www.youtube.com/embed/'.$matches[1].'?rel=0&amp;playsinline=1&amp;controls=1&amp;showinfo=0&amp;modestbranding=0" frameborder="0" allowfullscreen></iframe>';
	// Vimeo
	else if( preg_match( '/vimeo\.com\/(\w+\s*\/?)*([0-9]+)*$/i', $link[2], $matches ) )
	return '<iframe src="//player.vimeo.com/video/'.$matches[1].'?color=ffffff" width="'.$width.'" height="'.$height.'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
	// Dailymotion
	else if( preg_match( '/^www\.dailymotion\.com\/(?:[a-z]+\/)?video\/([^\/]+)/i', $link[2], $matches ) )
	  return '<iframe frameborder="0" width="'.$width.'" height="'.$height.'" src="http://www.dailymotion.com/embed/video/'.$matches[1].'"></iframe>';
    else if( preg_match( '/dai\.ly\/(\w+\s*\/?)*([0-9]+)*$/i', $link[2], $matches ) )
	  return '<iframe frameborder="0" width="'.$width.'" height="'.$height.'" src="http://www.dailymotion.com/embed/video/'.$matches[1].'"></iframe>';
	// ItemFix.com
	else if( preg_match( '/itemfix\.com\/(\w+\s*\/?)*([0-9]+)*$/i', $link[2], $matches ) )
	  return '<iframe width="'.$width.'" height="'.$height.'" src="http://www.itemfix.com/e/'.$link[0].'" frameborder="0" allowfullscreen></iframe>';
	// Twitch TV
	else if ( preg_match('/twitch\.tv\/(\w+\s*\/?)*([0-9]+)*$/i',$link[2], $matches))
		return '<iframe src="http://www.twitch.tv/'.$matches[1].'/embed" frameborder="0" scrolling="no" height="'.$height.'" width="'.$width.'"></iframe>';
	// RuTube
	else if( preg_match( '/rutube\.ru\/video\/(\w+\s*\/?)*([0-9]+)*$/i', $link[2], $matches ) )
		return '<iframe src="//rutube.ru/play/embed/'.$matches[1].'" width="'.$width.'" height="'.$height.'" allowFullScreen frameborder=0></iframe>';
    // SoundCloud
    else if ( preg_match('/^(?:www\.)?soundcloud\.com\/([^\/]+)/i',  $link[2], $matches ) )
        return '<embed src="https://w.soundcloud.com/player/?url='.$link[0].'" height="100"> </embed>';
     // Utreon
	else if( preg_match( '/utreon\.com\/v\/(\w+\s*\/?)*([0-9]+)*$/i', $link[2], $matches ) )
		return '<iframe src="https://utreon.com/embed/'.$matches[1].'" width="'.$width.'" height="'.$height.'" allowFullScreen frameborder=0></iframe>';
	// Streamable
	else if( preg_match( '/streamable\.com\/(\w+\s*\/?)*([0-9]+)*$/i', $link[2], $matches ) )
		return '<iframe src="https://streamable.com/e/'.$matches[1].'" width="'.$width.'" height="'.$height.'" allowFullScreen frameborder=0></iframe>';
    // Google Drive videos
  else if( preg_match( '/drive\.google\.com\/file\/d\/([^\/]+)/i', $link[2], $matches ) )
		return '<iframe src="https://drive.google.com/file/d/'.$matches[1].'/preview" width="'.$width.'" height="'.$height.'" allowFullScreen frameborder=0></iframe>';
  
  }


  // default to linkifying with icon
	return '<a href="'.$link[0].'" rel="nofollow external" target="_blank" class="link-external">'.$link[0].' <i class="icon-external-link"></i></a>';

}

/*Reads query parameters
params : result array as key => value
string : query string
required : array of required parameters key
@return true if required parameters are present.
*/
function params( &$params, $string, $required )
{
  $string = html_entity_decode($string);
  if( !is_array( $required ) ) $required = array( $required );
  if( substr( $string, 0, 1 ) == '?' ) $string = substr( $string, 1 );
  $params = array();
  $bits = explode( '&', $string );
  foreach( $bits as $bit ) {
	$pair = explode( '=', $bit, 2 );
	if( in_array( $pair[0], $required ) ) $params[ $pair[0] ] = $pair[1];
  }
  return count( $required ) == count( $params );
}

}
?>
