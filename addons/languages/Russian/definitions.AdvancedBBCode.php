<?php
// Copyright 2011 Toby Zerner, Simon Zerner
// This file is part of esoTalk. Please see the included license file for usage information.

// English Definitions for the BBCode plugin.

$definitions["AdvancedBBCode.DefaultMenuItem"] = "BB коды";
$definitions["AdvancedBBCode.ActiveCodes"] = "Активные BB коды";
$definitions["AdvancedBBCode.CreateCode"] = "Создать BB код";
$definitions["AdvancedBBCode.Description"] = "BBCode — это специальная реализация языка HTML, предоставляющая более удобные возможности по форматированию сообщений. С помощью этой страницы вы можете добавлять, удалять и изменять BBCodes.";
$definitions["AdvancedBBCode.Usage"] = "Использование BBCode";
$definitions["AdvancedBBCode.UsageDescription"] = "Здесь определяется использование BBCode. Любая вводимая переменная может быть заменена на соответствующую лексему (примеры ниже).";
$definitions["AdvancedBBCode.Examples"] = "Примеры";
$definitions["AdvancedBBCode.HTMLTemplate"] = "Замена HTML";
$definitions["AdvancedBBCode.HTMLTemplateDescription"] = "Здесь определяются замены HTML. Не забывайте добавить лексемы, использованные выше!";
$definitions["AdvancedBBCode.Hint"] = "Подсказка";
$definitions["AdvancedBBCode.HintDescription"] = "Данное поле содержит краткое описание BBCode.";
$definitions["AdvancedBBCode.HintLabel"] = "Текст подсказки";
$definitions["AdvancedBBCode.Lexems"] = "Лексемы";
$definitions["AdvancedBBCode.LexemDescription"] = "Лексемы являются метками-заполнителями для вводимого пользователем содержимого. ".
                                                "Правильность введённого содержимого будет подтверждена лишь в том случае, если оно ".
                                                "отвечает соответствующему определению. При необходимости вы можете нумеровать их путём ".
                                                "добавления номера в конце лексемы внутри фигурных скобок. Например {TEXT1}, {TEXT2}.".
                                                "<br>Кроме лексем для замены HTML можно использовать любые языковые переменные из языковых ".
                                                "файлов. Например, {L_<em>&lt;STRINGNAME&gt;</em>}, где <em>&lt;STRINGNAME&gt;</em> — это ".
                                                "имя переведённой строки, которую вы хотите добавить. Например, {L_WROTE} будет отображено ".
                                                "как «wrote» или переведено в зависимости от выбранного пользователем языка.<br><br><strong>".
                                                "Примечание: только нижеуказанные лексемы могут использоваться в пользовательских BBCodes.</strong>";
$definitions["AdvancedBBCode.Lexem"] = "Лексема";
$definitions["AdvancedBBCode.LexemUsage"] = "Описание";
$definitions["AdvancedBBCode.LexemTEXT"] = "Любой текст, включая символы любого языка, числа и так далее. Не следует применять эту лексему в тегах HTML. Вместо этого используйте лексемы IDENTIFIER, INTTEXT или SIMPLETEXT.";
$definitions["AdvancedBBCode.LexemSIMPLETEXT"] = "Буквы латинского алфавита (A-Z), цифры, пробелы, запятые, точки, минус, плюс, дефис и подчёркивание.";
$definitions["AdvancedBBCode.LexemINTTEXT"] = "Символы Unicode, цифры, пробелы, запятые, точки, минус, плюс, дефис, подчёркивание.";
$definitions["AdvancedBBCode.LexemIDENTIFIER"] = "Буквы латинского алфавита (A-Z), цифры, дефис и подчёркивание.";
$definitions["AdvancedBBCode.LexemNUMBER"] = "Любая последовательность цифр.";
$definitions["AdvancedBBCode.LexemEMAIL"] = "Правильный адрес электронной почты.";
$definitions["AdvancedBBCode.LexemURL"] = "Правильный адрес URL с использованием любого протокола (http, ftp и так далее не могут использоваться для деструктивных действий JavaScript). Если ничего не задано, то к строке будет автоматически добавлен префикс «http://».";
$definitions["AdvancedBBCode.LexemLOCAL_URL"] = "Локальный адрес URL. URL должен быть относительным к странице темы и не должен содержать протокола или имени сервера, как ссылки, начинающиеся с «".C("esoTalk.baseURL")."»";
$definitions["AdvancedBBCode.LexemRELATIVE_URL"] = "Относительный адрес URL. Можно использовать для подстановки отдельных частей адреса URL, но с осторожностью: полный адрес URL является правильным относительным адресом URL. Если требуется использовать относительные адреса URL конференции, применяйте лексему LOCAL_URL.";
$definitions["AdvancedBBCode.LexemCOLOR"] = "Цвет HTML. Цвет может быть задан в числовом формате <samp>#FF1234</samp> или <a href=\"http://www.w3.org/TR/CSS21/syndata.html#value-def-color\">ключевым словом цвета CSS</a>. Например, <samp>fuchsia</samp> или <samp>InactiveBorder</samp>.";
$definitions["message.tplBBWarning"] = 	'Добавляемый BBCode использует лексему {TEXT} в тегах HTML. Это может создать проблемы с безопасностью, связанные с XSS (межсайтовым скриптингом). Попробуйте применить лексемы {SIMPLETEXT} или {INTTEXT}, использующие более строгие проверки. Игнорируйте данное предупреждение только в случае, если польностью осознаёте возможные риски, и использование лексемы {TEXT} абсолютно необходимо. Нажмите ОК, если вы все равно хотите добавить этот код.';
$definitions["message.tplBBWarningProceed"]		= 'Продолжить';
$definitions["AdvancedBBCode.BBCODE_INVALID"] = 'BBCode создан в недопустимой форме.';
$definitions["AdvancedBBCode.BBCODE_INVALID_TAG_NAME"] = 'Выбранное имя тега BBCode уже существует.';
$definitions["AdvancedBBCode.BBCODE_HELPLINE_TOO_LONG"]	= 'Введённый текст информации слишком длинный.';
$definitions["AdvancedBBCode.BBCODE_OPEN_ENDED_TAG"]		= 'Настраиваемый BBCode должен содержать открывающий и закрывающий теги.';
$definitions["AdvancedBBCode.BBCODE_TAG_TOO_LONG"]		= 'Введённое имя тега слишком длинное.';
$definitions["AdvancedBBCode.BBCODE_TAG_DEF_TOO_LONG"]	= 'Введённое определение тега слишком длинное. Введите более короткое определение.';
$definitions["AdvancedBBCode.TOO_MANY_BBCODES"]	= 'Вы больше не можете создать BBCodes. Удалите или переместите некоторые BBCodes и попробуйте снова.';
$definitions["AdvancedBBCode.BBCODE_SAVED"] = 'BBCode успешно сохранен.';
$definitions["AdvancedBBCode.abbcode"] = 'Расширенные BB коды';