<?php
namespace verbb\kint\renderers;

use Kint\Renderer\Renderer;
use Kint\Renderer\RichRenderer;
use Kint\Renderer\TextRenderer;
use Kint\Zval\InstanceValue;
use Kint\Zval\Value;

/**
 * Renders dumped values as `console.log()` calls so they appear in the browser's developer console
 * rather than in the page. Each value becomes a plain JSON structure the console can expand.
 */
class ConsoleRenderer extends Renderer
{
    // Public Methods
    // =========================================================================

    public function filterParserPlugins(array $plugins): array
    {
        // Use the same lightweight parser plugins as the text renderer; the rich-only ones add
        // representations the console output never shows
        $return = [];

        foreach ($plugins as $plugin) {
            foreach (TextRenderer::$parser_plugin_whitelist as $allowed) {
                if ($plugin instanceof $allowed) {
                    $return[] = $plugin;

                    continue 2;
                }
            }
        }

        return $return;
    }

    public function preRender(): string
    {
        $nonce = RichRenderer::$js_nonce !== null ? ' nonce="' . htmlspecialchars(RichRenderer::$js_nonce) . '"' : '';

        return '<script' . $nonce . '>';
    }

    public function postRender(): string
    {
        return '</script>';
    }

    public function render(Value $o): string
    {
        $arguments = [];

        if ($o->name !== null && $o->name !== '') {
            $arguments[] = $this->_encode((string)$o->name);
        }

        $arguments[] = $this->_encode($this->_toConsole($o));

        return 'console.log(' . implode(', ', $arguments) . ');';
    }

    public function renderNothing(): string
    {
        return 'console.log(' . $this->_encode('No argument') . ');';
    }


    // Private Methods
    // =========================================================================

    private function _toConsole(Value $o): mixed
    {
        if (in_array('recursion', $o->hints, true)) {
            return '*RECURSION*';
        }

        if (in_array('blacklist', $o->hints, true)) {
            return '*BLACKLISTED*';
        }

        if (in_array('depth_limit', $o->hints, true)) {
            return '*DEPTH TOO GREAT*';
        }

        $contents = $o->value->contents ?? null;

        switch ($o->type) {
            case 'array':
                return $this->_children($o);
            case 'object':
                $class = $o instanceof InstanceValue ? $o->classname : 'object';

                return ['__class' => $class] + $this->_children($o);
            case 'double':
                // JSON has no representation for these, so show them as PHP would
                return is_float($contents) && !is_finite($contents) ? (string)$contents : $contents;
            case 'string':
            case 'integer':
            case 'boolean':
            case 'null':
                return $contents;
            default:
                // Resources and anything else without a JSON equivalent are shown by type
                return (string)$o->getType();
        }
    }

    private function _children(Value $o): array
    {
        $children = [];

        if (!$o->value || !is_array($o->value->contents)) {
            return $children;
        }

        $contents = $o->value->contents;

        if ($o instanceof InstanceValue && $o->value->getName() === 'properties') {
            $contents = self::sortProperties($contents, TextRenderer::$sort);
        }

        foreach ($contents as $child) {
            if ($child instanceof Value) {
                $children[(string)$child->name] = $this->_toConsole($child);
            }
        }

        return $children;
    }

    private function _encode(mixed $value): string
    {
        // Escape HTML-significant characters so the JSON can't close the surrounding script tag
        $flags = JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_INVALID_UTF8_SUBSTITUTE | JSON_PARTIAL_OUTPUT_ON_ERROR;

        return json_encode($value, $flags) ?: 'null';
    }
}
