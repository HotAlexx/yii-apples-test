<p>
    <h1>Яблоневый сад (тестовое задание на Yii 2)</h1>
</p>


Установка
-------------------
Склонировать репозиторий:
```
git clone https://github.com/HotAlexx/yii-apples-test.git
```
Установить зависимости:
```
composer install
```
Запустить инсталляционный скрипт и следовать инструкциям:
```
php init --env=Development --overwrite=All
```

Создать базу данных и прописать настройки в файле:
```
/path/to/yii-application/common/config/main-local.php
```

Выполнить миграции:
```
php yii migrate
```

Выполнив настройку web-сервера, прописав хосты в папки:
```
/path/to/yii-application/frontend/web
/path/to/yii-application/backend/web
```

Зайти через браузер в приложения, зарегистрироваться, авторизоваться и смотреть функционал в backend-части.

При необходимости, если не удастся подтвердить пользователя по email - установить в БД руками для него status = 10.