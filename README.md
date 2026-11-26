# Shambles
```
composer require pderas/shambles
```

### Table Of Contents
1. [About](#about)
2. [Installation](#installation)
3. [Requirements](#requirements)
4. [Usage](#usage)
5. [License](#license)

## About
Shambles is a Laravel package that gives your models a random hash. You can use the hash in URLs and lookups instead of the auto-incrementing id.

## Installation
#### Requirements
To use this package, the following requirements must be met:
- [PHP](https://www.php.net/) 8.1+
- [Laravel](https://laravel.com/) 10, 11, 12 or 13

Laravel's package auto-discovery registers the service provider, so there is nothing else to install.

## Usage
If you would like a config file to set defaults for all models, publish it:
```bash
php artisan vendor:publish --provider="Pderas\Shambles\ShamblesServiceProvider"
```

The config file has two settings:

| Key | Default | Description |
|---|---|---|
| `hash_size` | `36` | Number of random bytes in each hash. The stored hash is hex, so it is twice this many characters long (72 by default). |
| `route_key` | `'hash'` | The column Laravel uses for route model binding. |

### Back End
Add a `hash` column to the table of each model that will use Shambles. It must be at least twice `hash_size` characters long; the default `string` column (255 characters) is fine for the default size.

For example, in a migration:
```php
public function up(): void
{
    Schema::table('my_table', function (Blueprint $table) {
        $table->string('hash')->unique();
    });
}
```

Then add the trait to the model:

```php
use Pderas\Shambles\Traits\ShamblesTrait;

class MyModel extends Model
{
    use ShamblesTrait;
}
```

Now every new model gets a hash automatically, whether it is made with `new`, `create`, `make`, `forceCreate` or `replicate`. You can look models up by hash:

```php
MyModel::findByHash($hash);        // returns null if not found
MyModel::findByHashOrFail($hash);  // throws ModelNotFoundException if not found
```

Route model binding uses the hash too:
```
http://localhost/my-model-route/{HASH}
```

```php
function myModelRouteFn(Request $request, MyModel $my_model)
{
    ...
    $my_model->update(...);
    ...
}
```

#### Per-model settings
To use a different hash size for one model, give it a `$hashSize` property (in bytes):

```php
class MyModel extends Model
{
    use ShamblesTrait;

    protected static $hashSize = 16; // 32-character hash
}
```

To use a different route key for one model, override `getRouteKeyName()`:

```php
class MyModel extends Model
{
    use ShamblesTrait;

    public function getRouteKeyName()
    {
        return 'id';
    }
}
```

Don't redeclare `$defaultHashSize` or `$defaultRouteKey` in your model. PHP raises a fatal error when a class redeclares a trait's property with a different value.

## License
This project is covered under the MIT License. Feel free to use it wherever you like.
