# Chronicle
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
To use this package, the following requiremenst must be met:
- [Composer](https://getcomposer.org/)
- [Laravel](https://laravel.com/) (5.3+)
- [Carbon](https://carbon.nesbot.com/)

#### Instructions
Once you have succesfully required the package, (v5.3 only) you must register the service provider in your config/app.php file.
```
PDERAS\Shambles\ShamblesServiceProvider::class,
```

## Usage
### Back End
To use shambles you must make add a column 'hash' to the desired models in the database.

Then all you have to do is add the Trait to the models

```
import PDERAS\Shambles\ShamblesTrait;

class MyModel extends Model
{
    use ShamblesTrait;

    ...
}
```

## License
This project is covered under the MIT License. Feel free to use it wherever you like.
