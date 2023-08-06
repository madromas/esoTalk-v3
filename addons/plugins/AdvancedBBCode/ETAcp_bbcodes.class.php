<?php
if (!defined("IN_ESOTALK")) exit;

class bitfield
{
	var $data;

	function __construct($bitfield = '')
	{
		$this->data = base64_decode($bitfield);
	}

	/**
	*/
	function get($n)
	{
		// Get the ($n / 8)th char
		$byte = $n >> 3;

		if (strlen((string) $this->data) >= $byte + 1)
		{
			$c = $this->data[$byte];

			// Lookup the ($n % 8)th bit of the byte
			$bit = 7 - ($n & 7);
			return (bool) (ord($c) & (1 << $bit));
		}
		else
		{
			return false;
		}
	}

	function set($n)
	{
		$byte = $n >> 3;
		$bit = 7 - ($n & 7);

		if (strlen((string) $this->data) >= $byte + 1)
		{
			$this->data[$byte] = $this->data[$byte] | chr(1 << $bit);
		}
		else
		{
			$this->data .= str_repeat("\0", $byte - strlen((string) $this->data));
			$this->data .= chr(1 << $bit);
		}
	}

	function clear($n)
	{
		$byte = $n >> 3;

		if (strlen((string) $this->data) >= $byte + 1)
		{
			$bit = 7 - ($n & 7);
			$this->data[$byte] = $this->data[$byte] &~ chr(1 << $bit);
		}
	}

	function get_blob()
	{
		return $this->data;
	}

	function get_base64()
	{
		return base64_encode($this->data);
	}

	function get_bin()
	{
		$bin = '';
		$len = strlen((string) $this->data);

		for ($i = 0; $i < $len; ++$i)
		{
			$bin .= str_pad(decbin(ord($this->data[$i])), 8, '0', STR_PAD_LEFT);
		}

		return $bin;
	}

	function get_all_set()
	{
		return array_keys(array_filter(str_split($this->get_bin())));
	}

	function merge($bitfield)
	{
		$this->data = $this->data | $bitfield->get_blob();
	}
}

class ETAcp_bbcodes
{
//	var $u_action;
        public $warning_confirmed = false;
        public $admincontroller;
        public $controller;
        private array $bbcodes = array();   
        private $bbcode_bitfield;
    
	function main($bbcodedata)
	{

		// Set up mode-specific vars
            $form = $this->admincontroller->data["form"];
            $model = $this->admincontroller->GetModel();
            $bbcode_id = $bbcodedata["bbcode_id"];
            
		switch ($bbcodedata['action'])
		{
			case 'add':
                            $form->setValue("bbcode_match", "");
                            $form->setValue("bbcode_tpl", "");
                            $form->setValue("bbhint", "");
                            $form->setValue("bbcode_id", "");
			break;

			case 'edit':
                                $row = $model->getBBcodeById($bbcode_id);

				if (!$row)
				{
					throw new Exception("ETBBcodes: The BB code id='".$bbcode_id."' does not exist.");
				}
                            $form->setValue("bbcode_match", $row["bbcode_match"]);
                            $form->setValue("bbcode_tpl", $row["bbcode_tpl"]);
                            $form->setValue("bbhint", $row["bbcode_helpline"]);
                            $form->setValue("bbcode_id", $bbcode_id);
			break;
                

			case 'modify':
                                $row = $model->getBBcodeById($bbcode_id);

				if (!$row)
				{
					throw new Exception("ETBBcodes: The BB code id='".$bbcode_id."' does not exist.");
				}
			// No break here

			case 'create':
				$bbcode_match = $form->getValue("bbcode_match");
				$bbcode_tpl = $form->getValue("bbcode_tpl");
				$bbcode_helpline =$form->getValue("bbhint");
			break;
		}

		// Do major work
		switch ($bbcodedata['action'])
		{
			case 'edit':
			case 'add':
                        $form->action = URL("admin/".strtolower($this->admincontroller->GetPluginName())."/create");
                        $this->admincontroller->render("admin/".strtolower($this->admincontroller->GetPluginName())."_create");
                        break;
                
			case 'modify':
			case 'create':

				$warn_text = preg_match('%<[^>]*\{text[\d]*\}[^>]*>%i', (string) $bbcode_tpl);
                            
				if ($warn_text && !$form->getValue("warning_confirmed"))
				{
                                    $this->admincontroller->responseType = RESPONSE_TYPE_AJAX;
                                    $this->admincontroller->json("confirmwarning", 1);
                                    $this->admincontroller->json("result", 0);
                                    $this->admincontroller->render();
                                    break;
                                }
                                else
                                {
                                    $data = $this->build_regexp($bbcode_match, $bbcode_tpl);
                                    if ($data=='BBCODE_INVALID')
                                    {
                                        $this->admincontroller->responseType = RESPONSE_TYPE_AJAX;
                                        $this->admincontroller->json("error", 'AdvancedBBCode.BBCODE_INVALID');
                                        $this->admincontroller->json("result", 0);
                                        $this->admincontroller->render();
                                        break;                                    
                                    }
                                    $hard_coded = array('code', 'quote', 'quote=', 'attachment', 'attachment=', 'b', 'i', 'url', 'url=', 'img', 'size', 'size=', 'color', 'color=', 'u', 'list', 'list=', 'email', 'email=', 'flash', 'flash=');

                                    if (($bbcodedata['action'] == 'modify' && strtolower($data['bbcode_tag']) !== strtolower($row['bbcode_tag'])) || ($bbcodedata['action'] == 'create'))
                                    {
                                            $info = $model->getTagExists(strtolower($data['bbcode_tag']));

                                            // Grab the end, interrogate the last closing tag
                                            if ($info['test'] === '1' || in_array(strtolower($data['bbcode_tag']), $hard_coded) || (preg_match('#\[/([^[]*)]$#', (string) $bbcode_match, $regs) && in_array(strtolower($regs[1]), $hard_coded)))
                                            {
                                                $this->admincontroller->responseType = RESPONSE_TYPE_AJAX;
                                                $this->admincontroller->json("error", 'AdvancedBBCode.BBCODE_INVALID_TAG_NAME');
                                                $this->admincontroller->json("result", 0);
                                                $this->admincontroller->render();
                                                break;                                    
                                            }
                                    }                                    
                                    if (str_ends_with($data['bbcode_tag'], '='))
                                    {
                                            $test = substr($data['bbcode_tag'], 0, -1);
                                    }
                                    else
                                    {
                                            $test = $data['bbcode_tag'];
                                    }

                                    if (!preg_match('%\\[' . $test . '[^]]*].*?\\[/' . $test . ']%s', (string) $bbcode_match))
                                    {
                                        $this->admincontroller->responseType = RESPONSE_TYPE_AJAX;
                                        $this->admincontroller->json("error", 'AdvancedBBCode.BBCODE_OPEN_ENDED_TAG');
                                        $this->admincontroller->json("result", 0);
                                        $this->admincontroller->render();
                                        break;                                    
                                    }

                                    if (strlen((string) $data['bbcode_tag']) > 16)
                                    {
                                        $this->admincontroller->responseType = RESPONSE_TYPE_AJAX;
                                        $this->admincontroller->json("error", 'AdvancedBBCode.BBCODE_TAG_TOO_LONG');
                                        $this->admincontroller->json("result", 0);
                                        $this->admincontroller->render();
                                        break;                                           
                                    }

                                    if (strlen((string) $bbcode_match) > 4000)
                                    {
                                        $this->admincontroller->responseType = RESPONSE_TYPE_AJAX;
                                        $this->admincontroller->json("error", 'AdvancedBBCode.BBCODE_TAG_DEF_TOO_LONG');
                                        $this->admincontroller->json("result", 0);
                                        $this->admincontroller->render();
                                        break;                                           
                                    }

                                    if (strlen((string) $bbcode_helpline) > 255)
                                    {
                                        $this->admincontroller->responseType = RESPONSE_TYPE_AJAX;
                                        $this->admincontroller->json("error", 'AdvancedBBCode.BBCODE_HELPLINE_TOO_LONG');
                                        $this->admincontroller->json("result", 0);
                                        $this->admincontroller->render();
                                        break;                                            
                                    }
                                    $sql_ary = array(
                                            'bbcode_tag'				=> $data['bbcode_tag'],
                                            'bbcode_match'				=> $bbcode_match,
                                            'bbcode_tpl'				=> $bbcode_tpl,
                                            'bbcode_helpline'			=> $bbcode_helpline,
                                            'second_pass_match'			=> $data['second_pass_match'],
                                            'second_pass_replace'		=> $data['second_pass_replace']
                                    );
                                    
                                    if ($bbcodedata['action'] == 'create')
                                    {
                                            $row = $model->getMaxBBcodeId();

                                            if ($row)
                                            {
                                                    $bbcode_id = $row['max_bbcode_id'] + 1;
                                            }
                                            else
                                            {
                                                    $bbcode_id = 1;
                                            }

                                            if ($bbcode_id > BBCODE_LIMIT)
                                            {
                                                $this->admincontroller->responseType = RESPONSE_TYPE_AJAX;
                                                $this->admincontroller->json("error", 'AdvancedBBCode.TOO_MANY_BBCODES');
                                                $this->admincontroller->json("result", 0);
                                                $this->admincontroller->render();
                                                break;                                            
                                            }

                                            $sql_ary['bbcode_id'] = (int) $bbcode_id;

                                            $model->CreateTag($sql_ary);
                                            $this->admincontroller->responseType = RESPONSE_TYPE_AJAX;
                                            $this->admincontroller->json("result", 1);
                                            $this->admincontroller->render();
                                            break;
                                    }
                                    else
                                    {
                                            if ($row["second_pass_match"]!=$sql_ary["second_pass_match"])
                                                $model->ResetBBCache($row['bbcode_id']);
                                            $model->UpdateTag($sql_ary,array(
                                                                    'bbcode_id'=> $row['bbcode_id']));
                                            $this->admincontroller->responseType = RESPONSE_TYPE_AJAX;
                                            $this->admincontroller->json("result", 1);
                                            $this->admincontroller->render();
                                            break;
                                    }                                    
                                }
			case 'delete':

                                $row = $model->getBBcodeById($bbcode_id);

				if ($row)
				{
                                    $model->deleteBBcodeById($bbcode_id);
                                    $model->ResetBBCache($bbcode_id);
                                    $this->admincontroller->action_index();                                            
				}
			break;                                
                }
        }

	/*
	/*
	* Build regular expression for custom bbcode
	*/
	function build_regexp(&$bbcode_match, &$bbcode_tpl)
	{
		$bbcode_match = trim($bbcode_match);
		$bbcode_tpl = trim($bbcode_tpl);
		$utf8 = str_contains($bbcode_match, 'INTTEXT');

		// make sure we have utf8 support
		$utf8_pcre_properties = false;
		if (version_compare(PHP_VERSION, '5.1.0', '>=') || (version_compare(PHP_VERSION, '5.0.0-dev', '<=') && version_compare(PHP_VERSION, '4.4.0', '>=')))
		{
			// While this is the proper range of PHP versions, PHP may not be linked with the bundled PCRE lib and instead with an older version
			if (@preg_match('/\p{L}/u', 'a') !== false)
			{
				$utf8_pcre_properties = true;
			}
		}

		$fp_match = preg_quote($bbcode_match, '!');
		$sp_match = preg_quote($bbcode_match, '!');
		$sp_replace = $bbcode_tpl;
		$sp_tokens = array(
			'URL'	 => '(?i)((?:' . str_replace(array('!', '\#'), array('\!', '#'), $this->get_preg_expression('url')) . ')|(?:' . str_replace(array('!', '\#'), array('\!', '#'), $this->get_preg_expression('www_url')) . '))(?-i)',
			'LOCAL_URL'	 => '(?i)(' . str_replace(array('!', '\#'), array('\!', '#'), $this->get_preg_expression('relative_url')) . ')(?-i)',
			'RELATIVE_URL'	 => '(?i)(' . str_replace(array('!', '\#'), array('\!', '#'), $this->get_preg_expression('relative_url')) . ')(?-i)',
			'EMAIL' => '(' . $this->get_preg_expression('email') . ')',
			'TEXT' => '(.*?)',
			'SIMPLETEXT' => '([a-zA-Z0-9-+.,_ ]+)',
			'INTTEXT' => ($utf8_pcre_properties) ? '([\p{L}\p{N}\-+,_. ]+)' : '([a-zA-Z0-9\-+,_. ]+)',
			'IDENTIFIER' => '([a-zA-Z0-9-_]+)',
			'COLOR' => '([a-zA-Z]+|#[0-9abcdefABCDEF]+)',
			'NUMBER' => '([0-9]+)',
		);

		$pad = 0;
		$modifiers = 'i';
		$modifiers .= ($utf8 && $utf8_pcre_properties) ? 'u' : '';

		if (preg_match_all('/\{(' . implode('|', array_keys($sp_tokens)) . ')[0-9]*\}/i', $bbcode_match, $m))
		{
			foreach ($m[0] as $n => $token)
			{
				$token_type = $m[1][$n];
				$sp_match = str_replace(preg_quote($token, '!'), $sp_tokens[$token_type], $sp_match);

				// Prepend the board url to local relative links
				$replace_prepend = ($token_type === 'LOCAL_URL') ? C("esoTalk.baseURL") : '';
				$sp_replace = str_replace($token, $replace_prepend . '${' . ($n + 1) . '}', $sp_replace);
			}

			$sp_match = '!' . $sp_match . '!s' . (($utf8) ? 'u' : '');
		}
		else
		{
			// No replacement is present, no need for a second-pass pattern replacement
			// A simple str_replace will suffice
			$fp_match = '!' . $fp_match . '!' . $modifiers;
			$sp_match = $fp_replace;
			$sp_replace = '';
		}

		// Lowercase tags
		$bbcode_tag = preg_replace('/.*?\[([a-z0-9_-]+=?).*/i', '$1', $bbcode_match);
		$bbcode_search = preg_replace('/.*?\[([a-z0-9_-]+)=?.*/i', '$1', $bbcode_match);

		if (!preg_match('/^[a-zA-Z0-9_-]+=?$/', (string) $bbcode_tag))
		{
			return 'BBCODE_INVALID';
		}

		$sp_match = preg_replace('#\[/?' . $bbcode_search . '#ie', "strtolower('\$0')", $sp_match);
		$sp_replace = preg_replace('#\[/?' . $bbcode_search . '#ie', "strtolower('\$0')", $sp_replace);

		return array(
			'bbcode_tag'				=> $bbcode_tag,
			'second_pass_match'			=> $sp_match,
			'second_pass_replace'		=> $sp_replace
		);
	}
        
    function get_preg_expression($mode)
    {
            switch ($mode)
            {
                    case 'email':
                            // Regex written by James Watts and Francisco Jose Martin Moreno
                            // http://fightingforalostcause.net/misc/2006/compare-email-regex.php
                            return '([\w\!\#$\%\&\'\*\+\-\/\=\?\^\`{\|\}\~]+\.)*(?:[\w\!\#$\%\'\*\+\-\/\=\?\^\`{\|\}\~]|&amp;)+@((((([a-z0-9]{1}[a-z0-9\-]{0,62}[a-z0-9]{1})|[a-z])\.)+[a-z]{2,63})|(\d{1,3}\.){3}\d{1,3}(\:\d{1,5})?)';
                    break;

                    case 'bbcode_htm':
                            return array(
                                    '#<!\-\- e \-\-><a href="mailto:(.*?)">.*?</a><!\-\- e \-\->#',
                                    '#<!\-\- l \-\-><a (?:class="[\w-]+" )?href="(.*?)(?:(&amp;|\?)sid=[0-9a-f]{32})?">.*?</a><!\-\- l \-\->#',
                                    '#<!\-\- ([mw]) \-\-><a (?:class="[\w-]+" )?href="(.*?)">.*?</a><!\-\- \1 \-\->#',
                                    '#<!\-\- s(.*?) \-\-><img src="\{SMILIES_PATH\}\/.*? \/><!\-\- s\1 \-\->#',
                                    '#<!\-\- .*? \-\->#s',
                                    '#<.*?>#s',
                            );
                    break;

                    // Whoa these look impressive!
                    // The code to generate the following two regular expressions which match valid IPv4/IPv6 addresses
                    // can be found in the develop directory
                    case 'ipv4':
                            return '#^(?:(?:\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(?:\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$#';
                    break;

                    case 'ipv6':
                            return '#^(?:(?:(?:[\dA-F]{1,4}:){6}(?:[\dA-F]{1,4}:[\dA-F]{1,4}|(?:(?:\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(?:\d{1,2}|1\d\d|2[0-4]\d|25[0-5])))|(?:::(?:[\dA-F]{1,4}:){0,5}(?:[\dA-F]{1,4}(?::[\dA-F]{1,4})?|(?:(?:\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(?:\d{1,2}|1\d\d|2[0-4]\d|25[0-5])))|(?:(?:[\dA-F]{1,4}:):(?:[\dA-F]{1,4}:){4}(?:[\dA-F]{1,4}:[\dA-F]{1,4}|(?:(?:\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(?:\d{1,2}|1\d\d|2[0-4]\d|25[0-5])))|(?:(?:[\dA-F]{1,4}:){1,2}:(?:[\dA-F]{1,4}:){3}(?:[\dA-F]{1,4}:[\dA-F]{1,4}|(?:(?:\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(?:\d{1,2}|1\d\d|2[0-4]\d|25[0-5])))|(?:(?:[\dA-F]{1,4}:){1,3}:(?:[\dA-F]{1,4}:){2}(?:[\dA-F]{1,4}:[\dA-F]{1,4}|(?:(?:\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(?:\d{1,2}|1\d\d|2[0-4]\d|25[0-5])))|(?:(?:[\dA-F]{1,4}:){1,4}:(?:[\dA-F]{1,4}:)(?:[\dA-F]{1,4}:[\dA-F]{1,4}|(?:(?:\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(?:\d{1,2}|1\d\d|2[0-4]\d|25[0-5])))|(?:(?:[\dA-F]{1,4}:){1,5}:(?:[\dA-F]{1,4}:[\dA-F]{1,4}|(?:(?:\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(?:\d{1,2}|1\d\d|2[0-4]\d|25[0-5])))|(?:(?:[\dA-F]{1,4}:){1,6}:[\dA-F]{1,4})|(?:(?:[\dA-F]{1,4}:){1,7}:)|(?:::))$#i';
                    break;

                    case 'url':
                    case 'url_inline':
                            $inline = ($mode == 'url') ? ')' : '';
                            $scheme = ($mode == 'url') ? '[a-z\d+\-.]' : '[a-z\d+]'; // avoid automatic parsing of "word" in "last word.http://..."
                            // generated with regex generation file in the develop folder
                            return "[a-z]$scheme*:/{2}(?:(?:[a-z0-9\-._~!$&'($inline*+,;=:@|]+|%[\dA-F]{2})+|[0-9.]+|\[[a-z0-9.]+:[a-z0-9.]+:[a-z0-9.:]+\])(?::\d*)?(?:/(?:[a-z0-9\-._~!$&'($inline*+,;=:@|]+|%[\dA-F]{2})*)*(?:\?(?:[a-z0-9\-._~!$&'($inline*+,;=:@/?|]+|%[\dA-F]{2})*)?(?:\#(?:[a-z0-9\-._~!$&'($inline*+,;=:@/?|]+|%[\dA-F]{2})*)?";
                    break;

                    case 'www_url':
                    case 'www_url_inline':
                            $inline = ($mode == 'www_url') ? ')' : '';
                            return "www\.(?:[a-z0-9\-._~!$&'($inline*+,;=:@|]+|%[\dA-F]{2})+(?::\d*)?(?:/(?:[a-z0-9\-._~!$&'($inline*+,;=:@|]+|%[\dA-F]{2})*)*(?:\?(?:[a-z0-9\-._~!$&'($inline*+,;=:@/?|]+|%[\dA-F]{2})*)?(?:\#(?:[a-z0-9\-._~!$&'($inline*+,;=:@/?|]+|%[\dA-F]{2})*)?";
                    break;

                    case 'relative_url':
                    case 'relative_url_inline':
                            $inline = ($mode == 'relative_url') ? ')' : '';
                            return "(?:[a-z0-9\-._~!$&'($inline*+,;=:@|]+|%[\dA-F]{2})*(?:/(?:[a-z0-9\-._~!$&'($inline*+,;=:@|]+|%[\dA-F]{2})*)*(?:\?(?:[a-z0-9\-._~!$&'($inline*+,;=:@/?|]+|%[\dA-F]{2})*)?(?:\#(?:[a-z0-9\-._~!$&'($inline*+,;=:@/?|]+|%[\dA-F]{2})*)?";
                    break;

                    case 'table_prefix':
                            return '#^[a-zA-Z][a-zA-Z0-9_]*$#';
                    break;
            }

            return '';
    }
    
	function parse($post)
	{
		// Prepare BBcode (just prepares some tags for better parsing)
                $this->bbcode_bitfield = '';
		if (str_contains((string) $post["content"], '['))
		{
			$this->bbcode_init();
			$this->parse_bbcode($post);
		}            
                $model = $this->controller->GetModel();
                $model->UpdateBBCache($post["postId"],$this->bbcode_bitfield);
		return false;
	}
   
	/**
	* Init bbcode data for later parsing
	*/
	function bbcode_init()
	{
                $model = $this->controller->GetModel();
                $rowset = $model->getBBcodesRegexps()->allRows();

		foreach ($rowset as $row)
		{
			$this->bbcodes[$row['bbcode_tag']] = array(
				'bbcode_id'	=> (int) $row['bbcode_id'],
				'regexp'	=> array($row['second_pass_match'] => $row['second_pass_replace']));
		}
	}
        
	function parse_bbcode($post)
	{
		if (!$this->bbcodes)
		{
			$this->bbcode_init();
		}

		$this->bbcode_bitfield = '';
		$bitfield = new bitfield();

		foreach ($this->bbcodes as $bbcode_name => $bbcode_data)
		{
                        foreach ($bbcode_data['regexp'] as $regexp => $replacement)
                        {                        
                                $bit_data = $bbcode_data['bbcode_id']-1;
                                if (preg_match($regexp, (string) $post["content"]))
                                {
                                        $bitfield->set($bit_data*2);
                                        $bitfield->clear($bit_data*2+1);
                                }
                                else
                                {
                                        $bitfield->clear($bit_data*2);
                                        $bitfield->set($bit_data*2+1);                                    
                                }
                        }
		}
		$this->bbcode_bitfield = $bitfield->get_base64();
	}
        
	function bbcode_second_pass(&$formatted,$post)
	{
            if (str_contains((string) $formatted["body"], '['))
            {                    
                $this->bbcode_bitfield = '';                    
                if (!$this->bbcodes)
                {
                        $this->bbcode_init();

                }
                if ($post)
                {
                    $model = $this->controller->GetModel();
                    $row= $model->GetBitfield($post["postId"]);
                    if ($row)
                       $this->bbcode_bitfield = $row["bbcode_bitfield"];
                }
                $bitfield = new bitfield($this->bbcode_bitfield);
                $correctedbitfield = new bitfield();
                foreach ($this->bbcodes as $bb_tag => $bbcode_data) {
                    $bit_data = $bbcode_data['bbcode_id']-1; 
                    if (!$bitfield->get($bit_data*2+1))
                    {
                        foreach ($bbcode_data['regexp'] as $regexp => $replacement)
                        {                        
                            if (preg_match($regexp, (string) $formatted["body"]))
                            {
                                    $correctedbitfield->set($bit_data*2);
                                    $correctedbitfield->clear($bit_data*2+1);
                                    $formatted["body"] = preg_replace($regexp, $replacement, $formatted["body"]);
                            }
                            else
                            {
                                    $correctedbitfield->clear($bit_data*2);
                                    $correctedbitfield->set($bit_data*2+1);                                    
                            }   
                        }
                    }
                    else {
                            $correctedbitfield->clear($bit_data*2);
                            $correctedbitfield->set($bit_data*2+1);                                                                
                    }

                } 
                if ($post)
                {               
                    if ($bitfield->get_base64()!=$correctedbitfield->get_base64())
                        $model->UpdateBBCache($post["postId"],$correctedbitfield->get_base64());
                }
             }
        }           
}




?>
