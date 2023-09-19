# Configuration
Create a `kint.php` file under your `/config` directory with the following options available to you. You can also use multi-environment options to change these per environment.

The below shows the defaults already used by Kint, so you don't need to add these options unless you want to modify the values.

```php
<?php

return [
    '*' => [
        'kintSettings' => [
            'aliases' => ['time'],
            'depth_limit' => 7,
            'expanded' => false,
        ],
        'richRendererSettings' => [
            'theme' => 'original.css',
        ],
    ],
];
```

## Configuration options
- `kintSettings` - The [Kint Settings](https://kint-php.github.io/kint/settings/) to apply globally.
- `richRendererSettings` - The [Rich Renderer Settings](https://kint-php.github.io/kint/settings/).

## Control Panel
You can also manage configuration settings through the Control Panel by visiting Settings → Kint.
