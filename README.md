# yii2basic-gulp-adminlte
Каркас yii2-basic приложения с модулем админки AdminLTE и сборщиком gulp

Шаги установки:

1. `composer install`

2. `yarn install`

3. Создать базу данных, хост на локальном сервере. Внутри папки `/config` создать файл db.php с содержимым:

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

5. Создать файл .env и указать имя локального хоста в параметре PROXY.

6. Накатить миграции посредством команды `php yii migrate`.

7. Создать в таблице `users` пользователя для доступа в админку.

Все scss, js, шрифты и изображения хранятся в директории `/assets/src/`. 

При добавлении новых js-файлов, необходимо указать путь в config.yml по аналогии с примером.
