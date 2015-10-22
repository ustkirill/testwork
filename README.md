Тестовое задание
================

### База данных

Настройте `config/db.php` пример:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=testwork',
    'username' => 'root',
    'password' => 'root',
    'charset' => 'utf8',
];
```

### Порядок установки

Скачать и установить `composer`

~~~
https://getcomposer.org/download/
~~~

Установка зависимостей

~~~
php composer.phar install
~~~

Создание структуры базы данных

~~~
yii migrate
~~~

Выполните sql запросы из папки `source`

Запустите сервер PHP из папки `web`

~~~
php -S localhost:80
~~~
