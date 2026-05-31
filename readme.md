## Description

Модуль создаёт базу данных и включает логи для всего приложения через Bootstrap.

Данный модуль не занимается логированием, только просмотром и управлением логами из базы данных.

[Официальная документация Yii2 Logging](https://www.yiiframework.com/doc/guide/2.0/en/runtime-logging)

!!! При ошибках БД, БД может быть недоступна для записи лога, поэтому логирование в базу данных нужно включать, только
если это на самом деле необходимо.

## Старая заметка.

TODO: Добавить в описание: что логгер добавляет в Bootstrap и какие имеет параметры конфигурации.

Для того чтобы включить запись логов в базу данных, добавьте в конфиг:

```php
return [
    // the "log" component must be loaded during bootstrapping time
    'bootstrap' => ['log'],
    // the "log" component process messages with timestamp. Set PHP timezone to create correct timestamp
    'timeZone' => 'America/Los_Angeles',
    'components' => [
        'log' => [
            'targets' => [
               'database' =>  [
                    'class' => 'yii\log\DbTarget',
                    'levels' => ['error', 'warning'],
                    'categories' => ['yii\db\*'],
                    'logTable' => '{{%log_logs}}',
                ],
            ],
        ],
    ],
];
```

