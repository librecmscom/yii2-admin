# Administrator Extension for Yii 2

Installation
------------

Next steps will guide you through the process of installing yii2-admin using [composer](http://getcomposer.org/download/). Installation is a quick and easy three-step process.

### Step 1: Install component via composer

Either run

```
composer require --prefer-dist yuncms/yii2-admin
```

or add

```json
"yuncms/yii2-admin": "~1.0.0"
```

to the `require` section of your composer.json.

### Step 2: Configuring your application

Add following lines to your main configuration file:

```php
'bootstrap' => [
    'yuncms\admin\Bootstrap',
],
'modules' => [
    'admin' => [
        'class' => 'yuncms\admin\Module'   
    ],
],
```

### Step 3: Updating database schema

After you downloaded and configured Yii2-admin, the last thing you need to do is updating your database schema by applying the migrations:

```bash
$ php yii migrate/up 
```