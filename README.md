<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii 2 Advanced Project Template</h1>
    <br>
</p>

<h2>Information</h2>

<p>Консольная команда для загрузки курсов валют - "php yii currency/download"</p>

<p>Команда для планировщика: в файл заданий crontab записываем(crontab -e) команду  "0 0 * * * php /var/www/project/yii currency/download"</p>

<p>Методы:
    <br>/currencies - список валют на текущую дату
    <br>/currencies?name=usd - курс для переданного кода валюты на текущую дату
    <br>/currencies?date=2020-04-16 - курс для переданной даты
    <br>/currencies?page=2 - для пагинации
</p>

<p>Токен: Bearer qwerty</p>

