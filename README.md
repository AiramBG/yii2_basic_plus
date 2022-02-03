<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii 2 Basic++</h1>
    <br>
</p>

Yii 2 Basic++ Project Template is a skeleton [Yii 2](http://www.yiiframework.com/) application best for
rapidly creating small projects.

The template contains all the basic features seen in Yii2 basic project, including some features from advanced project and more!

It includes all commonly used configurations that would allow you to focus on adding new
features to your application.


DIRECTORY STRUCTURE
-------------------
      config               application configuration
      environments         environment-based configuration
      runtime              files generated during runtime
      src 
         web               web related logic (widgets, pages, etc)
         console           scripts to be executed in console (cron jobs, etc)
         common            web/console agnostic logic (managers, entities, helpers, etc) 
      tests                test src scripts 
      vendor               dependent 3rd-party packages



REQUIREMENTS
------------

* PHP 5.6.0
* MySQL 5.0


INSTALLATION
------------

### Install via Composer

If you do not have [Composer](http://getcomposer.org/), you may install it by following the instructions
at [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix) or:
~~~
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
~~~


You can then install this project template using the following commands:
~~~
git clone https://github.com/AiramBG/yii2_basic_plus.git projectdir
cd projectdir
~~~
Assuming that `projectdir` is the name of your project directory

~~~
composer install
~~~

### Config your web server
If you are using Apache 2, the site configuration below should work fine (change `projectdir` to your project directory and port `80` to whatever else you have free):
~~~
<VirtualHost *:80>
   DocumentRoot "projectdir/src/web/public"
   <Directory projectdir/src/web/public">
       AllowOverride All
   </Directory>
</VirtualHost>
~~~


CONFIGURATION
-------------
Inside the `environment` folder you will find two subfolders: `dev` and `prod` which correspond to the development and production environments. Each of these folders has a `config` subfolder with all the settings for those environments.

Configure each environment with the requirements you need. Each configuration file is explained below.

### Params
Edit the file `config/params.php` with real data. Admin account will be associated with the adminEmail parameter in the migration step.

### Mailer
Edit the file `config/mailer.php` to enable sending emails, for example:

```php
return [
    'class' => 'yii\swiftmailer\Mailer',
    'viewPath' => '@common/components/mail',
    'useFileTransport' => false,
    'transport' => [
        'class' => 'Swift_SmtpTransport',
        'host' => 'smtp.gmail.com',
        'username' => 'your@gmail.com',
        'password' => '',
        'port' => '587',
        'encryption' => 'tls',
    ],
];
```
If you use an email address with a Gmail domain, remember that you will need to enable "Less Secure Apps" in your google account or develop secure access using OAUTH (if you do, please share!).

### Database
Edit the file `config/db.php` with real data, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2basic',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```

**NOTES:**
- Yii won't create the database for you, this has to be done manually before you can access it.
- Check and edit the other files in the `config/` directory to customize your application as required.
- Refer to the README in the `tests` directory for information specific to basic application tests.

##Switch between environments
When you have finished configuring the environments, you will need to set one of them to run the framework.
Set the development environment using the following command:
~~~
php environment/select
~~~

This process will copy easyly all configuration files from `environment` folder to `config` folder.
ATTENTION! Remember to update the `environment` configuration before switching to another environment or the configuration changes will be lost.

It is good practice to change configuration parameters directly within the `environment` folder and run the command again to apply the changes.

RUN MIGRATIONS
--------------
When you have configured the database and established an environment you can launch migrations. Migrations are scripts that work with databases to create tables, add records, update indexes, or any other update task.
~~~
 php yii migrate
~~~
The command above will install all tables in your database.


Now you should be able to access the application through the following URL:
~~~
http://localhost/
~~~

TESTING
-------
The tests are located in the `tests` folder and mimic the directory structure of the` src` folder.

OTHER THINGS
------
Tokens are codes used in account creation and login to provide unique identification, so they expire after a while.

To remove expired tokens you can use a cron script or use a mysql event like the example below.
```mysql
CREATE EVENT IF NOT EXISTS tokens_expiration_event
ON SCHEDULE EVERY 1 HOUR
COMMENT 'Delete expired tokens'
DO
DELETE FROM tokens WHERE expiration_at < NOW();
```
By default, expired tokens are only deleted if someone tries to use them again.