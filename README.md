# hipay wallet sdk

This library is the official one from hipaywallet.com but packaged for composer.
It is versioned as 1.0 (MAPI_VERSION) and the documentation is version 1.4 from July 1st, 2013.

# Installing via Composer

The recommended way to install is through [Composer](http://composer.org).

```sh
# Install Composer
$ curl -sS https://getcomposer.org/installer | php

# Add easypay-php as a dependency
$ php composer.phar require gordalina/hipay-wallet:~1
```

After installing, you need to require Composer's autoloader:

```php
require 'vendor/autoload.php';
```

# License

This repository (excluding hipay source code) is under the MIT License, see the complete license [here](LICENSE)
