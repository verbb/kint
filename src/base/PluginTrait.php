<?php
namespace verbb\kint\base;

use Craft;

use yii\log\Logger;

use verbb\base\BaseHelper;

trait PluginTrait
{
    // Static Properties
    // =========================================================================

    public static $plugin;


    // Public Methods
    // =========================================================================

    public static function log($message, $attributes = []): void
    {
        if ($attributes) {
            $message = Craft::t('kint', $message, $attributes);
        }

        Craft::getLogger()->log($message, Logger::LEVEL_INFO, 'kint');
    }

    public static function error($message, $attributes = []): void
    {
        if ($attributes) {
            $message = Craft::t('kint', $message, $attributes);
        }

        Craft::getLogger()->log($message, Logger::LEVEL_ERROR, 'kint');
    }


    // Private Methods
    // =========================================================================

    private function _setPluginComponents(): void
    {
        $this->setComponents([

        ]);

        BaseHelper::registerModule();
    }

    private function _setLogging(): void
    {
        BaseHelper::setFileLogging('kint');
    }

}