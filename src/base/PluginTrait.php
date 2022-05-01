<?php
namespace verbb\redactortweaks\base;

use verbb\redactortweaks\RedactorTweaks;
use verbb\base\BaseHelper;

use Craft;

use yii\log\Logger;

trait PluginTrait
{
    // Properties
    // =========================================================================

    public static RedactorTweaks $plugin;


    // Static Methods
    // =========================================================================

    public static function log(string $message, array $params = []): void
    {
        $message = Craft::t('redactor-tweaks', $message, $params);

        Craft::getLogger()->log($message, Logger::LEVEL_INFO, 'redactor-tweaks');
    }

    public static function error(string $message, array $params = []): void
    {
        $message = Craft::t('redactor-tweaks', $message, $params);

        Craft::getLogger()->log($message, Logger::LEVEL_ERROR, 'redactor-tweaks');
    }


    // Private Methods
    // =========================================================================

    private function _registerComponents(): void
    {
        $this->setComponents([

        ]);

        BaseHelper::registerModule();
    }

    private function _registerLogTarget(): void
    {
        BaseHelper::setFileLogging('redactor-tweaks');
    }

}