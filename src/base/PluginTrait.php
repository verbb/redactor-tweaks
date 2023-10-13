<?php
namespace verbb\redactortweaks\base;

use verbb\redactortweaks\RedactorTweaks;

use verbb\base\LogTrait;
use verbb\base\helpers\Plugin;

trait PluginTrait
{
    // Properties
    // =========================================================================

    public static ?RedactorTweaks $plugin = null;


    // Traits
    // =========================================================================

    use LogTrait;
    

    // Static Methods
    // =========================================================================

    public static function config(): array
    {
        Plugin::bootstrapPlugin('redactor-tweaks');

        return [];
    }

}