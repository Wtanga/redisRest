# Stack
redisRest PHP8(native) + redis(predis) + bootsrap
# Задание 1. 
Консольная программа на php(cli)
Требуется реализовать компонент который позволит добавлять и удалять данные из Redis.

Команда добавления: $ ./command redis add {key} {value}
Команда удаления: $ ./command redis delete {key}

В Redis установить ttl 1 час. Дополнительно учесть возможность перехода на другое хранилище, например Memcached.
PHP компонент не должен иметь сторонних зависимостей от библиотек(composer)(за исключением работы с Redis)  
**php redis.php add key value**  
**php redis.php delete key**

# Задание 2. 
Реализовать веб страницу(+ бекенд) для отображения информации из «задания 1»
Вывести список данных в формате:
<li>{key}: {value} <a href=‘#’ class=‘remove’>delete</a></li>

Данные требуется получать(удалять) используя REST запросы.

Получение данных: GET /api/redis
Ответ:
status: true,
code: 200,
data: {
 {key}: {value},
 {key}: {value},
 {key}: {value},
 …
}

Удаление данных: DELETE /api/redis/{key}
Ответ:
status: true,
code: 200,
data: {}

В случае ошибок, ответ в формате: 
status: false,
code: 500,
data: {
 ’message’: ‘Error info message’
}  
# REST запрос GET  
![REST запрос GET](img/Screenshot_2.png)  
# REST запрос GET{id}  
![REST запрос GET{id}](img/Screenshot_3.png)  
# REST запрос DELETE{id}  
![REST запрос DELETE{id}](img/Screenshot_4.png)  
# REST запрос GET после DELETE  
![REST запрос GET после DELETE](img/Screenshot_5.png)
