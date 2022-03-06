<?php
namespace verbb\redactortweaks;

use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;
use craft\redactor\assets\redactor\RedactorAsset;

use verbb\base\assetbundles\CpAsset as VerbbCpAsset;

class RedactorTweaksAsset extends AssetBundle
{
    // Public Methods
    // =========================================================================

    public function init(): void
    {
        $this->sourcePath = '@verbb/redactortweaks/resources/dist';

        $this->depends = [
            VerbbCpAsset::class,
            CpAsset::class,
            RedactorAsset::class,
        ];

        $this->css = [
            'css/redactor-tweaks.css',
        ];

        parent::init();
    }
}