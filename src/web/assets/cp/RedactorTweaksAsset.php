<?php
namespace verbb\redactortweaks\web\assets\cp;

use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

use craft\redactor\assets\redactor\RedactorAsset;
use verbb\base\web\assets\cp\CpAsset as VerbbCpAsset;

class RedactorTweaksAsset extends AssetBundle
{
    // Public Methods
    // =========================================================================

    public function init(): void
    {
        $this->sourcePath = '@verbb/redactortweaks/web/assets/cp/dist';

        $this->depends = [
            VerbbCpAsset::class,
            CpAsset::class,
            RedactorAsset::class,
        ];

        $this->css = [
            'redactor-tweaks.css',
        ];

        parent::init();
    }
}
