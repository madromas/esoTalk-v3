<?php
// Copyright 2011 Toby Zerner, Simon Zerner
// This file is part of esoTalk. Please see the included license file for usage information.

// English Definitions for the BBCode plugin.
$definitions["AdvancedBBCode.DefaultMenuItem"] = "BB Codes";
$definitions["AdvancedBBCode.ActiveCodes"] = "Active BB Codes";
$definitions["AdvancedBBCode.CreateCode"] = "Create BB Code";

$definitions["AdvancedBBCode.Description"] = 'BBCode is a special implementation of HTML offering greater control over what and how something is displayed. From this page you can add, remove and edit custom BBCodes.';
$definitions["AdvancedBBCode.Usage"] = 'BBCode usage';
$definitions["AdvancedBBCode.UsageDescription"] = 'Here you define how to use the BBCode. Replace any variable input by the corresponding token (see below).';
$definitions["AdvancedBBCode.Examples"] = "Example:";
$definitions["AdvancedBBCode.HTMLTemplate"] = 'HTML replacement';
$definitions["AdvancedBBCode.HTMLTemplateDescription"] = 'Here you define the default HTML replacement. Do not forget to put back tokens you used above!';
$definitions["AdvancedBBCode.Hint"] = 'Help line';
$definitions["AdvancedBBCode.HintDescription"] = "Brief BBCode description.";
$definitions["AdvancedBBCode.HintLabel"] = "Description text";
$definitions["AdvancedBBCode.Lexems"] = 'TOKENS';
$definitions["AdvancedBBCode.LexemDescription"] = 'Tokens are placeholders for user input. The input will be validated only if it matches the corresponding definition. If needed, you can number them by adding a number as the last character between the braces, e.g. {TEXT1}, {TEXT2}.<br /><br />Within the HTML replacement you can also use any language string present in your language/ directory like this: {L_<em>&lt;STRINGNAME&gt;</em>} where <em>&lt;STRINGNAME&gt;</em> is the name of the translated string you want to add. For example, {L_WROTE} will be displayed as “wrote” or its translation according to user’s locale.<br /><br /><strong>Please note that only tokens listed below are able to be used within custom BBCodes.</strong>';
$definitions["AdvancedBBCode.Lexem"] = 'TOKEN';
$definitions["AdvancedBBCode.LexemUsage"] = 'What can it be?';
$definitions["AdvancedBBCode.LexemTEXT"] = 'Any text, including foreign characters, numbers, etc… You should not use this token in HTML tags. Instead try to use IDENTIFIER, INTTEXT or SIMPLETEXT.';
$definitions["AdvancedBBCode.LexemSIMPLETEXT"] = 'Characters from the latin alphabet (A-Z), numbers, spaces, commas, dots, minus, plus, hyphen and underscore';
$definitions["AdvancedBBCode.LexemINTTEXT"] = 'Unicode letter characters, numbers, spaces, commas, dots, minus, plus, hyphen, underscore and whitespaces.';
$definitions["AdvancedBBCode.LexemIDENTIFIER"] = 'Characters from the latin alphabet (A-Z), numbers, hyphen and underscore';
$definitions["AdvancedBBCode.LexemNUMBER"] = 'Any series of digits';
$definitions["AdvancedBBCode.LexemEMAIL"] = 'A valid e-mail address';
$definitions["AdvancedBBCode.LexemURL"] = 'A valid URL using any protocol (http, ftp, etc… cannot be used for javascript exploits). If none is given, “http://” is prefixed to the string.';
$definitions["AdvancedBBCode.LexemLOCAL_URL"] = 'A local URL. The URL must be relative to the topic page and cannot contain a server name or protocol, as links are prefixed with “'.C("esoTalk.baseURL").'”';
$definitions["AdvancedBBCode.LexemRELATIVE_URL"] = 'A relative URL. You can use this to match parts of a URL, but be careful: a full URL is a valid relative URL. When you want to use relative URLs of your board, use the LOCAL_URL token.';
$definitions["AdvancedBBCode.LexemCOLOR"] = 'A HTML colour, can be either in the numeric form <samp>#FF1234</samp> or a <a href="http://www.w3.org/TR/CSS21/syndata.html#value-def-color">CSS colour keyword</a> such as <samp>fuchsia</samp> or <samp>InactiveBorder</samp>';
$definitions["message.tplBBWarning"] = 	'The BBCode you are trying to add seems to use a {TEXT} token inside a HTML attribute. This is a possible XSS security issue. Try using the more restrictive {SIMPLETEXT} or {INTTEXT} types instead. Only proceed if you understand the risks involved and you consider the use of {TEXT} absolutely unavoidable. Press OK if you want to proceed addin the code';
$definitions["message.tplBBWarningProceed"]		= 'Proceed';
$definitions["AdvancedBBCode.BBCODE_INVALID"] = 'Your BBCode is constructed in an invalid form.';
$definitions["AdvancedBBCode.BBCODE_INVALID_TAG_NAME"] = 'The BBCode tag name that you selected already exists.';
$definitions["AdvancedBBCode.BBCODE_HELPLINE_TOO_LONG"]	= 'The info line you entered is too long.';
$definitions["AdvancedBBCode.BBCODE_OPEN_ENDED_TAG"]		= 'Your custom BBCode must contain both an opening and a closing tag.';
$definitions["AdvancedBBCode.BBCODE_TAG_TOO_LONG"]		= 'The tag name you selected is too long.';
$definitions["AdvancedBBCode.BBCODE_TAG_DEF_TOO_LONG"]	= 'The tag definition that you have entered is too long, please shorten your tag definition.';
$definitions["AdvancedBBCode.TOO_MANY_BBCODES"]	='You cannot create any more BBCodes. Please remove one or more BBCodes then try again.';
$definitions["AdvancedBBCode.BBCODE_SAVED"] = 'BBCode saved successfully.';
$definitions["AdvancedBBCode.abbcode"] = 'Advanced BB code';

