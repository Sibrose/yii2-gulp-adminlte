# yii2basic-webpack-adminlte
Каркас yii2-basic приложения с модулем админки AdminLTE и Webpack

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

5. Накатить миграции посредством команды `php yii migrate`.

6. Создать в таблице `users` пользователя для доступа в админку. 
Можно использовать следующий запрос (login - admin, pass - qwertydoctor): 
`INSERT INTO users VALUES ('1', 'admin', '1', '$2y$13$YR8vM7kMXhjIa7hnxkaV5.qHtxTlj0BnQyvrfFSDz9.C5iAMnyJRK', null, null, 'admin@admin.ru', '10', '2', '2');`

Запуск Webpack осуществляется с помощью команды `npm start`

Все scss, js, шрифты и изображения хранятся в директории `/assets/src/`. 
Js-скрипты добавляются в папку `/assets/src/js/vendor`, после чего нужно добавить импорт в `/assets/src/js/index.js`.


