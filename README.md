# esoTalk v3

## This is an updated version of the esoTalk forum v1.0.0g4 from 17 May 2014
> 
![mad](https://user-images.githubusercontent.com/64708726/185802624-3f7f8aec-532c-4966-b58b-5bbbcf1210f7.jpg)

![mad2](https://user-images.githubusercontent.com/64708726/185802724-af43a611-1d13-4f18-b3e6-743110bc1e5f.jpg)

![admin](https://github.com/madromas/esoTalk-v3/assets/64708726/de61db61-4029-4cbf-ace8-f61e3ea54d4f)

#### Demo: http://hub.madway.net


> Original (but outdated) project is here: https://github.com/esotalk/esoTalk

## esoTalk – Fat-free forum software

esoTalk is a free, open-source forum software package built with PHP and MySQL. It is designed to be:

 - **Fast.** esoTalk's code was architectured to have little overhead and to be as efficient as possible.
 - **Simple.** All of esoTalk's interfaces are designed around simplicity, ease-of-use, and speed.
 - **Powerful.** Despite its simplicity, a large array of [plugins](https://github.com/madromas/esoTalk-v3/tree/master/addons/plugins), [skins](https://github.com/madromas/esoTalk-v3/tree/master/addons/skins) and [languages](https://github.com/madromas/esoTalk-v3/tree/master/addons/languages) are available to extend the functionality of esoTalk.

esoTalk is developed by Toby Zerner in memory of his brother, Simon. 

### System Requirements

esoTalk requires **PHP 7.2+** and **now also work with php 8.1** and a modern version of **MySQL or MariaDB**.

The PHP **gd extension** is required to support avatar uploading.

esoTalk has only been tested on **Apache** and **lighttpd**. If you encounter a problem specific to any other web server, please [create an issue](https://github.com/madromas/esoTalk-v3/issues).

### Installation

Installing esoTalk is super easy. In brief, simply:

1. [Download esoTalk.](https://github.com/madromas/esoTalk-v3)
2. Extract and upload the files to your PHP-enabled web server.
3. Visit the location in your web browser and follow the instructions in the installer.

### Upgrading

To upgrade esoTalk from an older version, simply:

1. [Download] [Github](https://github.com/madromas/esoTalk-v3) the latest version of esoTalk.
2. Extract and upload all of the files to your web-server, overwriting old ones. (Be careful that you don't lose custom plugins, skins, and languages you've uploaded to the addons directory, though!)
3. Visit **your-forum.com/?p=upgrade** in your web browser and watch esoTalk complete the upgrade.

### Troubleshooting

If you are having problems installing esoTalk, view the [Github](https://github.com/madromas/esoTalk-v3) page. Or visit (https://madway.net)

### License
GPL-2.0 License

#### Best Regards to
https://github.com/tobyzerner


### 10 hidden esoTalk Features

One of the main ideas when developing esoTalk was ease of use for the end user - to keep a concise interface and a standard set of features to avoid clutter. However, there are enough unobtrusive hidden functions that give esoTalk a bit of versatile functionality without breaking the main idea.

Here are some of the great things that are available to you:

### 1. Create a private topic with yourself
![Screenshot 2023-07-29 224640](https://github.com/madromas/esoTalk-v3/assets/64708726/dc1b41c5-3bb9-420b-a8cd-b34554a8cc6b)
Do you want to save a couple of notes, draft a draft for later, or just talk to yourself? Creating a private theme with yourself is the perfect way to do it! No one else will be able to see this topic. (Unless, of course, you decide to add others to the topic later.)

### 2. Create a private topic with a group of users
![Screenshot 2023-07-29 225250](https://github.com/madromas/esoTalk-v3/assets/64708726/cccad463-6e43-467a-b3a4-434e366e8e30)
You can also create a private theme with any number of user groups. Just type "Members", "Administrators", or "Moderators" in the field when you change the privacy settings and press Enter.

### 3. View results from a single or multiple categories

The esoTalk search page is an incredibly powerful tool with all the gambits available to use - but it also has another hidden feature that makes the search even more powerful. By default, clicking on a category will show all the topics in it and any of its subcategories. But what if you want to view topics only from a specific category, without taking into account subcategories?
Just hold down the Shift key and then click on a category, your search will be narrowed down to topics that are directly in this category. And if you keep holding the Shift key and clicking on other categories, you will be able to view topics from the selected categories, you can select many categories at once!

### 4. Find the original post that was quoted
![Screenshot 2023-07-29 230007](https://github.com/madromas/esoTalk-v3/assets/64708726/dac1270b-f1ac-4577-ae4c-2a837a552bfc)
Hover over the quote and you will see a magnifying glass icon. Click on this icon and you will be taken to the original message that was quoted. If the message is within the current topic, the page will simply go to the original message without having to reload. Elegant!

### 5. Quote several messages or part of them
![Screenshot 2023-07-29 230541](https://github.com/madromas/esoTalk-v3/assets/64708726/01574228-8fa7-4258-8d3b-4f65bdf78044)
Usually, by clicking on the citation button, you instantly go to the form of writing an answer with a ready-made quote. But what if you want to quote multiple answers at once to answer them all at once?

The Shift key saves the world once again - hold it down and click on the quote icon, the finished quote will be waiting for you in the form of writing an answer without going down to it.

You can also quote only a part of a separately selected post by selecting the necessary part and clicking the citation icon.

### 6. Keyboard shortcut Ctrl+Enter to send a response

Tired of taking your hands off the keyboard, moving your hand to the mouse, looking for the "Light" button with the cursor and pressing the left mouse button? Us too. That's why you can just press Ctrl+Enter to send a response - without any hassle.

### 7. Negative gambits
![Screenshot 2023-07-29 230839](https://github.com/madromas/esoTalk-v3/assets/64708726/c80a2e56-0beb-4a15-9bee-991768461d1b)
If you put an exclamation mark before the gambit, its effect will be negative. (You can also replace plus (+) with minus (-), which does the same thing.) Thus, the search phrase above will show topics that are NOT fixed, are NOT closed and are NOT private (!#important - #closed + !#private). Absolutely any gambit can be set negatively.

Even cooler - you can quickly add negative gambits to the search field by holding down the Shift key and clicking on the gambit. And don't forget that you can double-click on the gambit for instant search!

### 8. Ignore Conversation
![Screenshot 2023-07-29 231137](https://github.com/madromas/esoTalk-v3/assets/64708726/7e284006-31ce-4809-8db7-a8850d2c0174)
Sometimes there are topics that you are simply not interested in - topics that you would not want to see while browsing the forum. esoTalk took care of that too! In the topic that you would like to ignore, click on the "Options" button and select "Ignore conversation". The topic will be marked as ignored and will no longer catch your eye - unless you use the #ignored gambit to search!

### 9. @ mentions

Do you want to mention an individual user in a topic? In your answer, write "@" and start typing the username. Suitable suggestions will start appearing as you type the name. Select the desired user and press Enter. After sending the response, the user's name will become a link to his profile, and they themselves will receive a notification that they were mentioned in the topic with a link to your answer!
![Screenshot 2023-07-29 231552](https://github.com/madromas/esoTalk-v3/assets/64708726/e49156e1-47c5-4182-aba8-b3469828cf91)
Autofill of the name also works when entering the gambit #author:name and #participant:name. Try it yourself!

### 10. Hide categories
![Screenshot 2023-07-29 232104](https://github.com/madromas/esoTalk-v3/assets/64708726/e53261f0-0c40-4567-8da9-9dd93ff4797b)
And last but not least, just like you can ignore topics - if there is a certain category that you don't really care about, you can hide it too! Go to the categories page (click on the icon with three stripes in the upper left corner of the search page), click on the control button to the right of the category you are interested in, and select "Hide". The category will turn gray and all the topics inside it will no longer appear in the search results. So simple!






