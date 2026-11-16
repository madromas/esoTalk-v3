<?php
// Copyright 2011, 2026 Toby Zerner, Simon Zerner, Katsuji
// This file is part of esoTalk. Please see the included license file for usage information.

// BBCodeプラグインの日本語定義
$definitions["AdvancedBBCode.DefaultMenuItem"] = "BBコード";
$definitions["AdvancedBBCode.ActiveCodes"] = "有効なBBコード";
$definitions["AdvancedBBCode.CreateCode"] = "BBコードの作成";

$definitions["AdvancedBBCode.Description"] = 'BBCodeは、何とどのように表示するかについてより大きな制御を提供する、HTMLの特別な実装です。このページから、カスタムBBCodeを追加、削除、編集できます。';
$definitions["AdvancedBBCode.Usage"] = 'BBコードの使用方法';
$definitions["AdvancedBBCode.UsageDescription"] = 'ここでは、BBCodeの使い方を定義します。あらゆる変数入力は、対応するトークンに置き換えてください（下記参照）。';
$definitions["AdvancedBBCode.Examples"] = "例:";
$definitions["AdvancedBBCode.HTMLTemplate"] = 'HTML置換';
$definitions["AdvancedBBCode.HTMLTemplateDescription"] = 'ここでは、デフォルトのHTML置換を定義します。上記で使用したトークンを戻すことを忘れないでください！';
$definitions["AdvancedBBCode.Hint"] = 'ヒントライン';
$definitions["AdvancedBBCode.HintDescription"] = "BBCodeの簡単な説明。";
$definitions["AdvancedBBCode.HintLabel"] = "説明テキスト";
$definitions["AdvancedBBCode.Lexems"] = 'トークン';
$definitions["AdvancedBBCode.LexemDescription"] = 'トークンはユーザー入力のプレースホルダーです。入力は、対応する定義と一致した場合にのみ検証されます。必要に応じて、波括弧の間に番号を追加することでそれらに番
号を付けることができます。例：{TEXT1}、{TEXT2}。<br /><br />HTML置換内では、ご自身の言語/ディレクトリ内のあらゆる言語文字列も、次のように使用できます：{L_<em>&lt;STRINGNAME&gt;</em>} ここで<em>&lt;STRINGNAME&gt;</em>は、追加したい翻訳文字列の名前です。例えば、{L_WROTE}は、ユーザーのロケールに応じて「wrote」またはその翻訳として表示されます。<br /><br /><strong class="notice">注：カスタムBBCode内で使用できるのは、下記にリストされているトークンのみです。</strong>';
$definitions["AdvancedBBCode.Lexem"] = 'トークン';
$definitions["AdvancedBBCode.LexemUsage"] = '何に使用できますか？';
$definitions["AdvancedBBCode.LexemTEXT"] = 'あらゆるテキスト（外国語の文字、数字などを含む）。このトークンをHTMLタグ内で使用しないでください。代わりに、IDENTIFIER、INTTEXT、またはSIMPLETEXTを使用してみてください。';
$definitions["AdvancedBBCode.LexemSIMPLETEXT"] = 'ラテンアルファベット（A-Z）、数字、スペース、コンマ、ドット、ハイフン、プラス、アンダースコアの文字';
$definitions["AdvancedBBCode.LexemINTTEXT"] = 'Unicode文字、数字、スペース、コンマ、ドット、ハイフン、プラス、アンダースコア、および空白文字。';
$definitions["AdvancedBBCode.LexemIDENTIFIER"] = 'ラテンアルファベット（A-Z）、数字、ハイフン、アンダースコアの文字。';
$definitions["AdvancedBBCode.LexemNUMBER"] = 'あらゆる数字の連続。';
$definitions["AdvancedBBCode.LexemEMAIL"] = '有効なEメールアドレス。';
$definitions["AdvancedBBCode.LexemURL"] = '任意のプロトコル（http、ftpなど）を使用した有効なURL（JavaScriptエクスプロイトには使用できません）。指定がない場合、文字列には“http://”がプレフィックスされます。';
$definitions["AdvancedBBCode.LexemLOCAL_URL"] = 'ローカルURL。URLはトピックページに対して相対的でなければならず、サーバー名やプロトコルを含めることはできません。リンクは「'.C("esoTalk.baseURL").'」でプレフィックス付けされます。';
$definitions["AdvancedBBCode.LexemRELATIVE_URL"] = '相対URL。これはURLの一部に一致させるために使用できますが、注意してください。完全なURLは有効な相対URLです。掲示板の相対URLを使用したい場合は、LOCAL_URLトー
クンを使用してください。';
$definitions["AdvancedBBCode.LexemCOLOR"] = 'HTMLカラー。数値形式<samp>#FF1234</samp>、または<a href="http://www.w3.org/TR/CSS21/syndata.html#value-def-color">CSSカラーキーワード</a href="http://www.w3.org/TR/CSS21/syndata.html#value-def-color">（例：<samp>fuchsia</samp>や<samp>InactiveBorder</samp>）</a>のいずれかです。';
$definitions["message.tplBBWarning"] = '追加しようとしているBBCodeが、HTML属性内で{TEXT}トークンを使用しているようです。これは潜在的なXSSセキュリティ上の問題です。代わりに、より制限の厳しい{SIMPLETEXT}または{INTTEXT}タイプを使用してみてください。関わるリスクを理解しており、{TEXT}の使用が絶対に避けられないと判断した場合にのみ続行してください。コードを追加するにはOKを押してください。';
$definitions["message.tplBBWarningProceed"]                = '続行';
$definitions["AdvancedBBCode.BBCODE_INVALID"] = 'BBCodeの形式が正しくありません。';
$definitions["AdvancedBBCode.BBCODE_INVALID_TAG_NAME"] = '選択されたBBCodeタグ名は、すでに存在します。';
$definitions["AdvancedBBCode.BBCODE_HELPLINE_TOO_LONG"]        = '入力された情報ラインが長すぎます。';
$definitions["AdvancedBBCode.BBCODE_OPEN_ENDED_TAG"]                = 'カスタムBBCodeには、開始タグと終了タグの両方が必要です。';
$definitions["AdvancedBBCode.BBCODE_TAG_TOO_LONG"]                = '選択されたタグ名が長すぎます。';
$definitions["AdvancedBBCode.BBCODE_TAG_DEF_TOO_LONG"]        = '入力されたタグ定義が長すぎます。タグ定義を短縮してください。';
$definitions["AdvancedBBCode.TOO_MANY_BBCODES"]        ='これ以上のBBCodeを作成することはできません。1つ以上のBBCodeを削除してから、再度お試しください。';
$definitions["AdvancedBBCode.BBCODE_SAVED"] = 'BBCodeは正常に保存されました。';
$definitions["AdvancedBBCode.abbcode"] = '高度なBBコード';

?>
