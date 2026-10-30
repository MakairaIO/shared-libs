<?php

namespace Makaira\Trait;

use function preg_replace;
use function sprintf;
use function strlen;
use function strtolower;
use function strtoupper;
use function substr;
use function trim;

trait LanguageNormalizerTrait
{
    protected function normalizeLanguage(string $language): string
    {
        $trimmed  = trim($language);
        $lowered  = strtolower($trimmed);
        $replaced = preg_replace('/\W/', '-', $lowered);

        return match (strlen((string) $replaced)) {
            4       => sprintf('%s-%s', substr((string) $replaced, 0, 2), strtoupper(substr((string) $replaced, 2, 2))),
            5       => sprintf('%s-%s', substr((string) $replaced, 0, 2), strtoupper(substr((string) $replaced, 3, 2))),
            default => $replaced,
        };
    }
}
