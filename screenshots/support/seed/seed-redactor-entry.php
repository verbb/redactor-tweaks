/** Seed a current Craft entry using Redactor's real field type. */

use craft\elements\Entry;
use craft\fieldlayoutelements\CustomField;
use craft\fieldlayoutelements\entries\EntryTitleField;
use craft\helpers\Json;
use craft\models\EntryType;
use craft\models\FieldLayout;
use craft\models\FieldLayoutTab;
use craft\models\Section;
use craft\models\Section_SiteSettings;
use craft\redactor\Field as RedactorField;

$fields = Craft::$app->getFields();
$entries = Craft::$app->getEntries();
$elements = Craft::$app->getElements();
$site = Craft::$app->getSites()->getPrimarySite();
$fieldHandle = 'articleBody';
$sectionHandle = 'screenshotArticles';

$field = $fields->getFieldByHandle($fieldHandle);

if (!$field instanceof RedactorField) {
    $field = new RedactorField([
        'name' => 'Article body',
        'handle' => $fieldHandle,
    ]);

    if (!$fields->saveField($field)) {
        throw new RuntimeException('Unable to save Redactor field: ' . Json::encode($field->getErrors()));
    }
}

$section = $entries->getSectionByHandle($sectionHandle);

if (!$section) {
    $entryType = new EntryType([
        'name' => 'Articles',
        'handle' => $sectionHandle . 'Type',
    ]);

    $layout = new FieldLayout(['type' => Entry::class]);
    $tab = new FieldLayoutTab([
        'name' => Craft::t('app', 'Content'),
        'layout' => $layout,
    ]);
    $tab->setElements([new EntryTitleField(), new CustomField($field)]);
    $layout->setTabs([$tab]);
    $entryType->setFieldLayout($layout);

    if (!$entries->saveEntryType($entryType)) {
        throw new RuntimeException('Unable to save Redactor entry type: ' . Json::encode($entryType->getErrors()));
    }

    $section = new Section([
        'name' => 'Articles',
        'handle' => $sectionHandle,
        'type' => Section::TYPE_CHANNEL,
    ]);
    $section->setEntryTypes([$entryType]);
    $section->setSiteSettings([
        new Section_SiteSettings([
            'siteId' => $site->id,
            'enabledByDefault' => true,
            'hasUrls' => false,
        ]),
    ]);

    if (!$entries->saveSection($section)) {
        throw new RuntimeException('Unable to save Redactor section: ' . Json::encode($section->getErrors()));
    }
}

$entryType = $entries->getEntryTypesBySectionId($section->id)[0] ?? null;

if (!$entryType) {
    throw new RuntimeException('Redactor section has no entry type.');
}

$entry = Entry::find()
    ->sectionId($section->id)
    ->slug('a-more-focused-workspace')
    ->siteId($site->id)
    ->status(null)
    ->one();

if (!$entry) {
    $entry = new Entry([
        'sectionId' => $section->id,
        'typeId' => $entryType->id,
        'siteId' => $site->id,
        'slug' => 'a-more-focused-workspace',
        'enabled' => true,
    ]);
}

$entry->title = 'A more focused workspace';
$entry->setFieldValue($fieldHandle, <<<'HTML'
<h2>Write without the clutter</h2>
<p>A compact editor leaves more room for the content itself, while keeping familiar formatting controls close at hand.</p>
<blockquote>Small interface changes make a noticeable difference during a long editing session.</blockquote>
<p><strong>Redactor Tweaks</strong> changes the authoring interface, not the HTML stored with the entry.</p>
HTML);

if (!$elements->saveElement($entry)) {
    throw new RuntimeException('Unable to save Redactor screenshot entry: ' . Json::encode($entry->getErrors()));
}

echo Json::encode([
    'entryEditRoute' => parse_url((string)$entry->getCpEditUrl(), PHP_URL_PATH),
], JSON_THROW_ON_ERROR);
