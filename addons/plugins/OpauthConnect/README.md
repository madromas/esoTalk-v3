OpauthConnect
=============

Signing in via social networks.  
Plugin for [esoTalk](http://esotalk.org) forum engine.

Supported services
------------------

1. Google plus
2. Facebook
3. Twitter
4. Vkontakte

Steps to install
----------------

1. Download and extract plugin
2. Rename plugin folder to `OpauthConnect` (case sensitive!)
3. Move plugin to esoTalk plugin directory (in newest version it is "*addons/plugins*")
4. Enable plugin on esoTalk administration page
5. Check needed social networks and enter credentials
6. Go to your social application settings and add some info:  
    * For **Facebook**:
        1. Go to *http://developers.facebook.com*
        2. Select your application
        3. Select *Settings* in left menu
        4. Add your website (or edit existing *Site URL*)
        5. Navigate to *Advanced* tab
        6. Enable *Client OAuth Login*
        7. Add to *Valid OAuth redirect URIs* value  
           `http://your-forum.com/user/social/facebook`
        8. Select *Status & Review* in left menu
        9. Make your application public
    * For **Google**:
        1. Go to *http://code.google.com/apis/console*
        2. Select *APIs & auth* -> *Credentials* in left menu
        3. Create new Client ID or edit existing
        4. Set to *Authorized redirect URI* value  
           `http://your-forum.com/user/social/google/oauth2callback`  
    * For **Twitter**:
        1. Go to *http://dev.twitter.com/apps*
        2. Select your application
        3. Navigate to *Settings* tab
        4. Set to *Callback URL* value  
           `http://your-forum.com/user/social/twitter/oauth_callback`  
    * For **Vkontakte**:
        1. Go to *http://vk.com/apps?act=settings*
        2. Find your application and click *Manage*
        3. Navigate to *Settings* tab
        4. Set to *Base domain* your domain name (e.g. `your-forum.com`)
        5. Set to *Site address* your site address (e.g. `http://your-forum.com`)

IMPORTANT!!!

7. Add following code where you want to display login buttons  
`
<?php $this->trigger("RenderOpauth"); ?>`

Steps to update from v1.0+ to v2.0+
-----------------------------------

*One note before we start. After updating you will lose some information about users, but no worries. 
This will not affect Google and Facebook users (they just need to press "complete authorization" button after first login attempt), 
but Twitter users have to enter and confirm their email address once more.*

1. Backup your database (**Recommended**)
2. Don't forget to backup your custom templates (if any)
3. Update your config file "*config/config.php*"  
There is no way to update it automatically, so you have to do it by yourself.  
By default there is no writing permission to config file. You have to add it first.  
Find lines started with prefix `plugin.opauthconnect` and replace this prefix to `OpauthConnect`
4. Do needed steps to install

Customizing templates
---------------------

*No need to edit templates directly in plugin directory and then taking care about your templates after update. 
You can overwrite needed templates in your skin. 
You can overwrite any template. But I would recommend to customize only **emails** and **login buttons** templates.  
Here are some steps:*

1. Take a look on views structure in plugin folder and find needed template
2. Go to your skin views directory "*addons/skins/yourskinname/views*". If you are not using custom skin you can choose "*Default*", but 
in this case be careful with next esoTalk updates.
3. Add needed template to skin views folder.  
For example, your need to customize login buttons. So the filepath is `social/oc_buttons.php`. 
You have to create folder `social` in your skin views directory, then add file `oc_buttons.php` to newly created folder.  
***Done!*** Now plugin is using your template instead of original.
4. To be aware of what variables you can use in your custom templates, take a look on comments in original plugin templates