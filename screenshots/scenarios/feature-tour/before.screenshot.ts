import { defineScreenshotScenario } from '@verbb/craft-screenshots/api';

import { seedRedactorTweaksFixture } from '../../support/fixtures';

let entryEditRoute = '/admin/entries';

export default defineScreenshotScenario({
    id: 'redactor-tweaks-feature-tour-before',
    output: 'feature-tour/redactor-tweaks-before.png',
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
    preSteps: [
        {
            type: 'evaluate',
            expression: `
                (() => {
                    for (const stylesheet of document.querySelectorAll('link[rel="stylesheet"]')) {
                        if (new URL(stylesheet.href).pathname.endsWith('/css/redactor-tweaks.css')) {
                            stylesheet.remove();
                        }
                    }
                })();
            `,
        },
        { type: 'wait', waitFor: { type: 'timeout', ms: 300 } },
    ],
    target: {
        type: 'selector',
        selector: '.field:has(.redactor-box)',
        padding: 6,
    },
    caption: 'The same genuine Redactor field with only Redactor’s standard control-panel styling.',
    intent: 'Provide a truthful baseline comparison by disabling only the plugin stylesheet on the live field.',
});
