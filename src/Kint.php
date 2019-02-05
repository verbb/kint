<?php
/**
 * Kint plugin for Craft CMS 3.x
 *
 * Kint. For Craft. Finally.
 *
 * @link      https://mildlygeeky.com
 * @copyright Copyright (c) 2019 Mildly Geeky, Inc.
 */

namespace mildlygeeky\kint;

use Craft;
use craft\base\Plugin;

use mildlygeeky\kint\services\KintService;
use mildlygeeky\kint\models\Settings;

use Kint\Twig\TwigExtension as KintTwigExtension;

use yii\base\Exception;

/**
 * Class Kint
 *
 * @author    Mildly Geeky, Inc.
 * @package   Kint
 * @since     1.0.0
 *
 * @property  KintService $kintService
 */
class Kint extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * @var Kint
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

        \Kint\Renderer\RichRenderer::$theme = $this->getSettings()->kintDisplayTheme;

        Craft::$app->view->registerTwigExtension(new KintTwigExtension());
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
