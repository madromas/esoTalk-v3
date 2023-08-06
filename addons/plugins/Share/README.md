## esoTalk – Share plugin

- Share conversations with Facebook, Twitter and Google+.

### Installation

Browse to your esoTalk plugin directory:
```
cd WEB_ROOT_DIR/addons/plugins/
```

Clone the Share plugin repo into the plugin directory:
```
git clone git@github.com:tvb/Share.git Share
```

Chown the Share plugin folder to the right web user:
```
chown -R apache:apache Share/
```

### Translation

Add the following definitions to your translation file (or create a seperate definitions.Share.php file):

```
$definitions["Share"] = "Share";
$definitions["Share on"] = "Share on";
```
