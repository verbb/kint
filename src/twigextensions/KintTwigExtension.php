<?php
/**
 * Kint plugin for Craft CMS 3.x
 *
 * Adds Kint, an in-app PHP debugger, to Craft CMS 3.x for use in Twig and PHP.
 *
 * @link      https://mildlygeeky.com
 * @copyright Copyright (c) 2019 Mildly Geeky, Inc.
 */

namespace mildlygeeky\kint\twigextensions;

use Kint\Kint;
use Kint\Parser\MicrotimePlugin;
use mildlygeeky\kint\Plugin;

/**
 * @author    Mildly Geeky, Inc.
 * @package   Kint
 * @since     1.0.0
 */
class KintTwigExtension extends \Twig_Extension
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
            new \Twig_SimpleFunction('microtime', [$this, 'microtime']),
            new \Twig_SimpleFunction('trace', [$this, 'trace']),
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
