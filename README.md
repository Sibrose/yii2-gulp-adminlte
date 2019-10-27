# yii2basic-gulp-adminlte
Каркас yii2-basic приложения с модулем админки AdminLTE и сборщиком gulp

Шаги установки:

1. `composer install`

2. `yarn install`

3. Внутри папки `/config` создать файл db.php с содержимым:

```
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=DBNAME;unix_socket=/Applications/MAMP/tmp/mysql/mysql.sock',
    'username' => 'USERNAME',
    'password' => 'PASSWORD',
    'charset' => 'utf8',
];
```

4. Внутри папки `/config` создать файл params.php с содержимым:

```
return [
    'adminEmail' => 'admin@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',
    'appName' => 'APPLICATION NAME',
    'shortAppName' => 'SHORT APPLICATION NAME'
];
```

