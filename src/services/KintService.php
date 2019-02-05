<?php
/**
 * Kint plugin for Craft CMS 3.x
 *
 * Kint. For Craft. Finally.
 *
 * @link      https://mildlygeeky.com
 * @copyright Copyright (c) 2019 Mildly Geeky, Inc.
 */

namespace mildlygeeky\kint\services;

use craft\base\Component;
use Kint\Kint;

/**
 * @author    Mildly Geeky, Inc.
 * @package   Kint
 * @since     1.0.0
 */
class KintService extends Component
{
    public static function d($debug = null)
    {
        return Kint::dump($debug);
    }

    public static function dd($debug = null)
    {
        return ddd($debug);
    }

    public static function s($debug = null)
    {
        return s($debug);
    }

    public static function sd($debug = null)
    {
        return sd($debug);
    }

    public static function time()
    {
        return d(microtime());
    }
}
