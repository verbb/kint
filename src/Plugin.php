<?php
/**
 * Kint plugin for Craft CMS 3.x
 *
 * Adds Kint, an in-app PHP debugger, to Craft CMS 3.x for use in Twig and PHP.
 *
 * @link      https://mildlygeeky.com
 * @copyright Copyright (c) 2019 Mildly Geeky, Inc.
 */

namespace mildlygeeky\kint;

use Craft;
use craft\base\Plugin as BasePlugin;

use Kint\Kint;
use mildlygeeky\kint\models\Settings;
use mildlygeeky\kint\twigextensions\KintTwigExtension as CraftKintTwigExtension;

use Kint\Renderer\RichRenderer;
use Kint\Twig\TwigExtension as KintTwigExtension;

use yii\base\Exception;

/**
 * Class Kint
 *
 * @author    Mildly Geeky, Inc.
 * @package   Kint
 * @since     1.0.0
 *
 */
class Plugin extends BasePlugin
{
    // Static Properties
    // =========================================================================

    /**
     * @var Plugin
     */
    public static $plugin;

    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $schemaVersion = '1.0.0';

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        self::$plugin = $this;

        Kint::$aliases[] = 'time';

        RichRenderer::$theme = $this->getSettings()->kintDisplayTheme ?: 'original.css';
        Craft::$app->view->registerTwigExtension(new KintTwigExtension());
        Craft::$app->view->registerTwigExtension(new CraftKintTwigExtension());
    }

    /**
     * @inheritdoc
     */
    protected function createSettingsModel()
    {
        return new Settings();
    }

    /**
     * @inheritdoc
     * @throws \Twig_Error_Loader
     * @throws Exception
     */
    protected function settingsHtml(): string
    {
        try {
            return Craft::$app->view->renderTemplate(
                'kint/settings',
                [
                    'settings' => $this->getSettings()
                ]
            );
        } catch (\Twig_Error_Loader $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }
}
