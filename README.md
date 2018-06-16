Notification
==========

A Symfony2 project that allows to webmasters send real time messages to webmasters client via one line script code.

Requirements
============
  1. php +5.4 with mcrypt and mysql
  2. apache or nginx
  3. Python with Tornado modules

Install
========

Create database:
```
mysql -u root -p -e "DROP DATABASE IF EXISTS notify;create database notify;"
```

Update Composer:
```
composer update -vvv
```

Update bower:
```
bower update
```

##### Check file permissions (Important!): #####
(This command controls general file permission. You can run until each item seem OK, run user as www-data)
```
sudo -u www-data php app/console notify:check
```

Basic system install:
```
sudo -u www-data php app/console notify:install
```

For allow websocket connections run python tornado app (tornado runs over :8080 port):
```
python tornado/notify.py
```

For track gcm and sms events. And send sms and gcm messages on scheduled time:
```
sudo -u www-data php app/console schedule:control:run
```

For cross domain support to your apache virtual hosts file like below:
```
#for tracker .json files stored area
<If "%{REQUEST_URI} =~ m#ua/trackers#">
    Header set Access-Control-Allow-Origin "*"
</If>
#for test adblock is installed 
<If "%{REQUEST_URI} =~ m#cdn/js/ads.js#">
    Header set Access-Control-Allow-Origin "*"
</If>
``` 

Update dynamic notify javascript file from. :
```
curl http://[YOUR_BASE_URL]/export/cdnLib
```

If you are working on cdn js library(web/cdn/js/ut.js.php.js) below url watchs for changes;
```
curl http://[YOUR_BASE_URL]/export/cdnLib/watch
```
Usage
=====

If you installed all components correctly open below url;
```
http://[YOUR_BASE_URL]/login
```
now login with credentials that you have created from console. Now you will redirect to /trackers url from there create an tracker. And copy given code and paste any html file. Then, create an event from below url:
```
http://[YOUR_BASE_URL]/dashboard/tracker/[YOUR_TRACKER_HASH]/events/new/messageBox
```

If your created event scheduled for now. You must see an noty type message box (run html file from hostname like localhost).

###Gcm & Sms Events###

####Sms:####
Import some phone numbers first from Menu ->Lists ->Phone List create an .cvs like below:
```
# numbers.cvs
01234567889[;John][;Kendrick][;Turkcell]
anotherNumber;John;Kendrick;Turkcell
```
import file from ``` Import Bulk Number ``` button. Then Create Event -> Sms menu and create an sms message. Be sure schedule:control:run command runs background.

####Gcm;####
Server side ready fully. Preparing android sdk.

Available Event Types
=====================
  1. Google Cloud Message
  2. Sms
  3. Message Box
  4. Alert Message
  5. Redirect
  6. Link Share
  7. Iframe Box
  8. Script File Inject