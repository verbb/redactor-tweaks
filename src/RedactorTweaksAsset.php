<?php
namespace verbb\redactortweaks;

use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;
use craft\redactor\assets\redactor\RedactorAsset;

class RedactorTweaksAsset extends AssetBundle
{
    public function init()
    {
        $this->sourcePath = '@verbb/redactortweaks/resources/dist';

        $this->depends = [
            CpAsset::class,
            RedactorAsset::class,
        ];

        $this->css = [
            'css/redactor-tweaks.css'
        ];

        parent::init();
    }
}