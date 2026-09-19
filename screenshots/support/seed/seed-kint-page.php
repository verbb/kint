// craft-screenshots: sample-frontend
/** Seed a real Craft entry and a project template that passes it to Kint. */

use craft\elements\Entry;
use craft\fieldlayoutelements\CustomField;
use craft\fieldlayoutelements\entries\EntryTitleField;
use craft\fields\PlainText;
use craft\helpers\FileHelper;
use craft\helpers\Json;
use craft\models\EntryType;
use craft\models\FieldLayout;
use craft\models\FieldLayoutTab;
use craft\models\Section;
use craft\models\Section_SiteSettings;

$fields = Craft::$app->getFields();
$entries = Craft::$app->getEntries();
$elements = Craft::$app->getElements();
$site = Craft::$app->getSites()->getPrimarySite();
$sectionHandle = 'kintArticles';
$summaryHandle = 'kintSummary';

$summary = $fields->getFieldByHandle($summaryHandle);

if (!$summary instanceof PlainText) {
    $summary = new PlainText([
        'name' => 'Summary',
        'handle' => $summaryHandle,
        'multiline' => true,
    ]);

    if (!$fields->saveField($summary)) {
        throw new RuntimeException('Unable to save Kint summary field: ' . Json::encode($summary->getErrors()));
    }
}

$section = $entries->getSectionByHandle($sectionHandle);

if (!$section) {
    $entryType = new EntryType(['name' => 'Articles', 'handle' => $sectionHandle . 'Type']);
    $layout = new FieldLayout(['type' => Entry::class]);
    $tab = new FieldLayoutTab(['name' => Craft::t('app', 'Content'), 'layout' => $layout]);
    $tab->setElements([new EntryTitleField(), new CustomField($summary)]);
    $layout->setTabs([$tab]);
    $entryType->setFieldLayout($layout);

    if (!$entries->saveEntryType($entryType)) {
        throw new RuntimeException('Unable to save Kint entry type: ' . Json::encode($entryType->getErrors()));
    }

    $section = new Section(['name' => 'Articles', 'handle' => $sectionHandle, 'type' => Section::TYPE_CHANNEL]);
    $section->setEntryTypes([$entryType]);
    $section->setSiteSettings([new Section_SiteSettings([
        'siteId' => $site->id,
        'enabledByDefault' => true,
        'hasUrls' => false,
    ])]);

    if (!$entries->saveSection($section)) {
        throw new RuntimeException('Unable to save Kint section: ' . Json::encode($section->getErrors()));
    }
}

$entryType = $entries->getEntryTypesBySectionId($section->id)[0] ?? null;
$entry = Entry::find()->sectionId($section->id)->slug('a-coastal-weekend')->siteId($site->id)->status(null)->one();

if (!$entry) {
    $entry = new Entry([
        'sectionId' => $section->id,
        'typeId' => $entryType->id,
        'siteId' => $site->id,
        'slug' => 'a-coastal-weekend',
        'enabled' => true,
    ]);
}

$entry->title = 'A coastal weekend';
$entry->setFieldValue($summaryHandle, 'A practical guide to beaches, walks, and places worth stopping for along the coast.');

if (!$elements->saveElement($entry)) {
    throw new RuntimeException('Unable to save Kint entry: ' . Json::encode($entry->getErrors()));
}

$templateDir = Craft::getAlias('@templates');
FileHelper::createDirectory($templateDir);
$template = <<<'TWIG'
{# craft-screenshots: sample-frontend #}
{% set article = craft.entries.section('kintArticles').one() %}
{% set value = {
    entry: article,
    publishing: {
        section: article.section,
        author: article.author,
        site: article.site,
    },
    related: {
        topics: ['Travel', 'Coast', 'Weekend guides'],
        featured: true,
    },
} %}
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Inspecting a Craft entry</title>
    <style>
        body { margin: 0; padding: 48px; background: #f5f7fa; color: #243447; font: 16px/1.5 system-ui, sans-serif; }
        main { max-width: 1080px; margin: 0 auto; }
        h1 { margin: 0 0 8px; font-size: 30px; }
        p { margin: 0 0 28px; color: #64748b; }
    </style>
</head>
<body>
    <main>
        <h1>Inspecting a Craft entry</h1>
        <p>Kint keeps complex values navigable while a template is being built.</p>
        {{ d(value) }}
    </main>
</body>
</html>
TWIG;
file_put_contents($templateDir . '/kint-screenshot.twig', $template);

echo Json::encode(['frontendRoute' => '/kint-screenshot'], JSON_THROW_ON_ERROR);
