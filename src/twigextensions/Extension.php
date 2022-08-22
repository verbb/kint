<?php
namespace verbb\kint\twigextensions;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

use Kint\Kint;
use Kint\Parser\MicrotimePlugin;

class Extension extends AbstractExtension
{
    // Public Methods
    // =========================================================================

    public function getName(): string
    {
        return 'Kint';
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('microtime', [$this, 'microtime']),
            new TwigFunction('trace', [$this, 'trace']),
        ];
    }

    public function trace(): void
    {
        Kint::trace();
    }

    public function microtime($reset = false): void
    {
        if ($reset) {
            MicrotimePlugin::clean();
        }

        Kint::dump(microtime());
    }
}
