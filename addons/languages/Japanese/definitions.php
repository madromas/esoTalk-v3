<?php
// Copyright 2011, 2026 Toby Zerner, Simon Zerner, Katsuji
// This file is part of esoTalk. Please see the included license file for usage information.

ET::$languageInfo["Japanese"] = [
	"locale" => "ja-JP",
	"name" => "Japanese",
	"description" => "A Japanese language pack.",
	"version" => ESOTALK_VERSION,
  "author" => "Katsuji",
  "authorEmail" => "5557720max@gmail.com",
  "authorURL" => "https://github.com/Katsuji-Codes/esoTalk-v3-Japanese-Language-Pack",
	"license" => "GPLv2"
];

// Define the character set that this language uses.
$definitions["charset"] = "utf-8";

$definitions["date.full"] = "%c";

$definitions["month"] = array(
  "January"   => "1月",
  "February"  => "2月",
  "March"     => "3月",
  "April"     => "4月",
  "May"       => "5月",
  "June"      => "6月",
  "July"      => "7月",
  "August"    => "8月",
  "September" => "9月",
  "October"   => "10月",
  "November"  => "11月",
  "December"  => "12月"
);

$definitions["%d day ago"] = "昨日";
$definitions["%d days ago"] = "%d 日前";
$definitions["%d hour ago"] = "1 時間前";
$definitions["%d hours ago"] = "%d 時間前";
$definitions["%d minute ago"] = "1 分前";
$definitions["%d minutes ago"] = "%d 分前";
$definitions["%d month ago"] = "1 ヶ月前";
$definitions["%d months ago"] = "%d ヶ月前";
$definitions["%d second ago"] = "1 秒前";
$definitions["%d seconds ago"] = "%d 秒前";
$definitions["%d week ago"] = "先週";
$definitions["%d weeks ago"] = "%d 週間前";
$definitions["%d year ago"] = "昨年";
$definitions["%d years ago"] = "%d 年前";

$definitions["%s and %s"] = "%s および %s";
$definitions["%s can view this conversation."] = "%s はこの会話を閲覧できます。";
$definitions["%s changed %s's group to %s."] = "%s は %s のグループを %s に変更しました。";
$definitions["%s changed your group to %s."] = "%s はあなたのグループを %s に変更しました。";
$definitions["%s conversation"] = "%s の会話";
$definitions["%s conversations"] = "%s の会話";
$definitions["%s has registered and is awaiting approval."] = "%s は登録し、承認待ちです。";
$definitions["%s invited you to %s."] = "%s が %s にあなたを招待しました。";
$definitions["%s joined the forum."] = "%s がフォーラムに参加しました。";
$definitions["%s mentioned you in %s."] = "%s は %s であなたに言及しました。";
$definitions["%s post"] = "%s の投稿";
$definitions["%s posted %s"] = "%s が %s を投稿しました";
$definitions["%s posted in %s."] = "%s は %s に投稿しました。";
$definitions["%s posts"] = "%s の投稿";
$definitions["%s reply"] = "%s の返信";
$definitions["%s replies"] = "%s の返信";
$definitions["%s Settings"] = "%s の設定";
$definitions["%s started the conversation %s."] = "%s が会話 %s を開始しました。";
$definitions["%s will be able to view this conversation."] = "%s はこの会話を閲覧できるようになります。";
$definitions["%s will be able to:"] = "%s は以下のことができます：";

$definitions["A new version of esoTalk (%s) is available."] = "esoTalk の新しいバージョン (%s) が利用可能です。";
$definitions["a private conversation"] = "プライベートな会話";
$definitions["Automatically follow conversations that I reply to"] = "私が返信した会話を自動的にフォローする";
$definitions["Automatically follow private conversations that I'm added to"] = "追加されたプライベート会話を自動的にフォローする";
$definitions["Access the administrator control panel."] = "管理者コントロールパネルにアクセスします。";
$definitions["Account type"] = "アカウントの種類";
$definitions["Activate"] = "有効化";
$definitions["Activity"] = "アクティビティ";
$definitions["Add"] = "追加";
$definitions["Administration"] = "管理";
$definitions["Administrator email"] = "管理者メールアドレス";
$definitions["Administrator password"] = "管理者パスワード";
$definitions["Administrator username"] = "管理者ユーザー名";
$definitions["Advanced options"] = "詳細オプション";
$definitions["All Channels"] = "すべてのチャンネル";
$definitions["Allow members to edit their own posts:"] = "メンバー自身の投稿を編集できるようにする:";
$definitions["Already have an account? <a href='%s' class='link-login'>Log in!</a>"] = "アカウントをお持ちですか？ <a href='%s' class='link-login'>ログイン！</a>";
$definitions["Appearance"] = "外観";
$definitions["Approve"] = "承認";
$definitions["Automatically star conversations that I reply to"] = "私が返信した会話を自動的にスターにする";
$definitions["Avatar"] = "アバター";

$definitions["Back to channels"] = "チャンネルに戻る";
$definitions["Back to conversation"] = "会話に戻る";
$definitions["Back to member"] = "メンバーに戻る";
$definitions["Back to members"] = "メンバーに戻る";
$definitions["Back to search"] = "検索に戻る";
$definitions["Background color"] = "背景色";
$definitions["Background image"] = "背景画像";
$definitions["Base URL"] = "基本URL";
$definitions["Bold"] = "太字";
$definitions["By %s"] = "%s による";

$definitions["Can suspend/unsuspend members"] = "メンバーを一時停止/解除できる";
$definitions["Cancel"] = "キャンセル";
$definitions["Change"] = "変更";
$definitions["Change %s's Permissions"] = "%s の権限を変更";
$definitions["Change avatar"] = "アバターを変更";
$definitions["Change Channel"] = "チャンネルを変更";
$definitions["Change channel"] = "チャンネルを変更";
$definitions["Change username"] = "ユーザー名を変更";
$definitions["Change Password or Email"] = "パスワードまたはメールアドレスの変更";
$definitions["Change Password"] = "パスワードの変更";
$definitions["Change password"] = "パスワードの変更";
$definitions["Change permissions"] = "権限を変更";
$definitions["Channel description"] = "チャンネルの説明";
$definitions["Channel List"] = "チャンネルリスト";
$definitions["Channel title"] = "チャンネル名";
$definitions["Channel slug"] = "チャンネルのスラッグ";
$definitions["Channels"] = "チャンネル";
$definitions["Choose a secure password of at least %s characters"] = "%s 文字以上の安全なパスワードを選択してください";
$definitions["Choose what people will see when they first visit your forum."] = "フォーラムに初めてアクセスしたユーザーに見せる内容を選択してください。";
$definitions["Click on a member's name to remove them."] = "メンバーの名前をクリックして削除します。";
$definitions["Close registration"] = "登録を閉じる";
$definitions["Confirm password"] = "パスワードの確認";
$definitions["Controls"] = "コントロール";
$definitions["Conversation"] = "会話";
$definitions["Conversations participated in"] = "参加した会話";
$definitions["Conversations started"] = "開始した会話";
$definitions["Conversations"] = "会話";
$definitions["Copy permissions from"] = "〜から権限をコピー";
$definitions["Create Channel"] = "チャンネルを作成";
$definitions["Create Group"] = "グループを作成";
$definitions["Create Member"] = "メンバーを作成";
$definitions["Customize how users can become members of your forum."] = "ユーザーがあなたのフォーラムのメンバーになる方法をカスタマイズします。";
$definitions["Customize your forum's appearance"] = "フォーラムの表示をカスタマイズします";

$definitions["Dashboard"] = "ダッシュボード";
$definitions["Default forum language"] = "デフォルトのフォーラム言語";
$definitions["<strong>Delete</strong> all conversations forever."] = "<strong>すべての会話を永久に削除</strong>";
$definitions["Delete Channel"] = "チャンネルを削除";
$definitions["Delete conversation"] = "会話を削除";
$definitions["Delete member"] = "メンバーを削除";
$definitions["<strong>Delete this member's posts.</strong> All of this member's posts will be marked as deleted, but will be able to be restored manually."] = "<strong>このメンバーの投稿を削除します。
</strong> このメンバーのすべての投稿は削除済みとしてマークされますが、手動で復元することが可能です。";
$definitions["Delete"] = "削除";
$definitions["Deleted %s by %s"] = "%s を %s が削除しました";
$definitions["Deny"] = "拒否";
$definitions["Disable"] = "無効化";
$definitions["Discard"] = "破棄";
$definitions["Don't allow other users to see when I am online"] = "私がオンラインであること他のユーザーに見えないようにする";
$definitions["Don't have an account? <a href='%s' class='link-join'>Sign up!</a>"] = "アカウントをお持ちではありませんか？ <a href='%s' class='link-join'>サインアップ！</a>";
$definitions["Don't repeat"] = "繰り返しをしない";
$definitions["Don't require users to confirm their account"] = "ユーザーにアカウントの確認を要求しない";

$definitions["Edit Channel"] = "チャンネルを編集";
$definitions["Edit Group"] = "グループを編集";
$definitions["Edit member groups"] = "メンバーグループを編集";
$definitions["Edit your profile"] = "プロフィールを編集";
$definitions["Edit"] = "編集";
$definitions["Edited %s by %s"] = "%s を %s が編集しました";
$definitions["Editing permissions"] = "権限の編集";
$definitions["Email me when I'm added to a private conversation"] = "プライベート会話に招待されたときにメールで通知する";
$definitions["Email me when someone mentions me in a post"] = "誰かが投稿で私に言及したときにメールで通知する";
$definitions["Email me when someone posts in a channel I have followed"] = "フォローしているチャンネルに誰かが投稿したときにメールで通知する";
$definitions["Email me when someone posts in a conversation I have followed"] = "フォローしている会話に誰かが投稿したときにメールで通知する";
$definitions["Email me when there is a new post by a member I have followed"] = "フォローしているメンバーが新しい投稿をしたときにメールで通知する";
$definitions["Email"] = "メール";
$definitions["Enable"] = "有効化";
$definitions["Enabled"] = "有効化済み";
$definitions["Enter a conversation title"] = "会話タイトルを入力";
$definitions["Error"] = "エラー";
$definitions["esoTalk version"] = "バージョン";
$definitions["Everyone"] = "すべての人";

$definitions["Share"] = "共有";
$definitions["Share on"] = "〜で共有";

$definitions["Fatal Error"] = "致命的なエラー";
$definitions["Feed"] = "フィード";
$definitions["Filter by name or group..."] = "名前またはグループでフィルタリング...";
$definitions["Find this post"] = "この投稿を見つける";
$definitions["First posted"] = "最初に投稿された";
$definitions["Follow"] = "フォローする";
$definitions["Follow to receive notifications"] = "通知を受け取るためにフォローする";
$definitions["Following"] = "フォロー中";

$definitions["For %s seconds"] = "%s 秒間";
$definitions["Forever"] = "永久に";
$definitions["Forgot?"] = "忘れた？";
$definitions["Forgot Password"] = "パスワードを忘れた";
$definitions["Forum"] = "フォーラム";
$definitions["Forum header"] = "フォーラムヘッダー";
$definitions["Forum language"] = "フォーラム言語";
$definitions["Forum privacy"] = "フォーラムのプライバシー";
$definitions["Forum Settings"] = "フォーラム設定";
$definitions["Forum Statistics"] = "フォーラム統計";
$definitions["Forum title"] = "フォーラムのタイトル";
$definitions["forumDescription"] = "%s は %s に関するウェブフォーラムであり、%s です。";

$definitions["Give this group the 'moderate' permission on all existing channels"] = "このグループに既存のすべてのチャンネルで「モデレート」権限を付与します";
$definitions["Global permissions"] = "グローバル権限";
$definitions["Go to top"] = "トップへ";
$definitions["Group name"] = "グループ名";
$definitions["group.administrator"] = "管理者";
$definitions["group.administrator.plural"] = "管理者たち";
$definitions["group.guest"] = "ゲスト";
$definitions["group.guest.plural"] = "ゲストたち";
$definitions["group.member"] = "メンバー";
$definitions["group.member.plural"] = "メンバーたち";
$definitions["group.Moderator"] = "モデレーター";
$definitions["group.Moderator.plural"] = "モデレーターたち";
$definitions["group.suspended"] = "停止中";
$definitions["Groups can be used to categorize members and give them certain privileges."] = "グループは、メンバーを分類し、特定の特権を付与するために使用できます。";
$definitions["Groups"] = "グループ";
$definitions["Guests can view the:"] = "ゲストは以下を閲覧できます:";

$definitions["Header"] = "ヘッダー";
$definitions["Header color"] = "ヘッダーの色";
$definitions["Heads Up!"] = "ご注意ください！";
$definitions["Hide"] = "非表示";
$definitions["Home page"] = "ホームページ";
$definitions["HTML is allowed."] = "HTMLが許可されています。";

$definitions["If you run into any other problems or just want some help with the installation, feel free to ask for assistance at the <a href='%s'>support forum</a>."] = "その他の問題が発生した場合は、またはインストールに関するヘルプが必要な場合は、<a href='%s'>サポートフォーラム</a>で遠慮なくサポートを求めてください。";
$definitions["Install esoTalk"] = "esoTalkをインストール";
$definitions["Install My Forum"] = "マイフォーラムをインストール";
$definitions["Installed Languages"] = "インストール済みの言語";
$definitions["Installed Plugins"] = "インストール済みプラグイン";
$definitions["Installed plugins"] = "インストール済みプラグイン";
$definitions["Installed Skins"] = "インストール済みスキン";
$definitions["Installed skins"] = "インストール済みスキン";
$definitions["is %s"] = "は %s です";

$definitions["Joined"] = "参加済み";
$definitions["just now"] = "たった今";

$definitions["Keep me logged in"] = "サインイン状態を維持する";
$definitions["<strong>Keep this member's posts.</strong> All of this member's posts will remain intact, but will show [deleted] as the author."] = "<strong>このメンバーの投稿を保持します。</strong> このメンバーのすべての投稿は保持されますが、著者として[削除済み]と表示されます。";

$definitions["label.draft"] = "下書き";
$definitions["label.locked"] = "ロック済み";
$definitions["label.ignored"] = "無視";
$definitions["label.private"] = "プライベート";
$definitions["label.sticky"] = "固定";
$definitions["Labels"] = "ラベル";
$definitions["Last active"] = "最終アクティブ";
$definitions["Last active %s"] = "%sが最終アクティブ";
$definitions["Latest"] = "最新";
$definitions["Latest News"] = "最新ニュース";
$definitions["Loading..."] = "読み込み中...";
$definitions["Lock"] = "ロック";
$definitions["Log In"] = "ログイン";
$definitions["Log Out"] = "ログアウト";

$definitions["Make member and online list visible to:"] = "メンバーとオンラインリストを以下に表示します:";
$definitions["Manage Channels"] = "チャンネルの管理";
$definitions["Manage Groups"] = "グループの管理";
$definitions["Manage Languages"] = "言語の管理";
$definitions["Manage your forum's channels (categories)"] = "フォーラムのチャンネル（カテゴリー）を管理する";
$definitions["Mark as read"] = "既読としてマーク";
$definitions["Mark as unread"] = "未読としてマーク";
$definitions["Mark all as read"] = "すべて既読としてマーク";
$definitions["Mark listed as read"] = "リスト内のものを既読としてマーク";
$definitions["Maximum size of %s. %s."] = "%sの最大サイズ。%s。";
$definitions["Member groups"] = "メンバーグループ";
$definitions["Member list"] = "メンバーリスト";
$definitions["Member List"] = "メンバーリスト";
$definitions["Member privacy"] = "メンバーのプライバシー";
$definitions["Members"] = "メンバー";
$definitions["Members Allowed to View this Conversation"] = "この会話を閲覧できるメンバー";
$definitions["Members Awaiting Approval"] = "承認待ちのメンバー";
$definitions["Members Online"] = "オンラインのメンバー";
$definitions["Members who are part of this group can be listed by searching for the group name in the member list."] = "このグループのメンバーは、メンバーリストでグループ名を検索することでリストアップできます。";
$definitions["Mobile skin"] = "モバイルスキン";
$definitions["Moderate"] = "モデレート";
$definitions["<strong>Move</strong> conversations to the following channel:"] = "<strong>会話を移動</strong>して、以下のチャンネルに移動します:";
$definitions["Mute conversation"] = "会話をミュート";
$definitions["MySQL database"] = "MySQLデータベース";
$definitions["MySQL host address"] = "MySQLホストアドレス";
$definitions["MySQL password"] = "MySQLパスワード";
$definitions["MySQL queries"] = "MySQLクエリ";
$definitions["MySQL table prefix"] = "MySQLテーブルプレフィックス";
$definitions["MySQL username"] = "MySQLユーザー名";
$definitions["MySQL version"] = "MySQLバージョン";

$definitions["Name"] = "名前";
$definitions["never"] = "決して";
$definitions["%s new"] = "%s 新規";
$definitions["New conversation"] = "新規会話";
$definitions["New Conversation"] = "新規会話";
$definitions["New conversations in the past week"] = "過去一週間に作成された新規会話";
$definitions["New email"] = "新しいメール";
$definitions["New members in the past week"] = "過去一週間に参加した新規メンバー";
$definitions["New password"] = "新しいパスワード";
$definitions["New posts in the past week"] = "過去一週間に投稿された新規投稿";
$definitions["New username"] = "新しいユーザー名";
$definitions["Next Step"] = "次のステップ";
$definitions["Next"] = "次へ";
$definitions["No preview"] = "プレビューなし";
$definitions["No"] = "いいえ";
$definitions["Notifications"] = "通知";
$definitions["Now"] = "今";

$definitions["OK"] = "OK";
$definitions["Online"] = "オンライン";
$definitions["online"] = "オンライン";
$definitions["Only allow members of this group to see who else is in it"] = "このグループのメンバーだけが他のメンバーを閲覧できるようにする";
$definitions["Open registration"] = "登録を公開";
$definitions["optional"] = "オプション";
$definitions["Order By:"] = "並べ替え基準:";
$definitions["Original Post"] = "オリジナル投稿";

$definitions["Page Not Found"] = "ページが見つかりません";
$definitions["Password"] = "パスワード";
$definitions["PHP version"] = "PHPバージョン";
$definitions["Plugins"] = "プラグイン";
$definitions["Post a Reply"] = "返信を投稿";
$definitions["Post count"] = "投稿数";
$definitions["Posts"] = "投稿";
$definitions["Powered by"] = "提供元";
$definitions["Preview"] = "プレビュー";
$definitions["Previous"] = "前へ";

$definitions["Quote"] = "引用";
$definitions["quote"] = "引用";

$definitions["Read more"] = "もっと読む";
$definitions["Recent posts"] = "最近の投稿";
$definitions["Recover Password"] = "パスワードを回復";
$definitions["Registered members"] = "登録済みメンバー";
$definitions["Registration"] = "登録";
$definitions["Registration Closed"] = "登録が締め切られました";
$definitions["Remove avatar"] = "アバターを削除";
$definitions["Rename Member"] = "メンバーの名前を変更";
$definitions["Reply"] = "返信";
$definitions["Report a bug"] = "バグを報告";
$definitions["Require administrator approval"] = "管理者による承認を必要とします";
$definitions["Require users to confirm their email address"] = "ユーザーにメールアドレスの確認を要求します";
$definitions["Restore"] = "復元";
$definitions["restore"] = "復元";
$definitions["Reset"] = "リセット";

$definitions["Save Changes"] = "変更を保存";
$definitions["Save Draft"] = "下書きを保存";
$definitions["Search conversations..."] = "会話を検索...";
$definitions["Search within this conversation..."] = "この会話内を検索...";
$definitions["Search"] = "検索";
$definitions["See the private conversations I've had with %s"] = "%sとのプライベート会話を見る";
$definitions["Set a New Password"] = "新しいパスワードを設定";
$definitions["Settings"] = "設定";
$definitions["Show an image in the header"] = "ヘッダーに画像を表示";
$definitions["Show in context"] = "コンテキストで表示";
$definitions["Show matching posts"] = "一致する投稿を表示";
$definitions["Show the channel list by default"] = "デフォルトでチャンネルリストを表示";
$definitions["Show the conversation list by default"] = "デフォルトで会話リストを表示";
$definitions["Show the forum title in the header"] = "ヘッダーにフォーラムタイトルを表示";
$definitions["Sign Up"] = "サインアップ";
$definitions["Skins"] = "スキン";
$definitions["Sort By"] = "並び替え";
$definitions["Specify Setup Information"] = "セットアップ情報を指定";
$definitions["Star to receive notifications"] = "通知を受け取るためにフォローします";
$definitions["Starred"] = "フォロー中";
$definitions["Start"] = "開始";
$definitions["Start a conversation"] = "会話を開始";
$definitions["Start a new conversation"] = "新しい会話を開始";
$definitions["Start a private conversation with %s"] = "%sとプライベート会話を開始";
$definitions["Start Conversation"] = "会話の開始";
$definitions["Starting a conversation"] = "会話の開始";
$definitions["Statistics"] = "統計情報";
$definitions["statistic.conversation.plural"] = "%s 件の会話";
$definitions["statistic.conversation"] = "%s 件の会話";
$definitions["statistic.member.plural"] = "%s 人のメンバー";
$definitions["statistic.member"] = "%s 人のメンバー";
$definitions["statistic.online.plural"] = "%s 人がオンラインです";
$definitions["statistic.online"] = "%s 人がオンラインです";
$definitions["statistic.post.plural"] = "%s 件の投稿";
$definitions["statistic.post"] = "%s 件の投稿";
$definitions["Sticky"] = "固定";
$definitions["Subscribe"] = "購読";
$definitions["Subscribed"] = "購読済み";
$definitions["Subscription"] = "購読";
$definitions["Success!"] = "成功！";
$definitions["Suspend member"] = "メンバーを停止";
$definitions["Suspend members."] = "メンバーを停止します。";
$definitions["Suspend"] = "停止";

$definitions["To get started with your forum, you might like to:"] = "フォーラムを始めるために、以下を試してみてください。";

$definitions["Unapproved"] = "承認されていません";
$definitions["Unhide"] = "非表示を解除";
$definitions["Uninstall"] = "アンインストール";
$definitions["Unlock"] = "ロック解除";
$definitions["Unmute conversation"] = "会話のミュート解除";
$definitions["Unstarred"] = "フォローしていません";
$definitions["Unsticky"] = "固定解除";
$definitions["Unsubscribe new users by default"] = "デフォルトで新規ユーザーの購読を解除";
$definitions["Unsubscribe"] = "購読解除";
$definitions["Unsubscribed"] = "購読解除済み";
$definitions["Unsuspend member"] = "メンバーを再開";
$definitions["Unsuspend"] = "再開";
$definitions["Until someone replies"] = "誰かが返信するまで";
$definitions["Untitled conversation"] = "タイトルなしの会話";
$definitions["Upgrade esoTalk"] = "esoTalkをアップグレード";
$definitions["Use a background image"] = "背景画像を使用";
$definitions["Use for mobile"] = "モバイル向けに使用";
$definitions["Use friendly URLs"] = "フレンドリーURLを使用";
$definitions["Used to verify your account and subscribe to conversations"] = "アカウントを確認し、会話を購読するために使用されます";
$definitions["Username"] = "ユーザー名";
$definitions["Username or Email"] = "ユーザー名またはメール";

$definitions["View %s's profile"] = "%sのプロフィールを見る";
$definitions["View all notifications"] = "すべての通知を見る";
$definitions["View more"] = "もっと見る";
$definitions["View your profile"] = "プロフィールを見る";
$definitions["View"] = "表示";
$definitions["Viewing: %s"] = "閲覧中: %s";
$definitions["viewingPosts"] = "<b>%s-%s</b> 件の %s 件の投稿を閲覧中";

$definitions["Warning"] = "警告";
$definitions["Welcome to esoTalk!"] = "esoTalkへようこそ！";
$definitions["We've logged you in and taken you straight to your forum's administration panel. You're welcome."] = "サインインし、フォーラムの管理パネルに直接移動しました。ようこそ。";
$definitions["Write a reply..."] = "返信を書き込む...";

$definitions["Yes"] = "はい";
$definitions["You can manage channel-specific permissions on the channels page."] = "チャンネル固有の権限は、チャンネルページで管理できます。";
$definitions["Your current password"] = "現在のパスワード";


// Messages.
$definitions["message.groupsHelp"] = "グループの作成/削除および管理";
$definitions["message.404"] = "おっと、ご要望のページは見つかりませんでした！戻って別のリンクをクリックするか、何か別のことを試してみてください。";
$definitions["message.accountNotYetApproved"] = "管理者によってアカウントがまだ承認されていません。忍耐は美徳です！";
$definitions["message.ajaxDisconnected"] = "サーバーとの通信ができませんでした。数秒待って<a href='javascript:jQuery.ETAjax.resumeAfterDisconnection()'>再試行</a>するか、<a href='' onclick='window.location.reload();return false'>ページを更新</a>してください。";
$definitions["message.ajaxRequestPending"] = "ちょっと待ってください！いくつかの処理がまだ進行中です！このページから移動すると、最近行った変更が失われる可能性があります。";
$definitions["message.avatarError"] = "アバターのアップロード中に問題が発生しました。有効な画像形式（.jpg、.png、または.gifなど）を使用していること、およびファイルが極端に巨大ではないことを確認してください。";
$definitions["message.cannotDeleteLastChannel"] = "おい、待って！最後のチャンネルを削除することはできません！会話はどこに行ってしまうのでしょう？それは馬鹿げていますよ。";
$definitions["message.cannotEditSinceReply"] = "誰かが投稿後に返信しているため、あなたの投稿を編集することはできません。";
$definitions["message.changesSaved"] = "変更が保存されました。";
$definitions["message.channelsHelp"] = "チャンネルは、フォーラム上の会話を分類するために使用されます。必要なだけチャンネルを作成でき、以下でドラッグ＆ドロップによって再配置/ネストできます。";
$definitions["message.channelSlugTaken"] = "このスラッグは別のチャンネルによって使用されています。";
$definitions["message.confirmDelete"] = "本当にこれを削除してもよろしいですか？本気で、元に戻すことはできませんよ。";
$definitions["message.confirmDiscardPost"] = "投稿をドラフトとして保存していません。破棄しますか？";
$definitions["message.confirmEmail"] = "新しく作成したアカウントを使い始める前に、メールアドレスの確認が必要です。今後1〜2分以内に、アカウントを有効にするためのリンクが記載されたメールを送信します。";
$definitions["message.confirmLeave"] = "おっと、編集している内容が保存されていません！このページを離れると、変更が失われます。大丈夫ですか？";
$definitions["message.connectionError"] = "スクリプトはMySQLサーバーに接続できませんでした。返されたエラーは以下です:<br/>%s";
$definitions["message.conversationDeleted"] = "会話は削除されました。気分はよくなりましたか？";
$definitions["message.conversationNotFound"] = "何らかの理由でこの会話を表示できません。存在しないか、表示する権限がない可能性があります。";
$definitions["message.cookieAuthenticationTheft"] = "セキュリティ上の理由により、「ログイン情報を記憶する」クッキーを使用してログインできませんでした。手動でログインしてください！";
$definitions["message.deleteChannelHelp"] = "おっと、ちょっと待ってください！このチャンネルを削除すると、元に戻す方法がありません。タイムマシンを構築しない限りは。しかし、えーと、<em>簡単</em>に元に戻す方法はありません。このチャンネルのすべての会話は、他の任意のチャンネルに移動できます。";
$definitions["message.emailConfirmed"] = "やった！アカウントが検証され、会話への参加を開始できます。自分自身で<a href='".URL("conversation/start")."'>開始してみて</a>はいかがですか？";
$definitions["message.emailDoesntExist"] = "そのメールアドレスはデータベース内のどのメンバーとも一致しませんでした。タイプミスをしていませんか？";
$definitions["message.emailNotYetConfirmed"] = "ログインする前にメールアドレスを確認する必要があります！確認メールが届かない場合は、スパムフォルダを確認するか、<a href='%s'>こちらをクリックして再送信</a>してください。";
$definitions["message.emailTaken"] = "くそっ、このメールアドレスはすでにメンバーによって使用されています！";
$definitions["message.empty"] = "このフィールドを入力する必要があります。";
$definitions["message.emptyPost"] = "えーっと...、投稿には何か入力した方がいいと思いますよ。";
$definitions["message.emptyTitle"] = "会話のタイトルは空にできません。だって、誰が空のタイトルをクリックするでしょうか？考えてみてください。";
$definitions["message.esoTalkAlreadyInstalled"] = "<strong>フォーラムはすでにインストールされています。</strong> 再インストールするには、<code>config/config.php</code>を削除する必要があります。";
$definitions["message.esoTalkUpdateAvailable"] = "新しいバージョン%sが利用可能です。";
$definitions["message.esoTalkUpdateAvailableHelp"] = "セキュリティリスクを減らすため、常に最新バージョンをインストールすることが推奨されます。それから、クールな新機能もあるかもしれませんよ！";
$definitions["message.esoTalkUpToDate"] = "あなたのバージョンは最新です。";
$definitions["message.esoTalkUpToDateHelp"] = "";
$definitions["message.fatalError"] = "フォーラムで致命的なエラーが発生しました。";
$definitions["message.fileUploadFailed"] = "何らかの問題が発生し、選択したファイルをアップロードできませんでした。大きすぎるか、形式が間違っているのかもしれません？";
$definitions["message.fileUploadFailedMove"] = "アップロードされたファイルを宛先にコピーできませんでした。フォーラムの管理者に連絡してください。";
$definitions["message.fileUploadNotImage"] = "アップロードされたファイルは、受け入れ可能な形式の画像ではありません。";
$definitions["message.fileUploadTooBig"] = "選択したファイルが大きすぎるため、アップロードできませんでした。";
$definitions["message.forgotPasswordHelp"] = "ああ、パスワードを忘れてしまった！心配しないで、よくあることです。メールアドレスを入力するだけで、新しいパスワードを設定する方法を説明する指示を送信します。";
$definitions["message.fulltextKeywordWarning"] = "キーワードが4文字未満、または「the」や「for」のような一般的な英単語は、検索の基準に含まれないことに注意してください。";
$definitions["message.gambitsHelp"] = "ガンビットは、あなたが探しているものを説明するフレーズです。ガンビットをクリックすると、検索フィールドに挿入されます。ガンビットをダブルクリックすると、即座に検索されます。通常の検索キーワードも機能します！";
$definitions["message.gdNotEnabledWarning"] = "<strong>GD拡張機能が有効になっていません。</strong> これはアバターのサイズ変更と保存に必要です。ホストまたは管理者にインストール/有効化してもらう必要があります。";
$definitions["message.greaterMySQLVersionRequired"] = "<strong>MySQL 4以上がインストールされ、<a href='http://php.net/manual/en/mysql.installation.php' target='_blank'>PHPのMySQL拡張機能が有効になっている必要があります</a>。これら両方の要件をインストール/アップグレードするか、ホストまたは管理者にインストールを依頼してください。</strong>";
$definitions["message.greaterPHPVersionRequired"] = "<strong>スクリプトを実行するには、サーバーにPHP %s以上がインストールされている必要があります。</strong> PHPのインストールをアップグレードするか、ホストまたは管理者にサーバーのアップグレードを依頼してください。";
$definitions["message.incorrectLogin"] = "ログイン情報が正しくありません。";
$definitions["message.incorrectPassword"] = "現在のパスワードが正しくありません。";
$definitions["message.installerAdminHelp"] = "以下の情報を使用して、フォーラムの管理者アカウントを設定します。";
$definitions["message.installerFilesNotWritable"] = "<strong>以下のファイル/フォルダに書き込みできません：%s。</strong> これを解決するには、FTPクライアントでこれらのファイル/フォルダに移動し、<code>chmod</code>で<code>0777</code>に設定する必要があります。";
$definitions["message.installerWelcome"] = "下のフォームに記入して、ファットフリーフォーラムを設定してください。<br>問題が発生した場合は、<a href='%s' target='_blank'>ウェブサイト</a>でサポートを受けてください。";
$definitions["message.invalidChannel"] = "無効なチャンネルを選択しました！";
$definitions["message.invalidEmail"] = "このメールアドレスは有効ではないようです...";
$definitions["message.invalidUsername"] = "ユーザー名は3文字から20文字の英数字で選択する必要があります。";
$definitions["message.javascriptRequired"] = "このページは正常に機能するためにJavaScriptが必要です。有効にしてください！";
$definitions["message.languageUninstalled"] = "言語がアンインストールされました。";
$definitions["message.locked"] = "うーん、この会話は<strong>ロック</strong>されていますので、返信することはできません。";
$definitions["message.loginToParticipate"] = "会話を開始したり、投稿に返信したりするには、ログインしてください。";
$definitions["message.logInToReply"] = "<a href='%1\$s' class='link-login'>ログイン</a>するか、<a href='%2\$s' class='link-join'>サインアップ</a>して返信してください！";
$definitions["message.logInToSeeAllConversations"] = "<a href='".URL("user/login")."' class='link-login'>ログイン</a>して、ゲストには非表示になっている可能性のあるチャンネル/会話を表示させましょう。";
$definitions["message.memberNotFound"] = "うーん、その名前のメンバーはいないようです。";
$definitions["message.memberNoPermissionView"] = "この会話があるチャンネルの閲覧権限がないため、そのメンバーを追加できません。";
$definitions["message.nameTaken"] = "入力された名前は既に使用されているか、予約語です。";
$definitions["message.newSearchResults"] = "検索結果に影響を与える新しいアクティビティがありました。<a href='%s'>更新</a>";
$definitions["message.noActivity"] = "%s はこのフォーラムで何もしていません！";
$definitions["message.noChannels"] = "表示されているチャンネルはありません。";
$definitions["message.noMembersOnline"] = "現在オンラインのメンバーはいません。";
$definitions["message.hidden"] = "非表示";
$definitions["message.noNotifications"] = "通知はありません。";
$definitions["message.noPermission"] = "この操作を実行する権限がありません。";
$definitions["message.noPermissionToReplyInChannel"] = "このチャンネルの会話に返信する権限がありません。";
$definitions["message.noPluginsInstalled"] = "現在インストールされているプラグインはありません。";
$definitions["message.noSearchResults"] = "検索に一致する会話は見つかりませんでした。";
$definitions["message.noSearchResultsMembers"] = "検索に一致するメンバーは見つかりませんでした。";
$definitions["message.noSearchResultsPosts"] = "検索に一致する投稿は見つかりませんでした。";
$definitions["message.noSkinsInstalled"] = "現在インストールされているスキンはありません。";
$definitions["message.notWritable"] = "<code>%s</code> は書き込みできません。それを<code>777</code>に<code>chmod</code>するか、存在しない場合は、それを含むフォルダに<code>chmod</code>を適用してみてください。";
$definitions["message.pageNotFound"] = "お探しのページが見つかりませんでした。";
$definitions["message.passwordChanged"] = "よし、パスワードは変更されました。これでログインできます！ねえ、もう忘れちゃだめだよ、いいかい？";
$definitions["message.passwordEmailSent"] = "了解しました。パスワードをリセットするためのリンクが記載されたメールを送信しました。今後1〜2分以内に受信しない場合は、スパムフォルダを確認してください。本当に、時々スパムに振り分けられてしまうんですよ - 信じられますか？！";
$definitions["message.passwordsDontMatch"] = "パスワードが一致しません。";
$definitions["message.passwordTooShort"] = "パスワードが短すぎます。";
$definitions["message.pluginCannotBeEnabled"] = "プラグイン <em>%s</em> は有効にできません: %s";
$definitions["message.pluginDependencyNotMet"] = "このプラグインを有効にするには、%s バージョン %s がインストールされ、有効になっている必要があります。";
$definitions["message.pluginUninstalled"] = "プラグインがアンインストールされました。";
$definitions["message.postNotFound"] = "お探しの投稿は見つかりませんでした。";
$definitions["message.postTooLong"] = "あなたの投稿はすごく長いです！長すぎる！許可されている最大文字数は %s です。本当に長いです！";
$definitions["message.preInstallErrors"] = "これらのエラーは、インストールを続行する前に解決する必要があります。";
$definitions["message.preInstallWarnings"] = "以下の警告を解決せずにインストールを続行できますが、一部の機能が制限される可能性があります。";
$definitions["message.reduceNumberOfGambits"] = "会話のより幅広い範囲を見つけるために、使用しているガンビットや検索キーワードの数を減らしてください。";
$definitions["message.registerGlobalsWarning"] = "<strong>PHPのregister_globals設定が有効になっています。</strong> この設定がオンの状態でもスクリプトは実行できますが、セキュリティを強化し、問題を防ぐためにオフにすることを推奨します。";
$definitions["message.registrationClosed"] = "このフォーラムへの登録は一般公開されていません。";
$definitions["message.removeDirectoryWarning"] = "おい！私たちがお伝えしたように、<code>%s</code> ディレクトリを削除していないようです！ハッカーが何か悪いことをするのを防ぐために、念のため削除した方がいいですよ。";
$definitions["message.safeModeWarning"] = "<strong>セーフモードが有効になっています。</strong> これは問題を引き起こす可能性がありますが、オフにできない場合でも続行できます。";
$definitions["message.searchAllConversations"] = "この用語をすべての会話で検索してみてください。";
$definitions["message.setNewPassword"] = "よし！では、新しいパスワードは何にしたいですか？";
$definitions["message.skinUninstalled"] = "スキンがアンインストールされました。";
$definitions["message.suspended"] = "痛い！フォーラムモデレーターがあなたの<strong>アカウントを停止</strong>しました。最悪ですが、停止が解除されるまで、ここであまり何もできません。くそったれども！";
$definitions["message.suspendMemberHelp"] = "%s を停止すると、会話への返信、会話の開始、プライベート会話の閲覧ができなくなります。実質的にゲストと同じ権限になります。";
$definitions["message.tablePrefixConflict"] = "インストーラーは、同じMySQLデータベース内に同じテーブルプレフィックスを持つ別のインストールがあることを検出しました。<br>• このインストールを上書きするには、「インストール」をもう一度クリックしてください。<strong>すべてのデータが失われます。</strong><br>• これに加えて新しいインストールを作成するには、テーブルプレフィックスを変更してください。";
$definitions["message.unsuspendMemberHelp"] = "%s の停止解除により、彼らはこのフォーラムの会話に再び参加できるようになります。";
$definitions["message.upgradeSuccessful"] = "スクリプトのアップグレードが正常に完了しました。";
$definitions["message.waitForApproval"] = "新しく作成したアカウントを使用開始する前に、管理者によるアカウントの承認が必要です。承認されるとメールでお知らせします！";
$definitions["message.waitToReply"] = "会話を開始または返信する間隔は、少なくとも %s 秒待つ必要があります。深呼吸をして、もう一度試してみてください。";
$definitions["message.waitToSearch"] = "おっと、落ち着いて！検索を多すぎたようです。 %s 秒待ってから再度試してください。";


// GENERAL EMAIL TEXT - Text Inspirations you can find here: https://reallygoodemails.com/
$definitions["email.click"]                  = "こちらをクリック！";
$definitions["email.help"]                   = "さらにサポートが必要ですか？";
$definitions["email.hint"]                   = "お手伝いいたします";
$definitions["email.link"]                   = "上記のボタンが機能しない場合は、以下のリンクをブラウザにコピー＆ペーストしてください:";
$definitions["email.quest"]                  = "ご質問がある場合は、このメールには返信せず、フォーラムをご利用ください。いつでも喜んでお手伝いいたします。";
$definitions["email.sender"]                 = "どうぞよろしく、<br>管理者";

$definitions["email.header"]                 = "<p>こんにちは、%sさん！</p>";
$definitions["email.footer"]                 = "<p>(いつでも<a href='%s'>こちら</a>をクリックしてメール設定を変更できます。)</p> ";

$definitions["email.confirmEmail.subject"]   = "こんにちは、%1\$sさん！&mdash; フォーラムへの登録はよろしいですか？"; 

$definitions["email.confirmEmail.body"]      = "<p>お使いのメールアドレスから、『%1\$s』フォーラムに興味があるというリクエストを受け取りました。</p>
                                                <p>しかし、参加される前に、これがあなたの意図であることを確認させてください。</p>
                                                <p>ですので、大きな赤いボタンをクリックして確認してください。（<b>登録されていない場合は、何もしないでください。二度とご迷惑をおかけしません。</b>）よろしくお願いします！</p>"; 
                                                                                                
$definitions["email.approved.subject"]       = "登録ありがとうございます %1\$sさん、アカウントが承認されました。"; 
$definitions["email.approved.body"]          = "<p>%1\$sフォーラムにご登録いただき、ありがとうございます！</p>
                                                <p>ぜひ私たちのコミュニティへようこそ。</p>
                                                <p>このフォーラムはアイデアをいつでも歓迎しています。</p>
                                                <p>何かご提案があれば、メールでご連絡ください。</p>
                                                <p>最後に、PayPal (internmail@gmail.com) を通じて、大小問わず寄付を受け付けていることをお知らせします。（ちなみに、大口の寄付には素敵な特典がついてきます。）</p>
                                                <p>以下のボタンをクリックしてログインし、活動を開始してください。</p>";
$definitions["email.forgotPassword.subject"] = "パスワードを忘れてしまいましたか、%1\$sさん？"; 
$definitions["email.forgotPassword.body"]    = "<p>%1\$sフォーラムのパスワードをリセットする必要がありますか？問題ありません！</p>
                                                <p>下のボタンをクリックするだけで、すぐに手続きが完了します。</p>
                                                <p><b>もしこのリクエストをされた覚えがない場合は、このメールを無視してください。</b></p>"; 
$definitions["email.mention.subject"]        = "[%1\$sさんから言及されました] %2\$s"; 
$definitions["email.mention.body"]           = "<p><strong>%1\$sさん</strong>が<strong>%2\$s</strong>の投稿であなたに言及しました。</p>
                                                <hr size='1'>%3\$s<hr size='1'>
                                                <p>大きな赤いボタンをクリックして、投稿の文脈で確認してください。</p>"; 

$definitions["email.privateAdd.subject"]     = "[プライベート] %1\$s"; 
$definitions["email.privateAdd.body"]        = "<p>あなたは<strong>%1\$s</strong>というタイトルのプライベートな会話に追加されました。</p>
                                                <hr size='1'>%2\$s<hr size='1'>
                                                <p>大きな赤いボタンをクリックして、この会話を閲覧してください。</p>";

$definitions["email.post.subject"]           = "[新しい返信] %1\$s";
$definitions["email.post.body"]              = "<p><strong>%1\$sさん</strong>が、あなたがフォローしている会話<strong>%2\$s</strong>に返信しました。</p>
                                                <hr size='1'>%3\$s<hr size='1'>
                                                <p>大きな赤いボタンをクリックして、新しいアクティビティを確認してください。</p>"; 

// Translating the gambit system can be quite complex, but we'll do our best to get you through it. :)
// Note: Don't use any html entities in these definitions, except for: &lt; &gt; &amp; &#39;

// Simple gambits
// These gambits are pretty much evaluated as-they-are.
// tag:, author:, contributor:, and quoted: are combined with a value after the colon (:).
// For example: tag:video games, author:myself
$definitions["gambit.author:"] = "作者:";
$definitions["gambit.contributor:"] = "寄稿者:";
$definitions["gambit.member"] = "メンバー";
$definitions["gambit.myself"] = "私";
$definitions["gambit.draft"] = "下書き";
$definitions["gambit.locked"] = "ロック済み";
$definitions["gambit.order by newest"] = "新しい順に並べる";
$definitions["gambit.order by replies"] = "返信数順に並べる";
$definitions["gambit.private"] = "非公開";
$definitions["gambit.random"] = "ランダム";
$definitions["gambit.reverse"] = "逆順";
$definitions["gambit.starred"] = "フォロー中";
$definitions["gambit.ignored"] = "無視";
$definitions["gambit.sticky"] = "固定";
$definitions["gambit.unread"] = "未読";
$definitions["gambit.limit:"] = "制限:";

// Aliases
// These are gambits which tell the gambit system to use another gambit.
// In other words, when you type "active today", the gambit system interprets it as if you typed "active 1 day".
// The first of each pair, the alias, can be anything you want.
// The second, however, must fit with the regular expression pattern defined below (more on that later.)
$definitions["gambit.active today"] = "今日アクティブ"; // what appears in the gambit cloud
$definitions["gambit.active 1 day"] = "過去1日間アクティブ"; // what it actually evaluates to

$definitions["gambit.has replies"] = "返信あり";
$definitions["gambit.has >0 replies"] = "1つ以上の返信あり";
$definitions["gambit.has >10 replies"] = "10以上の返信あり";

$definitions["gambit.has no replies"] = "返信なし";
$definitions["gambit.has 0 replies"] = "返信0件";

$definitions["gambit.dead"] = "非アクティブ";
$definitions["gambit.active >30 day"] = "30日以上アクティブ";

// Units of time
// These are used in the active gambit.
// ex. "[active] [>|<|>=|<=|last] 180 [second|minute|hour|day|week|month|year]"
$definitions["gambit.second"] = "秒";
$definitions["gambit.minute"] = "分";
$definitions["gambit.hour"] = "時間";
$definitions["gambit.day"] = "日";
$definitions["gambit.week"] = "週";
$definitions["gambit.month"] = "月";
$definitions["gambit.year"] = "年";
$definitions["gambit.last"] = "最終"; // as in "active last 180 days"
$definitions["gambit.active"] = "アクティブ"; // as in "active last 180 days"

// Now the hard bit. This is a regular expression to test for the "active" gambit.
// The group (?<a> ... ) is the comparison operator (>, <, >=, <=, or last).
// The group (?<b> ... ) is the number (ex. 24).
// The group (?<c> ... ) is the unit of time.
// The languages of "last" and the units of time are defined above.
// However, if you need to reorder the groups, do so carefully, and make sure spaces are written as " *".
$definitions["gambit.gambitActive"] = "/^{$definitions["gambit.active"]} *(?<a>>|<|>=|<=|{$definitions["gambit.last"]})? *(?<b>\d+) *(?<c>{$definitions["gambit.second"]}|{$definitions["gambit.minute"]}|{$definitions["gambit.hour"]}|{$definitions["gambit.day"]}|{$definitions["gambit.week"]}|{$definitions["gambit.month"]}|{$definitions["gambit.year"]})/";

// These appear in the tag cloud. They must fit the regular expression pattern where the ? is a number.
// If the regular expression pattern has been reordered, these gambits must also be reordered (as well as the ones in aliases.)
$definitions["gambit.active last ? hours"] = "{$definitions["gambit.active"]} {$definitions["gambit.last"]} ? {$definitions["gambit.hour"]}s";
$definitions["gambit.active last ? days"] = "{$definitions["gambit.active"]} {$definitions["gambit.last"]} ? {$definitions["gambit.day"]}s";

// This is similar to the regular expression for the active gambit, but for the "has n reply(s)" gambit.
// Usually you just need to change the "has" and "repl".
$definitions["gambit.gambitHasNReplies"] = "/^has *(?<a>>|<|>=|<=)? *(?<b>\d+) *repl/";

?>
