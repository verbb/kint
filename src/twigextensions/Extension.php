<?php
namespace verbb\kint\twigextensions;

use Twig_Extension;
use Twig_SimpleFunction;
use Twig_SimpleFilter;
use Twig_Environment;

use Kint\Kint;
use Kint\Parser\MicrotimePlugin;

class Extension extends Twig_Extension
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'Kint';
    }

    /**
     * @inheritdoc
     */
    public function getFunctions()
    {
        return [
            new Twig_SimpleFunction('microtime', [$this, 'microtime']),
            new Twig_SimpleFunction('trace', [$this, 'trace']),
        ];
    }

    public function trace()
    {
        Kint::trace();

        return null;
    }

    public function microtime($reset = false)
    {
        if ($reset) {
            MicrotimePlugin::clean();
        }

        Kint::dump(microtime());

        return null;
    }
}
