# Тестовое задание
## 1. выборка данных
Нужно создать веб страницу на которой будет выборка данных, чтобы в конечном итоге получилась вот такая html таблица:

| code_from | code_to | city_from | city_to | airport_from | airport_to |
|-----------|---------|-----------|---------|--------------|------------|
| DME       | KUF     | Москва    | Самара  | Домодедово   | Курумоч    |
| СМШ       | MOW     | Самара    | Москва  | Курумоч      | Внуково    |

## Решение
Виртуальный `view` для линейного объедения всех объектов.
[config/schema/airobjects.sql](config/schema/airobjects.sql)

```sql
 /*
 Звпрос объединяющий (UNION) все коды в одну линию городов и аэропортов.
 Все имена: русские и английские
 Для городов определяется аэолпорт по умолчанию, например, первый по алфавиту
 
 Поля: 
	`id` объекта
    `type` тип: city|airport
    `name` наименование объекта
    `code` код объекта 3 буквы
    `lang` язык кода ru|en справочно
    `city_name` однозначное название города
    `airport_name` однозначное название аэропорта города 
 */
 create or REPLACE view airobjects as
 -- Города РУС
select
	city.id, 
    'city' type,
    city.name, 
    city.code_ru `code`,
    'ru' `lang`,
    city.name city_name,
    min(airport.name) airport_name -- выбор первого аэропорта по алфавиту
from city 
	left join airport
		on airport.city_code_en = city.code_en
group by city.id        
union
-- Городоа EN
select
	city.id, 
    'city',
    city.name, 
    city.code_en `code`,
    'en' `lang`,
    city.name city_name,
    min(airport.name) airport_name -- выбор первого аэропорта по алфавиту
from city
	left join airport
		on airport.city_code_en = city.code_en
group by city.id           
union
-- Аэропорты РУС
select
	airport.id,
    'airport',
    airport.name,
    airport.code_ru `code`,
    'ru' `lang`,
    city.name city_name, -- город взятый из аэропорта
    airport.name airport_name 
from
	airport
    join city
		on city.code_en = airport.city_code_en
union
-- Аэропорты EN
select
	airport.id,
    'airport',
    airport.name,
    airport.code_en `code`,
    'en' `lang`,
    city.name city_name, -- город взятый из аэропорта
    airport.name airport_name
from
	airport
    join city
		on city.code_en = airport.city_code_en;
    
```

### Итоговая  `view`

| id | type    | name           | code | lang | city_name    | airport_name   |
|----|---------|----------------|------|------|--------------|----------------|
| 1  | city    | Москва         | МОВ  | ru   | Москва       | Внуково        |
| 2  | city    | Самара         | СМШ  | ru   | Самара       | Курумоч        |
| 3  | city    | Екатеринбург   | ЕКБ  | ru   | Екатеринбург | Кольцово       |
| 4  | city    | Париж          | ПАЖ  | ru   | Париж        | Сержи Понтоис  |
| 5  | city    | Сургут         | СУР  | ru   | Сургут       | Сургут         |
| 6  | city    | Новосибирск    | ОВБ  | ru   | Новосибирск  | Толмачево      |
| 1  | city    | Москва         | MOW  | en   | Москва       | Внуково        |
| 2  | city    | Самара         | KUF  | en   | Самара       | Курумоч        |
| 3  | city    | Екатеринбург   | SVX  | en   | Екатеринбург | Кольцово       |
| 4  | city    | Париж          | PAR  | en   | Париж        | Сержи Понтоис  |
| 5  | city    | Сургут         | SGC  | en   | Сургут       | Сургут         |
| 6  | city    | Новосибирск    | OVB  | en   | Новосибирск  | Толмачево      |
| 1  | airport | Внуково        | ВНК  | ru   | Москва       | Внуково        |
| 2  | airport | Домодедово     | ДМД  | ru   | Москва       | Домодедово     |
| 3  | airport | Шереметьево    | ШРМ  | ru   | Москва       | Шереметьево    |
| 4  | airport | Курумоч        | СКЧ  | ru   | Самара       | Курумоч        |
| 5  | airport | Кольцово       | КЛЦ  | ru   | Екатеринбург | Кольцово       |
| 6  | airport | Шарль Де Голль | ЦДГ  | ru   | Париж        | Шарль Де Голль |
| 7  | airport | Сержи Понтоис  |      | ru   | Париж        | Сержи Понтоис  |
| 8  | airport | Сургут         | СУР  | ru   | Сургут       | Сургут         |
| 9  | airport | Толмачево      | ТЛЧ  | ru   | Новосибирск  | Толмачево      |
| 1  | airport | Внуково        | VKO  | en   | Москва       | Внуково        |
| 2  | airport | Домодедово     | DME  | en   | Москва       | Домодедово     |
| 3  | airport | Шереметьево    | SVO  | en   | Москва       | Шереметьево    |
| 4  | airport | Курумоч        | KUF  | en   | Самара       | Курумоч        |
| 5  | airport | Кольцово       | SVX  | en   | Екатеринбург | Кольцово       |
| 6  | airport | Шарль Де Голль | CDG  | en   | Париж        | Шарль Де Голль |
| 7  | airport | Сержи Понтоис  | POX  | en   | Париж        | Сержи Понтоис  |
| 8  | airport | Сургут         | SGC  | en   | Сургут       | Сургут         |
| 9  | airport | Толмачево      | OVB  | en   | Новосибирск  | Толмачево      |

Для формирования требуемой таблицы, выполнить запрос [config/schema/select1.sql](config/schema/select1.sql)
```sql
select 
	route.from `code_from`,
    route.to `code_to`,
    from_objects.city_name `city_from`,
    to_objects.city_name `city_to`,
    from_objects.airport_name `airport_from`,    
    to_objects.airport_name `airport_to`
from
	route
    left join airobjects `from_objects`
		on from_objects.code = route.`from`
        AND from_objects.type = route.from_type
    left join airobjects `to_objects`
		on to_objects.code = route.`to`
        AND to_objects.type = route.to_type 
```
### Формирование данных 
в методе контроллера
[Controller/RouteController.php:184](https://github.com/xv1t/city-travel-test01/blob/master/src/Controller/RouteController.php#L184)
```php
    public function task1()
    {
        $route = $this->Route->newEntity();
        $sql = \file_get_contents(APP . '../config/schema/select1.sql');
        $data = ConnectionManager::get('default')
            ->query($sql)
            ->fetchAll();
        $this->set(compact('data', 'route', 'data2'));
       
    }
```

### Генерация страницы
[Template/Route/task1.ctp](src/Template/Route/task1.ctp)
# 2. создать HTML форму для записи данных в таблицу route
Файл шаблона создания формы [Template/Route/add2.ctp](src/Template/Route/add2.ctp)

Шаблон содержит [срипт JS](https://github.com/xv1t/city-travel-test01/blob/master/src/Template/Route/add2.ctp#L34) c комментариями

Обработка запроса autocomplete AJAX на стороне сервера [Controller/RouteController.php:152](https://github.com/xv1t/city-travel-test01/blob/master/src/Controller/RouteController.php#L152)

Обработка вставки новой записи в `route`
[Controller/RouteController.php:59](https://github.com/xv1t/city-travel-test01/blob/master/src/Controller/RouteController.php#L59)

# 3. Как можно оптимизировать каждую из таблиц, для повышения производительности? 
> Просто описать
1. Все поля с `code_*` сделать фиксированную длину поля `CHAR(3)`
2. Ввести таблицу `types` для ссылки на тип через ключ `type_id`, а не через слова `airport|city`
3. В таблицу `airport` вместо буквенных кодов связи с `city` добавить ключ типа `city_id` и проиндексировать его.
4. Вести в одной таблице сразу и аэропорты и города, например, `airobjects`  и с ключем `id`. И в таблицу `route` поля сделать такие: 
```sql
CREATE TABLE `route` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from_id` varchar(45) NOT NULL,
  `to_id` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
```
5. И при выборке из `route` делать `join`  с таблицей `airport` а уже из неё вытаскивать тип


