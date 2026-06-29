<?php

namespace App\Support;

use Illuminate\Support\Str;

class SearchNormalizer
{
    public static function normalize(?string $value): string
    {
        $value = trim((string) $value);

        if ($value === '') {
            return '';
        }

        $normalized = Str::of($value)
            ->ascii()
            ->lower()
            ->replaceMatches('/[^a-z0-9\s#.-]+/', ' ')
            ->replaceMatches('/\s+/', ' ')
            ->trim()
            ->value();

        return $normalized;
    }

    public static function contains(string $haystack, ?string $needle): bool
    {
        $needle = self::normalize($needle);

        if ($needle === '') {
            return true;
        }

        return str_contains(self::normalize($haystack), $needle);
    }
}
