import { defineScreenshotScenario } from '@verbb/craft-screenshots/api';

import { seedRedactorTweaksFixture } from '../../support/fixtures';

let entryEditRoute = '/admin/entries';

export default defineScreenshotScenario({
    id: 'redactor-tweaks-feature-tour-after',
    output: 'feature-tour/redactor-tweaks-after.png',
    route: () => entryEditRoute,
    viewport: { width: 1180, height: 760, deviceScaleFactor: 2 },
    async setup(context) {
        const fixture = await seedRedactorTweaksFixture(context);
        entryEditRoute = fixture.entryEditRoute;
    },
    waitFor: [
        { type: 'selector', selector: '.redactor-box', state: 'visible', timeout: 30000 },
        { type: 'text', text: 'Write without the clutter' },
    ],
    preSteps: [{ type: 'wait', waitFor: { type: 'timeout', ms: 300 } }],
    target: {
        type: 'selector',
        selector: '.field:has(.redactor-box)',
        padding: { top: 18, right: 0, bottom: 18, left: 0 },
    },
    caption: 'A genuine Redactor field with Redactor Tweaks active in Craft 5.',
    intent: 'Show the more compact toolbar and editing type at the centre of the plugin’s value.',
});
