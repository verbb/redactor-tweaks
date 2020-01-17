<?php
namespace verbb\redactortweaks\base;

use Craft;
use craft\log\FileTarget;

use yii\log\Logger;

use verbb\base\BaseHelper;

trait PluginTrait
{
    // Static Properties
    // =========================================================================

    public static $plugin;


    // Public Methods
    // =========================================================================

    public static function log($message)
    {
        Craft::getLogger()->log($message, Logger::LEVEL_INFO, 'redactor-tweaks');
    }

    public static function error($message)
    {
        Craft::getLogger()->log($message, Logger::LEVEL_ERROR, 'redactor-tweaks');
    }


    // Private Methods
    // =========================================================================

    private function _setPluginComponents()
    {
        $this->setComponents([

        ]);

        BaseHelper::registerModule();
    }

    private function _setLogging()
    {
        Craft::getLogger()->dispatcher->targets[] = new FileTarget([
            'logFile' => Craft::getAlias('@storage/logs/redactor-tweaks.log'),
            'categories' => ['redactor-tweaks'],
        ]);
    }

}