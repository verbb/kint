import { defineScreenshotScenario } from '@verbb/craft-screenshots/api';

import { seedKintFixture } from '../../support/fixtures';

let frontendRoute = '/';

export default defineScreenshotScenario({
    id: 'kint-feature-tour-debugger',
    output: 'feature-tour/kint-debugger.png',
    route: () => frontendRoute,
    viewport: { width: 1180, height: 820, deviceScaleFactor: 2 },
    async setup(context) {
        const fixture = await seedKintFixture(context);
        frontendRoute = fixture.frontendRoute;
    },
    waitFor: [
        { type: 'loadState', state: 'networkidle' },
        { type: 'selector', selector: '.kint-rich', state: 'visible', timeout: 30000 },
    ],
    steps: [
        { type: 'click', selector: '.kint-rich > dl > dt' },
        { type: 'wait', waitFor: { type: 'timeout', ms: 150 } },
        { type: 'click', selector: ':nth-match(.kint-rich dt:has-text("publishing"), 1)' },
        { type: 'wait', waitFor: { type: 'timeout', ms: 250 } },
    ],
    target: {
        type: 'selector',
        selector: 'main',
        padding: 6,
    },
    caption: 'Kint’s interactive rich renderer exploring a nested value built from a real Craft entry.',
    intent: 'Show the collapsible structure, type details, and nested Craft data that distinguish Kint from a raw dump.',
});
