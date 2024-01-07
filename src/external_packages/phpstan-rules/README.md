# @todo: use-me as a separate repo

# PhpStan Rules

- `composer require shortener/phpstan-rules --dev`
- add `phpstan.neon.dist` in the project's root
- use some configuration below

### Basic rules:

```yaml
includes:
    - src/external_packages/phpstan-rules/config/phpstan.base.neon

parameters:
    paths: [src]
```

### Basic rules + Symfony

```yaml
includes:
    - src/external_packages/phpstan-rules/config/phpstan.symfony.neon

parameters:
    paths: [src]

    symfony:
      container_xml_path: var/cache/dev/KernelDevDebugContainer.xml
      console_application_loader: tests/ConsoleApplication.php
```

### Basic rules + Symfony + Doctrine

```yaml
includes:
    - src/external_packages/phpstan-rules/config/phpstan.symfony-doctrine.neon

parameters:
    paths: [src]
    symfony:
        container_xml_path: var/cache/dev/shortener_KernelDevDebugContainer.xml
        console_application_loader: tests/ConsoleApplication.php

    doctrine:
        objectManagerLoader: tests/bootstrap-orm.php
```

```php
// tests/bootstrap-orm.php

<?php

declare(strict_types=1);

use shortener\Kernel;
use Symfony\Component\Dotenv\Dotenv;

require __DIR__ . '/../vendor/autoload.php';

(new Dotenv())->bootEnv(__DIR__ . '/../.env');

$kernel = new Kernel($_SERVER['APP_ENV'], (bool) $_SERVER['APP_DEBUG']);
$kernel->boot();

return $kernel->getContainer()->get('doctrine')->getManager();
```
