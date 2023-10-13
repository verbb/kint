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

    public bool $hasCpSettings = true;
    public string $schemaVersion = '1.0.0';


    // Traits
    // =========================================================================

    use PluginTrait;


    // Public Methods
    // =========================================================================

    public function init(): void
    {
        parent::init();

        self::$plugin = $this;

        $this->_registerTwigExtensions();

        if (Craft::$app->getRequest()->getIsCpRequest()) {
            $this->_registerCpRoutes();
        }

        // Defer most setup tasks until Craft is fully initialized:
        Craft::$app->onInit(function() {
            $settings = $this->getSettings();

            // Set global Kint settings
            foreach ($settings->getKintSettings() as $key => $value) {
                KintPackage::$$key = $value;
            }

            // Set RichRenderer settings
            foreach ($settings->getRichRendererSettings() as $key => $value) {
                RichRenderer::$$key = $value;
            }
        });
    }

    public function getSettingsResponse(): mixed
    {
        return Craft::$app->getResponse()->redirect(UrlHelper::cpUrl('kint/settings'));
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

    private function _registerTwigExtensions(): void
    {
        Craft::$app->getView()->registerTwigExtension(new Extension);
        Craft::$app->getView()->registerTwigExtension(new KintTwigExtension);
    }
}
