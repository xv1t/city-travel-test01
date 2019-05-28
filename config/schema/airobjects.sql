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
    