<?php
namespace Craft;

class RedactorTweaksPlugin extends BasePlugin
{
    // =========================================================================
    // PLUGIN INFO
    // =========================================================================
    
    public function getName()
    {
        return Craft::t('Redcator Fixes');
    }

    public function getVersion()
    {
        return '1.0.0';
    }

    public function getDeveloper()
    {
        return 'S. Group';
    }

    public function getDeveloperUrl()
    {
        return 'http://sgroup.com.au';
    }

    public function init()
    {
        if (craft()->request->isCpRequest() && craft()->userSession->isLoggedIn()) {
            craft()->templates->includeCssResource('redactortweaks/css/redactortweaks.css');
        }
    }
}

