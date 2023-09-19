# Usage

### `d()`
This is the simplest usage, and will output an interactive debugger for the variable passed in.

```twig
{{ d(entry) }}

{# or #}
{{ d(entry, otherEntry) }}
```

### `s()`
This works essentially the same way as the built-in Twig dump method, and returns a plain text debugging output.

```twig
{{ s(entry) }}

{# or #}
{{ s(entry, otherEntry) }}
```

### `microtime()`
Basic reporting of memory usage at the time that the command is run, as well as a timestamp. If used multiple times,
it will also report the time since it was last called and average duration. Passing `true` as an argument will reset the counter.

```twig
{{ microtime() }}
```

You can also reset the counter:

```twig
{{ microtime(true) }}
```

### `trace()`
Outputs a PHP backtrace from the point at which the function is called - note, this function uses quite a bit of memory
(you should likely set `memory_limit 512M`, and the output might not be all that helpful, as you are mostly going to be
seeing compiled PHP from the Twig templates.

```twig
{{ trace() }}
```
