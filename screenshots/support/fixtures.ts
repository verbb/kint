import { readFileSync } from 'node:fs';
import { dirname, join } from 'node:path';
import { fileURLToPath } from 'node:url';

import type { ScreenshotSetupContext } from '@verbb/craft-screenshots/types';

type KintFixture = {
    frontendRoute: string;
};

const supportDir = dirname(fileURLToPath(import.meta.url));
const seedScript = readFileSync(join(supportDir, 'seed', 'seed-kint-page.php'), 'utf8');

/** Seed the entry and project-owned frontend template used by the Kint capture. */
export async function seedKintFixture(context: ScreenshotSetupContext): Promise<KintFixture> {
    const output = await context.runCraftScript(seedScript, { label: 'seed-kint-page' });
    const fixture = JSON.parse(output.trim()) as KintFixture;

    if (!fixture.frontendRoute) {
        throw new Error(`Invalid Kint fixture payload: ${output}`);
    }

    return fixture;
}
