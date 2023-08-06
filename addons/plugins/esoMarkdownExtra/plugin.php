<?php

if (!defined("IN_ESOTALK")) exit;

ET::$pluginInfo["esoMarkdownExtra"] = array(
    "name"        => "esoMarkdownExtra",
    "description" => "This plugin uses the Markdown Extra library from Michel Fortin to render text.",
    "version"     => "1.0",
    "author"      => "Kassius Iakxos",
    "authorEmail" => "kassius@users.noreply.github.com",
    "authorURL"   => "http://github.com/kassius",
    "license"     => "GPLv2"
);


spl_autoload_register(function($class){
		require preg_replace('{\\\\|_(?!.*\\\\)}', DIRECTORY_SEPARATOR, ltrim($class, '\\')).'.php';
});
use \Michelf\MarkdownExtra;

require_once(PATH_CORE."/lib/ETFormat.class.php");

class MDETFormat extends ETFormat
{
	public function format($sticky = false)
	{
		if (C("esoTalk.format.mentions")) $this->mentions();
		if (!$this->inline) $this->quotes();
		$this->closeTags();
		
		return $this;
	}

	
	public function links()
	{
		// Convert normal links - http://www.example.com, www.example.com - using a callback function.
		$this->content = preg_replace_callback(
			"/(?<=\s|^|>|&lt;)(\w+:\/\/)?([\w\-\.]+\.(?:AC|AD|AE|AERO|AF|AG|AI|AL|AM|AN|AO|AQ|AR|ARPA|AS|ASIA|AT|AU|AW|AX|AZ|BA|BB|BD|BE|BF|BG|BH|BI|BIZ|BJ|BM|BN|BO|BR|BS|BT|BV|BW|BY|BZ|CA|CAT|CC|CD|CF|CG|CH|CI|CK|CL|CM|CN|CO|COM|COOP|CR|CU|CV|CW|CX|CY|CZ|DE|DJ|DK|DM|DO|DZ|EC|EDU|EE|EG|ER|ES|ET|EU|FI|FJ|FK|FM|FO|FR|GA|GB|GD|GE|GF|GG|GH|GI|GL|GM|GN|GOV|GP|GQ|GR|GS|GT|GU|GW|GY|HK|HM|HN|HR|HT|HU|ID|IE|IL|IM|IN|INFO|INT|IO|IQ|IR|IS|IT|JE|JM|JO|JOBS|JP|KE|KG|KH|KI|KM|KN|KP|KR|KW|KY|KZ|LA|LB|LC|LI|LK|LR|LS|LT|LU|LV|LY|MA|MC|MD|ME|MG|MH|MIL|MK|ML|MM|MN|MO|MOBI|MP|MQ|MR|MS|MT|MU|MUSEUM|MV|MW|MX|MY|MZ|NA|NAME|NC|NE|NET|NF|NG|NI|NL|NO|NP|NR|NU|NZ|OM|ORG|PA|PE|PF|PG|PH|PK|PL|PM|PN|POST|PR|PRO|PS|PT|PW|PY|QA|RE|RO|RS|RU|RW|SA|SB|SC|SD|SE|SG|SH|SI|SJ|SK|SL|SM|SN|SO|SR|ST|SU|SV|SX|SY|SZ|TC|TD|TEL|TF|TG|TH|TJ|TK|TL|TM|TN|TO|TP|TR|TRAVEL|TT|TV|TW|TZ|UA|UG|UK|US|UY|UZ|VA|VC|VE|VG|VI|VN|VU|WF|WS|XXX|YE|YT|ZA|ZM|ZW)(?:[\.\/#][^\s<]*?)?)(?=\)\s|[\s\.,?!>]*(?:\s|&gt;|>|$))/i",
			array($this, "linksCallback"), $this->content);

		// Convert email links.
		$this->content = preg_replace('/(?<=^|\r\n|\n| |\t|<br>|<br\/>|<br \/>)!?([a-z]+:(?:\/\/)?)([^ <>"\r\n\?]+)(\?[^ <>"\r\n]+)?/i', "<a href='mailto:$0' class='link-email'>$0</a>", $this->content);

		return $this;
		
		
	}
	
	
	
	
	
		
		
		
		
	
}

class ETPlugin_esoMarkdownExtra extends ETPlugin
{
	public $content;
	public $MDETFormat;
	public $MDEParser;

	public function init()
	{
		$this->MDETFormat = new MDETFormat;
		$this->MDEParser = new MarkdownExtra;
		$this->MDEParser->fn_id_prefix = mt_rand(0,99999)."-";
	}

	public function handler_format_beforeFormat($sender)
	{
		$this->MDETFormat->content = $sender->get();
	}

	public function handler_format_afterFormat($sender)
	{
		$this->MDETFormat->links(); 
		
		$search = array("\r&gt; ","\n&gt; ");
		$this->MDETFormat->content = str_replace($search, "\n> ", $this->MDETFormat->content);
		$this->MDETFormat->content = $this->MDEParser->transform($this->MDETFormat->content);

		$this->MDETFormat->content = str_replace("\r", "\n", $this->MDETFormat->content);
		while(strstr($this->MDETFormat->content,"\n\n") !== FALSE) { $this->MDETFormat->content = str_replace("\n\n", "", $this->MDETFormat->content); }

		$this->MDETFormat->format();
		$this->MDETFormat->content = str_replace("\\\"", "\"", $this->MDETFormat->content);
		
		
		$this->MDETFormat->content = preg_replace_callback(
		      '#\<code (.*?)\>(.+?)\<\/code\>#s',function($m)
		      {
		        //remove link-member link in code view
		        $code = preg_replace("#\<a href='(.*?)' class='link-member'\>(.*?)</a\>#s","$2",$m[2]);
		        //fixed html format
		        $code = str_replace("&amp;","&",$code);
		        return  "<code ".$m[1].">".$code."</code>";
		    },$this->MDETFormat->content);
    
    
		$sender->content = $this->MDETFormat->content;
	}

	public function handler_conversationController_renderBefore($sender)
	{
		$sender->addCSSFile($this->resource("markdown.css"));
	}

}

?>
