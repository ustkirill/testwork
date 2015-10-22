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

1. Установка зависимостей

~~~
php composer.phar install
~~~

2. Создание структуры базы данных

~~~
yii migrate
~~~

3. Выполните sql запросы из папки `source`

4. Запустите сервер PHP из папки `web`

~~~
php -S localhost:80
~~~

==========
# testwork
