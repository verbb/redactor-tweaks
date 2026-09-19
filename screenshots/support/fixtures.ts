import { readFileSync } from 'node:fs';
import { dirname, join } from 'node:path';
import { fileURLToPath } from 'node:url';

import type { ScreenshotSetupContext } from '@verbb/craft-screenshots/types';

type RedactorTweaksFixture = {
    entryEditRoute: string;
};

const supportDir = dirname(fileURLToPath(import.meta.url));
const seedScript = readFileSync(join(supportDir, 'seed', 'seed-redactor-entry.php'), 'utf8');

/** Seed a genuine Redactor field on a Craft entry. */
export async function seedRedactorTweaksFixture(context: ScreenshotSetupContext): Promise<RedactorTweaksFixture> {
    const output = await context.runCraftScript(seedScript, { label: 'seed-redactor-tweaks' });
    const fixture = JSON.parse(output.trim()) as RedactorTweaksFixture;

    if (!fixture.entryEditRoute) {
        throw new Error(`Invalid Redactor Tweaks fixture payload: ${output}`);
    }

    return fixture;
}
