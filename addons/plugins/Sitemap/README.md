## esoTalk – Sitemap plugin

- Generate XML index and sitemap files.

### Installation

Browse to your esoTalk plugin directory:
```
cd WEB_ROOT_DIR/addons/plugins/
```

Clone the Sitemap plugin repo into the plugin directory:
```
git clone git@github.com:tvb/Sitemap.git Sitemap
```

Chown the Sitemap plugin folder to the right web user:
```
chown -R apache:apache Bitcoin/
```

### Translation

Create `definitions.Sitemap.php` in your language pack with the following definitions:

```
$definitions["0.0"] = "0.0";
$definitions["0.1"] = "0.1";
$definitions["0.2"] = "0.2";
$definitions["0.3"] = "0.3";
$definitions["0.4"] = "0.4";
$definitions["0.5"] = "0.5";
$definitions["0.6"] = "0.6";
$definitions["0.7"] = "0.7";
$definitions["0.8"] = "0.8";
$definitions["0.9"] = "0.9";
$definitions["<strong>Bing Sitemaps</strong> has been pinged. (response code: ".$response.")"] = "<strong>Bing Sitemaps</strong> has been pinged. (response code: ".$response.")";
$definitions["<strong>Google Sitemaps</strong> has been pinged. (response code: ".$response.")"] = "<strong>Google Sitemaps</strong> has been pinged. (response code: ".$response.")";
$definitions["Always"] = "Always";
$definitions["Automatically submit to Bing"] = "Automatically submit to Bing";
$definitions["Automatically submit to Google"] = "Automatically submit to Google";
$definitions["Cache Time"] = "Cache Time";
$definitions["Daily"] = "Daily";
$definitions["Exclude Channels"] = "Exclude Channels";
$definitions["Frequency for channels"] = "Frequency for channels";
$definitions["Frequency for default conversations"] = "Frequency for default conversations";
$definitions["Frequency for sticky conversations"] = "Frequency for sticky conversations";
$definitions["Hourly"] = "Hourly";
$definitions["Hours"] = "Hours";
$definitions["Monthly"] = "Monthly";
$definitions["Never"] = "Never";
$definitions["Please submit <strong><i>".C("esoTalk.baseURL")."sitemap-index.xml</i></strong> to <a href='https://support.google.com/sites/answer/100283?hl=en' target='_blank'>Google Webmaster Tools</a> and <a href='http://www.bing.com/webmaster/help/how-to-submit-sitemaps-82a15bd4' target='_blank'>Bing Webmaster Tools</a>."] = "Please submit <strong><i>".C("esoTalk.baseURL")."sitemap-index.xml</i></strong> to <a href='https://support.google.com/sites/answer/100283?hl=en' target='_blank'>Google Webmaster Tools</a> and <a href='http://www.bing.com/webmaster/help/how-to-submit-sitemaps-82a15bd4' target='_blank'>Bing Webmaster Tools</a>.";
$definitions["Priority for channels"] = "Priority for channels";
$definitions["Priority for default conversations"] = "Priority for default conversations";
$definitions["Priority for sticky conversations"] = "Priority for sticky conversations";
$definitions["Sitemap generated!"] = "Sitemap generated!";
$definitions["The sitemap has been regenerated!"] = "The sitemap has been regenerated!";
$definitions["Weekly"] = "Weekly";
$definitions["Yearly"] = "Yearly";

$definitions["message.Sitemap.cache"] = "To reduse server load, the sitemap will be cached for some time. After this time it will be recreated. Enter the number of hours for which the sitemap will be cached. Or enter 0 for disabling caching.";
$definitions["message.Sitemap.exclude"] = "Channels selected here and topics inside them will be excluded from the Sitemap.";
```

### Screenshots
Settings page
![Settings]()
