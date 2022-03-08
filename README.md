# Laravel Tenantable

## Installation

You can install the package via composer:

```bash
composer require talentd1223/laravel-tenantable
```

Now lets setup it:

```bash
php artisan tenantable:setup
```

## Usage

Let's say you have the `App\Models\Organization` as a tenant model. 

Now I'll take it step by step, since I was very confused when I implemented my firt multitenancy application. 


### Migrations

You need 2 types of migrations, `master` and `tenant`. The migrations in the `app\database\migrations` directory, are used for `tenant`. If you have to add migrations for the `master` use `app\database\migrations\master` directory.

## Testing

``` bash
composer test
```


