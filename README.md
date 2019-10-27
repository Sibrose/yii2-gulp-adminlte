# yii2basic-gulp-adminlte
Каркас yii2-basic приложения с модулем админки AdminLTE и сборщиком gulp

Шаги установки:

1. `composer install`

2. `yarn install`

3. Внутри папки `/config` создать файл db.php, с содержимым:
```
<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=gremm;unix_socket=/Applications/MAMP/tmp/mysql/mysql.sock',
    'username' => 'root',
    'password' => 'root',
    'charset' => 'utf8',
];

```
