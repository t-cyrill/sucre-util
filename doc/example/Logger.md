Usage Sucre\Logger
=====================================

Sucre\Logger is simple Logger for easy to use.

## Example
--------------------

### Simple Example in Sucre namespace

```php
<?php
namespace Sucre;
reqire __DIR__.'/composer/autoload.php';

Logger::info('message');
```

Default Logger is Logger\StandardOutLogger.

### Example in other namespace
```php
<?php
namespace Sucre;

use Sucre\Logger;

reqire __DIR__.'/composer/autoload.php';

Logger::info('message');
```

### Swap default logger to other
```php
<?php
namespace Sucre;

use Sucre\Logger;

reqire __DIR__.'/composer/autoload.php';

$logger = Logger\ColorizeStandardOutLogger::factory();
$logger->setLevel(Logger::WARN); // Logging only warn, error, fatal

Logger::setLogger($logger);

Logger::info('info message');
Logger::info('error message');
```

