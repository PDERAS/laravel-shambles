# Shambles
```
composer require pderas/shambles
```

### Table Of Contents
1. [About](#about)
2. [Installation](#installation)
3. [Requirements](#requirements)
4. [Instructions](#instructions)
5. [Usage](#usage)
6. [License](#license)

## About
This package is designed for Laravel that adds a hash value to a model into the database.

## Installation
#### Requirements
To use this package, the following requirements must be met:
- [Composer](https://getcomposer.org/)
- [Laravel](https://laravel.com/) (5.3+)

#### Instructions
Once you have succesfully required the package, (v5.3 only) you must register the service provider in your config/app.php file.
```
PDERAS\Shambles\ShamblesServiceProvider::class,
```

## Usage
If you would like a config file for shambles to define a specific hash size.
```
php artisan vendor:publish --provider="PDERAS\Shambles\ShamblesServiceProvider"
```

### Back End
To use shambles you must make add a column 'hash' to the desired models in the database.

e.i. in a migration somewhere...
```
class MyMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('my_table', function(Blueprint $table) {
            $table->string('hash')->unique();
        });
    }
}
```

Then all you have to do is add the Trait to the models

```
use PDERAS\Shambles\ShamblesTrait;

class MyModel extends Model
{
    use ShamblesTrait;

    $defaultHashSize = 36;      // hash length can be set on a per model basis
    $defaultRouteKey = 'hash';  // laravel default uses 'id' 

    ...
}
```

Now whenever you create a new model it will auto add a hash to it. You can then use that hash for lookups and obscure the models auto-incrementing id.

Get Request ...
```
http://localhost/my-model-route/{HASH}
```

```
function myModelRouteFn(Request $request, MyModel $my_model)
{
    ...
    $my_model->update(...);
    ...
}
```


## License
This project is covered under the MIT License. Feel free to use it wherever you like.
