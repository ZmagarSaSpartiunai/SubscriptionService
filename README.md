<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Примітки:
1. наповнення фейковими даними - php artisan migrate:fresh --seed 
2. У всіх фейкових юзерів пароль quart.
3. Щоб мати доступ до CRUD підписок, треба змінити ability юзера на 'admin' 
4. Файл імпорту з запитами quart.postman_collection.json в корені проекту
## Мета

Реалізувати api для надання можливості публікації статей після оплати обраного плану підписки.

## Реєстрація

Для реєстрації в системі користувач може скористатися стандартною формою реєстрації:email password.
## Підписка

Типи підписок задаються адміністратором системи. Система не повинна мати фіксовану кількість підписок, і вони можуть задаватися динамічно. Якщо стара підписка не закінчилась, то при набитті новой, відбуається перерахунок грошей зі старой підписки на нову. Користувач не може опублікувати статей більше, ніж зазначено в обраному (оплаченому) плані. Користувач може мати тільки одноактивний план. Невикористані можливості публікації - анулюються. План стає доступним після підтвердження оплати(фейкова сплата).
### Створення публікацій:
Користувач може створити публікацію. Публікація вважається активною, коли користувач змінює її статус на active. Тобто користувач може зберігати скільки завгодно чернеток незалежно від обраного плану.

## Публікації

Усі активні публікації виводяться у загальній стрічці за принципом блогу. Повинна бути можливість фільтрації статей за авторами.
