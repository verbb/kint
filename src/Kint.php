<?php
namespace verbb\kint;

use verbb\kint\base\PluginTrait;
use verbb\kint\models\Settings;
use verbb\kint\twigextensions\Extension;

use Craft;
use craft\base\Plugin;
use craft\events\RegisterUrlRulesEvent;
use craft\helpers\UrlHelper;
use craft\web\UrlManager;

use yii\base\Event;

use Kint\Kint as KintPackage;
use Kint\Renderer\RichRenderer;
use Kint\Twig\TwigExtension as KintTwigExtension;

class Kint extends Plugin
{
    // Properties
    // =========================================================================

    public $schemaVersion = '1.0.0';
    public $hasCpSettings = true;


    // Traits
    // =========================================================================

    use PluginTrait;


    // Public Methods
    // =========================================================================

    public function init()
    {
        parent::init();

        self::$plugin = $this;

        KintPackage::$aliases[] = 'time';
        RichRenderer::$theme = $this->getSettings()->kintDisplayTheme;

        $this->_setPluginComponents();
        $this->_setLogging();
        $this->_registerTwigExtensions();
        $this->_registerCpRoutes();
    }

    public function getSettingsResponse()
    {
        Craft::$app->getResponse()->redirect(UrlHelper::cpUrl('kint/settings'));
    }


    // Protected Methods
    // =========================================================================

    protected function createSettingsModel(): Settings
    {
        return new Settings();
    }


    // Private Methods
    // =========================================================================

    private function _registerCpRoutes(): void
    {
        Event::on(UrlManager::class, UrlManager::EVENT_REGISTER_CP_URL_RULES, function(RegisterUrlRulesEvent $event) {
            $event->rules = array_merge($event->rules, [
                'kint/settings' => 'kint/base/settings',
            ]);
        });
    }

    private function _registerTwigExtensions()
    {
        Craft::$app->getView()->registerTwigExtension(new Extension);
        Craft::$app->getView()->registerTwigExtension(new KintTwigExtension);
    }
}
