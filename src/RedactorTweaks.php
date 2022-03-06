<?php
namespace verbb\redactortweaks;

use verbb\redactortweaks\base\PluginTrait;

use Craft;
use craft\base\Plugin;
use craft\events\RegisterComponentTypesEvent;
use craft\redactor\Field as RedactorField;

use yii\base\Event;

class RedactorTweaks extends Plugin
{
    // Properties
    // =========================================================================

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

        $this->_setPluginComponents();
        $this->_setLogging();

        if (Craft::$app->getPlugins()->getPlugin('redactor') && Craft::$app->getRequest()->isCpRequest) {
            Craft::$app->getView()->registerAssetBundle(RedactorTweaksAsset::class);
        }
    }
}
