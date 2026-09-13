# Configuration

You can customise Kint’s settings using a PHP configuration file. This is optional: each setting has a default, so you only need to include the values you want to change.

To override a setting, create `kint.php` in your Craft project’s `/config` directory and return an array of setting names and values. For example, the following will limit debugging output to four levels of nested values:

```php
<?php

return [
    'kintSettings' => ['depth_limit' => 4],
];
```

All other settings keep their defaults. Add any further settings you want to change to the same array. The options below explain the available settings and their defaults.

## Configuration Options

::: reference
### `kintSettings`

**Type:** `array` · **Default:** `[]`

The [Kint Settings](https://kint-php.github.io/kint/settings/) to apply globally.
:::


::: reference
### `richRendererSettings`

**Type:** `array` · **Default:** `[]`

The [Rich Renderer Settings](https://kint-php.github.io/kint/settings/).
:::


## Control Panel
You can also manage configuration settings through the Control Panel by visiting Settings → Kint.
