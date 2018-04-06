<?php
namespace verbb\redactortweaks;

use Craft;
use craft\base\Plugin;
use craft\events\RegisterComponentTypesEvent;
use craft\redactor\Field as RedactorField;

use yii\base\Event;

class RedactorTweaks extends Plugin
{
    // Static Properties
    // =========================================================================

    public static $plugin;


    // Public Methods
    // =========================================================================

    public function init()
    {
        parent::init();

        self::$plugin = $this;

        if (Craft::$app->getPlugins()->getPlugin('redactor') && Craft::$app->getRequest()->isCpRequest) {
            Craft::$app->getView()->registerAssetBundle(RedactorTweaksAsset::class);
        }
    }
}
