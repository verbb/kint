# Kint plugin for Craft CMS 3.x

Adds Kint, an in-app PHP debugger, to Craft CMS 3.x for use in Twig and PHP.

![Screenshot](resources/screenshots/screenshot.png)

## Requirements

This plugin requires Craft CMS 3.0 or later.

## Installation

To install the plugin, follow these instructions.

1. Open your terminal and go to your Craft project:

        cd /path/to/project

2. Then tell Composer to load the plugin:

        composer require mildlygeeky/craft-kint

3. In the Control Panel, go to Settings → Plugins and click the “Install” button for Kint.

## Kint Overview

Kint is an interactive debugger for PHP applications. Full documentation is available at http://raveren.github.io/kint/.

Its advantages include that it can be run out of devMode (though you would not want to use it in a public setting), and
it is interactive, with keyboard shortcuts to expand and collapse objects, separates content from methods, etc.

## Configuring Kint

No configuration required, but you can set the theme that Kint will use within the plugin's settings screen.

## Using Kint

- Click anywhere on the bar to unfold it
- Double click + to unfold all children
- Press d to toggle keyboard navigation.
- Press the “⇄” icon on the right to see what code you’d need to use to get at a piece of data.
- Press the “⌕” icon on the right to open a live search.
- Change tabs to see different views of data.
- You can sort tables of data by clicking on the headers.

### Templating

#### d (dump)

`{{ d(entry) }}` or `{{ d(entry, otherEntry) }}`

This is the simplest usage, and will output an interactive debugger for the variable passed in.

#### j (dump - console.log())

`{{ j(entry) }}` or `{{ j(entry, otherEntry) }}`

This is the same as `d`, except all output will be sent to `console.log()`

#### s (simple dump)

`{{ s(someTwigVariable) }}` or `{{ s(entry, otherEntry) }}`

This works essentially the same way as the built-in Twig dump method, and returns a plain text debugging output.

#### microtime (point-in-time memory usage and timestamp)

`{{ microtime() }}` and `{{ microtime(true) }}` to reset the counter

Basic reporting of memory usage at the time that the command is run, as well as a timestamp. If used multiple times,
it will also report the time since it was last called and average duration. Passing `true` as an argument will reset the counter.

#### trace (backtrace)

`{{ trace() }}`

Outputs a PHP backtrace from the point at which the function is called - note, this function uses quite a bit of memory
(you should likely set `memory_limit 512M`, and the output might not be all that helpful, as you are mostly going to be
seeing compiled PHP from the Twig templates.

## Credit

* Thank you to Rokas Šleinius, the developer of Kint - he welcomes donations at [Kint's website](http://raveren.github.io/kint/)

Brought to you by [Mildly Geeky, Inc.](https://mildlygeeky.com)
