<?php
/**
 * Kint plugin for Craft CMS 3.x
 *
 * Kint. For Craft. Finally.
 *
 * @link      https://mildlygeeky.com
 * @copyright Copyright (c) 2019 Mildly Geeky, Inc.
 */

namespace mildlygeeky\kint\models;

use craft\base\Model;

/**
 * @author    Mildly Geeky, Inc.
 * @package   Kint
 * @since     1.0.0
 */
class Settings extends Model
{
    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $kintDisplayTheme;

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['kintDisplayTheme', 'default', 'value' => 'original.css'],
        ];
    }
}
