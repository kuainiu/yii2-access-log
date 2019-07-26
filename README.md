Admin Extension for Yii 2
========================
Admin Extension for Yii 2

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist kuainiu/yii2-access-log "^1.0.0"
```

or add

```
"kuainiu/yii2-access-log": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :




Add modules configuration:

```
return [
    'modules'             => [
        'logtest'   => [
            'class'  => 'kuainiu\accesslog\Module',
            'includeIndex'=>true
        ],
        ],
];
```

You can then access admin-extension manager through the following URL:

```
http://localhost/kuainiu/accesslog
```
