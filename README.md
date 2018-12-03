#Eloquent Query Filters
A simple PHP Eloquent extension for universal filters.

## Installation

```
$ composer require wtolk/eloqunt-query-filter
```

```json
{
    "require": {
        "wtolk/eloquent-query-filter": "^1.0"
    }
}
```

## Usage

Our request must be like

```php
/filter[column_name:operator]=something
```

Метод поддерживает операторы, поддерживающиеся самим Eloquent


Our case is filtering users by name, age and gender
###Inclusion the trait to your model

```php
<?php

use Illuminate\Database\Eloquent\Model;
use WTolk\SimpleFilter;

class User extends Model
{
    use SimpleFilter;
}
```
###View
```html
<input type="text" name="filter[name:like]">
<input type="text" name="filter[age:>]">
<input type="text" name="filter[gender]">
```

###Controller
```php
$users=User::filter($request->filter())->get();
```